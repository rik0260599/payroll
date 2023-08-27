<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Menu</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary mr-auto p-2">Edit Menu</h6>
            </div>
        </div>
        <div class="card-body" style="color: #000;">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                <div class="form-group">
                    <label for="menu">Menu</label>
                    <input type="text" name="menu" class="form-control" id="menu" value="<?= $menu['menu']; ?>">
                    <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                <a href="<?= base_url('menu'); ?>" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>