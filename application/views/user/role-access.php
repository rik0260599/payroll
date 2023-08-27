<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <h5>Jabatan : </h5>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Title</th>
                            <th>Access Read</th>
                            <th>Access Create</th>
                            <th>Access Update</th>
                            <th>Access Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($user_access_menu as $men) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $men['menu']; ?></td>
                                <td><?= $men['title']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <?php $same = 0 ?>
                                        <?php foreach($access_jabatan as $access): ?>
                                            <?php 
                                                if(
                                                    $men['id'] == $access['id_user_sub_menu'] && 
                                                    $access['access_read'] == 1 && 
                                                    $this->uri->segment(3) == $access['id_jabatan']
                                                ):
                                                    $same = 1;
                                                    break;
                                             else:
                                                $same = 0;
                                             endif ?>
                                        <?php endforeach ?>
                                                <input <?= $same == 1 ? 'checked' : ''?> class="check-access" type="checkbox" 
                                                data-type="access_read"
                                                data-submenu="<?= $men['id'] ?>"
                                                data-idjabatan="<?= $this->uri->segment(3) ?>"
                                                >
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <?php $same = 0 ?>
                                        <?php foreach($access_jabatan as $access): ?>
                                            <?php 
                                                if(
                                                    $men['id'] == $access['id_user_sub_menu'] && 
                                                    $access['access_create'] == 1 && 
                                                    $this->uri->segment(3) == $access['id_jabatan']
                                                ):
                                                    $same = 1;
                                                    break;
                                             else:
                                                $same = 0;
                                             endif ?>
                                        <?php endforeach ?>
                                                <input <?= $same == 1 ? 'checked' : ''?> class="check-access" type="checkbox" 
                                                data-type="access_create"
                                                data-submenu="<?= $men['id'] ?>"
                                                data-idjabatan="<?= $this->uri->segment(3) ?>"
                                                >
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <?php $same = 0 ?>
                                        <?php foreach($access_jabatan as $access): ?>
                                            <?php 
                                                if(
                                                    $men['id'] == $access['id_user_sub_menu'] && 
                                                    $access['access_update'] == 1 && 
                                                    $this->uri->segment(3) == $access['id_jabatan']
                                                ):
                                                    $same = 1;
                                                    break;
                                             else:
                                                $same = 0;
                                             endif ?>
                                        <?php endforeach ?>
                                                <input <?= $same == 1 ? 'checked' : ''?> class="check-access" type="checkbox" 
                                                data-type="access_update"
                                                data-submenu="<?= $men['id'] ?>"
                                                data-idjabatan="<?= $this->uri->segment(3) ?>"
                                                >
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <?php $same = 0 ?>
                                        <?php foreach($access_jabatan as $access): ?>
                                            <?php 
                                                if(
                                                    $men['id'] == $access['id_user_sub_menu'] && 
                                                    $access['access_delete'] == 1 && 
                                                    $this->uri->segment(3) == $access['id_jabatan']
                                                ):
                                                    $same = 1;
                                                    break;
                                             else:
                                                $same = 0;
                                             endif ?>
                                        <?php endforeach ?>
                                                <input <?= $same == 1 ? 'checked' : ''?> class="check-access" type="checkbox" 
                                                data-type="access_delete"
                                                data-submenu="<?= $men['id'] ?>"
                                                data-idjabatan="<?= $this->uri->segment(3) ?>"
                                                >
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->