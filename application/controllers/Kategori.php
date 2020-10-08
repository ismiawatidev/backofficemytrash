<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->model('kategori_m');
    }

    public function index()
    {
        $data['title'] = 'Kategori';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('kategori_m', 'sampah');
        $data['kategori'] = $this->db->get('sampah')->result_array();

        $this->form_validation->set_rules('kategori', 'kategori', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kategori/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori'),
                'harga' => $this->input->post('harga'),
                'keterangan' => $this->input->post('keterangan')
            ];
            $this->db->insert('sampah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('kategori');
        }
    }

    public function kategoriedit($id)
    {
        $data['title'] = 'Kategori Sampah Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $query = $this->kategori_m->get($id);
        $data['row'] = $query->row();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/kategori-edit', $data);
        $this->load->view('templates/footer');
    }

    public function editproses()
    {
        $post = $this->input->post(null, TRUE);
        $this->kategori_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data berhasil disimpan');
            </script>";
        }
        echo "<script>
                window.location='" . site_url('kategori') . "';
            </script>";
    }

    public function kategoridel($id)
    {
        $this->kategori_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
            window.location='" . site_url('kategori') . "';
            </script>";
        }
    }
}
