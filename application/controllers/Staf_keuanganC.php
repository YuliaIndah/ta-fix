<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf_keuanganC extends CI_Controller {

	var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['UserM','staf_keuanganM']);
		Staf_keuangan_access();
	}

	public function data_diri(){ //halaman data diri
		$data['title'] = "Data Diri | Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_keuangan/data_diri_content', $this->data, true) ;
		$this->load->view('staf_keuangan/index_template', $data);
	}

	public function status_kegiatan_pegawai(){ //halaman index Sekretaris Departemen (dashboard)
		$kode_jenis_kegiatan = 1; //kegiatan mahasiswa
		$this->data['data_pengajuan_kegiatan'] = $this->UserM->get_data_pengajuan($kode_jenis_kegiatan)->result();
		$this->data['UserM'] = $this->UserM ;
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['title'] = "status Kegiatan Pegawai| Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_keuangan/status_kegiatan_pegawai_content', $this->data, true) ;
		$this->load->view('staf_keuangan/index_template', $data);
	}
	public function status_kegiatan_mahasiswa(){ //halaman index Sekretaris Departemen (dashboard)
		$kode_jenis_kegiatan = 2; //kegiatan mahasiswa
		$this->data['data_pengajuan_kegiatan'] = $this->UserM->get_data_pengajuan($kode_jenis_kegiatan)->result();
		$this->data['UserM'] = $this->UserM ;
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['title'] = "status Kegiatan Mahasiswa| Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_keuangan/status_kegiatan_mahasiswa_content', $this->data, true) ;
		$this->load->view('staf_keuangan/index_template', $data);
	}

	public function detail_kegiatan($id){ //menampilkan modal dengan isi dari detail_pengajuan.php
		$data['detail_kegiatan'] = $this->UserM->get_data_pengajuan_by_id_staf($id)->result()[0];
		$data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$this->load->view('staf_keuangan/detail_kegiatan', $data);
	}

	public function edit_data_diri($no_identitas){ //edit data diri
		$this->form_validation->set_rules('jen_kel', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('no_hp', 'no_hp','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			redirect('Staf_keuanganC/pengajuan_kegiatan');
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
				redirect('Staf_keuanganC/data_diri');
			}else{
				redirect('Staf_keuanganC/pengajuan_kegiatan');
				$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			}	
		}
	}


	public function index(){ //halaman index Sekretaris Departemen (dashboard)
		$data['title'] = "Beranda | Staf Keuangan";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_keuangan/index_content', $this->data, true) ;
		$this->load->view('staf_keuangan/index_template', $data);
	}

	public function pengajuan_kegiatan(){ //halaman kegiatan pegawai
		$kode_unit = $this->session->userdata('kode_unit');

		$data['title'] = "Pengajuan Kegiatan | Staf Keuangan";
		$this->data['UserM'] = $this->UserM ;	
		// $this->data['Staf_keuanganM'] = $this->Staf_keuanganM ;	

		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pjok kanan
		$this->data['data_kegiatan'] = $this->UserM->get_kegiatan_pegawai()->result();	//menampilkan kegiatan yang diajukan user sebagai pegwai
		$this->data['id_pimpinan'] 		= $this->UserM->get_id_pimpinan($kode_unit)->result()[0]->id_pengguna; //ambil id pimpinan
		$data['body'] = $this->load->view('staf_keuangan/pengajuan_kegiatan_content', $this->data, true);
		$this->load->view('staf_keuangan/index_template', $data);
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
			redirect('staf_keuanganC/pengajuan_kegiatan');
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
					redirect('staf_keuanganC/pengajuan_kegiatan');
				}
				$this->session->set_flashdata('sukses','Data Pengajuan Kegiatan anda berhasil ditambahkan');
				redirect('staf_keuanganC/pengajuan_kegiatan');
			}else{
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
				redirect('staf_keuanganC/pengajuan_kegiatan');
			}
		}
	}
	public function pengaturan_akun(){ //halaman pengaturan akun
		$data['title'] = "Pengaturan Akun | Sekretaris Departemen";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('staf_keuangan/pengaturan_akun_content', $this->data, true) ;
		$this->load->view('staf_keuangan/index_template', $data);
	}

	public function detail_progress($id){ //menampilkan modal dengan isi dari detail_kegiatan.php
		$data['detail_progress']	= $this->UserM->get_detail_progress($id)->result();
		$this->load->view('staf_keuangan/detail_progress', $data);
	}
}