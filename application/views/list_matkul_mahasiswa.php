    <h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span>  Daftar Mata Kuliah</h1>
    
    <br />
    <?php if(isset($matkul)){
        foreach ($matkul as $row ) { 
            $sess_data['id_mk'] = $row->nama;
            $this->session->set_userdata($sess_data);
    ?>
        <h3><a href="<?php echo base_url('index.php/rest_client/enroll'); ?>/<?php echo $row->id;?>"><span class="glyphicon glyphicon-book"></span></span> <?php echo $row->nama_matkul; ?></h3></a>
        Dosen : <?php echo $row->nama; ?>
        <hr />

    <?php
        }
    } 
    ?>