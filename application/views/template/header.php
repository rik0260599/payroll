<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- css pribadi -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-calculator"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Payroll<sup>Undira</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                            WHERE `user_access_menu`.`role_id` = $role_id 
                            ORDER BY `user_access_menu`.`menu_id` ASC
                        ";
            $menu = $this->db->query($queryMenu)->result_array();

            ?>

            <!-- Heading -->
            <?php foreach ($menu as $men) : ?>
            <!-- menu utama -->
            <div class="sidebar-heading">
                <?= $men['menu']; ?>
            </div>
            <!-- sub menu -->
            <?php
                $menuId = $men['id'];
                $querySubMenu = "SELECT user_sub_menu.*,user_menu.menu
                                    FROM `user_sub_menu` JOIN `user_menu`
                                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                    WHERE `user_sub_menu`.`menu_id` = $menuId
                                    AND `user_sub_menu`.`is_active` = 1
                                ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
            <?php foreach ($subMenu as $submen) : ?>
            <?php if ($title == $submen['title']) : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <?php else : ?>
            <li class="nav-item">
                <?php endif ?>
                <?php if(access_jabatan("access_read",$submen['id'])): ?>
                <a class="nav-link pb-0" href="<?= base_url($submen['url']); ?>">
                    <i class="<?= $submen['icon']; ?>"></i>
                    <span><?= $submen['title']; ?></span>
                </a>
                <?php endif ?>
            </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-3">
            <?php endforeach; ?>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <?php 
							$user_id = $this->session->userdata('user_id');
							$data_jabatan = $this->db->select('user_jabatan.*, master_jabatan.jabatan, master_jabatan.role_id')
												->from('master_jabatan')
												->join('user_jabatan', 'user_jabatan.jabatan_id = master_jabatan.id_jabatan')
												->where('user_jabatan.user_id', $user_id)
												->get()->result();
						?>

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chevron-down fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-400 navbar-search" method="post"
                                    action="<?= base_url('Auth/swap_sidebar') ?>">
                                    <div class="input-group" style="width: 350px">
                                        <input type="hidden" value="<?= $user_id ?>" name="user_id">
                                        <select name="role_id" class="form-control" id="">
                                            <?php foreach($data_jabatan as $value) { ?>
                                            <option <?php if ($role_id == $value->role_id) {
															echo "selected=\"selected\"";
														} ?> value="<?= $value->role_id.'--'.$value->jabatan_id ?>"><?= $value->jabatan ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-save fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="<?= base_url('setting'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <a class="dropdown-item" href="<?= base_url('setting/changepassword'); ?>">
                                    <i class="fas fa-user-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->