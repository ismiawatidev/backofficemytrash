<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('nasabah_m');
        $this->load->model('transaksi_m');
        $this->load->model('kategori_m');
    }


 

    public function tabung()
    {
        $data['title'] = 'Tabung';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nasabah'] =  $this->nasabah_m->get()->result_array();
        $data['sampah'] =  $this->kategori_m->get()->result();
        $data['invoice'] =$this->transaksi_m->invoice_no();
        $data['cart'] = $this->transaksi_m->get();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/tabung', $data);
            $this->load->view('templates/footer');
        
    }
    //ADD CART
    public function process()
    { 
        $data = $this->input->post(null, TRUE);
        
        if (isset($_POST['add'])) 
        {
          $this->transaksi_m->add($data,$ket="0");
        }else if(isset($_POST['jual']))
        {
            $this->transaksi_m->add($data,$ket="1");
        }

        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }
    //TRANSAKSI TABUNG
    public function prosestransaksi()
    { 
        $data = $this->input->post(null, TRUE);
        $this->transaksi_m->berat($data);
        $this->transaksi_m->add_transaksi($data,$ket="1");
        $cart = $this->transaksi_m->get()->result();
        $this->nasabah_m->tambah_saldo($data);
        $invoice = $this->input->post('invoice');
        $row = [];
        foreach ($cart as $c => $value) {
            array_push($row, array(
                 'invoice' =>  $invoice,
                 'kategori' => $value->kategori,
                 'berat'    => $value->berat,
                 'harga'    => $value->harga,
                 'total'    => $value->total,
            )
        );
        }
        $this->transaksi_m->add_transaksi_detail($row);
        $this->transaksi_m->del(['invoice' => $invoice ]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);

    }

    public function edit()
    {
        $data = $this->input->post(null, TRUE);
        if (isset($_POST['edit'])) 
        {
          $this->transaksi_m->edit_cart($data);
        }

        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }

    function cart_data() {
        $data['cart'] = $this->transaksi_m->get();
        $this->load->view('transaksi/cart_data', $data);
    }

    public function cari(){
        $id=$_GET['id'];
        $cari =$this->kategori_m->cari($id)->result();
        echo json_encode($cari);
    } 

    public function cart_del()
    {
        $cart_id = $this->input->post('cart_id');
        $this->transaksi_m->del(['id' => $cart_id]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
    }


    //TRANSAKSI AMBIL
    public function ambil()
    {
        $data['title'] = 'Ambil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nasabah'] =  $this->nasabah_m->get()->result_array();
        $data['sampah'] =  $this->kategori_m->get()->result();
        $data['invoice'] =$this->transaksi_m->invoice_no();
        $data['cart'] = $this->transaksi_m->get();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/ambil', $data);
            $this->load->view('templates/footer');
        
    }

    public function prosesambil()
    {
        $data = $this->input->post(null, TRUE);
        if ($_POST['ambil'] > $_POST['total']) {
            $params = array("saldo" => false);
            echo json_encode($params);
        }else{
        $this->transaksi_m->add_transaksi($data,$ket="2");
        $this->nasabah_m->ambil_saldo($data);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);
        }
    }

    //JUAL SAMPAH
    public function jual()
    {
        $data['title'] = 'JUAL';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['sampah'] =  $this->kategori_m->get()->result();
        $data['invoice'] =$this->transaksi_m->invoice_no();
        $data['cart'] = $this->transaksi_m->get();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaksi/jual', $data);
            $this->load->view('templates/footer');
    }
    public function prosesjual()
    { 
        $data = $this->input->post(null, TRUE);
        $this->transaksi_m->berat($data);
        $this->transaksi_m->add_transaksi($data,$ket="3");
        $cart = $this->transaksi_m->get()->result();
        $invoice = $this->input->post('invoice');
        $row = [];
        foreach ($cart as $c => $value) {
            array_push($row, array(
                 'invoice' =>  $invoice,
                 'kategori' => $value->kategori,
                 'berat'    => $value->berat,
                 'harga'    => $value->harga,
                 'total'    => $value->total,
            )
        );
        }
        $this->transaksi_m->add_transaksi_detail($row);
        $this->transaksi_m->del(['invoice' => $invoice ]);
        if ($this->db->affected_rows() > 0) 
        {
          $params = array("success" => true);
        } else {
          $params = array("success" => false);
        } 
        echo json_encode($params);

    }

}    