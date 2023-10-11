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

            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dtTendik" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>No Rekening</th>
                            <th>Gaji(Rp)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($tendik as $gt) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td class="text-center"><?= tanggal_indonesia2($gt['periode']); ?></td>
                            <td class="text-center"><?= $gt['nip']; ?></td>
                            <td class="text-center"><?= $gt['nama_karyawan']; ?></td>
                            <td class="text-center"><?= $gt['jabatan']; ?></td>
                            <td class="text-center"><?= $gt['golongan']; ?></td>
                            <td class="text-center"><?= $gt['no_rek']; ?> (<?= $gt['nama_bank']; ?>)</td>
                            <td class="text-right"> <?= $gt['total'];?></td>
                            <td class="text-center">
                                <a class="btn btn-outline-primary btn-sm" title="Cetak"
                                    href="<?= base_url('sliptendik/cetakslip/'.$gt['id_gaji_tendik'])?>"><i
                                        class="fas fa-print"></i></a>
                                <a class="btn btn-outline-warning btn-sm" title="Detail"
                                    href="<?= base_url('tendik/detailTendik/'.$gt['id_gaji_tendik'])?>">Detail</a>
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
<!-- Modal Message-->
<div class="modal fade" id="modalMessage" tabindex="-1" aria-labelledby="modalMessageLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalMessageLabel">Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <input type="hidden" id="idGaji">
                                <label id="lblMessage"></label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>