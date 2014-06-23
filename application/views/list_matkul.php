    <h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span>  Daftar Mata Kuliah</h1>
    <button onclick="window.location.href='<?php echo base_url('index.php/rest_client/tambah_matkul');?>'" class="btn btn-danger"><span class="glyphicon glyphicon-plus"></span>  Tambah Mata Kuliah</button>
    <?php echo $this->uri->segment(3); ?>
    <br />
    <?php if(isset($matkul)){
        foreach ($matkul as $row ) { 
    ?>
        <h3><span class="glyphicon glyphicon-book"></span></span> <?php echo $row->nama_matkul; ?></h3>
        Dosen : <?php echo $row->nama; ?>
        <hr />

    <?php
        }
    } 
    ?>