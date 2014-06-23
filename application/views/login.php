<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form E-Learning</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">

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
	    		<span class="glyphicon glyphicon-book"></span>
	    		<h2>E-Learning</h2>
	    		<div class="box">
          <?php if($this->session->flashdata('flashInfo')):?>
            <p class='flashMsg flashInfo'> <?php $this->session->flashdata('akun')?> </p>
          <?php endif ?>
	    		<?php echo form_open('rest_client/proses_login'); ?>
	        		<input name="username" type="text" placeholder="username" value="<?php echo set_value('username');?>">
		    		<input name="password" type="password" placeholder="password" value="<?php echo set_value('password');?>">
		    		<button class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
		    		<a class="btn btn-default full-width" href="<?php echo base_url('index.php/rest_client/form_register'); ?>"><span class="glyphicon glyphicon-floppy-disk"></span></a>
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