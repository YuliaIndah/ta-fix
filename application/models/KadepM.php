<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class KadepM extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function get_data_pengguna(){ //ambil data seluruh pengguna yang terdaftar
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->join('jabatan', 'jabatan.kode_jabatan = pengguna.kode_jabatan');
		$this->db->join('unit', 'unit.kode_unit = pengguna.kode_unit');
		$this->db->join('data_diri', 'pengguna.no_identitas = data_diri.no_identitas');
		$query = $this->db->get(); 
		return $query;
	}

	public function aktif_pro($kode_doc){ //aktifasi akun pengguna
		$status = "aktif";
		$data = array('status' =>$status);

		$this->db->where('kode_doc', $kode_doc);
		$this->db->update('dokumen_prosedur', $data);
		return TRUE;
	}

	public function non_aktif_pro($kode_doc){ //deaktifasi akun pengguna
		$status = "tidak";
		$data = array('status' =>$status);

		$this->db->where('kode_doc', $kode_doc);
		$this->db->update('dokumen_prosedur', $data);
		return TRUE;
	}

	public function aktif($id_pengguna){ //aktifasi akun pengguna
		$status = "aktif";
		$data = array('status' =>$status);

		$this->db->where('id_pengguna', $id_pengguna);
		$this->db->update('pengguna', $data);
		return TRUE;
	}

	public function non_aktif($id_pengguna){ //deaktifasi akun pengguna
		$status = "tidak aktif";
		$data = array('status' =>$status);

		$this->db->where('id_pengguna', $id_pengguna);
		$this->db->update('pengguna', $data);
		return TRUE;
	}

	public function hapus($id){//hapus persetujuan kegiatan
		$this->db->where('kode_acc_kegiatan', $id);
		$this->db->delete('acc_kegiatan');
		return "berhasil";
	}
	
}