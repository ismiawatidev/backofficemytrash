<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin</div>
              <a href="<?= base_url('user/datauser'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">User</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="<?= base_url('nasabah'); ?>">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Nasabah</div>
              <span class="h5 mb-0 font-weight-bold text-gray-800"><?=$nasabah ?> Nasabah</span>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    </a>
  
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaksi</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="<?= base_url('transaksi/tabung'); ?>" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Menabung</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menu</div>
              <a href="<?= base_url('menu/submenu'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Submenu Management</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="row">

            <div class="col-xl-8 col-yl-8 col-lg-7">

              <!-- Area Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <div id="graph" style="height: 370px; width: 100%;"></div>
                  </div>
                  <hr>
                </div>
              </div>

            </div>

<div class="col-lg-5 col-xl-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Top 5</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <table class="table table-responsive table-striped">
                    <tbody>
                     <?php $i = 1; ?>
                    <?php foreach ($tops as $s) : ?>
                        <tr>
                            <th scope="row">#<?= $i; ?>.</th>
                            <td><?= $s['nama']; ?></td>
                            <td><?= $s['saldo']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                  </tbody>
                  </table>
                  </div>                  
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Qty Sampah</h6>
                </div>
                <div class="card-body">
                  <table class="table table-responsive table-striped">
                    <tbody>
                     <?php $i = 1; ?>
                    <?php foreach ($sampah as $s) : ?>
                        <tr>
                            <th scope="row">#<?= $i; ?>.</th>
                            <td><?= $s['kategori']; ?></td>
                            <td><?= $s['qty']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                  </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>

</div>
</div>

<!-- End of Main Content -->
<!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/canvasjs.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>assets/js/demo/jquery.canvasjs.min.js"></script>
  <script src="<?php echo base_url().'assets/js/raphael-min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/morris.min.js'?>"></script>
  <script>
    Morris.Area({
          element: 'graph',
          data: <?php echo $data;?>,
          xkey: 'bulan',
          ykeys: ['beli','jual','profit'],
          labels: ['Beli','Jual','Profit']
        });
</script>