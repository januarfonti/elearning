<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> List Event </h1>


<?php 
	if ($this->session->userdata('level')=="Mahasiswa") {
?>
		<?php if ($cek_event =="1"){ ?>
		<a href="<?php echo base_url(); ?>index.php/rest_client/kuis/<?php echo $id_mk; ?>"><h3><?php echo $query->judul; ?></h3></a>
		<?php } 
		else { ?>
		<h3>Event masih kosong</h3>
		
	<?php } }

	elseif ($this->session->userdata('level') == "Dosen") { ?>
		<?php if ($cek_event =="1"){ ?>
		<a href="<?php echo base_url(); ?>index.php/rest_client/kuis/<?php echo $id_mk; ?>"><h3><?php echo $query->judul; ?></h3></a>
		<button onclick="window.location.href='<?php echo base_url('index.php/rest_client/update_event');?>/<?php echo $id_mk; ?>'" class="btn btn-success "><span class="glyphicon glyphicon-plus"></span>  Detail & Update Event</button>
		<button onclick="window.location.href='<?php echo base_url('index.php/rest_client/all_nilai');?>/<?php echo $id_mk; ?>'" class="btn btn-warning "><i class="fa fa-clock-o"></i>  Lihat Nilai</button>
		<?php } 
		else { ?>
		<h3>Event masih kosong</h3>
		<button onclick="window.location.href='<?php echo base_url('index.php/rest_client/add_event');?>/<?php echo $id_mk; ?>'" class="btn btn-info "><span class="glyphicon glyphicon-plus"></span>  Buat Event Baru</button>
	<?php } }