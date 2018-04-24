<!DOCTYPE html>  
<html lang="en">  
<head>  
 <title>Daftar | Sistem</title>  
 <meta charset="utf-8">  
 <meta http-equiv="X-UA-Compatible" content="IE=edge">  
 <meta name="viewport" content="width=device-width, initial-scale=1">  
 <!-- Latest compiled and minified CSS -->  
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >  
  <link href="<?php echo base_url();?>assets/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
 <style type="text/css">  
 .form-box{  
   max-width: 500px;  
   position: relative;  
   margin: 0.5% auto;  
 }  
</style>  
</head>  
<body> 
  <div class="wrapper">  
    <div class="container">  
     <div class="row">  
      <div class="form-box">  
       <div class="panel panel-primary">  
      <!-- <div class="panel-heading text-center">  
       <h3>Register</h3>  
     </div>  --> 
     <div class="panel-body">  
       <div class="row">  
         <div class="col-sm-12">  
           <?php echo $this->session->flashdata('msg'); ?>  
           <!-- <div style="color: red; text-align: justify-all;"><?php echo validation_errors()?></div> -->
         </div>  
       </div>  
       <form action="<?php echo base_url(); ?>UserC/daftar" method="post">
      <!--   <div class="panel-heading text-center">  
         <h4>Data Diri : </h4>  
       </div> -->
       <div class="row">  
         <div class="col-sm-12">  
          <div class="form-group">  
            <!-- <label class="control-label" for="no_identitas">Nomor Identitas : </label>   -->
            <div>  
              <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" id="no_identitas" name="no_identitas" placeholder="Nomor Identitas" required>  
              <span class="text-danger" style="color: red;"><?php echo form_error('no_identitas'); ?></span>  
            </div>  
          </div>  
        </div>  
      </div>  
      <div class="row">  
       <div class="col-sm-12">  
        <div class="form-group">  
          <!-- <label class="control-label" for="nama">Nama Lengkap : </label>   -->
          <div >  
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>  
            <span class="text-danger" style="color: red;"><?php echo form_error('nama'); ?></span>  
          </div>  
        </div>  
      </div>  
    </div>
    <div class="form-group">
      <label>Jenis Kelamin  </label><span> <label> : </label></span>
      <label class="radio-inline">
       <input type="radio" name="jen_kel" id="Laki - laki" value="Laki - laki" checked>Laki - laki
     </label>
     <label class="radio-inline">
       <input type="radio" name="jen_kel" id="Perempuan" value="Perempuan">Perempuan
     </label>
   </div> 

   <div class="row">  
    <div class="col-sm-7">
     <div class="form-group">  
      <!-- <label class="control-label" for="tmp_lahir">Tempat Lahir</label>   -->
      <div>  
        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" placeholder="Tempat Lahir" required>  
        <span class="text-danger" style="color: red;"><?php echo form_error('tmp_lahir'); ?></span>  
      </div>  
    </div>  
  </div>
  <div class="col-sm-4">
   <div class="form-group">  
    <!-- <label class="control-label" for="tmp_lahir">Tanggal Lahir</label>   -->
    <div class="input-group date">
      <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo set_value('tgl_lahir');?>" placeholder="dd-mm-yyy" required>
    </div>           
  </div>  
</div>
</div>
<div class="form-group">
  <!-- <label for="bidang"> Bidang yang akan di lamar :</label> -->
  <select class="form-control" name="kode_unit" id="kode_unit" required>

    <option value="">---- Pilih Unit ---- </option>
    <?php 
    foreach ($unit->result() as $pilihan_unit) {
      ?>
      <option value="<?php echo $pilihan_unit->kode_unit ;?>"> <?php echo $pilihan_unit->nama_unit ;?> </option>
      <?php
    }
    ?>
  </select>
  <span class="text-danger" style="color: red;"><?php echo form_error('kode_jabatan'); ?></span>  
</div>
<div class="form-group">
  <!-- <label for="bidang"> Bidang yang akan di lamar :</label> -->
  <select class="form-control" name="kode_jabatan" id="kode_jabatan" required>
    <option value="">---- Pilih Jabatan ---- </option>
    <?php 
    foreach ($jabatan->result() as $pilihan_jabatan) {
      ?>
      <option value="<?php echo $pilihan_jabatan->kode_jabatan ;?>"> <?php echo $pilihan_jabatan->nama_jabatan ;?> </option>
      <?php
    }
    ?>
  </select>
  <span class="text-danger" style="color: red;"><?php echo form_error('kode_jabatan'); ?></span>  
</div>
<div class="form-group">
  <!-- <label>Alamat</label> -->
  <textarea name="alamat" value="" class="form-control" placeholder="Alamat" rows="3" required></textarea>
</div>
<div class="form-group">
  <!-- <label>Nomor Handphone</label> -->
  <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="no_hp" placeholder="Nomor Handphone" required>
</div>
<!-- <div class="panel-heading text-center">  
 <h4>Data Akun : </h4>  
</div>   -->
<div class="form-group">  
  <!-- <label class="control-label" for="pswd">Email</label>   -->
  <div>  
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>  
    <span class="text-danger" style="color: red;"><?php echo form_error('email'); ?></span>  
  </div>  
</div>  
<div class="row">  
  <div class="col-md-6">
   <div class="form-group">  
    <div>  
     <input type="password" class="form-control" id="pswd" name="password" placeholder="Password" required>  
     <span class="text-danger"><?php echo form_error('password'); ?></span>
   </div>  
 </div>  
</div>
<div class="col-md-6">
 <div class="form-group">  
  <div class="input-group">
   <input type="password" class="form-control" id="cn-pswd" name="confirmpswd" placeholder="Confirm Password" required>  
   <span class="text-danger"><?php echo form_error('confirmpswd'); ?></span>
 </div>           
</div>  
</div>
</div>

<div class="form-group">   
  <div class="row">  
    <div class="btn-submit">
     <button type="submit" class="col-md-offset-1 col-md-10 btn btn-success btn-outline">Daftar</button>  
   </div>
 </div>  
</div> 
<div class="form-group">
  <div class="col-md-12 control">
    <div style="border-top: 1px solid#888; margin-top:5px; margin-bottom: 5px; font-size:85%" >
    </div>
    <div>
      Sudah punya akun ?
      <a href="<?php echo site_url('LoginC')?>">Masuk</a>
    </div>
  </div> 
</form>
</div>
</div> 
<div class="panel-footer panel-info">
<!--   <center>
    <img src="<?php echo base_url();?>assets/image/logo/logo-ugm.png" style="height: 40px;">
  </center> -->
</div>  
</div>  
</div>  
</div>  
</div>  
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
</script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>   

<script type="text/javascript">
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }

  // $(function() {
  //   $( "#tgl_lahir" ).datepicker({ 
  //     minDate: $minDate, 
  //     maxDate: new Date()
  //   });
  // });
  $(function() {
    $("#tgl_lahir").datepicker({
      maxDate : "-20y"
    });
  });
</script>


</body>  
</html>  