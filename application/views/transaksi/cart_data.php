<?php $no = 1;
  if ($cart->num_rows() > 0) {  
  foreach ($cart->result() as $c => $data) { 
  $sub = $data->berat*$data->harga;
    ?>


  <tr>
    <td><?=$no++?>.</td>
    <td ><?=$data->kategori?></td>
    <td ><?=$data->berat?></td> 
    <td name="harga" class="harga"><?=$data->harga?></td>             
    <td id="subtot" name="subtot" class="subtot"><?=intval($sub) ?></td> 
    <input type="hidden" name="qty" id="qty" class="qty" value="<?=$data->qty?>">
    <td style="text-align: center">    
    <button id="update-cart" 
        data-toggle="modal" 
        data-target="#modal-item-update" 
        class="badge badge-primary"
        data-cartid="<?=$data->cart_id?>"
        data-kategori_id="<?=$data->kategori_id?>"
        data-berat="<?=$data->berat?>"
    >
    <i class="fa fa-update"></i> Update
    </button> | 
    <button id="del_cart" class="badge badge-danger" data-cartid="<?=$data->cart_id?>">
      <i class="fa fa-trash"></i> Delete
    </button>                       
    </td>
  </tr>
  <tr>
  <?php  }
  }else {
  echo '<tr>
  <td colspan="6" class="text-center">Tidak ada item </td>
  </tr>';
  }
?>