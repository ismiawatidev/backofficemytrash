<body id="page-top">

  <!-- Page Wrapper -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">Username</th>
                      <th style="text-align: center">Name</th>
                      <th style="text-align: center">Level</th>
                      <th style="text-align: center;width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['email']; ?></td>
                            <td><?= $m['name'];?></td>
                            <td><?= $m['level']; ?></td>
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
</body>
</div>