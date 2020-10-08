<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form method="post" action="<?= base_url('nasabah/editproses') ?>">
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" value="<?= $row->nama?>" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" value="<?= $this->input->post('alamat') ?? $row->alamat ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-2 col-form-label">No_hp</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_hp" class="form-control" value="<?= $this->input->post('no_hp') ?? $row->no_hp ?>" required>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>  
                        <a href="<?= site_url('nasabah') ?>" class="btn btn-info btn-icon-split">
                                  <span class="icon text-white-20">
                                    <i class="fas fa-info-back"></i>
                                  </span>
                                  <span class="text">Back</span>
                                </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->