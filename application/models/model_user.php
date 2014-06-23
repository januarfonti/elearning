<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

	class Model_user extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
  

    public function tampilUser(){
      return $this->db->query("select * from tbl_user ")->result();
    }

    public function tampil_dosen(){
      return $this->db->query("select * from tbl_user where level='Dosen'")->result();
    }

		  public function ambilPengguna($data) {
          $this->db->select('*');
          $this->db->from('tbl_user');
          $this->db->where($data);
          $query = $this->db->get();
          return $query;
      }
  
  		public function dataPengguna($email) {
			$this->db->select('email');
   			$this->db->select('nama');
   			$this->db->where('email', $email);
   			$query = $this->db->get('tbl_user');
   
   			return $query->row();
  		}

      function insert_user($data){
        $query = $this->db->insert('tbl_user',$data);
        return $query;
    }

    function get_alluser(){
        return $this->db->query("select * from tbl_user ")->result();
    }

    function get_alluser_detail($id){
        return $this->db->query("select * from tbl_user where id=$id ")->result();
    }

    function update_user($id,$data){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_user',$data);
        return $query;
    }

    function ubah_user1($id,$status){
      $this->db->query("update tbl_user set ='$status' where id=1"); 
    }

    public function ubah_user($id, $data)
    {
    $result = $this->db->query("update tbl_user set status='$data' where id=$id "); 

    return $result;
  }
  

  
	}  

  


?>
