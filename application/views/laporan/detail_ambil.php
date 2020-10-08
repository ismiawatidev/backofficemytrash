<body id="page-top">
 
  <!-- Page Wrapper -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Ambil</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-striped" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">No.Rekening</th>
                      <th style="text-align: center">Invoice</th>
                      <th style="text-align: center">Ambil</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    $total = 0; ?>
                    <?php foreach ($ambil as $m) : 
                    $total += $m['total']?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td style="text-align: center"><?= $m['no_rek']; ?></td>
                            <td style="text-align: center"><?= $m['invoice'];?></td>
                            <td style="text-align: center">Rp.<?= $m['total']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" style="text-align: right;"><b>Grand Total</b></td>
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