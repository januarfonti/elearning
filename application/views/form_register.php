<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Form E-Learning</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/register.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<br />
<br />
		<div class="jumbotron">
	  		<div class="container">
	    		<span class="glyphicon glyphicon-floppy-disk"></span>
	    		<h2>Register</h2>
	    		<div class="box">
	    		<?php echo form_open('rest_client/register_rest') ?>


	        		<input name="status" type="hidden" value="Tidak Aktif">
              <select name="level">
                <option value="Dosen">Dosen</option>
                <option value="Mahasiswa">Mahasiswa</option>
              </select>
	        		
	        		<input name="nama" type="text" placeholder="Nama">
	        		<input name="username" type="text" placeholder="Username">
	        		<input name="password" type="text" placeholder="Password">

		    		
		    		<button type="submit" class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
		    		<a class="btn btn-default full-width" href="<?php echo base_url('index.php/rest_client/login'); ?>"><span class="glyphicon glyphicon-remove"></span></a>
		    		
		    	<?php echo form_close(); ?>
	    		</div>
	  		</div>
		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>