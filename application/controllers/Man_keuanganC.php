<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Man_keuanganC extends CI_Controller {

	var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['UserM','Man_keuanganM']);
		Man_keuangan_acess();
	}

	// sebagai semua
	public function data_diri(){ //halaman data diri
		$data['title'] = "Data Diri | Kepala Departemen";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/data_diri_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}

	// sebagai manajer keuangan
	public function index(){ //halaman index manajer Keuangan (dashboard)
		$data['title'] = "Beranda | Manajer Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/index_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}

	public function pengaturan_akun(){ //halaman pengaturan akun
		$data['title'] = "Pengaturan Akun | Manajer Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/pengaturan_akun_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}

	public function persetujuan_kegiatan_pegawai(){ //halaman persetujuan kegiatan pegawai (manajer keuangan)
		$kode_jenis_kegiatan = 1; //kegiatan pegawai
		$data['title'] = "Persetujuan Kegiatan Pegawai | Manajer Keuangan";
		$this->data['data_pengajuan_kegiatan'] = $this->UserM->get_data_pengajuan($kode_jenis_kegiatan)->result();
		$this->data['UserM'] = $this->UserM ;	
		$this->data['Man_keuanganM'] = $this->Man_keuanganM ;	
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/persetujuan_kegiatan_pegawai_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}
	public function persetujuan_kegiatan_mahasiswa(){ //halaman persetujuan kegiatan pegawai mahasiswa (manajer keuangan)
		$kode_jenis_kegiatan = 2; //kegiatan mahasiswa
		$data['title'] = "Persetujuan Kegiatan Mahasiswa  | Manajer Keuangan";
		$this->data['data_pengajuan_kegiatan'] = $this->UserM->get_data_pengajuan($kode_jenis_kegiatan)->result();
		$this->data['UserM'] = $this->UserM ;
		$this->data['Man_keuanganM'] = $this->Man_keuanganM ;		
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/persetujuan_kegiatan_mahasiswa_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}
	public function persetujuan_kegiatan_staf(){ //halaman persetujuan kegiatan staf (manajer keuangan)

		$id_pengguna = $this->session->userdata('id_pengguna');
		$kode_unit = $this->session->userdata('kode_unit');
		$kode_jabatan = $this->session->userdata('kode_jabatan');
		$data['title'] = "Persetujuan Kegiatan Staf | Manajer Keuangan";

		$this->data['data_pengajuan_kegiatan'] = $this->Man_keuanganM->get_data_pengajuan_staf($kode_unit, $kode_jabatan)->result();
		$this->data['UserM'] = $this->UserM ;
		$this->data['Man_keuanganM'] = $this->Man_keuanganM ;		
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('man_keuangan/persetujuan_kegiatan_staf_content', $this->data, true) ;
		$this->load->view('man_keuangan/index_template', $data);
	}

	// sebagi pegawai

	public function pengajuan_kegiatan(){ //halaman pengajuan kegiatan pegawai
		$data['title'] = "Pengajuan Kegiatan | Manajer Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pjok kanan
		$this->data['data_kegiatan'] = $this->UserM->get_kegiatan_pegawai()->result();	//menampilkan kegiatan yang diajukan user sebagai pegwai
		$this->data['UserM'] = $this->UserM ;	
		
		$data['body'] = $this->load->view('man_keuangan/pengajuan_kegiatan_content', $this->data, true);
		$this->load->view('man_keuangan/index_template', $data);
	}

	public function detail_pengajuan($id){ //menampilkan modal dengan isi dari detail_pengajuan.php
		$data['detail_kegiatan'] = $this->UserM->get_data_pengajuan_by_id_staf($id)->result()[0];
		$data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['nama_progress'] = $this->UserM->get_pilihan_nama_progress()->result();
		$this->load->view('man_keuangan/detail_pengajuan', $data);
	}

	public function detail_kegiatan($id){ //menampilkan modal dengan isi dari detail_pengajuan.php
		$data['detail_kegiatan'] = $this->UserM->get_data_pengajuan_by_id_staf($id)->result()[0];
		$data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$this->load->view('man_keuangan/detail_kegiatan', $data);
	}

	public function detail_progress($id){ //menampilkan modal dengan isi dari detail_kegiatan.php
		$data['detail_progress']	= $this->UserM->get_detail_progress($id)->result();
		$this->load->view('man_keuangan/detail_progress', $data);
	}


	public function edit_data_diri($no_identitas){ //edit data diri
		$this->form_validation->set_rules('jen_kel', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('no_hp', 'no_hp','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			redirect('Man_keuanganC/data_diri');
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
				redirect('Man_keuanganC/data_diri');
			}else{
				redirect('Man_keuanganC/data_diri');
				$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			}	
		}
	}

	public function post_pengajuan_kegiatan_pegawai(){ //fungsi post pengajuan kegiatan pegawai
		$this->form_validation->set_rules('id_pengguna', 'No Identitas','required');
		$this->form_validation->set_rules('kode_jenis_kegiatan', 'Kode Jenis Kegiatan','required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('tgl_kegiatan', 'Tanggal Kegiatan','required');
		$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan','required');
		$this->form_validation->set_rules('dana_diajukan', 'Dana Diajukan','required');
		$this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
			redirect('Man_keuanganC/pengajuan_kegiatan_');
		}else{
			$id_pengguna 			= $_POST['id_pengguna'];
			$kode_jenis_kegiatan 	= $_POST['kode_jenis_kegiatan'];
			$nama_kegiatan 			= $_POST['nama_kegiatan'];
			$tgl_kegiatan 			= date('Y-m-d',strtotime($_POST['tgl_kegiatan']));
			$tgl_selesai_kegiatan 	= date('Y-m-d',strtotime($_POST['tgl_selesai_kegiatan']));
			$dana_diajukan 			= $_POST['dana_diajukan'];
			$tgl_pengajuan 			= $_POST['tgl_pengajuan'];

			$data_pengajuan_kegiatan = array(
				'id_pengguna' 			=> $id_pengguna,
				'kode_jenis_kegiatan' 	=> $kode_jenis_kegiatan,
				'nama_kegiatan' 		=> $nama_kegiatan,
				'tgl_kegiatan'			=> $tgl_kegiatan,
				'tgl_selesai_kegiatan'	=> $tgl_selesai_kegiatan,
				'dana_diajukan' 		=> $dana_diajukan,
				'tgl_pengajuan'			=> $tgl_pengajuan,
				'pimpinan'				=> $id_pengguna);

			$insert_id = $this->UserM->insert_pengajuan_kegiatan($data_pengajuan_kegiatan);
				if($insert_id){ //get last insert id
					$upload = $this->UserM->upload(); // lakukan upload file dengan memanggil function upload yang ada di UserM.php
				if($upload['result'] == "success"){ // Jika proses upload sukses
					$this->UserM->save($upload,$insert_id); // Panggil function save yang ada di UserM.php untuk menyimpan data ke database

					$format_tgl 	= "%Y-%m-%d";
					$tgl_progress 	= mdate($format_tgl);
					$format_waktu 	= "%H:%i:%s";
					$waktu_progress	= mdate($format_waktu);

					$kode_nama_progress	= "1";
					$komentar			= "insert otomatis";
					$jenis_progress		= "kegiatan";

					$data = array(
						'id_pengguna' 			=> $id_pengguna,
						'kode_fk'				=> $insert_id,
						'kode_nama_progress' 	=> $kode_nama_progress,
						'komentar'				=> $komentar,
						'jenis_progress'		=> $jenis_progress,
						'tgl_progress'			=> $tgl_progress,
						'waktu_progress'		=> $waktu_progress

					);
				$this->UserM->insert_progress($data); //insert progress langsung ketika mengajukan kegiatan untuk manajer, kepala, dan pimpinan yang lain

				}else{ // Jika proses upload gagal
					$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
					$this->UserM->delete($insert_id);//hapus data pengajuan kegiatan ketka gagal upload file
					$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
					redirect('Man_keuanganC/pengajuan_kegiatan');
				}
				$this->session->set_flashdata('sukses','Data Pengajuan Kegiatan anda berhasil ditambahkan');
				redirect('Man_keuanganC/pengajuan_kegiatan');
			}else{
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
				redirect('Man_keuanganC/pengajuan_kegiatan');
			}
		}
	}

	public function post_progress(){ //posting progress dan update kegiatan (dana disetujuin)
		$this->form_validation->set_rules('id_pengguna', 'ID Pengguna','required');
		$this->form_validation->set_rules('kode_fk', 'Kode Kegiatan','required');
		$this->form_validation->set_rules('kode_nama_progress', 'Nama Progress','required'); //diterima/ditolak
		$this->form_validation->set_rules('komentar', 'Komentar','required');
		$this->form_validation->set_rules('jenis_progress', 'Jenis Progress','required'); //kegiatan/barang
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			redirect_back(); //kembali ke halaman sebelumnya -> helper
		}else{
			$id_pengguna		= $_POST['id_pengguna'];
			$kode_fk			= $_POST['kode_fk'];
			$kode_nama_progress	= $_POST['kode_nama_progress'];
			$komentar			= $_POST['komentar'];
			$jenis_progress		= $_POST['jenis_progress'];


			$format_tgl 	= "%Y-%m-%d";
			$tgl_progress 	= mdate($format_tgl);
			$format_waktu 	= "%H:%i";
			$waktu_progress	= mdate($format_waktu);

			$data = array(
				'id_pengguna' 			=> $id_pengguna,
				'kode_fk'				=> $kode_fk,
				'kode_nama_progress' 	=> $kode_nama_progress,
				'komentar'				=> $komentar,
				'jenis_progress'		=> $jenis_progress,
				'tgl_progress'			=> $tgl_progress,
				'waktu_progress'		=> $waktu_progress

			);

			if($this->UserM->insert_progress($data)){ //insert progress
				$this->session->set_flashdata('sukses','Data anda berhasil disimpan');
				redirect_back(); // redirect kembali ke halaman sebelumnya
			}else{
				$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
				redirect_back(); //kembali ke halaman sebelumnya -> helper
			}
		}
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
					redirect('Man_keuanganC/pengaturan_akun');
				}else{
					$this->session->set_flashdata('error','Data tidak berhasil dirubah');
					redirect('Man_keuanganC/pengaturan_akun');
				}
			}else{
				$this->session->set_flashdata('error','Kata sandi lama tidak cocok');
				redirect('Man_keuanganC/pengaturan_akun');
			}	
		}
	}
}