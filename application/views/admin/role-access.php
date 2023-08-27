<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <h5>Role : <?= $role['role']; ?></h5>

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
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Access</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $men) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $men['menu']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $men['id']); ?>data-role="<?= $role['id']; ?>" data-menu="<?= $men['id']; ?>">
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