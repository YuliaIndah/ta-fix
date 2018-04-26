<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StafC extends CI_Controller {

	var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['UserM','StafM']);
		staf_access();
	}

	public function data_diri(){ //halaman data diri
		$data['title'] = "Data Diri | Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf/data_diri_content', $this->data, true) ;
		$this->load->view('staf/index_template', $data);
	}

	public function edit_data_diri($no_identitas){ //edit data diri
		$this->form_validation->set_rules('jen_kel', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('no_hp', 'no_hp','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			redirect('StafC/pengajuan_kegiatan');
		}else{
			$jen_kel    = $_POST['jen_kel'];
			$tmp_lahir  = $_POST['tmp_lahir'];
			$tgl_lahir  = date('Y-m-d',strtotime($_POST['tgl_lahir']));
			$alamat     = $_POST['alamat'];
			$no_hp      = $_POST['no_hp'];

			$data = array(
				'jen_kel'     => $jen_kel,
				'tmp_lahir'   => $tmp_lahir,
				'tgl_lahir'   => $tgl_lahir,
				'alamat'      => $alamat,
				'no_hp'       => $no_hp
			);

			if($this->UserM->edit_data_diri($no_identitas,$data)){
				$this->session->set_flashdata('sukses','Data anda berhasil disimpan');
				redirect('StafC/data_diri');
			}else{
				redirect('StafC/pengajuan_kegiatan');
				$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			}	
		}
	}


	public function index(){ //halaman index Sekretaris Departemen (dashboard)
		$data['title'] = "Beranda | Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf/index_content', $this->data, true) ;
		$this->load->view('staf/index_template', $data);
	}

	public function pengajuan_kegiatan(){ //halaman kegiatan pegawai
		$kode_unit = $this->session->userdata('kode_unit');

		$data['title'] 					= "Pengajuan Kegiatan | Staf Keuangan";
		$this->data['UserM'] = $this->UserM ;	
		$this->data['data_diri'] 		= $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pjok kanan
		$this->data['data_kegiatan'] 	= $this->UserM->get_kegiatan_pegawai()->result();	//menampilkan kegiatan yang diajukan user sebagai pegwai
		$this->data['id_pimpinan'] 		= $this->UserM->get_id_pimpinan($kode_unit)->result()[0]->id_pengguna;
		$data['body'] 					= $this->load->view('staf/pengajuan_kegiatan_content', $this->data, true);
		$this->load->view('staf/index_template', $data);
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
			redirect('StafC/pengajuan_kegiatan');
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
					redirect('StafC/pengajuan_kegiatan');
				}
				$this->session->set_flashdata('sukses','Data Pengajuan Kegiatan anda berhasil ditambahkan');
				redirect('StafC/pengajuan_kegiatan');
			}else{
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
				redirect('StafC/pengajuan_kegiatan');
			}
		}
	}
	public function pengaturan_akun(){ //halaman pengaturan akun
		$data['title'] = "Pengaturan Akun | Sekretaris Departemen";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf/pengaturan_akun_content', $this->data, true) ;
		$this->load->view('staf/index_template', $data);
	}

	public function detail_progress($id){ //menampilkan modal dengan isi dari detail_kegiatan.php
		$data['detail_progress']	= $this->UserM->get_detail_progress($id)->result();
		$this->load->view('staf/detail_progress', $data);
	}

	public function post_ganti_password(){
		$this->form_validation->set_rules('sandi_lama', 'Sandi Lama', 'trim|required|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('sandi_baru', 'Sandi Baru', 'trim|required|min_length[6]|max_length[50]');
		$this->form_validation->set_rules('konfirmasi_sandi_baru', 'Konfirmasi Sandi Baru', 'trim|required|min_length[6]|max_length[50]|matches[sandi_baru]'); 
		if ($this->form_validation->run() == FALSE)  
		{  
			redirect_back();
		}else{ 
			$sandi_lama   = $_POST['sandi_lama'];  
			$sandi_baru   = $_POST['sandi_baru'];  
			$id_pengguna  = $_POST['id_pengguna']; 

			$sandi_baru   = $_POST['sandi_baru'];  
			$passhash     = md5($sandi_baru);

			$data_update  = array(
				'password'        => $passhash);

			$ada = $this->UserM->cek_row($id_pengguna, $sandi_lama);
			if($ada > 0){
				if($this->UserM->update_pass($id_pengguna, $data_update)){
					$this->session->set_flashdata('sukses','Data berhasil dirubah');
					redirect('StafC/pengaturan_akun');
				}else{
					$this->session->set_flashdata('error','Data tidak berhasil dirubah');
					redirect('StafC/pengaturan_akun');
				}
			}else{
				$this->session->set_flashdata('error','Kata sandi lama tidak cocok');
				redirect('StafC/pengaturan_akun');
			}	
		}
	}
}