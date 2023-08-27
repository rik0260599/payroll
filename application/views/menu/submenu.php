<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= validation_errors(); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2"><?= $title; ?></h6>
                <a href="#" class="btn btn-outline-primary btn-md" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub Menu</a>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="text-center">
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>Menu</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody class="text-center">
                        <?php $i = 1; ?>
                        <?php foreach ($submenu as $submen) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $submen['title']; ?></td>
                                <td><?= $submen['menu']; ?></td>
                                <td><?= $submen['url']; ?></td>
                                <td><?= $submen['icon']; ?></td>
                                <td><?= $submen['is_active']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>menu/editsubmenu/<?= $submen['id']; ?>" class="btn btn-outline-success btn-sm">Edit</a>
                                    <a href="<?= base_url(); ?>menu/hapussubmenu/<?= $submen['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('yakin?');">Delete</a>
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

<!-- Modal Add-->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Input Sub Menu Title">
                    </div>
                    <div class="form-group">
                        <label>Menu</label>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $men) : ?>
                                <option value="<?= $men['id']; ?>"><?= $men['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Input Sub Menu URL">
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Input Sub Menu Icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>