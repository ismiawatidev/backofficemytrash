<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('nasabah');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($data)
    {
        $data = [
            'no_rekening' => $this->input->post('no_rekening'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'saldo' => 0,
            'password' => md5($this->input->post('no_rekening')),
            'status' => 1

        ];
        $query = $this->db->insert('nasabah', $data);
        return $query;
    }

    public function no_rekening()
    {
        $sql = "SELECT MAX(MID(no_rekening,9,4)) AS no_rekening 
        FROM nasabah 
        WHERE MID(no_rekening,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n   = ((int)$row->no_rekening) + 1;
            $no  = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $no_rekening = "NB" . date('ymd') . $no;
        return $no_rekening;
    }

    public function edit($post)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp')
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('nasabah', $data);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nasabah');
    }

    public function get2($id = null)
    {
        $this->db->from('nasabah');
        if ($id != null) {
            $this->db->where('no_rekening', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function cari($id)
    {
        $query = $this->db->get_where('nasabah', array('no_rekening' => $id));
        return $query;
    }

    public function tambah_saldo($data)
    {
        $saldo = $data['saldo'] + $data['total'];
        $tambah = [
            'saldo' => $saldo
        ];
        $this->db->where('no_rekening', $data['no_rekening']);
        $this->db->update('nasabah', $tambah);
    }

    public function ambil_saldo($data)
    {
        $ambil = $data['total'] - $data['ambil'];
        $params = [
            'saldo' => $ambil
        ];
        $this->db->where('no_rekening', $data['no_rekening']);
        $this->db->update('nasabah', $params);
    }

    public function top()
    {
        $this->db->from('nasabah')->order_by('saldo', 'DSC')->limit(5);
        $query = $this->db->get();
        return $query;
    }
}
