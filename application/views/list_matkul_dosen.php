<br />
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Selamat datang dosen <strong><i><?php echo $username=$this->session->userdata('nama'); ?></i><strong>
</div>

<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span>  Daftar Mata Kuliah</h1>
<br />

<?php



   $row = $matkul_dosen; ?>

<h3><span class="glyphicon glyphicon-book"></span></span>  <?php echo $row->nama_matkul; ?></h3>
<hr />
   
<?php  ?>    



 


