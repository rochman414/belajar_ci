<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-sm-12">
            <div>
                <a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#addMenu">Add Sub Menu</a>
                <?= form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
                <?php
                if ($this->session->flashdata('message')) {
                    $sukses = $this->session->flashdata('message');
                    echo $sukses;
                }
                ?>
            </div>

            <table class="table table-sm table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col" class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($submenu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $m['title']; ?></td>
                            <td><?= $m['menu']; ?></td>
                            <td><?= $m['url']; ?></td>
                            <td><?= $m['icon']; ?></td>
                            <td><?= $m['is_active']; ?></td>
                            <td class="float-right">
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#editModal<?= $m['id'] ?>"><i class="fas fa-fw fa-edit"></i></a>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="second group">
                                        <a class="btn btn-sm btn-danger delete_lead" href="<?= base_url('menu/hapus/') . $m['id'] ?>"><i class="fas fa-fw fa-trash"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal add-->
<div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenuTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuTitle">Added new menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/tambahMenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="menu" id="menu" class="form-control" placeholder="Add New Menu">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- modal edit -->

<?php foreach ($submenu as $m) : ?>

    <div class="modal fade" id="editModal<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/update') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="title">Title </label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="hidden" readonly clas="form-control" name="id" id="id" value="<?= $m['id'] ?>">
                                <input type="text" class="form-control" id="title" name="title" value="<?= $m['title'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="url">URL </label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" id="url" name="url" value="<?= $m['url'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="icon">Icon :</label>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" id="icon" name="icon" value="<?= $m['icon'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="menu_id">Select Menu </label>
                            </div>
                            <div class="form-group col-md-10">
                                <select name="menu_id" id="menu_id" class="form-control">
                                    <?php foreach ($menu as $mn) : ?>
                                        <?php if ($m['menu_id'] == $mn['id']) : ?>
                                            <option value="<?= $mn['id'] ?>" selected><?= $mn['menu'] ?></option>
                                        <?php endif; ?>
                                        <option value="<?= $mn['id'] ?>"><?= $mn['menu'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class=" form-row">
                        <div class="container">
                            <div class="modal-footer">

                                <div class="form-group float-right">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



        </div>
    </div>
    </div>
<?php endforeach; ?>