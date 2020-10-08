<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <form method="post" action="<?= base_url('kategori/editproses') ?>">
                <input type="hidden" name="id" value="<?= $row->id ?>">
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="kategori" class="form-control" value="<?= $this->input->post('kategori') ?? $row->kategori ?>" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Harga" class="col-sm-2 col-form-label">Harga/Kg</label>
                    <div class="col-sm-10">
                        <input type="number" name="harga" class="form-control" value="<?= $this->input->post('harga') ?? $row->harga ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="textarea" name="keterangan" class="form-control" value="<?= $this->input->post('keterangan') ?? $row->keterangan ?>" required> 
                        
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>  
                        <a href="<?= site_url('kategori') ?>" class="btn btn-info btn-icon-split">
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