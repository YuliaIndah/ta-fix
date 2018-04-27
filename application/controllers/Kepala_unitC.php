<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepala_unitC extends CI_Controller {

	var $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['UserM','Kepala_unitM']);
		Kepala_unit_access();
	}
	public function data_diri(){ //halaman data diri
		$data['title'] = "Data Diri | Kepala Unit";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('kepala_unit/data_diri_content', $this->data, true) ;
		$this->load->view('kepala_unit/index_template', $data);
	}

	function upload_image(){
		$id_pengguna=$this->input->post('id_pengguna');

        $config['upload_path'] = './assets/image/profil'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
        $config['overwrite'] = TRUE;
        $new_name = md5($id_pengguna);
        $config['file_name'] = $new_name;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if(!empty($_FILES['foto_profil']['name'])){

        	if ($this->upload->do_upload('foto_profil')){
        		$gbr = $this->upload->data();
                //Compress Image
        		$config['image_library']='gd2';
        		$config['source_image']='./assets/image/profil/'.$gbr['file_name'];
        		$config['create_thumb']= FALSE;
        		$config['maintain_ratio']= FALSE;
        		$config['quality']= '50%';
        		$config['width']= 100;
        		$config['height']= 100;
        		$config['new_image']= './assets/image/profil/'.$gbr['file_name'];
        		$this->load->library('image_lib', $config);
        		// $this->image_lib->crop();
        		$this->image_lib->resize();

        		$gambar=$gbr['file_name'];
        		$this->UserM->simpan_upload($id_pengguna,$gambar);
        		$this->session->set_flashdata('sukses','Foto berhasil diunggah');
        		redirect('Kepala_unitC/data_diri');
        		// echo "Image berhasil diupload";
        	}

        }else{
        	$this->session->set_flashdata('error','Foto tidak berhasil diunggah');
        	redirect('Kepala_unitC/data_diri');
        }

    }

	public function edit_data_diri($no_identitas){ //edit data diri
		$this->form_validation->set_rules('jen_kel', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('no_hp', 'no_hp','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			redirect('Kepala_unitC/pengajuan_kegiatan');
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
				redirect('Kepala_unitC/data_diri');
			}else{
				redirect('Kepala_unitC/pengajuan_kegiatan');
				$this->session->set_flashdata('error','Data anda tidak berhasil disimpan');
			}	
		}
	}


	public function index(){ //halaman index Sekretaris Departemen (dashboard)
		$data['title'] = "Beranda | Kepala Unit";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('kepala_unit/index_content', $this->data, true) ;
		$this->load->view('kepala_unit/index_template', $data);
	}

	public function pengajuan_kegiatan(){ //halaman kegiatan pegawai
		$data['title'] = "Pengajuan Kegiatan | Kepala Unit";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0]; //get data diri buat nampilin nama di pjok kanan
		$this->data['data_kegiatan'] = $this->UserM->get_kegiatan_pegawai()->result();	//menampilkan kegiatan yang diajukan user sebagai pegwai
		$this->data['UserM'] = $this->UserM ;	
		
		$data['body'] = $this->load->view('kepala_unit/pengajuan_kegiatan_content', $this->data, true);
		$this->load->view('kepala_unit/index_template', $data);
	}

	public function post_pengajuan_kegiatan_pegawai(){ //fungsi post pengajuan kegiatan pegawai
		$this->form_validation->set_rules('id_pengguna', 'ID Pengguna','required');
		$this->form_validation->set_rules('kode_jenis_kegiatan', 'Kode Jenis Kegiatan','required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('tgl_selesai_kegiatan', 'Tanggal Selesai Kegiatan','required');
		$this->form_validation->set_rules('tgl_kegiatan', 'Tanggal Kegiatan','required');
		$this->form_validation->set_rules('dana_diajukan', 'Dana Diajukan','required');
		$this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan','required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan 1');
			redirect('Kepala_unitC/pengajuan_kegiatan');
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
					redirect('Kepala_unitC/pengajuan_kegiatan');
				}
				$this->session->set_flashdata('sukses','Data Pengajuan Kegiatan anda berhasil ditambahkan');
				redirect('Kepala_unitC/pengajuan_kegiatan');
			}else{
				$this->session->set_flashdata('error','Data Pengajuan Kegiatan anda tidak berhasil ditambahkan');
				redirect('Kepala_unitC/pengajuan_kegiatan');
			}
		}
	}

	public function pengaturan_akun(){ //halaman pengaturan akun
		$data['title'] = "Pengaturan Akun | Kepala Unit";
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('kepala_unit/pengaturan_akun_content', $this->data, true) ;
		$this->load->view('kepala_unit/index_template', $data);
	}

	public function persetujuan_kegiatan_staf(){ //halaman persetujuan kegiatan staf (manajer keuangan)
		$id_pengguna = $this->session->userdata('id_pengguna');
		$kode_unit = $this->session->userdata('kode_unit');
		$kode_jabatan = $this->session->userdata('kode_jabatan');

		$data['title'] = "Persetujuan Kegiatan Staf | Kepla Unit";
		$this->data['data_pengajuan_kegiatan'] = $this->UserM->get_data_pengajuan_staf($kode_unit, $kode_jabatan)->result();
		$this->data['Kepala_unitM'] = $this->Kepala_unitM;
		$this->data['UserM'] = $this->UserM;
		$this->data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['body'] = $this->load->view('kepala_unit/persetujuan_kegiatan_staf_content', $this->data, true);
		$this->load->view('kepala_unit/index_template', $data);
	}

	public function detail_pengajuan($id){ //menampilkan modal dengan isi dari detail_pengajuan.php
		$data['detail_kegiatan'] = $this->UserM->get_data_pengajuan_by_id_staf($id)->result()[0];
		$data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$data['nama_progress'] = $this->UserM->get_pilihan_nama_progress()->result();
		$this->load->view('kepala_unit/detail_pengajuan', $data);
	}

	public function detail_kegiatan($id){ //menampilkan modal dengan isi dari detail_pengajuan.php
		$data['detail_kegiatan'] = $this->UserM->get_data_pengajuan_by_id_staf($id)->result()[0];
		$data['data_diri'] = $this->UserM->get_data_diri()->result()[0];  	//get data diri buat nampilin nama di pjok kanan
		$this->load->view('kepala_unit/detail_kegiatan', $data);
	}
	public function detail_progress($id){ //menampilkan modal dengan isi dari detail_kegiatan.php
		$data['detail_progress']	= $this->UserM->get_detail_progress($id)->result();
		$this->load->view('kepala_unit/detail_progress', $data);
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
					redirect('Kepala_unitC/pengaturan_akun');
				}else{
					$this->session->set_flashdata('error','Data tidak berhasil dirubah');
					redirect('Kepala_unitC/pengaturan_akun');
				}
			}else{
				$this->session->set_flashdata('error','Kata sandi lama tidak cocok');
				redirect('Kepala_unitC/pengaturan_akun');
			}	
		}
	}
}