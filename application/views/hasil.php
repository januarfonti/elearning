<h1 class="page-header"><span class="glyphicon glyphicon-tree-conifer"></span> Hasil Kuis </h1>

<?php 
    if ($hasil<50){ ?>

    	<div class="alert alert-danger alert-dismissable">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    		Nilai anda dibawah standart, belajar lebih giat lagi !
		</div>

<?php }
    else { ?>
 		<div class="alert alert-info alert-dismissable">
    		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    		Nilai anda sudah diatas standart, jangan bosan untuk belajar !
		</div>
<?php }  ?>




<?php
	$attr = array('class' => 'form-horizontal','role' => 'form' );
	echo form_open('rest_client/simpan_nilai',$attr);
?>

<input name="id_mk" type="hidden" class="form-control" value="<?php echo $id_mk; ?>">
<input name="nilai" type="hidden" class="form-control" value="<?php echo $hasil; ?>">
<input name="id_user" type="hidden" class="form-control" value="<?php echo $this->session->userdata('id_user'); ?>">



  <div class="form-group">
    <label class="col-sm-2 control-label">Soal</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo $soal; ?></p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Jawaban Yang Benar</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $jawaban; ?>" disabled>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Jawaban Anda</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $input_jawaban; ?>" disabled>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Nilai</label>
    <div class="col-sm-10">
    <?php 
    if ($hasil<50){
    	$warna='color:#fa1a4a;';
    }
    else {
    	$warna='color:#00bb6a;';	
    }
    ?>
      <strong><input name="nilaii" type="text" class="form-control input-lg" value="<?php echo $hasil; ?>" style="<?php echo $warna; ?>" disabled></strong>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <button class="btn btn-info"><span class="glyphicon glyphicon-floppy-open"></span>  Simpan hasil kuis</button>
    </div>
  </div>

</form>