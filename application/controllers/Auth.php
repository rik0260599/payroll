<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Google\Client as GoogleClient;
use Google\Service\Oauth2;

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email_undira')) {
            redirect('setting');
        }
        $this->form_validation->set_rules('email_undira', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Payroll Undira";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $emailUndira = $this->input->post('email_undira');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email_undira' => $emailUndira])->row_array();
        //cek user
        if ($user) {
            //cek jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'jabatan_id' => $user['jabatan_id'],
                        'email_undira' => $user['email_undira'],
						'user_id' => $user['id'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('staf');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Anda Salah !!!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Anda Sedang di Nonaktifkan !!!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Password anda salah !!!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email_undira');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('jabatan_id');
        $this->session->unset_userdata('user_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out !!!</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $data['title'] = "404";
        $this->load->view('auth/blocked');
    }
    public function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'hengkyundira@gmail.com',
            'smtp_pass' => 'stkutxfvxkwhhdan',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('hengkyundira@gmail.com', 'Hengky IT Undira');
        $this->email->to($this->input->post('email_undira'));
        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email_undira=' . $this->input->post('email_undira') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    public function forgotPassword()
    {
        $this->form_validation->set_rules('email_undira', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Forgot Password";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('auth/footer');
        } else {
            $emailUndira = $this->input->post('email_undira');
            $user = $this->db->get_where('user', ['email_undira' => $emailUndira, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $emailUndira,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password !!!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak ditemukan atau tidak aktif !!!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $emailUndira = $this->input->get('email_undira');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email_undira' => $emailUndira])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $emailUndira);
                    $this->changePassword();
                } else {
                    $this->db->delete('user_token', ['email' => $emailUndira]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal !!! Token Expired !!!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal !!! Token Salah !!!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal !!! Email Salah !!!</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1',  'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2',  'Repeat Password', 'required|trim|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Change Password";
            $this->load->view('auth/header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('auth/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $emailUndira = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email_undira', $emailUndira);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->db->delete('user_token', ['email' => $emailUndira]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah di Ganti !!! Silahkan Login.</div>');
            redirect('auth');
        }
    }

	public function swap_sidebar()
	{
		$user_id = $this->input->post('user_id');
		$role_id = explode('--', $this->input->post('role_id'))[0];
        $jabatan_id = explode('--', $this->input->post('role_id'))[1];
		$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
		
		// var_dump($role_id);die;
		$this->session->unset_userdata('email_undira');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('jabatan_id');
        $this->session->unset_userdata('user_id');

		$data = [
			// 'user_id' => $user['id'],
			'email_undira' => $user['email_undira'],
			'user_id' => $user['id'],
			'role_id' => $role_id,
            'jabatan_id' => $jabatan_id
		];
		$this->session->set_userdata($data);
		if ($role_id == 1) {
			redirect('admin');
		} elseif ($role_id == 2) {
			redirect('staf');
		} else {
			redirect('user');
		}
	}

	public function login_google()
	{
		$email_input = $this->input->get('email_undira');
		$session_email = [
			'email_input' => $email_input
		];
        $_SESSION['email'] = $this->input->get('email_undira');
		$this->session->set_userdata($session_email);
		$email_input2 = $this->session->userdata('email_input');
		$client = new GoogleClient();
		$client->setApplicationName('Simkar');
		$client->setClientId('643843687412-2slkbhvebvgv88ukr05q3g3rie3jq0b8.apps.googleusercontent.com');
		$client->setClientSecret('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');
		$client->setRedirectUri('http://localhost/simkar/auth/login_google');
		$client->addScope(['https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile']);
		if($code = $this->input->get('code')) {
			$token = $client->fetchAccessTokenWithAuthCode($code);
			$client->setAccessToken($token);
			$oauth2 = new Oauth2($client);
			$user_info  = $oauth2->userinfo->get();
			$value['name'] = $user_info->name;
            $value['jabatan_id'] = $user_info->jabatan_id;
			$value['email_undira'] = $user_info->email;
			$value['image'] = $user_info->picture;
			$value['role_id'] = 3;
			$get_user = $this->db->get_where('user', ['email_undira' => $user_info->email])->row();
            
			if(!$get_user) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email yang anda inputkan tidak valid!.</div>');
				redirect('auth');
                return false;
			}
            if (!str_contains($user_info->email, "gmail.com")) { 
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email yang anda inputkan tidak valid!.</div>');
                redirect('auth');
                return false;
            }
			$get_user = $this->db->get_where('user', ['email_undira' => $user_info->email])->row_array();
			$session = [
				'email_undira' => $get_user['email_undira'],
				'user_id' => $get_user['id'],
				'role_id' => $get_user['role_id'],
                'jabatan_id' => $get_user['jabatan_id']
			];
			
			$this->session->set_userdata($session);
			if ($get_user['role_id'] == 1) {
				redirect('admin');
			} elseif ($get_user['role_id'] == 2) {
				redirect('staf');
			} else {
				redirect('user');
			}
			
		} else {
	
			$url = $client->createAuthUrl();
			header('Location:'.filter_var($url,FILTER_SANITIZE_URL));
		}
	}

    public function setLogin(){
        var_dump($_SESSION);die;
    }
}
