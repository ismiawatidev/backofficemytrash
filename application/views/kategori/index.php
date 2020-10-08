<body id="page-top">

  <!-- Page Wrapper -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Kategori Sampah</h6>
            </div>
            <div class="card-body">
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Kategori</a>
              <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">Kategori</th>
                      <th style="text-align: center">Harga</th>
                      <th style="text-align: center">Keterangan</th>
                      <th style="text-align: center;width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kategori as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['kategori']; ?></td>
                            <td>Rp.<?= $m['harga'];?>/Kg</td>
                            <td><?= $m['keterangan']; ?></td>
                            <td style="text-align: center">
                                <a href="<?= site_url('kategori/kategoriedit/' . $m['id']) ?>" class="btn btn-info btn-icon-split">
                                  <span class="icon text-white-20">
                                    <i class="fas fa-info-circle"></i>
                                  </span>
                                  <span class="text">Edit</span>
                                </a>
                                <a href="<?= site_url('kategori/kategoridel/' . $m['id']) ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-icon-split">
                                  <span class="icon text-white-20">
                                    <i class="fas fa-trash"></i>
                                  </span>
                                  <span class="text">Delete</span>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kategori'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Sampah" required=""><br>
                        <input type="number" class="form-control" id="Harga" name="harga" placeholder="Harga Per Kg" required=""><br>
                        <input type="textarea" class="form-control" id="Keterangan" name="keterangan" placeholder="Masukan Keterangan Jk di perlukan" required="">
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

</body>
</div>