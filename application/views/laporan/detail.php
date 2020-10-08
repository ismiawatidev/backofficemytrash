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
                <table class="table table-hover table-striped" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">Kategori</th>
                      <th style="text-align: center">Berat</th>
                      <th style="text-align: center">Harga</th>
                      <th style="text-align: center">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    $total = 0; ?>
                    <?php foreach ($tabung as $m) : 
                      $total +=$m['total'];?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td style="text-align: center"><?= $m['kategori']; ?></td>
                            <td style="text-align: center"><?= $m['berat'];?> Kg</td>
                            <td style="text-align: center">Rp.<?= $m['harga']; ?></td>
                            <td style="text-align: center">Rp.<?= $m['total']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" style="text-align: right;"><b>Grand Total</b></td>
                      <td style="text-align: center">Rp. <?=$total ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

        </div>

</body>
</div>