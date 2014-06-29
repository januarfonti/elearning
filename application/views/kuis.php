<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> Kuis </h1>








<?php $attr = array('class' => 'form-horizontal','role' => 'form' ); ?>

<?php echo form_open('rest_client/hasil',$attr); ?>

  <div class="form-group">
    <label class="col-sm-1 control-label">Soal</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo $query->soal; ?></p>
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label">Jawaban</label>
    <div class="col-sm-10">
      <textarea name="input_jawaban" type="text" rows="10" class="form-control" id="inputPassword" placeholder="Jawaban"></textarea>
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label"></label>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span>  Submit</button>
    </div>
  </div>


<?php echo form_close(); ?>