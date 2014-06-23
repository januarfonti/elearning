<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Rest_Client extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->config('rest');
		$this->load->spark('restclient/2.0.0');		
		$this->rest->initialize(array('server' => $this->config->item('rest_server')));
		//$this->rest->initialize(array('server' => 'http://localhost/elearning/index.php/rest_server/'));
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in')!="") {
			if($this->session->userdata('logged_in')!="" && $this->session->userdata('status')=="Aktif") {				
			redirect('rest_client/list_user');
			}
			else if($this->session->userdata('logged_in')!="" && $this->session->userdata('status')=="Tidak Aktif") {				
			$this->session->set_flashdata('akun', 'Akun anda belum aktif');
			redirect('rest_client/logout');
			}
		}
		else if ($this->session->userdata('logged_in')=="") {
			redirect('rest_client/login');
		}
	}
	
	/**
	 * 
	 * Produces a human readable list of methods available on the server side
	 */
	public function displayAPI()
	{
		//get methods list
        $methods_html = '';
        $methods = (array) $this->rest->get('API/format/json');
        
        //show the docstring for the method
        if(count($methods['functions'])>0)
        {
        	foreach ( $methods['functions'] as  $method) {	    
				if(empty($method->docstring))
				{
					$methods_html .= '<dt>'.$method->function.'</dt><dd>No description available</dd>';
				} else {
					$methods_html .= '<dt>'.$method->function.'</dt><dd>'.$method->docstring.'</dd>';
				}
        	}	
        	$methods_html .= '</dl>';
        }
        	
		echo '<pre>';
		print_r($methods);
		echo '</pre>';         

       	return $methods_html;				
	}		

	/**
	FUNGSI LOGIN
	**/

	public function login(){ 
		
		if($this->session->userdata('logged_in')=="") {
			$this->load->view('login'); 
		}

		else if($this->session->userdata('logged_in')!="") {
			redirect('rest_client');
		}
	}  
/**
	public function proses_login(){
		$data = array( 	'username' => $this->input->post('username'), 
						'password' => $this->input->post('password')
					); 
		$hasil = $this->rest->post('login/format/php',$data);
		$keluar=  $this->rest->get('login');
		echo "<pre>";
		echo $keluar->stat;
		echo "</pre>";
	} 

	**/

	

	public function proses_login(){
		$data = array( 	'username' => $this->input->post('username'), 
						'password' => $this->input->post('password')
					); 
		$hasil = $this->rest->post('login/format/php',$data);
		if ($hasil=='1'){
			$cek=$this->model_user->ambilPengguna($data);
			foreach($cek->result() as $qad)
            {
              $sess_data['logged_in'] = 'WesLogin';
              $sess_data['id_user'] = $qad->id;
              $sess_data['nama'] = $qad->nama;
              $sess_data['user'] = $qad->username;
              $sess_data['password'] = $qad->password;
              $sess_data['level'] = $qad->level;
              $sess_data['status'] = $qad->status;
              $this->session->set_userdata($sess_data);
            }
            if($this->session->userdata('level')=="Admin" && $this->session->userdata('status')=="Aktif") {
			redirect('rest_client/list_user');
			}
			else if($this->session->userdata('level')=="Dosen" && $this->session->userdata('status')=="Aktif") {
				redirect('rest_client/tampil_matkul_dosen');
			}
			else if($this->session->userdata('level')=="Mahasiswa" && $this->session->userdata('status')=="Aktif") {
				redirect('rest_client/tampil_matkul_mahasiswa');
			}
			else if($this->session->userdata('status')=="Tidak Aktif") {
				redirect('rest_client/logout');
			}

		}
		else{
			echo " <script>alert('Gagal Login: Cek username , password dan level anda!');history.go(-1);</script>";
		}
	} 

	public function logout() {
		$this->session->sess_destroy();
		redirect('rest_client/login');
	} 



	/**
	FUNGSI REGISTER
	*/


	public function form_register(){ 
		$this->load->view('form_register'); 
	}   

	public function register_rest(){ 
		$data = array( 	'level' => $this->input->post('level'), 
						'nama' => $this->input->post('nama'), 
						'username' => $this->input->post('username'), 
						'password' => $this->input->post('password'),
						'status' => $this->input->post('status')
						
					); 
		$query = $this->rest->post('register/mboh/1/format/php',$data); 
		if($query) { 
			redirect('rest_client/login'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	/**
	FUNGSI ADMIN
	*/

	public function proses_ubah(){ 
		$id = $this->input->post('id');   
		$data = array('status' => $this->input->post('status')); 
		
		$query = $this->rest->post('ubah/id/'.$id.'/format/php',$data); 
		if($query) { 
			//echo $query; 
			
			redirect('rest_client/list_user'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	public function list_user() { 
		$query =$this->rest->get('alluser/format/json');
		$data['user']=$query; 
			
		
		//$this->load->view('dashboard',$data); 

		$data['output']	=$this->load->view('list_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}


	public function detail_user($id){ 
		$data['user'] = $this->rest->get('user/id/'.$id.'/format/json'); 
		$data['output']	=$this->load->view('detail_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}   

	
	
	public function proses_edit_user(){ 

		$id = $this->input->post('id');   
		$data = array('status' => $this->input->post('status'));   
		if($query = $this->rest->post('update_user/id/'.$id.'/format/php',$data))
		{ 
			
			redirect('rest_client/list_user');
		} 
		else 
			{ 
				echo "<script>alert('Gagal coy'); window.close ();</script>"; 
			}   
	}


	public function tampil_matkul() { 
		$query =$this->rest->get('matkul/format/json');
		$data['matkul']=$query; 
		$data['output']	=$this->load->view('list_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}



	public function tambah_matkul(){ 
		
		$data['judul'] = 'Tambah Mata Kuliah';
		$data['dosen'] = $this->model_user->tampil_dosen();
		$data['output']	=$this->load->view('tambah_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		
	}   

	
	public function proses_tambah_matkul(){ 
		$data = array( 	'nama_matkul' => $this->input->post('nama_matkul'), 
						'enroll' => $this->input->post('enroll')
						
					); 
		$query = $this->rest->post('tambah_matkul/coba/1/format/php',$data); 
		if($query) { 
			redirect('rest_client/tampil_matkul'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	
	/** 
	Funntion Dosen 
	**/

	public function tampil_matkul_dosen() { 
		
		/** WEB SERVICE TAPI ERROR
		$query =$this->rest->get('matkul_dosen/format/json');
		$data['matkul_dosen']=$query;
		**/
		
		
		$id = $this->session->userdata('id_user'); 
		$data['matkul_dosen']=$this->model_matkul->show_matkul_dosen($id); 
		

		$data['output']	=$this->load->view('list_matkul_dosen',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}



	/** 
	Funntion Mahasiswa 
	**/


	public function tampil_matkul_mahasiswa() { 
		$query =$this->rest->get('matkul/format/json');
		$data['matkul']=$query; 
		$data['output']	=$this->load->view('list_matkul_mahasiswa',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function enroll() { 
		//$query =$this->rest->get('matkul/format/json');
		//$data['matkul']=$query; 

		$id_user = $this->session->userdata('id_user');
		$cek_enroll= $this->db->query("select * from tbl_enroll where id_user='$id_user'");
		if($cek_enroll->num_rows()>0) {
			
			$id_mk='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id_mk='';
			}
			else
			{
	    			$id_mk = $this->uri->segment(3);
			}


			$data['id_mk']=$id_mk;

			$data['judul_halaman']='Enroll';
			$data['output']	=$this->load->view('sudah_enroll',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);
			
		}

		else if ($cek_enroll->num_rows()==0)
		{
			
			$data['judul_halaman']='Enroll';
			$id_mk='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id_mk='';
			}
			else
			{
	    			$id_mk = $this->uri->segment(3);
			}


			$data['id_mk']=$id_mk;
			
			$data['output']	=$this->load->view('form_enroll',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);

		}


		
	}

	
		public function cek_enroll(){ 
			
		$enroll_key=$this->input->post('enroll');
		$cek_enroll = $this->model_matkul->cek_enroll($enroll_key);
		

		if($cek_enroll->num_rows()!=0) {
			
					

			$data['id_mk']=$this->input->post('input_idmk');
			$data['id_user']=$this->session->userdata('id_user');

			$this->rest->post('insert_enroll/enroll/1/format/php',$data); 

			//$this->model_matkul->insert_enroll($data); 
			$id_ne=$this->input->post('input_idmk');
			//echo " <script>alert('Berhasil Coy');history.go(-1);</script><meta http-equiv='refresh'>";
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/lihatsoal/$id_ne'>";
			
		}
		else if($cek_enroll->num_rows()==0) {
			redirect('rest_client/enroll');
		}
		}

		/**
		public function cek_enroll(){ 
			
		$enroll_key=$this->input->post('enroll');
		$cek_enroll = $this->model_matkul->cek_enroll($enroll_key);
		

		if($cek_enroll->num_rows()!=0) {
			
					

			$data['id_mk']=$this->input->post('input_idmk');
			$data['id_user']=$this->session->userdata('id_user');
			$this->model_matkul->insert_enroll($data); 
			$id_ne=$this->input->post('input_idmk');
			//echo " <script>alert('Berhasil Coy');history.go(-1);</script><meta http-equiv='refresh'>";
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/lihatsoal/$id_ne'>";
			
		}
		else if($cek_enroll->num_rows()==0) {
			redirect('rest_client/enroll');
		}
		}

	**/

		public function nilai(){
			
			$data['judul']='Nilai Keseluruhan';
			$data['tampil_nilai']=$this->rest->get('nilai');
			$data['output']	=$this->load->view('nilai',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);
			
			
			
				
			
		}



	/**
	SOAAAL
	**/

	public function lihatsoal()
	{
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}

		$query =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');
		$judul =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');

		$data['cobak']=$id_mk;
		$data['query']=$query; 
		$data['judul']=$judul; 
		$data['output']	=$this->load->view('lihat_soal',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function ikutites()
	{
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
		$no_soal='';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$no_soal='';
		}
		else
		{
    			$no_soal = $this->uri->segment(4);
		}
		
		
		$data["judul"]=$this->model_matkul->Judul_MK($id_mk);
		$data["soal"] = $this->model_matkul->Tampilkan_Soal($id_mk,$no_soal);
		$data["jumlah"] = $data["soal"]->num_rows;
		
		
		
		$data['output']	=$this->load->view('mulai_tes',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		
		
	}

	public function hasiltes()
	{
		
		$data=array();
		$jumlah = $this->input->post('banyak_soal');
		$jawaban= $this->input->post('pilih');
		$matkul = $this->input->post('matkul');
		$id_mk = $this->input->post('id_mk');
		$no_soal = $this->input->post('no_soal');
		$query=$this->model_matkul->Hitung_Hasil($id_mk,$no_soal);
		$data["hit_hasil"]=$query;
		$benar=0;
		$salah=0;
		foreach($query->result() as $hasil)
		{
			$jwb=$jawaban;
			$id=$hasil->id_soal;
			if($jwb[$id]==$hasil->kunci)
			{
				$benar++;
			}
			else {
				$salah++;
			}
		}
		$nilai=sprintf("%2.1f",$benar/$jumlah*100);
		if($nilai<60){
			$pesan="Belajarlah lebih baik lagi, sehingga bisa sukses di kemudian hari.";
		}
		else{
			$pesan="Selamat dan tingkatkan lagi.";
		}
		$datainput=array();
		$datainput["id_mk"]=$this->input->post('id_mk');
		$datainput["no_soal"]=$this->input->post('no_soal');
		$datainput["username"]=$this->session->userdata('user');
		$datainput["salah"]=$salah;
		$datainput["benar"]=$benar;
		$datainput["hasil"]=$nilai;
		if ($id_mk=="" AND $no_soal==""){
			echo "Ouuuppppzzzz,,,soalnya belum dikerjakan boz!!!!";
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/tampil_matkul'>";
		}
		else{
			$this->model_matkul->Simpan_Hasil($datainput);
		?>
		<script type="text/javascript" language="javascript">
		alert("<?php echo $this->session->userdata('user'); ?> telah mengikuti tes soal online <?php echo $matkul; ?>\n- Dengan total jawaban benar <?php echo $benar; ?> dan total jawaban salah <?php echo $salah; ?>.\n- Anda memperoleh nilai <?php echo $nilai; ?>\n- Pesan : <?php echo $pesan; ?>");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/tampil_matkul'>";
		}
	}

	/**
	 * 
	 * Access API "API" using GET through Phil's rest client
	 */		
	public function getApi()
	{
		echo '<pre>';
		print_r($this->rest->get('API/format/json'));
		echo '</pre>';		
	}		
}