<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-7">
            <div>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMenu">Add Menu</a>
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
                        <th scope="col">Menu</th>
                        <th scope="col" class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $m['menu']; ?></td>
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

<?php foreach ($menu as $m) : ?>

    <div class="modal fade" id="editModal<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/update') ?>" method="post">

                    <div class="modal-body">
                        <input type="hidden" readonly name="id" id="id" value="<?= $m['id'] ?>">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>