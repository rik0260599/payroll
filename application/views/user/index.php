<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex">
                        <h6 class="m-0 font-weight-bold text-primary mr-auto p-2">Slip Gaji Terbaru</h6>
                    </div>
                </div>
                <div class="card-body" style="color: #000;">
                    <div class="row">
                        <div class=" table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>422290888</td>
                                        <td>Golongan</td>
                                        <td>:</td>
                                        <td>Golongan 4</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>Nugraha</td>
                                        <td>Periode</td>
                                        <td>:</td>
                                        <td>10 Juni 2023</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-sm">
                                <table class="table table-bordered table-sm" width="20%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Keterangan</th>
                                            <th class="text-center">Biaya(Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Gaji Pokok</td>
                                            <td class="text-right">
                                                4,000,000.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="table-active">Tunjangan</th>
                                        </tr>
                                        <tr>
                                            <td>Tunjangan Jabatan Fungsional</td>
                                            <td class="text-right">
                                                0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tunjangan Pendidikan S3</td>
                                            <td class="text-right">
                                                0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Tunjangan Jabatan Struktural</td>
                                            <td class="text-right">
                                                0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Tunjangan Jabatan Rangkap</td>
                                            <td class="text-right">
                                                0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Transport dan Makan</td>
                                            <td class="text-right">
                                                1,000,000.00</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="table-active">BPJS</th>
                                        </tr>
                                        <tr>
                                            <td>Ketenagakerjaan (yayasan)
                                                0%
                                            </td>
                                            <td class="text-right">
                                                0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesehatan (yayasan)
                                                0%
                                            </td>
                                            <td class="text-right">
                                                0.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ketenagakerjaan (pribadi)
                                                0%
                                            </td>
                                            <td class="text-right">
                                                0,00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kesehatan (pribadi)
                                                0%
                                            </td>
                                            <td class="text-right">
                                                0,00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Potongan BPJS</td>
                                            <td class="text-right">
                                                - 0,00</td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="table-active">Lainnya</th>
                                        </tr>
                                        <tr>
                                            <td>Kenaikan Transisi</td>
                                            <td class="text-right">
                                                0,00</td>
                                        </tr>
                                        <tr>
                                            <td>Pinjaman</td>
                                            <td class="text-right">
                                                - 0,00</td>
                                        </tr>
                                        <tr>
                                            <th class=" table-active">Total dibayarkan</th>
                                            <th class="text-right">
                                                5,000,000.00</th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Row -->
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
        <?= $this->session->flashdata('message'); ?>

        <?php if(access_jabatan("access_read",3)): ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex">
                    <h6 class="m-0 font-weight-bold text-primary mr-auto p-2">Data Pinjaman</h6>
                    <!-- <a href="<?= base_url('jabatan/addJabatan'); ?>" class="btn btn-outline-primary btn-md">Add New Jabatan</a> -->
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Jumlah Pinjaman (Rp)</th>
                                <th>Tanggal Pinjaman</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-right">2,000,000.00</td>
                                <td>30 Mei 2023</td>
                                <td>Belum Lunas</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif ?>
        <!-- /.container-fluid -->
    </div>