<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
            </div>
        </div>
        <div class="card-body" style="color: #000;">
            <div class="row">
                <div class=" table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th colspan="6" class=" text-center">
                                    <h4>Detail Gaji Tenaga Pendidik<br>
                                        <?= tanggal_indonesia2($tendik['periode']); ?></h4>
                                </th>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?= $tendik['nama_karyawan']; ?></td>
                                <td>Golongan</td>
                                <td>:</td>
                                <td><?= $tendik['golongan']; ?></td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td>:</td>
                                <td><?= $tendik['nip']; ?></td>
                                <td>Periode</td>
                                <td>:</td>
                                <td><?= tanggal_indonesia2($tendik['periode']); ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>Jabatan</td>
                                <td>No Rekenig</td>
                                <td>:</td>
                                <td>Rekening</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="form-group col-md-6">
                        <label>NIP</label>
                        <input type="text" class="form-control" readonly value="<?= $tendik['nip']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Periode</label>
                        <input type="text" class="form-control" readonly
                            value="<?= tanggal_indonesia2($tendik['periode']); ?>">
                    </div> -->
            </div>
            <!-- <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nama</label>
                        <input type="text" class="form-control" readonly value="<?= $tendik['nama_karyawan']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Golongan</label>
                        <input type="text" class="form-control" readonly value="<?= $tendik['golongan']; ?>">
                    </div>
                </div> -->
            <div class="row">
                <div class="col-md">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-left" colspan="2">PENGHASILAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gaji Pokok</td>
                                    <td class="text-right"><?= number_format($tendik['gaji_pokok'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Jabatan Fungsional</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['t_jabatan_fungsional'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Pendidikan Khusus S3</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['t_pendidikan_s3'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Kehadiran dan Makan</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['transport_makan'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Jabatan Struktural</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['t_jabatan_struktural'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Tunjangan Jabatan Rangkap</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['t_jabatan_rangkap'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>BPJS TK (Yayasan)
                                        <?= number_format($tendik['bpjs_yayasan_ketnaker'],2, ".", ","); ?>% <b>*)</b>
                                    </td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_yayasan_ketnaker_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>BPJS Kesehatan (yayasan)
                                        <?= number_format($tendik['bpjs_yayasan_kesehatan'],2, ".", ","); ?>% <b>*)</b>
                                    </td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_yayasan_kesehatan_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Penyesuaian (Transisi)</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['transisi'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <th class=" table-active">Total Penerimaan</th>
                                    <th class="text-right">
                                        <?= $tendik['total']; ?></th>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-md">
                    <div class=" table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-left" colspan="2">POTONGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pajak <b>*)</b></td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>PPH 21 DTP</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>BPJS TK (Pribadi)
                                        <?= number_format($tendik['bpjs_pribadi_ketnaker'],2, ".", ","); ?>%</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_pribadi_ketnaker_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>BPJS Kesehatan (Pribadi)
                                        <?= number_format($tendik['bpjs_pribadi_kesehatan'],2, ".", ","); ?>%</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['bpjs_pribadi_kesehatan_biaya'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Potongan BPJS</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['potongan_bpjs'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <td>Pinjaman</td>
                                    <td class="text-right">
                                        <?= number_format($tendik['pinjaman'],2, ".", ","); ?></td>
                                </tr>
                                <tr>
                                    <th class=" table-active">Total Potongan</th>
                                    <th class="text-right">
                                        <?= $tendik['total']; ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class=" table-responsive">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th class=" table-active">Total Gaji Diterima (<i>Take Home Pay</i>)</th>
                                    <th class="text-right">
                                        <?= $tendik['total']; ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-3">
            <a href="<?= base_url('tendik');?>" class="btn btn-warning btn-sm">Kembali</a>
        </div>
    </div>
</div>