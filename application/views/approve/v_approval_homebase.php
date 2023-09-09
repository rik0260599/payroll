<!-- Begin Page Content -->

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?> -->
    <!-- <?= $this->session->flashdata('message'); ?> -->
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="approvalTendik" href="<?=base_url('approve');?>" role="tab"
                    aria-controls="v-pills-home">Gaji Tendik <span
                        class="badge badge-warning"><?= $count_tendik;?></span></a>
                <a class="nav-link active" id="approvalHomebase" href="<?=base_url('approve/homebase');?>" role="tab"
                    aria-controls="v-pills-profile">Gaji Dosen Homebase <span class="badge badge-warning">5</span></a>
            </div>

        </div>


        <div class="col-9" id="approvalTendik">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex">
                        <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?> Dosen Homebase</h6>
                        <a href="#" class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top"
                            title="Untuk yang belum submit">Send All to
                            Approval</a>
                    </div>

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->