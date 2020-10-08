<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $params['user'] = $post['user'];
        $this->db->where('id', $post['id']);
        $this->db->update('user', $params);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}
