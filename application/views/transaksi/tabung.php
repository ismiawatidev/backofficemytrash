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
                <input type="hidden" id="saldo" value="" name="saldo">
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
                      <label for="Kategori" class="col-sm-4 col-form-label">Kategori </label>                        
                      <div class="col-sm-8">                      
                        <select id="kategori" name="kategori" class="form-control" onchange="return autofill();" required>
                        <option value="">--Pilih--</option>
                        <?php foreach ($sampah as $kategori => $value) {
                          echo '<option value="'.$value->id.'">'.$value->kategori.'</option>';
                        } ?>
                        </select> 
                      </div>
                  </div>  
                <div class="form-group row">
                <label for="kg" class="col-sm-4 col-form-label">Berat Kg</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="kg" name="kg"  placeholder="Masukan Jumlah dalam KG" required>
                    <input type="hidden"  name="qty" id="qty">
                </div>
                </div>
                <div class="form-group row">
                <label for="harga" class="col-sm-4 col-form-label">Harga /Kg</label>
                <div class="col-sm-4">
                    <input readonly="" type="number" class="form-control" id="harga" name="harga" required>
                </div>
                <button type="button" id="add" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Input</button>
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
                <h1><b>Rp.<span name="total" class="grdtot" id="grdtot" style="font-size:50pt"></span></b></h1>  
                    </div>           
                  </div>
                </div>
              </div>

            </div>


            <!-- table transaksi -->
           <div class="col-lg-7">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                </div>
                <div class="card-body">
                  <table class="table table-responsive table-hover" id="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Berat</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="cart_table">
                    <?php $this->view('transaksi/cart_data') ?>
                  </tbody>
                </table>                
                </div>
             
              </div>

            </div>

            <div class="col-lg-5">
                    <div class="col-sm-8">
                    <a href="" class="btn btn-warning"><i class="fa fa-recycle"></i> RESET</a>
                     <button id="proses" class="btn btn-success"><i class="fa fa-download"> PROSES</i></button>
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
                              data-saldo="<?=$m['saldo']; ?>">
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
    <!-- MODAL EDIT -->
<div class="modal fade" id="modal-item-update" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="cartid_item" name="cartid_item">
            <div class="form-group">
                <select class="form-control" id="kategori_edit" onchange="return autofill2();">
                  <option value="">--Pilih--</option>
                        <?php foreach ($sampah as $kategori => $value) {
                          echo '<option value="'.$value->id.'">'.$value->kategori.'</option>';
                        } ?>
                </select><br>
                <input type="text" id="harga_edit" name="">
                <input type="number" class="form-control" id="berat_edit" name="berat_edit" placeholder="Berat" required=""><br>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="edit_cart" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
        </div>
        </div>
    </div>
</div>
<script>
  $(document).on('click','#select', function()
    {
      $('#no_rekening').val($(this).data('no_rekening'))
      $('#nama').val($(this).data('nama'))
      $('#saldo').val($(this).data('saldo'))
      $('#modal-item').modal('hide')
    }
)  
</script>
<script type="text/javascript">
  function autofill(){
        var id =document.getElementById('kategori').value;
        $.ajax({
                       url:"<?=site_url('transaksi/cari') ?>",
                       data:'&id='+id,
                       success:function(data){
                           var hasil = JSON.parse(data);  
          
      $.each(hasil, function(key,val){ 
                           document.getElementById('harga').value=val.harga;
                           document.getElementById('qty').value=val.qty;
                               
          
        });
      }
                   });
                  
    }
    function autofill2(){
        var id =document.getElementById('kategori_edit').value;
        $.ajax({
                       url:"<?=site_url('transaksi/cari') ?>",
                       data:'&id='+id,
                       success:function(data){
                           var hasil = JSON.parse(data);  
          
      $.each(hasil, function(key,val){ 
                           document.getElementById('harga_edit').value=val.harga;
                               
          
        });
      }
                   });
                  
    }
</script>
<script>
  $(document).on('click', '#add', function()
    {
      var no_rekening = $('#no_rekening').val()
      var kategori = $('#kategori').val()
      var kg = $('#kg').val()
      var invoice = $('#invoice').text()
      var harga = $('#harga').val()
      var nama = $('#nama').val()
      var qty = $('#qty').val()
      if (kategori == '') {
        alert('Kategori Sampah belum di pilih')
        $('#kategori').focus()
      } else if (kg == '') {
         alert('Berat Sampah belum di isi')
        $('#kg').focus()
      } else if (nama == '') {
        alert('No Rekening Belum di pilih')
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('transaksi/process') ?>',
        data: {'add' : true,'harga': harga,'no_rekening' : no_rekening,'qty':qty, 'kategori' : kategori, 'kg' :kg,'invoice' :invoice}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            $('#cart_table').load('<?=site_url('transaksi/cart_data') ?>', function() {
              calculate()
            })
           $('#berat').val('0')
           $('kategori').focus('') 
          } else { 
            alert('Gagal')}
           } 
        })
      } 
    }
  )

$(document).on('click','#del_cart', function () {
  if (confirm('Apakah Anda Yakin?')) {
    var cart_id = $(this).data('cartid')
    $.ajax({
      type : "POST",
      url : '<?=site_url('transaksi/cart_del')?>',
      dataType : 'json',
      data: {'cart_id' : cart_id},
      success : function(result) {
        if (result.success == true) {
          $('#cart_table').load('<?=site_url('transaksi/cart_data') ?>', function() {
            calculate()
            })
        }else{
         alert('Gagal Hapus'); 
        }
      }
      })

  }
})

$(document).on('click','#update-cart', function()
    {
      $('#cartid_item').val($(this).data('cartid'))
      $('#berat_edit').val($(this).data('berat'))
      $('#modal-item').modal('hide')
    }
)  

$(document).on('click', '#edit_cart', function()
    {
      var cartid = $('#cartid_item').val()
      var berat = $('#berat_edit').val()
      var kategori = $('#kategori_edit').val()
      var harga = $('#harga_edit').val()
      if (kategori == '') {
        alert('Kategori Sampah belum di pilih')
        $('#kategori_edit').focus()
      } else if (berat == '' || berat < 1) {
        alert('Pastikan Berat di Isi dengan Benar')
         $('#berat_edit').focus()
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('transaksi/edit') ?>',
        data: {'edit' : true,'harga':harga,'cartid_item': cartid,'kategori_edit' : kategori, 'berat_edit' : berat}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            $('#cart_table').load('<?=site_url('transaksi/cart_data') ?>', function() {
              calculate()
            })
            alert('Item Berhasil di Update')
            $('#modal-item-update').modal('hide');
           $('#berat').val('0')
           $('kategori').focus('') 
          } else { 
            alert('Gagal')}
           } 
        })
      } 
    }
  )


function calculate(){
  var grandTotal = 0;
  $('#cart_table tr').each(function (){
    var sub = $(this).find('.subtot').text();
    var stval = parseFloat(sub);
        grandTotal += isNaN(stval) ? 0 : stval;
  }) 
  $('.grdtot').text(grandTotal);
}

$(document).ready(function(){
  calculate()
})

//proses 
$(document).on('click', '#proses', function()
    {    
      var no_rekening = $('#no_rekening').val()
      var invoice = $('#invoice').text()
      var kategori = $('#kategori').val()
      var kg = $('#kg').val()
      var harga = $('#harga').val()
      var jumlah = $('#jumlah').val()
      var total = $('#grdtot').text()
      var bulan = $('#bulan').val()
      var saldo = $('#saldo').val()
      if (total < 1) {
        alert('Belum ada Data Yang di Inputkan')
        $('#no_rekening').focus()
      }else if(no_rekening == ''){
        alert('No Rekening Kosong')
        $('#no_rekening').focus()
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('transaksi/prosestransaksi') ?>',
        data: {'proses' : true,'no_rekening' : no_rekening,'bulan' :bulan, 'kategori' : kategori, 'kg' :kg,'invoice' : invoice,'harga' : harga, 'jumlah' : jumlah ,'total' :total,'saldo': saldo}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            alert('Transaksi Berhasil');
          } else { 
            alert('Gagal');
          }
           location.href='<?=site_url('transaksi/tabung') ?>'
           } 
        })
      } 
    }
  )


</script>