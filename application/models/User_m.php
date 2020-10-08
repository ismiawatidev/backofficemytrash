<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
	// public function add_nasabah($data)
	// {
	// 	$array = array(
	// 		'email' => $data['no_rekening'],
	// 		'image' => 'default.jpg',
	// 		'name' => $data['nama'],
	// 		// 'telepon' => $data['no_hp'],
	// 		// 'saldo' => $data['saldo'],

	// 		'password' => md5($data['no_rekening']),
	// 		'level' => 3,
	// 		'status' => 1,
	// 	);
	// 	$query = $this->db->insert('user', $array);
	// 	return $query;
	// }

	public function get($id = null)
	{
		$this->db->from('user')->order_by('level', 'ASCENDING');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function get_admin($id = null)
	{
		$this->db->from('user')->where('level', 1);
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
