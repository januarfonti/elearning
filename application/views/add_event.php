<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> <?php echo $title ?> </h1>
<?php echo $this->session->flashdata('pesan'); ?>

<?php $attr = array('class' => 'form-horizontal','role' => 'form' ); ?>

<?php echo form_open('rest_client/proses_add_event',$attr); ?>

  <input type="hidden" name="id_mk" value="<?php echo $id_mk; ?> ">


  <div class="form-group">
    <label class="col-sm-1 control-label">Judul</label>
    <div class="col-sm-10">
    <input name="judul" type="text" class="form-control" id="inputPassword" placeholder="Judul">
      
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-1 control-label">Soal</label>
    <div class="col-sm-10">
    <textarea name="soal" type="text" rows="3" class="form-control" id="inputPassword" placeholder="Jawaban"></textarea>
      
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label">Jawaban</label>
    <div class="col-sm-10">
      <textarea name="jawaban" type="text" rows="10" class="form-control" id="inputPassword" placeholder="Jawaban"></textarea>
    </div>
  </div>

  <div class="form-group">
	<label for="inputPassword" class="col-sm-1 control-label"></label>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-ok"></span>  Submit</button>
    </div>
  </div>


<?php echo form_close(); ?>