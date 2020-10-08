<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_m extends CI_Model
{

	public function get($id = null)
    {
        $this->db->from('sampah');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit($post)
    {
        $data = [
                'kategori' => $this->input->post('kategori'),
                'harga' => $this->input->post('harga'),
                'keterangan' => $this->input->post('keterangan')
            ];
        $this->db->where('id', $post['id']);
        $this->db->update('sampah', $data);
    }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sampah');
    }

    function cari($id){
        $query= $this->db->get_where('sampah',array('id'=>$id));
        return $query;
    }

    public function add_berat($array)
    {

        $this->db->update_batch('sampah',$array,'kategori');     
    }

}	