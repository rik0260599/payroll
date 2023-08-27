<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <?php if(access_jabatan("access_read",32)): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Periode Gaji</th>
                            <th>NIK Pegawai</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Gaji Bersih</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Periode Gaji</th>
                            <th>NIK Pegawai</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Gaji Bersih</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody class="text-center">
                        <tr>
                            <td>1</td>
                            <td>31 Desember 2022</td>
                            <td>1234</td>
                            <td>Athiyyah Nadiya</td>
                            <td>SDM</td>
                            <td>Rp.8.500.000</td>
                            <td><span class="badge badge-pill badge-success ">Lunas</span></td>
                            <td>
                                <a href="" class="btn btn-outline-info btn-sm">detail</a>
                                <a href="" class="btn btn-outline-success btn-sm">download</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif ?>

</div>
<!-- /.container-fluid -->