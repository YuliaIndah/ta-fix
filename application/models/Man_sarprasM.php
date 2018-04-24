<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Man_sarprasM extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	// Ambil Data Pengajuan Barang 
	function get_data_item_pengajuan(){
		$this->db->select('*');
		$this->db->from('item_pengajuan');
		$this->db->join('pengguna', 'pengguna.no_identitas = item_pengajuan.no_identitas');
		$this->db->join('jabatan', 'jabatan.kode_jabatan = pengguna.kode_jabatan');
		$this->db->join('unit', 'unit.kode_unit = pengguna.kode_unit');
		$this->db->join('barang', 'barang.kode_barang = item_pengajuan.kode_barang');
		$this->db->join('jenis_barang', 'jenis_barang.kode_jenis_barang = barang.kode_jenis_barang');
		$this->db->join('progress', 'progress.kode_fk = item_pengajuan.kode_item_pengajuan');
		$this->db->where('progress.jenis_progress ="barang"');
		$this->db->where('progress.kode_nama_progress ="1"');
		$this->db->group_by('item_pengajuan.kode_item_pengajuan');
		$query = $this->db->get();
		if($query){
			return $query;
		}else{
			return null;
		}
	}

	function get_data_item_pengajuan_by_id($id){ // menampilkan detail item pengajuan berdasarkan id
		$this->db->select('*');
		$this->db->from('item_pengajuan');
		$this->db->join('pengguna', 'pengguna.no_identitas = item_pengajuan.no_identitas');
		$this->db->join('jabatan', 'jabatan.kode_jabatan = pengguna.kode_jabatan');
		$this->db->join('unit', 'unit.kode_unit = pengguna.kode_unit');
		$this->db->join('barang', 'barang.kode_barang = item_pengajuan.kode_barang');
		$this->db->join('jenis_barang', 'jenis_barang.kode_jenis_barang = barang.kode_jenis_barang');
		$this->db->where('kode_item_pengajuan', $id);
		$query = $this->db->get();
		if($query){
			return $query;
		}else{
			return null;
		}
	}

	public function insert_pengajuan_kegiatan($data){   //post pengguna_jabatan
		if($this->db->insert('kegiatan', $data)){
			return $this->db->insert_id(); //return last insert ID
		} 
	}  
	
	// Fungsi untuk menyimpan data ke database
	public function save($upload,$insert_id){
		$data = array(
			'kode_kegiatan' => $insert_id, //last insert id
			'nama_file' 	=> $upload['file']['file_name'],
			'ukuran_file' 	=> $upload['file']['file_size']
		);
		
		$this->db->insert('file_upload', $data);
	}

	public function delete($id){ //hapus data pengajuan kegiatan ketika gagal upload file
		$this->db->where('kode_kegiatan', $id);
		$this->db->delete('kegiatan');
		return "berhasil delete";
	}

	public function edit_data_diri($no_identitas, $data){ //edit data diri
		$this->db->where('no_identitas', $no_identitas);
		$this->db->update('pengguna', $data);
		return TRUE;
	}

	public function insert_tambah_barang($data){ //post barang
		return $this->db->insert('barang', $data);
	}

	public function get_pilihan_jenis_barang(){ // untuk menampilkan pilihan jenis barang dengan dropdown
		$this->db->select('*');
		$this->db->from('jenis_barang');
		$query = $this->db->get();
		return $query;
	}

	public function get_pilihan_jenis_barang_by_id($kode_barang){ // untuk menampilkan pilihan jenis barang dengan dropdown
		$this->db->select('*');
		$this->db->from('jenis_barang');
		$this->db->join('barang', 'barang.kode_jenis_barang = jenis_barang.kode_jenis_barang');
		$this->db->where('barang.kode_barang',$kode_barang);
		$query = $this->db->get();
		return $query;
	}

	public function insert_pengajuan_barang($data){   //insert tabel item_pengajuan
		if($this->db->insert('item_pengajuan', $data)){
			return $this->db->insert_id(); //return last insert ID
		} 
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

	function get_data_klasifikasi_barang(){ // menampilkan data barang yang belum memiliki jenis barang / belum terklasifikasi
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('status_klasifikasi="tidak valid"'); // berdasarkan status_klasifikasi yang tidak valid
		$query = $this->db->get();
		if($query){
			return $query;
		}else{
			return null;
		}
	}

	public function update_klasifikasi_barang($kode_barang, $data){ //update barang dengan klasifikasi
		$this->db->where('kode_barang', $kode_barang);
		$this->db->update('barang', $data);
		return TRUE;
	}

	public function update_persetujuan($data, $kode_fk){ //update persetujuan progres jadi proses
		$this->db->where('item_pengajuan.kode_item_pengajuan', $kode_fk);
		$this->db->update('item_pengajuan', $data);
		return TRUE;
	}

	public function update_persetujuan_tersedia($data, $kode_item_pengajuan){ //update persetujuan status persediaan sama progres
		$this->db->where('item_pengajuan.kode_item_pengajuan', $kode_item_pengajuan);
		$this->db->update('item_pengajuan', $data);
		return TRUE;
	}
	
	public function get_data_pengajuan_staf($kode_unit, $kode_jabatan){ //ambil semua kegiatan yang diajukan staf
		$this->db->select('*');
		$this->db->from('kegiatan');
		$this->db->join('pengguna', 'pengguna.id_pengguna = kegiatan.id_pengguna');
		$this->db->join('data_diri', 'data_diri.no_identitas = pengguna.no_identitas');
		$this->db->join('jabatan', 'jabatan.kode_jabatan = pengguna.kode_jabatan');
		$this->db->join('unit', 'unit.kode_unit = pengguna.kode_unit');
		$this->db->join('jenis_kegiatan', 'jenis_kegiatan.kode_jenis_kegiatan = kegiatan.kode_jenis_kegiatan');
		$this->db->join('file_upload', 'file_upload.kode_kegiatan = kegiatan.kode_kegiatan');
		$this->db->where('unit.kode_unit', $kode_unit);
		$this->db->where('jabatan.kode_jabatan !=', $kode_jabatan);
		$this->db->where('jenis_kegiatan.kode_jenis_kegiatan = 1'); //kegiatan pegawai

		$query = $this->db->get();
		if($query){
			return $query;
		}else{
			return null;
		}
	}
}