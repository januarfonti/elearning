<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> Update Event </h1>








<?php $attr = array('class' => 'form-horizontal','role' => 'form' ); ?>

<?php echo form_open('rest_client/proses_update_event',$attr); ?>

  <input type="hidden" name="id_kuis" value="<?php echo $query->id ?>">


  <div class="form-group">
    <label class="col-sm-1 control-label">Judul</label>
    <div class="col-sm-10">
    <input name="judul" type="text" class="form-control" id="inputPassword" value="<?php echo $query->judul; ?>">
      
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label">Soal</label>
    <div class="col-sm-10">
    <textarea name="soal" type="text" rows="3" class="form-control" id="inputPassword" placeholder="Jawaban"><?php echo $query->soal; ?></textarea>
      
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label">Jawaban</label>
    <div class="col-sm-10">
      <textarea name="jawaban" type="text" rows="10" class="form-control" id="inputPassword" placeholder="Jawaban"><?php echo $query->jawaban; ?></textarea>
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label"></label>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span>  Submit</button>
    </div>
  </div>


<?php echo form_close(); ?>