<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf_sarprasC extends CI_Controller {

	var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['UserM','Staf_sarprasM']);
		Staf_sarpras_access();
	}

	public function data_diri(){ //halaman data diri
		$data['title'] = "Data Diri | Staf Sarana dan Prasarana";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_sarpras/data_diri_content', $this->data, true) ;
		$this->load->view('staf_sarpras/index_template', $data);
	}

	public function edit_data_diri($no_identitas){ // post edit data diri
		$jen_kel    = $_POST['jen_kel'];
		$tmp_lahir  = $_POST['tmp_lahir'];
		$tgl_lahir  = $_POST['tgl_lahir'];
		$alamat     = $_POST['alamat'];
		$no_hp      = $_POST['no_hp'];

		$data = array(
			'jen_kel'     => $jen_kel,
			'tmp_lahir'   => $tmp_lahir,
			'tgl_lahir'   => $tgl_lahir,
			'alamat'      => $alamat,
			'no_hp'       => $no_hp
		);
		$this->UserM->edit_data_diri($no_identitas,$data);
		$this->session->set_flashdata('sukses','Data anda berhasil disimpan');
		redirect('Staf_sarprasC/data_diri');
	}


	public function index(){ //halaman index Staff Sarpras (dashboard)
		$data['title'] = "Beranda | Staf Sarana dan Prasarana";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_sarpras/index_content', $this->data, true) ;
		$this->load->view('staf_sarpras/index_template', $data);
	}

	public function pengaturan_akun(){ //halaman pengaturan akun
		$data['title'] = "Pengaturan Akun | Staff Sarana dan Prasarana";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_sarpras/pengaturan_akun_content', $this->data, true) ;
		$this->load->view('staf_sarpras/index_template', $data);
	}

	// sebagai staff

	public function kelola_barang(){ //halaman kelola barang(man_sarpras)
		$data['title'] = "Kelola Barang | Manajer Sarana dan Prasarana";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];      //get data diri buat nampilin nama di pjok kanan
		$this->data['data_barang'] = $this->UserM->get_barang()->result();          //menampilkan data barang untuk man_sarpras dan staff sarpras
		$this->data['jenis_barang'] = $this->Staf_sarprasM->get_pilihan_jenis_barang()->result();
		$data['body'] = $this->load->view('staf_sarpras/barang_content', $this->data, true);
		$this->load->view('staf_sarpras/index_template', $data);
	}

	public function post_tambah_barang(){ //fungsi untuk tambah barang
		$this->form_validation->set_rules('nama_barang', 'Nama Barang','required');
		$this->form_validation->set_rules('kode_jenis_barang', 'Jenis Barang','required');
		if($this->form_validation->run() == FALSE)
		{
			$this->kelola_barang();
			//redirect ke halaman kelola barang
		}else{
			$nama_barang 		= $_POST['nama_barang'];
			$kode_jenis_barang	= $_POST['kode_jenis_barang'];
			$data_pengguna		= array(
				'nama_barang'		=> $nama_barang,
				'kode_jenis_barang'	=> $kode_jenis_barang
			);
			if($this->Staf_sarprasM->insert_tambah_barang($data_pengguna)){
				$this->session->set_flashdata('sukses','Data Barang berhasil ditambahkan');
				redirect('Staf_sarprasC/kelola_barang');
			}else{
				$this->session->set_flashdata('error','Data Barang tidak berhasil ditambahkan');
				redirect('Staf_sarprasC/kelola_barang');
			}
		}

	}

	public function ubah_barang($kode_barang){ //menampilkan modal dengan isi dari ubah_barang.php
		$data['ubah_barang']          = $this->UserM->get_barang_by_kode_barang($kode_barang)->result()[0];
		$data['pilihan_jenis_barang'] = $this->Staf_sarprasM->get_pilihan_jenis_barang()->result();
		$this->load->view('staf_sarpras/detail_ubah_barang', $data);
	}

	public function ubah_data_barang(){ //update data barang
		$kode_barang 		= $_POST['kode_barang'];
		$kode_jenis_barang  = $_POST['kode_jenis_barang'];

		$data = array(
			'kode_barang'       => $kode_barang,
			'kode_jenis_barang' => $kode_jenis_barang
		);
		$this->UserM->ubah_data_barang($kode_barang,$data);
		redirect('Staf_sarprasC/kelola_barang');
	}

	//sebagai pegawai

	public function ajukan_barang(){ //halaman pengajuan barang
		$data['title'] = "Daftar Pengajuan Barang | Kepala Departemen";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pojok kanan
		$this->data['data_ajukan_barang'] = $this->UserM->get_ajukan_barang()->result();	//menampilkan pengajuan barag yang diajukan user sebagai pegwai
		$this->data['pilihan_barang'] = $this->UserM->get_pilihan_barang()->result();
		$data['body'] = $this->load->view('staf_sarpras/ajukan_barang_content', $this->data, true);
		$this->load->view('staf_sarpras/index_template', $data);
	}

	public function pengajuan_kegiatan(){ //halaman kegiatan pegawai
		$kode_unit = $this->session->userdata('kode_unit');

		$data['title'] = "Pengajuan Kegiatan | Staf Keuangan";
		$this->data['UserM'] = $this->UserM ;	
		// $this->data['Staf_keuanganM'] = $this->Staf_keuanganM ;	

		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pjok kanan
		$this->data['data_kegiatan'] = $this->UserM->get_kegiatan_pegawai()->result();	//menampilkan kegiatan yang diajukan user sebagai pegwai
		$this->data['id_pimpinan'] 		= $this->UserM->get_id_pimpinan($kode_unit)->result()[0]->id_pengguna; //ambil id pimpinan
		$data['body'] = $this->load->view('staf_sarpras/pengajuan_kegiatan_content', $this->data, true);
		$this->load->view('staf_sarpras/index_template', $data);
	}

	public function detail_progress($id){ //menampilkan modal dengan isi dari detail_kegiatan.php
		$data['detail_progress']	= $this->UserM->get_detail_progress($id)->result();
		$this->load->view('staf_sarpras/detail_progress', $data);
	}

	public function post_tambah_ajukan_barang(){ //fungsi untuk tambah pengajuan barang
		$this->form_validation->set_rules('no_identitas', 'No Identitas','required');
		$this->form_validation->set_rules('kode_barang', 'Nama Barang','required');
		$this->form_validation->set_rules('tgl_item_pengajuan', 'Tanggal Item Pengajuan','required');
		$this->form_validation->set_rules('nama_item_pengajuan', 'Nama Item Pengajuan','required');
		$this->form_validation->set_rules('url', 'URL','required');
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan','required');
		$this->form_validation->set_rules('merk', 'Merk','required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Barang','required');
		// $this->form_validation->set_rules('pimpinan', 'Pimpinan','required');
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan 1');
			redirect('Staf_sarprasC/ajukan_barang') ;
			//redirect ke halaman pengajuan barang
		}else{
			$upload = $this->Staf_sarprasM->upload(); // lakukan upload file dengan memanggil function upload yang ada di Staf_sarprasM.php
			$no_identitas 		= $_POST['no_identitas'];
			$kode_barang 		= $_POST['kode_barang'];
			$tgl_item_pengajuan = $_POST['tgl_item_pengajuan'];
			$nama_item_pengajuan= $_POST['nama_item_pengajuan'];
			$url 				= $_POST['url'];
			$harga_satuan 		= $_POST['harga_satuan'];
			$merk 				= $_POST['merk'];
			$jumlah 			= $_POST['jumlah'];
			// $pimpinan			= $_POST['pimpinan'];

			$baru = "baru"; //buat status pengajuan berstatus baru ketika baru dibuat

			$data_pengguna		= array(
				'no_identitas'			=> $no_identitas,
				'kode_barang'			=> $kode_barang,
				'status_pengajuan'		=> $baru,
				'tgl_item_pengajuan'	=> $tgl_item_pengajuan,
				'nama_item_pengajuan'	=> $nama_item_pengajuan,
				'url'					=> $url,
				'harga_satuan'			=> $harga_satuan,
				'merk'					=> $merk,
				'jumlah'				=> $jumlah,
				'file_gambar' 			=> $upload['file']['file_name']
				// 'pimpinan'				=> $pimpinan

			);
			if($upload['result'] == "success"){ // Jika proses upload sukses
				$this->Staf_sarprasM->insert_pengajuan_barang($data_pengguna);  // untuk memasukkan data ke tabel item_pengajuan
				$this->session->set_flashdata('sukses','Data Barang berhasil ditambahkan');
				redirect('Staf_sarprasC/ajukan_barang');//redirect ke halaman pengajuan barang
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan 2');
				redirect('Staf_sarprasC/ajukan_barang');//redirect ke halaman pengajuan barang
			}

		}

	}	

	public function post_pengajuan_kegiatan_pegawai(){ //fungsi post pengajuan kegiatan pegawai
		$this->form_validation->set_rules('id_pengguna', 'ID Pengguna','required');
		$this->form_validation->set_rules('kode_jenis_kegiatan', 'Kode Jenis Kegiatan','required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('tgl_kegiatan', 'Tanggal Kegiatan','required');
		$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan','required');
		$this->form_validation->set_rules('dana_diajukan', 'Dana Diajukan','required');
		$this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan','required');
		$this->form_validation->set_rules('id_pimpinan', 'ID Pimpinan','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
			redirect('Staf_sarprasC/pengajuan_kegiatan');
		}else{
			$id_pengguna 			= $_POST['id_pengguna'];
			$kode_jenis_kegiatan 	= $_POST['kode_jenis_kegiatan'];
			$nama_kegiatan 			= $_POST['nama_kegiatan'];
			$tgl_kegiatan 			= date('Y-m-d',strtotime($_POST['tgl_kegiatan']));
			$tgl_selesai_kegiatan 	= date('Y-m-d',strtotime($_POST['tgl_selesai_kegiatan']));
			$dana_diajukan 			= $_POST['dana_diajukan'];
			$tgl_pengajuan 			= $_POST['tgl_pengajuan'];
			$id_pimpinan			= $_POST['id_pimpinan'];

			$data_pengajuan_kegiatan = array(
				'id_pengguna' 			=> $id_pengguna,
				'kode_jenis_kegiatan' 	=> $kode_jenis_kegiatan,
				'nama_kegiatan' 		=> $nama_kegiatan,
				'tgl_kegiatan'			=> $tgl_kegiatan,
				'tgl_selesai_kegiatan'	=> $tgl_selesai_kegiatan,
				'dana_diajukan' 		=> $dana_diajukan,
				'tgl_pengajuan'			=> $tgl_pengajuan,
				'pimpinan'				=> $id_pimpinan);

			$insert_id = $this->UserM->insert_pengajuan_kegiatan($data_pengajuan_kegiatan);
				if($insert_id){ //get last insert id
					$upload = $this->UserM->upload(); // lakukan upload file dengan memanggil function upload yang ada di UserM.php
				if($upload['result'] == "success"){ // Jika proses upload sukses
					$this->UserM->save($upload,$insert_id); // Panggil function save yang ada di UserM.php untuk menyimpan data ke database
				}else{ // Jika proses upload gagal
					$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
					$this->UserM->delete($insert_id);//hapus data pengajuan kegiatan ketka gagal upload file
					$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
					redirect('Staf_sarprasC/pengajuan_kegiatan');
				}
				$this->session->set_flashdata('sukses','Data Pengajuan Kegiatan anda berhasil ditambahkan');
				redirect('Staf_sarprasC/pengajuan_kegiatan');
			}else{
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
				redirect('Staf_sarprasC/pengajuan_kegiatan');
			}
		}
	}
	
}