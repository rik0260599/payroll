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
                <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Input Sub Menu Title" value="<?= $submenu['title']; ?>">
                </div>
                <div class="form-group">
                    <label>Menu</label>
                    <select class="form-control" name="menu_id">
                        <option value="">Select Menu</option>
                        <?php foreach ($menu as $men) : ?>
                            <option value="<?= $men['id']; ?>" <?= $men['id'] == $submenu['menu_id'] ? "selected" : null ?>><?= $men['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Input Sub Menu URL" value="<?= $submenu['url']; ?>">
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Input Sub Menu Icon" value="<?= $submenu['icon']; ?>">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" value="<?= $submenu['is_active']; ?>" checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>