<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{ 

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
        FROM transaksi 
        WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n   = ((int)$row->invoice_no) +1;
            $no  = sprintf("%'.04d" , $n);
        }else{
            $no = "0001";
        }
        $invoice = "IN".date('ymd').$no;
        return $invoice;
    }

    public function add($data,$ket)
    {   
        if ($ket == 1) {
            $qty = $data['qty']-$data['kg'];
        }else{
            $qty = $data['qty']+$data['kg'];
        }
         $total = $data['harga']*$data['kg'];
         $data = [
                'no_rekening' => $this->input->post('no_rekening'),
                'invoice' => $this->input->post('invoice'),
                'kategori' => $this->input->post('kategori'),
                'berat' => $this->input->post('kg'),
                'harga' => $this->input->post('harga'),
                'qty' => $qty,
                'total' => $total,
            ];
       $this->db->insert('cart', $data);
    }

    public function get($params = null)
    {
        $this->db->select('*, sampah.id as id, cart.berat as berat,cart.qty as qty, cart.harga as harga, cart.id as cart_id, cart.kategori as kategori_id');
        $this->db->from('cart');
        $this->db->join('sampah', 'cart.kategori = sampah.id');
        if($params !=null) {
            $this->db->where($params);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit_cart($post)
    {
        $total = $post['harga']*$post['berat_edit'];
        $params = array(
            'kategori' => $post['kategori_edit'],
            'berat' => $post['berat_edit'],
            'harga' => $post['harga'],
            'total' => $total,
        );
        $this->db->where('id',$post['cartid_item']);
        $this->db->update('cart',$params);
    }

    public function del($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function add_transaksi($post,$ket)
    {
        if ($ket == 1) {
            $ket = "1";
            $total = $this->input->post('total');
        }else if($ket == 2){
            $ket = "2";
            $total = $this->input->post('ambil');
        }else if($ket == 3){
            $ket = "3";
            $total = $this->input->post('total');
        }
       $params = array(
            'no_rek' => $this->input->post('no_rekening'),
            'invoice' => $this->input->post('invoice'),
            'total' => $total,
            'ket' => $ket,
            'bulan' => $this->input->post('bulan'),
        );
        $this->db->insert('transaksi',$params);
        return $this->db->insert_id();
    }
    function add_transaksi_detail($params)
    {
        $this->db->insert_batch('transaksi_detail',$params);
    }
    // BERAT (JUAL & tabung)
    public function berat($post)
    {
        $row = [];
        $cart = $this->get()->result();
        foreach ($cart as $c => $value) {
            array_push($row, array(
                 'id' => $value->kategori_id,
                 'qty'    => $value->qty,
            )
        );
        }
        $this->db->update_batch('sampah', $row, 'id');
        return $this->db->insert_id();  
    }

    // LAPORAN
    public function get2($id = null)
    {
        $this->db->from('transaksi')->order_by('invoice','DESC')->where('ket',1);
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    //LAPORAN DETAIL
    public function get3($id = null)
    {
        $this->db->from('transaksi_detail');
        if ($id != null) {
            $this->db->where('invoice', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function ambil_saldo($data)
    {
        $params = [
            'no_rek' => $data['no_rekening'],
            'total' => $data['ambil'],
            'ket' => 2,
            'invoice' => $data['invoice']
        ];
        $this->db->insert('transaksi',$params);
        return $this->db->insert_id();
    }
    public function jumlah($ket)
    {
        $this->db->select('tgl,invoice,no_rek,bulan, SUM(total) as total ,COUNT(tgl) as tanggal');
        $this->db->where('ket',$ket);
        $this->db->group_by('bulan');
        $this->db->from('transaksi');
        $hasil = $this->db->get();
        return $hasil;
    }
    
    public function get4($id = null)
    {
        $this->db->from('transaksi');
        if ($id != null) {
            $this->db->where('tgl', $id);
            $this->db->where('ket', 2);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get5($id = null)
    {
        $this->db->from('transaksi_detail');
        if ($id != null) {
            $this->db->where('invoice', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // CHart
    function get_data_transaksi(){
        $this->db->select("tgl,bulan,invoice,no_rek,SUM(IF(ket = '1', total,0 )) as beli,SUM(IF(ket = '3', total,0 )) as jual,(SELECT SUM(IF(ket = '3', total,0 )) AS Total)-(SELECT SUM(IF(ket = '1', total,0 )) AS Total2) AS profit");
        $this->db->group_by('bulan');
        $result = $this->db->get('transaksi');
        return $result;
    }
    //jual,beli = profit ???


}	