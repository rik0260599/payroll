<!-- Begin Page Content -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?> -->
    <!-- <?= $this->session->flashdata('message'); ?> -->
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="approvalTendik" href="<?=base_url('approve');?>" role="tab"
                    aria-controls="v-pills-home">Gaji Tendik <span
                        class="badge badge-warning"><?= $count_tendik;?></span></a>
                <!-- <a class="nav-link" id="approvalHomebase" href="<?=base_url('approve/homebase');?>" role="tab"
                    aria-controls="v-pills-profile">Gaji Dosen Homebase <span class="badge badge-warning">5</span></a> -->
            </div>

        </div>


        <div class="col-9" id="approvalTendik">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex">
                        <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?> Tendik</h6>
                        <!-- <a href="#" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top"
                            title="Untuk yang belum submit">Approve All</a> -->
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dtApproveTendik" id="dataTable" width="100%" cellspacing="0">
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
                                            href="<?= base_url('approve/detailapprovetendik/'. $gt['id_gaji_tendik'])?>">Detail</a>
                                        <a class="btn btn-outline-success btn-sm"
                                            href="<?= base_url('approve/approvegajitendik/'. $gt['id_gaji_tendik'])?>"
                                            name="approve" id="<?=$gt['id_gaji_tendik']?>">Approve</a>
                                        <a class="btn btn-outline-danger btn-sm" name="reject"
                                            id="<?=$gt['id_gaji_tendik']?>">Reject</a>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add-->
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
                            <div class="alert alert-danger alert-dismissible fade show" id="alertNotes" role="alert">
                                <strong>Perhatian!</strong> "Note" harus diisi!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="idGaji">
                                <textarea name="txtMessage" id="txtMessage" class="form form-control" rows="5"
                                    onkeydown="MessageInput(this.value, this.maxlength )"
                                    onkeyup="MessageInput(this.value, this.maxlength )" maxlength="255"
                                    placeholder="Note . . ."></textarea>
                                <span class=" float-right text-secondary"><label id="lblCount">0</label>/255</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="button" id="btnApprove" name="btnApprove" class="btn btn-outline-success btn-sm"
                        value="Approve">
                    <input type="button" id="btnReject" name="btnReject" class="btn btn-outline-danger btn-sm"
                        value="Reject">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script>
function MessageInput(e, l) {
    var k = e.which == 0 ? e.keyCode : e.which;
    //alert(k);
    if (k == 8 || k == 37 || k == 39 || k == 46) return true;

    var maxlength = l;
    document.getElementById("lblCount").innerHTML = e.length;
    if (e.length >= maxlength) {
        return false;
    }
    return true;
}
</script>