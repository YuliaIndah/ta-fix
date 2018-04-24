<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Daftar</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	 -->
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
	<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script> -->
	<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body style="margin: 50px;">
	<div class="col-md-12">
		<div class="offset-md-3">
			<div class="col-md-8">
				<center>
					<img style="width: 15%;" src="<?php echo base_url();?>assets/image/logo/email-sent.jpg">
				</center>
				<div class="panel panel-info">
					<div>
						
					</div>
					<div class="panel-heading">
						<h1>Mohon Periksa Email anda . . </h1>
					</div>
					<div class="panel-body">
						<?php echo $this->session->flashdata('msg'); 
								// echo $_SESSION['no_identitas'];
						?>						
						<p> Email Salah ? Silahkan masukkan kembali <a href="#" name="email" onclick="formResend()">email</a> anda . . .</p>
					</div>
					<div>
						<form id="formResend" action="<?php echo base_url(); ?>UserC/post_resend_email" method="post" style="display: none;" >
							<div class="row">
								<div class="form-group col-md-6">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email" required> 
									<input type="hidden" name="id_pengguna" id="id_pengguna" value="<?php echo $_SESSION['id_pengguna']; ?>">  <!-- ambil data no identitas buat update email -->
									<span class="text-danger"><?php echo form_error('email'); ?></span>  
								</div>  
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-outline" name="submit"> Resend </button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- <button type="button" name="klik" onclick="formResend()">Hayo</button> -->

	<script type="text/javascript">
		function formResend(){
			$('#formResend').show();
		}
	</script>

</body>


</html>