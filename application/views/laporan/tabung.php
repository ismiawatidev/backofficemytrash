<body id="page-top">
 
  <!-- Page Wrapper -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Tabung</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">ID Invoice</th>
                      <th style="text-align: center">No Rekening</th>
                      <th style="text-align: center">Total</th>
                      <th style="text-align: center">Tgl</th>
                      <th style="text-align: center;width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($tabung as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['invoice']; ?></td>
                            <td><?= $m['no_rek'];?></td>
                            <td>Rp.<?= $m['total']; ?></td>
                            <td><?= $m['tgl']; ?></td>
                            <td style="text-align: center">
                            <a href="<?= site_url('laporan/detail/' . $m['invoice']) ?>" class="btn btn-info btn-icon-split">
                              <span class="icon text-white-20">
                                <i class="fas fa-info-circle"></i>
                              </span>
                              <span class="text">Detail</span>
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