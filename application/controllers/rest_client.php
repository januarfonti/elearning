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


	public function login(){ 
		
		if($this->session->userdata('logged_in')=="") {
			$this->load->view('login'); 
		}

		else if($this->session->userdata('logged_in')!="") {
			redirect('rest_client');
		}
	}  

	

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
			$this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									Registrasi Berhasil !
										</div>');
			redirect('rest_client/login'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
	} 

	

	public function list_user() { 
		$query =$this->rest->get('alluser/format/json');
		$data['title']='List User | Elearning PTIIK'; 
		$data['user']=$query; 
		$data['output']	=$this->load->view('list_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}


	public function detail_user($id){ 
		$data['title']='Detail User | Elearning PTIIK'; 
		$data['user'] = $this->rest->get('user/id/'.$id.'/format/json'); 
		$data['output']	=$this->load->view('detail_user',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}   

	
	
	public function proses_edit_user(){ 

		$id = $this->input->post('id');   
		$data = array('status' => $this->input->post('status'));   
		if($query = $this->rest->post('update_user/id/'.$id.'/format/php',$data))
		{ 
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									User Berhasi Diubah !
										</div>');
			redirect('rest_client/list_user');
		} 
		else 
			{ 
				echo "<script>alert('Gagal coy'); window.close ();</script>"; 
			}   
	}


	public function tampil_matkul() { 
		$query =$this->rest->get('matkul/format/json');
		$data['title']='Mata Kuliah | Elearning PTIIK'; 
		$data['matkul']=$query; 
		$data['output']	=$this->load->view('list_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}



	public function tambah_matkul(){ 
		
		$data['judul'] = 'Tambah Mata Kuliah';
		$data['title']='Tambah Mata Kuliah | Elearning PTIIK'; 
		$data['dosen'] = $this->model_user->tampil_dosen();
		$data['output']	=$this->load->view('tambah_matkul',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		
	}   

	
	public function proses_tambah_matkul(){ 
		$data = array( 	'nama_matkul' => $this->input->post('nama_matkul'), 
						'enroll' => $this->input->post('enroll'),
						'id_dosen' => $this->input->post('id_dosen')
						
					); 
		$query = $this->rest->post('tambah_matkul/coba/1/format/php',$data); 
		if($query) { 
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									Mata Kuliah Berhasil Ditambah !
										</div>');

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
		$id = $this->session->userdata('id_user'); 
		$data['title']='Mata Kuliah Dosen | Elearning PTIIK'; 
		$data['matkul_dosen']=$this->model_matkul->show_matkul_dosen($id); 
		$data['output']	=$this->load->view('list_matkul_dosen',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}



	public function tampil_matkul_mahasiswa() { 
		$query =$this->rest->get('matkul/format/json');
		$data['title']='Mata Kuliah | Elearning PTIIK'; 
		$data['matkul']=$query; 
		$data['output']	=$this->load->view('list_matkul_mahasiswa',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function enroll() { 
		$id_mk='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id_mk='';
			}
			else
			{
	    			$id_mk = $this->uri->segment(3);
			}
		$id_user = $this->session->userdata('id_user');
		$cek_enroll= $this->db->query("select * from tbl_enroll where id_user='$id_user' and id_mk='$id_mk'");
		if($cek_enroll->num_rows()>0) {
			$sess_data['session_id_mk'] = $id_mk;
        	$this->session->set_userdata($sess_data);
			$data['id_mk']=$id_mk;
			$data['title']='Enroll | Elearning PTIIK'; 
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
			$data['title']='Enroll User | Elearning PTIIK'; 
			$data['output']	=$this->load->view('form_enroll',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);

		}
	}

	
	public function cek_enroll(){ 
			
		$enroll_key=$this->input->post('enroll');
		$cek_enroll = $this->model_matkul->cek_enroll($enroll_key);
		

		if($cek_enroll->num_rows()!=0) {
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
			$data['id_user']=$this->session->userdata('id_user');
			//$this->rest->post('insert_enroll/enroll/1/format/php',$data); 
			$this->model_matkul->insert_enroll($data); 
			$id_ne=$this->input->post('input_idmk');
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/rest_client/event/$id_ne'>";
			
		}
		else if($cek_enroll->num_rows()==0) {
			redirect('rest_client/enroll');
		}
		}

		public function nilai(){
		
			$id_user= $this->session->userdata('id_user');
			$query = $this->rest->get('nilai/'.$id_user.'/format/json');
			$data['judul']='Nilai Keseluruhan';
			$data['title']='Nilai | Elearning PTIIK'; 
			$data['nilai']	=$query;
			$data['output']	=$this->load->view('nilai',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);

	}


	public function all_nilai(){
		
			$id_mk='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id_mk='';
			}
			else
			{
	    			$id_mk = $this->uri->segment(3);
			}
			$query = $this->rest->get('all_nilai/'.$id_mk.'/format/json');
			$data['judul']='Nilai Keseluruhan';
			$data['title']='Nilai | Elearning PTIIK'; 
			$data['nilai']	=$query;
			$data['output']	=$this->load->view('nilai',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);

	}




	public function event()
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

		//$data['query'] = $this->rest->get('event/'.$id_mk.'/format/json');
		//$data['query'] = $this->rest->get('ambil_kuis');
		$query = $this->rest->get('ambil_kuis/'.$id_mk.'/format/json');

		
		//$judul =$this->rest->get('lihatsoal/'.$id_mk.'/format/json');

		$data['id_mk']=$id_mk;
		$data['title']='Event | Elearning PTIIK'; 
		$data['query']=$query; 
		$data['cek_event']=$this->rest->get('cek_event/'.$id_mk.'/format/json');
		//$data['judul']=$judul; 
		$data['output']	=$this->load->view('event',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);


	}

	public function kuis(){

		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
		$sess_data['session_id_mk'] = $id_mk;
        $this->session->set_userdata($sess_data);
		$query = $this->rest->get('ambil_kuis/'.$id_mk.'/format/json');
		$data['title']='Kuis | Elearning PTIIK'; 
		$data['query']=$query; 
		$data['output']	=$this->load->view('kuis',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function update_event(){

		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
		$sess_data['session_id_mk'] = $id_mk;
        $this->session->set_userdata($sess_data);
		$query = $this->rest->get('ambil_kuis/'.$id_mk.'/format/json');
		$data['title']='Update Event | Elearning PTIIK'; 
		$data['query']=$query; 
		$data['output']	=$this->load->view('update_event',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
	}

	public function proses_update_event(){ 

		$id = $this->input->post('id_kuis');   
		$data = array('judul' => $this->input->post('judul'),
					'soal' => $this->input->post('soal'),
					'jawaban' => $this->input->post('jawaban')
			);   
		if($query = $this->rest->post('update_event/id/'.$id.'/format/php',$data))
		{ 
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									Event Berhasi Diubah !
										</div>');
			
			redirect('rest_client/tampil_matkul_dosen');
		} 
		else 
			{ 
				echo "<script>alert('Gagal coy'); window.close ();</script>"; 
			}   
		}

		public function add_event(){

		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
		//$sess_data['session_id_mk'] = $id_mk;
        //$this->session->set_userdata($sess_data);
		//$query = $this->rest->get('ambil_kuis/'.$id_mk.'/format/json');
		$data['id_mk']=$id_mk; 
		$data['title']='Add Event | Elearning PTIIK'; 
		$data['judul']='Add Event'; 
		$data['output']	=$this->load->view('add_event',$data,TRUE);
		$this->load->view('wrapper_dashboard',$data);
		}

		public function proses_add_event(){ 
		$data = array( 	'id_mk' => $this->input->post('id_mk'), 
						'judul' => $this->input->post('judul'),
						'soal' => $this->input->post('soal'),
						'jawaban' => $this->input->post('jawaban')
						
					); 
		$query = $this->rest->post('add_event/event/1/format/php',$data); 
		if($query) { 
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									Event Berhasi Ditambah !
										</div>');
			redirect('rest_client/tampil_matkul_dosen'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
			} 
		} 


	public function hasil(){
		
			$id_mk= $this->session->userdata('session_id_mk');
			$query = $this->rest->get('ambil_kuis/'.$id_mk.'/format/json');
			//var_dump($query->row());
			$jawaban = $query->jawaban;
			$input_jawaban = $this->input->post('input_jawaban');
			
			similar_text($jawaban,$input_jawaban,$percent);

			$data['title']='Hasil Kuis | Elearning PTIIK'; 
			$data['soal'] = $query->soal;
			$data['id_mk'] = $query->id_mk;
			$data['jawaban'] = $jawaban;
			$data['input_jawaban'] = $input_jawaban;
			$data['hasil']=$percent;
			$data['output']	=$this->load->view('hasil',$data,TRUE);
			$this->load->view('wrapper_dashboard',$data);
	}

	public function simpan_nilai(){ 
		$data = array( 	'id_mk' => $this->input->post('id_mk'), 
						'id_user' => $this->input->post('id_user'),
						'nilai' => $this->input->post('nilai')
						
					); 
		$query = $this->rest->post('add_nilai/hasil/1/format/php',$data); 
		if($query) { 
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable">
    									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    									Nilai sudah tersimpan !
										</div>');
			redirect('rest_client/nilai'); 
		} 
		else 
			{ 
				echo "<script>alert('Terjadi Error Saat Query')</script>"; 
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