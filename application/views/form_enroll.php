<br />


<div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-users fa-fw"></i>  <?php echo $judul_halaman; ?></div>
  <div class="panel-body">
  <?php $attr = array('role' => 'form','class' => 'form-horizontal'); ?>
  <?php echo form_open('rest_client/cek_enroll',$attr) ?>

  <input name="id" type="hidden" class="form-control" id="inputEmail3" value="">

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Enrollment Key</label>
    <div class="col-sm-10">
      <input name="enroll"  type="text" class="form-control" id="inputEmail3">
      <input name="input_idmk"  type="hidden" class="form-control" id="inputEmail3" value="<?php echo $id_mk ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"></label>
    <div class="col-sm-10">
      <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-thumbs-up"></span>  Enroll Mata Kuliah</button>
    </div>
  </div>

  </form>
  </div>
</div>