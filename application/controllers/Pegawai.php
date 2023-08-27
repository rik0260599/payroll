<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
class Pegawai extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }
    public function index()
    {
        if(!access_jabatan("access_read",17)){
            $this->load->view('auth/blocked');
            return false;
        }
        $data['title'] = "Data Pegawai";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $this->load->view('template/header', $data);
        $this->load->view('data/pegawai', $data);
        $this->load->view('template/footer');
    }

    public function addPegawai()
    {
        $data['title'] = "Add Data Pegawai";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['users'] = $this->m_user->getAllUser();
        $data['jabatan'] = $this->m_user->getJabatan();
        $data['role'] = $this->m_user->getRole();

        // $this->form_validation->set_rules('nik_ktp', 'NIK KTP', 'required|numeric');
        // $this->form_validation->set_rules('nik_karyawan', 'NIK Pegawai', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');
        // $this->form_validation->set_rules('name', 'Nama Pegawai', 'required');
        // $this->form_validation->set_rules('email_undira', 'Email Undira', 'required');
        // $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');

        // $this->form_validation->set_rules('address', 'Alamat', 'required');
        // $this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
        // $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        // $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        // $this->form_validation->set_rules('agama', 'Agama', 'required');
        // $this->form_validation->set_rules('status_pernikahan', 'Status', 'required');
        // $this->form_validation->set_rules('nama_bank', 'Bank', 'required');
        // $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|numeric');
        // $this->form_validation->set_rules('npwp', 'NPWP', 'required');
        // $this->form_validation->set_rules('telp', 'No.Hp', 'required|numeric');
        // $this->form_validation->set_rules('nama_darurat', 'Nama Kontak Darurat', 'required');
        // $this->form_validation->set_rules('telp_darurat', 'Telpon Kontak Darurat', 'required|numeric');
        // $this->form_validation->set_rules('no_bpjs_kesehatan', 'No BPJS Kesehatan', 'required|numeric');
        // $this->form_validation->set_rules('no_bpjs_ketenagakerjaan', 'No BPJS Ketenagakerjaan', 'required|numeric');
        // $this->form_validation->set_rules('password', 'Password', 'required');
        // $this->form_validation->set_rules('role_id', 'Role', 'required');
        // $this->form_validation->set_rules('is_active', 'Active', 'required');
        // $this->form_validation->set_rules('tgl_bergabung', 'Tanggal Bergabung', 'required');
        //keluarga
        // $this->form_validation->set_rules('nama_keluarga', 'Nama Keluarga', 'required');
        // $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        // $this->form_validation->set_rules('telp_keluarga', 'Telpon', 'required|numeric');
        //pendidikan
        // $this->form_validation->set_rules('tingkat_pendidikan', 'Tingkat Pendidikan', 'required');
        // $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        // $this->form_validation->set_rules('universitas', 'Universitas', 'required');
        // $this->form_validation->set_rules('alamat_univ', 'Alamat Universitas', 'required');
        // $this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
        // $this->form_validation->set_rules('nama_dospem', 'Nama Dosen Pembimbing', 'required');
        // $this->form_validation->set_rules('url', 'URL', 'required');
        // $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        // $this->form_validation->set_rules('tgl_lulus', 'Tanggal Selesai', 'required'); 
		
        if (!$this->input->post()) {
            $this->load->view('template/header', $data);
            $this->load->view('data/pegawai_add', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_user->addAllPegawai();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pegawai Di Tambahkan !!!</div>');
            redirect('pegawai');
        }
    }

    public function hapusPegawai($id)
    {
        $this->m_user->hapusPegawai($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pegawai di Hapus !!!</div>');
        redirect('pegawai');
    }

    public function detailPegawai()
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Detail Pegawai';
        $data['user'] = $this->m_auth->getUserLogin();
        $data['pegawai'] = $this->m_user->getPegawaiByID($id);
        $data['keluarga'] = $this->m_user->getKeluargaById($id);
        $data['pengalaman'] = $this->m_user->getPengalamanById($id);
        $data['pendidikan'] = $this->m_user->getPendidikanById($id);
        $data['pelatihan'] = $this->m_user->getPelatihanById($id);
        $data['seminar'] = $this->m_user->getSeminarById($id);
        // var_dump($data['keluarga']);

        $this->load->view('template/header', $data);
        $this->load->view('data/pegawai_detail', $data);
        $this->load->view('template/footer');
    }
    public function editPegawai($id)
    {
        $data['title'] = "Edit Data Pegawai";
        $data['user'] = $this->m_auth->getUserLogin();
        $data['jabatan'] = $this->m_jabatan->getAllJabatan();
        $data['role'] = $this->m_admin->getRole();
        $data['pegawai'] = $this->m_user->getPegawaiByID($id);

        // $this->form_validation->set_rules('name', 'Nama Pegawai', 'required');
        // $this->form_validation->set_rules('jabatan_id', 'Jabatan', 'required');
        // $this->form_validation->set_rules('address', 'Alamat', 'required');
        // $this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
        // $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        // $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        // $this->form_validation->set_rules('agama', 'Agama', 'required');
        // $this->form_validation->set_rules('status_pernikahan', 'Status', 'required');
        // $this->form_validation->set_rules('nik_ktp', 'NIK KTP', 'required|numeric');
        // $this->form_validation->set_rules('nik_karyawan', 'NIK Pegawai', 'required');
        // $this->form_validation->set_rules('nama_bank', 'Bank', 'required');
        // $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|numeric');
        // $this->form_validation->set_rules('npwp', 'NPWP', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');
        // $this->form_validation->set_rules('email_undira', 'Email Undira', 'required');
        // $this->form_validation->set_rules('telp', 'No.Hp', 'required|numeric');
        // $this->form_validation->set_rules('nama_darurat', 'Nama Kontak Darurat', 'required');
        // $this->form_validation->set_rules('telp_darurat', 'Telpon Kontak Darurat', 'required|numeric');
        // $this->form_validation->set_rules('no_bpjs_kesehatan', 'No BPJS Kesehatan', 'required|numeric');
        // $this->form_validation->set_rules('no_bpjs_ketenagakerjaan', 'No BPJS Ketenagakerjaan', 'required|numeric');
        // $this->form_validation->set_rules('role_id', 'Role', 'required');
        // $this->form_validation->set_rules('is_active', 'Active', 'required');
        // $this->form_validation->set_rules('tgl_bergabung', 'Tanggal Bergabung', 'required');

        if (!$this->input->post()) {
        	$data['user_jabatan'] = $this->db->query("SELECT * from user_jabatan where user_id = ".$this->session->userdata('user_id'))->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('data/pegawai_edit', $data);
            $this->load->view('template/footer');
        } else {
            $this->m_user->editPegawai();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pegawai Di Edit !!!</div>');
            redirect('pegawai');
        }
    }
	public function approved($id)
	{
		$this->db->set('approval', 'approved');
		$this->db->where('id', $id);
		$this->db->update('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pegawai Di Approved !!!</div>');
        redirect('pegawai');
	}
	public function rejected($id)
	{
		$this->db->set('approval', 'rejected');
		$this->db->where('id', $id);
		$this->db->update('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pegawai Di Rejected !!!</div>');
        redirect('pegawai');
	}
	public function import()
	{
		$this->load->library('excel');
		if(isset($_FILES["file"]["name"])) {
			//upload 
			$file_tmp = $_FILES['file']['tmp_name'];
			$file_name = $_FILES['file']['name'];
			$file_size =$_FILES['file']['size'];
			$file_type=$_FILES['file']['type'];

			$object = PHPExcel_IOFactory::load($file_tmp);
        
			foreach($object->getWorksheetIterator() as $worksheet){

				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row=2; $row<=$highestRow; $row++){
	
					$name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$jabatan_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$address = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$tempat_lahir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$tanggal_lahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$jenis_kelamin = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$agama = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$status_pernikahan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$nik_ktp = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$nik_karyawan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$nama_bank = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$no_rek = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$npwp = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$email_undira = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$telp = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$nama_darurat = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$telp_darurat = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$no_bpjs_kes = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$no_bpjs_ket = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$jenis_pegawai = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					$image = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
					$password = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
					$role_id = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
					$is_active = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
					$tgl_bergabung = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
					$created_at = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
					$approval = $worksheet->getCellByColumnAndRow(27, $row)->getValue();

					$data[] = array(
						'name'          				=> $name,
						'jabatan_id'          			=> $jabatan_id,
						'address'         				=> $address,
						'tmpt_lahir'					=> $tempat_lahir,
						'tgl_lahir'						=> $tanggal_lahir,
						'jenis_kelamin'					=> $jenis_kelamin,
						'agama'							=> $agama,
						'status_pernikahan'				=> $status_pernikahan,
						'nik_ktp'						=> $nik_ktp,
						'nik_karyawan'					=> $nik_karyawan,
						'nama_bank'						=> $nama_bank,
						'no_rek'						=> $no_rek,
						'npwp'							=> $npwp,
						'email'							=> $email,
						'email_undira'					=> $email_undira,
						'telp'							=> $telp,
						'nama_darurat'					=> $nama_darurat,
						'telp_darurat'					=> $telp_darurat,
						'no_bpjs_kesehatan'				=> $no_bpjs_kes,
						'no_bpjs_ketenagakerjaan'		=> $no_bpjs_ket,
						'jenis_pegawai'					=> $jenis_pegawai,
						'image'							=> $image,
						'password'						=> $password,
						'role_id'						=> $role_id,
						'is_active'						=> $is_active,
						'tgl_bergabung'					=> $tgl_bergabung,
						'created_at'					=> $created_at,
						'approval'						=> $approval
					);
	
				} 

			}
			
			$this->db->insert_batch('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Import Pegawai Berhasil !!!</div>');
        	redirect('pegawai');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Import Pegawai Gagal !!!</div>');
        	redirect('pegawai');
		}
	}

	public function export()
	{
		$th = [
			'font' => [
				'color' => [
					'rgb' => 'FFFFFF'
				],
				'bold' => true,
				'size'=> 11
			],
			'fill' => [
				'fillType' => Fill::FILL_SOLID,
				'startColor' => [
					'rgb' => '0077b6'
				],
			],
		];
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		//title
		$sheet->setCellValue('A1', 'Data Pegawai');
		$sheet->mergeCells('A1:Y1');
		$sheet->getStyle('A1')->getFont()->setSize('20');
		$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

		//column
		$sheet->getColumnDimension('A')->setWidth(19);
		$sheet->getColumnDimension('B')->setWidth(19);
		$sheet->getColumnDimension('C')->setWidth(32);
		$sheet->getColumnDimension('D')->setWidth(19);
		$sheet->getColumnDimension('E')->setWidth(14);
		$sheet->getColumnDimension('F')->setWidth(14);
		$sheet->getColumnDimension('G')->setWidth(12);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(28);
		$sheet->getColumnDimension('J')->setWidth(25);
		$sheet->getColumnDimension('K')->setWidth(15);
		$sheet->getColumnDimension('L')->setWidth(18);
		$sheet->getColumnDimension('M')->setWidth(21);
		$sheet->getColumnDimension('N')->setWidth(25);
		$sheet->getColumnDimension('O')->setWidth(25);
		$sheet->getColumnDimension('P')->setWidth(19);
		$sheet->getColumnDimension('Q')->setWidth(20);
		$sheet->getColumnDimension('R')->setWidth(19);
		$sheet->getColumnDimension('S')->setWidth(26);
		$sheet->getColumnDimension('T')->setWidth(27);
		$sheet->getColumnDimension('U')->setWidth(21);
		$sheet->getColumnDimension('V')->setWidth(21);
		$sheet->getColumnDimension('W')->setWidth(19);
		$sheet->getColumnDimension('X')->setWidth(19);
		$sheet->getColumnDimension('Y')->setWidth(19);

		//title head
		$sheet->setCellValue('A2', 'Nama');
		$sheet->setCellValue('B2', 'Jabatan');
		$sheet->setCellValue('C2', 'Alamat');
		$sheet->setCellValue('D2', 'Tempat Lahir');
		$sheet->setCellValue('E2', 'Tanggal Lahir');
		$sheet->setCellValue('F2', 'Jenis Kelamin');
		$sheet->setCellValue('G2', 'Agama');
		$sheet->setCellValue('H2', 'Status Pernikahan');
		$sheet->setCellValue('I2', 'NIK KTP');
		$sheet->setCellValue('J2', 'NIK Karyawan');
		$sheet->setCellValue('K2', 'Nama Bank');
		$sheet->setCellValue('L2', 'No Rekening');
		$sheet->setCellValue('M2', 'NPWP');
		$sheet->setCellValue('N2', 'Email');
		$sheet->setCellValue('O2', 'Email Undira');
		$sheet->setCellValue('P2', 'Telepon');
		$sheet->setCellValue('Q2', 'Nama Darurat');
		$sheet->setCellValue('R2', 'Telp Darurat');
		$sheet->setCellValue('S2', 'No BPJS Kesehatan');
		$sheet->setCellValue('T2', 'No BPJS Ketenagakerjaan');
		$sheet->setCellValue('U2', 'Jenis Pegawai');
		$sheet->setCellValue('V2', 'Role');
		$sheet->setCellValue('W2', 'Status');
		$sheet->setCellValue('X2', 'Tanggal Bergabung');
		$sheet->setCellValue('Y2', 'Approval');
		$sheet->getStyle('A2:Y2')->applyFromArray($th);

		$query = $this->m_user->query_excel();
		// var_dump($query);die;

		//looping data
		$row = 3;
		foreach($query as $value) {
			if($value->is_active = 1) {
				$value_is_active = 'aktif';
			} else {
				$value_is_active = 'non aktif';
			}
			$sheet->setCellValue('A'. $row, $value->name);
			$sheet->setCellValue('B'. $row, $value->jabatan);
			$sheet->setCellValue('C'. $row, $value->address);
			$sheet->setCellValue('D'. $row, $value->tmpt_lahir);
			$sheet->setCellValue('E'. $row, $value->tgl_lahir);
			$sheet->setCellValue('F'. $row, $value->jenis_kelamin);
			$sheet->setCellValue('G'. $row, $value->agama);
			$sheet->setCellValue('H'. $row, $value->status_pernikahan);
			$sheet->setCellValue('I'. $row, $value->nik_ktp);
			$sheet->setCellValue('J'. $row, $value->nik_karyawan);
			$sheet->setCellValue('K'. $row, $value->nama_bank);
			$sheet->setCellValue('L'. $row, $value->no_rek);
			$sheet->setCellValue('M'. $row, $value->npwp);
			$sheet->setCellValue('N'. $row, $value->email);
			$sheet->setCellValue('O'. $row, $value->email_undira);
			$sheet->setCellValue('P'. $row, $value->telp);
			$sheet->setCellValue('Q'. $row, $value->nama_darurat);
			$sheet->setCellValue('R'. $row, $value->telp_darurat);
			$sheet->setCellValue('S'. $row, $value->no_bpjs_kesehatan);
			$sheet->setCellValue('T'. $row, $value->no_bpjs_ketenagakerjaan);
			$sheet->setCellValue('U'. $row, $value->jenis_pegawai);
			$sheet->setCellValue('V'. $row, $value->role);
			$sheet->setCellValue('W'. $row, $value_is_active);
			$sheet->setCellValue('X'. $row, $value->tgl_bergabung);
			$sheet->setCellValue('Y'. $row, $value->approval);

			$row++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = 'data-pegawai';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');

	}
}
