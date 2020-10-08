<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('role_m');
        $this->load->model('user_m');
        $this->load->model('nasabah_m');
        $this->load->model('transaksi_m');
        $this->load->model('kategori_m');
        $this->load->model('siswa_m');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nasabah'] = $this->db->get('nasabah')->num_rows();
        $data['tops'] = $this->nasabah_m->top()->result_array();
        $data['sampah'] = $this->kategori_m->get()->result_array();
        $data2 = $this->transaksi_m->get_data_transaksi()->result_array();
        $data['chart'] = $this->transaksi_m->get_data_transaksi()->result_array();
        $data['data'] = json_encode($data2);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($level)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $level])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $level = $this->input->post('roleId');

        $data = [
            'level' => $level,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function RoleEdit($id)
    {
        $data['title'] = 'Role Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $query = $this->role_m->get($id);
        $data['row'] = $query->row();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-edit', $data);
        $this->load->view('templates/footer');
    }

    public function roleproses()
    {
        $post = $this->input->post(null, TRUE);
        $this->role_m->edit($post);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data berhasil disimpan');
            </script>";
        }
        echo "<script>
                window.location='" . site_url('admin/role') . "';
            </script>";
    }

    public function roledel($id)
    {
        $this->role_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
            window.location='" . site_url('admin/role') . "';
            </script>";
        }
    }

    public function siswa()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Role_model', 'role');

        $data['siswa'] = $this->role->getSiswa();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('templates/footer');
    }

    public function siswaregistration()
    {
        $data['title'] = 'User Registration';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/siswa-registration', $data);
        $this->load->view('templates/footer');
    }

    public function siswaproses()
    {
        $data['title'] = 'Siswa Registration';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => md5($this->input->post('password1')),
                'level' => 3,
                'name' => htmlspecialchars($this->input->post('name', true)),
                'status' => 1,
                'createdDate' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created.</div>');
            redirect('admin/siswa');
        }
    }

    public function siswadel($id)
    {
        $this->siswa_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
            window.location='" . site_url('admin/siswa') . "';
            </script>";
        }
    }

    // public function data()
    // {
    //     $data['title'] = 'Data Admin';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['admin'] = $this->user_m->get_admin()->result_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/data', $data);
    //     $this->load->view('templates/footer');
    // }
}
