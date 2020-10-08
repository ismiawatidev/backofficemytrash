<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('transaksi_m');
    }

	public function tabung()
	{
		$data['title'] = 'Laporan Tabung';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tabung'] =$this->transaksi_m->get2()->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/tabung', $data);
            $this->load->view('templates/footer');
	}
    public function detail($id)
    {
        $data['title'] = 'Detail Tabung';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tabung'] =$this->transaksi_m->get3($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/detail', $data);
        $this->load->view('templates/footer');
    }

    //Laporan Ambil
    public function ambil()
    {
        $data['title'] = 'Laporan Ambil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jml'] = $this->transaksi_m->jumlah($ket="2");
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/ambil', $data);
            $this->load->view('templates/footer');
    }
    public function detail_ambil($id)
    {
        $data['title'] = 'Detail Ambil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['ambil'] =$this->transaksi_m->get4($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/detail_ambil', $data);
        $this->load->view('templates/footer');
    }

    //LAPORAN JUAL
    public function jual()
    {
        $data['title'] = 'Laporan Jual';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jml'] = $this->transaksi_m->jumlah($ket="3");
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/jual', $data);
            $this->load->view('templates/footer');
    }
    public function detail_jual($id)
    {
        $data['title'] = 'Detail Penjualan Sampah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jual'] =$this->transaksi_m->get5($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/detail_jual', $data);
        $this->load->view('templates/footer');
    }
}