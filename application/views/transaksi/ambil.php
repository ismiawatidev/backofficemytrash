<?php
    $tgl = date('Y-m-d');
    $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $bulan = tglIndonesia(date('F Y', $prevN));
?>
<body id="page-top">
  <div class="container-fluid"> 
<div class="row">
            
            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Data</h6>
                </div>
                <form autocomplete="off">
                <div class="card-body">
                  <div class="form-group row">
                      <label for="tanggal" class="col-sm-4 col-form-label">Date </label>
                      <div class="col-sm-8">                      
                          <input type="text" class="form-control"  value="<?=tglIndonesia(date('D, d F, Y')); ?>" readonly="">
                          <input type="hidden" readonly="" id="bulan" name="bulan" value="<?php echo $bulan ?>" class="form-control"  required>
                      </div>
                  </div>  
                  <div class="form-group row">
                <label for="rekening" class="col-sm-4 col-form-label">Rekening</label>
                <div class="input-group col-sm-8">
                  <input type="text" name="no_rekening" id="no_rekening" class="form-control" readonly="" autofocus="">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                  
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nama </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" value="" readonly="">
                </div>
            </div>    
            </form>        
                </div>
              </div>

            </div>
            
            <div class="col-lg-4">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Input</h6>
                </div>
                <div class="card-body">
                <div class="form-group row">
                <label for="kg" class="col-sm-4 col-form-label">Jumlah</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="ambil" name="ambil"  placeholder="Masukan Jumlah Yang Akan di Ambil" required>
                </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-8">
                  <button type="button" id="add" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Input</button>
                </div>
                </div>
                </div>
              </div>

            </div>

            <div class="col-lg-4">

              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"> Invoice</h6>
                </div>
                <div align="right">
                <div class="card-body">
                  <div class="form-group row">
                <h4>Invoice <b><span name="invoice" id="invoice"><?= $invoice ?></span></b></h4> <br>
                <h1><b>Rp.<span name="total" class="total" id="total" style="font-size:50pt"></span></b>
                  
                </h1>  
                    </div>           
                  </div>
                </div>
              </div>

            </div>         



          </div>

        </div>
        <!-- /.container-fluid -->
<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Pilih Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">Rekening</th>
                      <th style="text-align: center">Nama</th>
                      <th style="text-align: center;width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($nasabah as $m) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $m['no_rekening']; ?></td>
                            <td><?= $m['nama']; ?></td>
                            <td class="text-center">
                              <button class="btn btn-xs btn-info" id="select" 
                              data-no_rekening="<?=$m['no_rekening'] ?>"
                              data-nama="<?=$m['nama']; ?>"
                              data-total="<?=$m['saldo']; ?>">
                              <i class="fa fa-check"></i> Select
                              </button>
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
<script>
  $(document).on('click','#select', function()
    {
      $('#no_rekening').val($(this).data('no_rekening'))
      $('#nama').val($(this).data('nama'))
      $('#total').text($(this).data('total'))
      $('#modal-item').modal('hide')
    }
  )
</script>
<script>
  $(document).on('click', '#add', function()
    {
      var no_rekening = $('#no_rekening').val()
      var ambil = $('#ambil').val()
      var invoice = $('#invoice').text()
      var nama = $('#nama').val()
      var bulan = $('#bulan').val()
      var total = $('#total').text()
      if (ambil == "") {
         alert('Masukan Nilai Yang di Ambil')
        $('#ambil').focus()
      } else if (no_rekening == '') {
         alert('Silahkan Pilih Nasabah')
        $('#no_rekening').focus()
      } 
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('transaksi/prosesambil') ?>',
        data: {'select' : true,'no_rekening' : no_rekening,'bulan':bulan, 'ambil' : ambil,'invoice' : invoice,'total': total}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            alert('Transaksi Berhasil');
          }else if(result.saldo==false){
            alert('Nominal melebihi saldo');
          }else { 
            alert('Gagal');
          }
           location.href='<?=site_url('transaksi/ambil') ?>'
           } 
        })
      } 
    }
  )
</script>