<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staf_sarprasM extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	public function get_pilihan_jenis_barang(){ // untuk menampilkan pilihan jenis barang dengan dropdown
		$this->db->select('*');
		$this->db->from('jenis_barang');
		$query = $this->db->get();
		return $query;
	}

	public function insert_tambah_barang($data){ //post barang
		return $this->db->insert('barang', $data);
	}

	public function upload(){ // Fungsi untuk upload gambar ke folder
		$config['upload_path'] = './assets/file_gambar'; // alamat folder penyimpanan gambar
		$config['allowed_types'] = 'jpg|png|jpeg|PNG';	 // tipe file yang boleh diunggah
		$config['max_size']	= '2048';					 // maksimal ukuran file yang diunggah
		$config['remove_space'] = TRUE;					 // menghilangkan spasi pada nama file
		$config['encrypt_name'] = TRUE;					 // mengenkripsi nama file yang diunggah
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => ''); // file akan di upload dan pindah ke folder penyimpanan gambar
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors()); // akan muncul pesan error 
			return $return;
		}
	}

	public function insert_pengajuan_barang($data){   //insert tabel item_pengajuan
		if($this->db->insert('item_pengajuan', $data)){
			return $this->db->insert_id(); //return last insert ID
		} 
	} 

}