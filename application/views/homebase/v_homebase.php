<!-- Begin Page Content -->
<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?> -->
    <!-- <?= $this->session->flashdata('message'); ?> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
                <a href="#" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top"
                    title="For not send or returned status">Send All to
                    Approval</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th>Fungsional</th>
                            <th>Gaji</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center"><?= tanggal_indonesia2('2023-06-10'); ?></td>
                            <td class="text-center">411100000</td>
                            <td>Rinaldiansyah</td>
                            <td>Teknik Informatika</td>
                            <td>Tenaga Pengajar</td>
                            <td class="text-right">4,000,000.00</td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-info">Not Send</span>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-outline-primary btn-sm">Detail</a>
                                <a class="btn btn-outline-success btn-sm">Send</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->