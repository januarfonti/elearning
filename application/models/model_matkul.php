<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');

	class Model_matkul extends CI_Model {
		public function __construct() {
			parent::__construct();
		}
  

    public function tampil_matkul(){
      return $this->db->query("select `tbl_matkul`.`nama_matkul` AS `nama_matkul`,`tbl_matkul`.`enroll` AS `enroll`,`tbl_user`.`nama` AS `nama`,`tbl_matkul`.`id` AS `id` from (`tbl_matkul` join `tbl_user` on((`tbl_user`.`id` = `tbl_matkul`.`id_dosen`)))")->result();
    }

    
    public function tampil_matkul_dosen1($id){
        
        
        return $this->db->query("select * from tbl_matkul where id_dosen=$id")->result();
    }

    public function tampil_nilai($id_user){
        return $this->db->query("SELECT * FROM tbl_nilai INNER JOIN tbl_matkul ON tbl_matkul.id = tbl_nilai.id_mk INNER JOIN tbl_user ON tbl_user.id = tbl_nilai.id_user where id_user='$id_user'");
    }

    public function tampil_all_nilai($id_mk){
        return $this->db->query("SELECT * FROM tbl_nilai INNER JOIN tbl_matkul ON tbl_matkul.id = tbl_nilai.id_mk INNER JOIN tbl_user ON tbl_user.id = tbl_nilai.id_user where id_mk='$id_mk'");
    }

    
    public function tampil_matkul_dosen($id) {
    $results = array();
    $this->db->select('*');
    $this->db->from('tbl_matkul');
    $this->db->where('id_dosen',$id);

    $query = $this->db->get();
    $results = $query->row();
    
    return $results;
    }

     function update_event($id,$data){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_kuis',$data);
        return $query;
    }

    function insert_event($data){
        $query = $this->db->insert('tbl_kuis',$data);
        return $query;
    }

    function insert_nilai($data){
        $query = $this->db->insert('tbl_nilai',$data);
        return $query;
    }



    public function cek_enroll($enroll) {
        $this->db->select('*');
        $this->db->from('tbl_matkul');
        $this->db->where('enroll', $enroll);
        $query = $this->db->get();
        return $query;
      }

    public function insert_enroll($data) {
        $query = $this->db->insert('tbl_enroll',$data);
        return $query;
    }

    
    function show_matkul_dosen($id){
        return $this->db->query("select * from tbl_matkul where id_dosen=$id ")->row();
    }		
  
  	function get_matkul_detail($id){
        return $this->db->query("select * from tbl_matkul where id=$id ")->result();
    }

     function insert_matkul($data){
        $query = $this->db->insert('tbl_matkul',$data);
        return $query;
    }

    function update_matkul($id,$data){
        $this->db->where('id',$id);
        $query = $this->db->update('tbl_user',$data);
        return $query;
    }
	
        function Lihat_Soal($id_mk)
        {
            
            $tampil = $this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where id_matkul='$id_mk' group by 
            tbl_soal.no_soal order by id_soal");
            return $tampil->result();
        }

        function Judul_MK($id_mk)
        {
            $matkul=$this->db->query("SELECT nama_matkul FROM tbl_matkul INNER JOIN tbl_soal ON tbl_matkul.id = tbl_soal.id_matkul INNER JOIN tbl_namasoal ON tbl_soal.no_soal = tbl_namasoal.id_namasoal  where id='$id_mk' group by nama_matkul");
            return $matkul;
        }

        function Tampilkan_Soal($id_mk,$no_soal)
        {
            $query_total=$this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where 
            id_matkul='$id_mk' AND no_soal='$no_soal' order by RAND()");
            return $query_total;
        }

        
        function Hitung_Soal($id_mk,$no_soal)
        {
            $query_total=$this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where 
            id_matkul='$id_mk' AND no_soal='$no_soal' order by RAND()");
            return $query_total;
        }


        function Hitung_Hasil($id_mk,$no_soal)
        {
            $query=$this->db->query("select * from tbl_soal left join tbl_matkul on tbl_soal.id_matkul=tbl_matkul.id where 
            id_matkul='$id_mk' AND no_soal='$no_soal'");
            return $query;
        }

        function Simpan_Hasil($datainput)
        {
            $this->db->insert('tbl_hasil',$datainput);
        }




}  