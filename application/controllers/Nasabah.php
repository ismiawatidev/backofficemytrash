<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('nasabah_m');
        $this->load->model('user_m');
    }

    public function index()
    {
        $data['title'] = 'Data Nasabah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nasabah'] = $this->db->get('nasabah')->result_array();
        $data['no_rekening'] = $this->nasabah_m->no_rekening();

        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'no_hp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('nasabah/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->input->post(null, TRUE);
            $this->nasabah_m->add($data);
            // $this->user_m->add_nasabah($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('nasabah');
        }
    }

    public function nasabahedit($id)
    {
        $data['title'] = 'Data Nasabah Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->nasabah_m->get($id)->row();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('nasabah/nasabah-edit', $data);
        $this->load->view('templates/footer');
    }

    public function editproses()
    {
        $post = $this->input->post(null, TRUE);
        $this->nasabah_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data berhasil disimpan');
            </script>";
        }
        echo "<script>
                window.location='" . site_url('nasabah') . "';
            </script>";
    }

    public function nasabahdel($id)
    {
        $this->nasabah_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
            window.location='" . site_url('nasabah') . "';
            </script>";
        }
    }
}
