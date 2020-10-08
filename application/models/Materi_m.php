<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi_m extends CI_Model
{

	public function get($id = null)
	{
		$this->db->from('materi');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$data = [
			'judul' => $post['judul'],
			'namafile' => $post['namafile'],
			'kelas' => $post['kelas'],
			'jurusan' => $post['jurusan'],
			'isactive' => $post['is_active'],
		];
		$this->db->insert('materi', $data);
	}

	public function edit($post)
	{
		$params['judul'] = $post['judul'];
		$params['namafile'] = $post['namafile'];
		$params['kelas'] = $post['kelas'];
		$params['jurusan'] = ucfirst($post['jurusan']);
		$params['isactive'] = ucfirst($post['active']);
		$this->db->where('id', $post['id']);
		$this->db->update('materi', $params);
	}

	public function del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('materi');
	}

	public function deldata($tabel, $where)
	{
		return $this->db->delete($tabel, $where);
	}
}
