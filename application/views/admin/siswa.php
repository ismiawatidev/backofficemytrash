<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
            <!-- <a href="<?= base_url('admin/siswaregistration'); ?>" class="btn btn-primary mb-3">Add New User</a> -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th width="30px" scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Level</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($siswa as $s) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $s['email']; ?></td>
                            <td><?= $s['name']; ?></td>
                            <td><?= $s['role']; ?></td>
                            <td><img src="<?= base_url('assets/img/profile/') . $s['image']; ?>" width="50px"></td>
                            <td>
                                <!-- <a href="" class="badge badge-success">Edit</a> -->
                                <a href="<?= site_url('admin/siswadel/' . $s['id']); ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->