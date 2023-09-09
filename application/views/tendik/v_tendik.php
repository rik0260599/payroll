<!-- Begin Page Content -->
<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?> -->
    <!-- <?= $this->session->flashdata('message'); ?> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <a href="<?= base_url('tendik/getGajiTendikFromOut')?>" class="btn btn-success btn-md"
                    data-toggle="tooltip" data-placement="top" title="Untuk yang belum submit">Get Gaji</a>
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
                <a href="#" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top"
                    title="Untuk yang belum submit">Send All to
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>No Rekening</th>
                            <th>Gaji(Rp)</th>
                            <th>Status</th>
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
                                <?php if($gt['status']=="0"){?>
                                <span class="badge badge-pill badge-info">Belum Submit</span>
                                <?php }elseif($gt['status']=="1"){?>
                                <span class="badge badge-pill badge-warning">Proses Approval</span>
                                <?php }elseif($gt['status']=="2"){?>
                                <span class="badge badge-pill badge-success">Disetujui</span>
                                <?php }elseif($gt['status']=="3"){?>
                                <span class="badge badge-pill badge-danger">Ditolak</span>
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-outline-primary btn-sm"
                                    href="<?= base_url('tendik/detailtendik/'. $gt['id_gaji_tendik'])?>">Detail</a>
                                <?php if($gt['status']=="0"){?>
                                <a href="<?= base_url('tendik/sendForApproval/'. $gt['id_gaji_tendik'])?>"
                                    class="btn btn-outline-success btn-sm">Send</a>
                                <?php }?>

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