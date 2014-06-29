<?php defined('BASEPATH') OR exit('No direct script access allowed');



// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Rest_Server extends REST_Controller
{
	protected $builtInMethods;
	
	public function __construct()
	{
		parent::__construct();
		$this->__getMyMethods();
	}
	

	private function __getMyMethods()
	{
		$reflection = new ReflectionClass($this);
		
		//get all methods
		$methods = $reflection->getMethods();
		$this->builtInMethods = array();
		
		//get properties for each method
		if(!empty($methods))
		{
			foreach ($methods as $method) {
				if(!empty($method->name))
				{
					$methodProp = new ReflectionMethod($this, $method->name);
					
					//saves all methods names found
					$this->builtInMethods['all'][] = $method->name;
					
					//saves all private methods names found
					if($methodProp->isPrivate()) 
					{
						$this->builtInMethods['private'][] = $method->name;
					}
					
					//saves all private methods names found					
					if($methodProp->isPublic()) 
					{
						$this->builtInMethods['public'][] = $method->name;
						
						// gets info about the method and saves them. These info will be used for the xmlrpc server configuration.
						// (only for public methods => avoids also all the public methods starting with '_')
						if(!preg_match('/^_/', $method->name, $matches))
						{
							//consider only the methods having "_" inside their name
							if(preg_match('/_/', $method->name, $matches))
							{	
								//don't consider the methods get_instance and validation_errors
								if($method->name != 'get_instance' AND $method->name != 'validation_errors')
								{
									// -method name: user_get becomes [GET] user
									$name_split = explode("_", $method->name);
									$this->builtInMethods['functions'][$method->name]['function'] = $name_split['0'].' [method: '.$name_split['1'].']';
									
									// -method DocString
									$this->builtInMethods['functions'][$method->name]['docstring'] =  $this->__extractDocString($methodProp->getDocComment());
								}
							}
						}
					}
				}
			}
		} else {
			return false;
		}
		return true;
	}	
	

	private function __extractDocString($DocComment)
	{
		$split = preg_split("/\r\n|\n|\r/", $DocComment);
		$_tmp = array();
		foreach ($split as $id => $row)
		{
			//clean up: removes useless chars like new-lines, tabs and *
			$_tmp[] = trim($row, "* /\n\t\r");
		}			
		return trim(implode("\n",$_tmp));
	}

	public function API_get()
	{
		$this->response($this->builtInMethods, 200); // 200 being the HTTP response code
	}
	

	public function register_post() { 

			$data = array( 	'level' => $this->post('level'), 
						   	'nama' => $this->post('nama'), 
						   	'username' => $this->post('username'), 
						   	'password' => $this->post('password'),
						   	'status' => $this->post('status')
						);   

			if($this->get('mboh')==1){ 
				$query = $this->model_user->insert_user($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}

		
		
		public function login_post()
    	{
    		$data = array('username' => $this->post('username'), 
						'password' => $this->post('password')
					); 
			$ambil=$this->model_user->ambilPengguna($data);
    		$hasil=$ambil->num_rows();
			$this->response($hasil, 200);    		

    	}

    	public function cek_enroll_get(){
    		$enroll=$this->post('enroll');
    		//$enroll='rpl2007';
    		$cek_enroll = $this->model_matkul->cek_enroll($enroll);
    		$hasil=$cek_enroll->num_rows();
    		if($hasil){$this->response($hasil, 200);    		
    		}
    		else { $this->response(array('error' => 'Enroll could not be found'), 404); } 
    		

    	}
    	


		

		public function alluser_get() {  
			
			$query = $this->model_user->get_alluser();   
			if($query) { $this->response($query, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		} 

			function update_user_post() { 
			
			$data = array( 	'status' => $this->post('status')
							
						);   
			
			$id = $this->get('id'); 
			$query = $this->model_user->update_user($id,$data); 
			$this->response($query, 200); 
		}   


		public function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        $user = $this->model_user->get_alluser_detail( $this->get('id') );
    	if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }


	public function matkul_get() {  
			
			$query = $this->model_matkul->tampil_matkul();   
			if($query) { $this->response($query, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		} 

		
	public function ambil_kuis_get(){
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}

		$query = $this->db->query("select * from tbl_kuis where id_mk='$id_mk'")->row();
		$this->response($query, 200); 		
	}

	public function nilai_get(){

		$id_user='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_user='';
		}
		else
		{
    			$id_user = $this->uri->segment(3);
		}

		//$query = $this->db->query("select * from tbl_nilai where id_user='$id_user'");
		$query = $this->model_matkul->tampil_nilai($id_user);
		if($query->num_rows() > 0){
			$respon = array(
					'data_nilai'=>$query->result_array(),
				);
			$this->response($respon, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'Data tidak ditemukan'), 500);
		}
	}

	public function all_nilai_get(){

		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}

		//$query = $this->db->query("select * from tbl_nilai where id_user='$id_user'");
		$query = $this->model_matkul->tampil_all_nilai($id_mk);
		if($query->num_rows() > 0){
			$respon = array(
					'data_nilai'=>$query->result_array(),
				);
			$this->response($respon, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'Data tidak ditemukan'), 500);
		}
	}




	public function cek_event_get(){
		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}

		$query = $this->db->query("select * from tbl_kuis where id_mk='$id_mk'")->num_rows();
		$this->response($query, 200); 		
	}

	public function update_event_post() { 
			
			$data = array( 	'judul' => $this->post('judul'),
							'soal' => $this->post('soal'),
							'jawaban' => $this->post('jawaban')
							
						);   
			
			$id = $this->get('id'); 
			$query = $this->model_matkul->update_event($id,$data); 
			$this->response($query, 200); 
		}   

		public function add_event_post() { 

			$data = array( 	'id_mk' => $this->post('id_mk'), 
						   	'judul' => $this->post('judul'),
						   	'soal' => $this->post('soal'),
						   	'jawaban' => $this->post('jawaban')
						   	
						);   

			if($this->get('event')==1){ 
				$query = $this->model_matkul->insert_event($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}

		public function add_nilai_post() { 

			$data = array( 	'id_mk' => $this->post('id_mk'), 
						   	'id_user' => $this->post('id_user'),
						   	'nilai' => $this->post('nilai')
						   	
						);   

			if($this->get('hasil')==1){ 
				$query = $this->model_matkul->insert_nilai($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}



	public function lihatsoal_get() {  

		$id_mk='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_mk='';
		}
		else
		{
    			$id_mk = $this->uri->segment(3);
		}
			
			
			$query=$this->model_matkul->Lihat_Soal($id_mk);
			$judul=$this->model_matkul->Judul_MK($id_mk); 

			if($query) { $this->response($query, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		}


		public function ambiluser_get() {  

		

			

			$data['username']='januarfonti';
			$data['password']='januarfonti';


			
			$ambiluser=$this->model_user->ambilPengguna($data);
			$keluar=$ambiluser->row();
			if($keluar) { $this->response($keluar, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		}



		public function ikutites_get() {  

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


			$judul=$this->model_matkul->Judul_MK($id_mk);
			$soal =$this->model_matkul->Tampilkan_Soal($id_mk,$no_soal);
			


			
			
			

			if($soal) { $this->response($soal, 200); 
			}   
			else { $this->response(array('error' => 'User could not be found'), 404); } 
		} 


			
	public function insert_enroll_post() { 

			
			$id_mk='';		
			if ($this->uri->segment(3) === FALSE)
			{
	    			$id_mk='';
			}
			else
			{
	    			$id_mk = $this->uri->segment(3);
			}
			$data['id_mk']=$this->get('id_mk');
			$data['id_user']=$this->get('id_user');
			//$data['id_user']=$this->session->userdata('id_user');

			if($this->get('enroll')==1){ 
				$query = $this->model_matkul->insert_enroll($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}

		public function coba_get() { 
			//$data['id_mk']=$this->post('input_idmk');
			$data=$this->session->userdata('nama');
			//$data='keluar';
			
			if($data) { $this->response($data, 200); 
			} 
			else 
				{ 
					$this->response($data, 404); // 200 being the HTTP response code 
				} 
		}


		public function tambah_matkul_post() { 

			$data = array( 	'nama_matkul' => $this->post('nama_matkul'), 
						   	'enroll' => $this->post('enroll'),
						   	'id_dosen' => $this->post('id_dosen')
						   	
						);   

			if($this->get('coba')==1){ 
				$query = $this->model_matkul->insert_matkul($data); 
			} 
			if($query) { $this->response($query, 200); 
			} 
			else 
				{ 
					$this->response($query, 404); // 200 being the HTTP response code 
				} 
		}

		



	
/**
	Function dosen
**/

		public function matkul_dosen_get() {  

		$id = $this->session->userdata('id_user'); 
		$query = $this->model_matkul->tampil_matkul_dosen($id);
    	if($query)
        {
            $this->response($query, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
		} 


	function nilaii_get(){
	$id_dosen = $this->session->userdata('id_user'); 		
	if($id_dosen!=null){
		$nilai = $this->db->query("select * from tbl_matkul where id_dosen=$id");
		if($nilai->num_rows() == 1){
			$respon = array(
					'status'=>true,
					//'id_siswa'=>$nilai->row()->id_siswa,
					//'nama_siswa'=>$nilai->row()->nama_siswa,
					//'n_bahasa'=>$nilai->row()->n_bahasa,
					'nama_matkul'=>$nilai->row()->nama_matkul,
					'id_dosen'=>$nilai->row()->id_dosen
				);
			$this->response($respon, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'Data tidak ditemukan'), 500);
		}
	}else{
		$nilai = $this->db->get('tbl_matkul');
		if($nilai->num_rows() > 0){
			$respon = array(
					'status'=>true,
					'data_nilai_siswa'=>$nilai->result_array(),
				);
			$this->response($respon, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'Data tidak ditemukan'), 500);
		}
	}
}







public function nilaiii_get(){
	
		//$username = $this->session->userdata('user');
		$username='cahyo';
		$nilai = $this->model_matkul->tampil_nilai($username);
		if($nilai->num_rows() > 0){
			$respon = array(
					'status'=>true,
					'data_nilai_siswa'=>$nilai->result_array(),
					
				);
			$this->response($respon, 200);
		}else{
			$this->response(array('status'=>false,'msg'=>'Data tidak ditemukan'), 500);
		}
	
}
	
}