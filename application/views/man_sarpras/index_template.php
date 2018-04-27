<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">

  <title><?php echo $title; ?></title>

  <link href="<?php echo base_url();?>assets/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" />    
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.min.css">

</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.html" class="logo">Manajer <span class="lite">Sarana dan Prasarana</span></a>
      <!--logo end-->
      <div class="top-nav notification-row">                
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="profile-ava">
                <?php
                if($data_diri->file_profil){
                  ?>
                  <img style="height: 35px;" src="<?php echo base_url()."assets/image/profil/".$data_diri->file_profil;?>">
                  <?php
                }else{
                 ?> 
                 <img style="height: 35px;" src="<?php echo base_url()?>assets/image/logo/img_avatar.png">
                 <?php
               }
               ?>
             </span>
             <span class="username"><?php echo $data_diri->nama;?></span>
             <b class="caret"></b>
           </a>
           <ul class="dropdown-menu extended logout">
            <div class="log-arrow-up"></div>
            <li class="eborder-top">
              <a href="<?php echo site_url('Man_sarprasC/data_diri')?>"><i class="icon_profile"></i> Data Diri</a>
            </li>
            <li>
              <a href="<?php echo site_url('Man_sarprasC/pengaturan_akun')?>"><i class="icon_cogs"></i> Pengaturan Akun</a>
            </li>
            <li>
              <a href="<?php echo site_url('LoginC/logout')?>"><i class="icon_key_alt"></i> Log Out</a>
            </li>
          </ul>
        </li>
        <!-- user login dropdown end -->
      </ul>
      <!-- notificatoin dropdown end-->
    </div>
  </header>      
  <!--header end-->
  <!--sidebar start-->
  <aside>
    <div id="sidebar"  class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu">                
        <li>
          <a href="<?php echo site_url('Man_sarprasC/')?>">
            <i class="icon_house_alt"></i>
            <span>Beranda</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('Man_sarprasC/kelola_barang')?>">
            <i class="icon_pencil-edit"></i>
            <span>Kelola Barang</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('Man_sarprasC/klasifikasi_barang')?>">
            <i class="icon_tags_alt"></i>
            <span>Klasifikasi Barang</span>
          </a>
        </li>
         <!--  <li>
            <a href="<?php echo site_url('Man_sarprasC/persetujuan_barang')?>">
              <i class=" icon_box-checked"></i>
              <span>Persetujuan Barang</span>
            </a>
          </li> -->
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_bag_alt"></i>
              <span>Persetujuan</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li> <a href="<?php echo site_url('Man_sarprasC/persetujuan_barang')?>">Barang</a></li>
              <li> <a href="<?php echo site_url('Man_sarprasC/persetujuan_kegiatan_staf')?>">Kegiatan Staf</a></li>
              <!-- <li> <a href="<?php echo site_url('Man_sarprasC/persetujuan_kegiatan_pegawai')?>">Kegiatan Pegawai</a></li> -->
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_bag_alt"></i>
              <span>Pengajuan</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li> <a href="<?php echo site_url('Man_sarprasC/ajukan_barang')?>">Barang</a></li>
              <li> <a href="<?php echo site_url('Man_sarprasC/pengajuan_kegiatan')?>">Kegiatan Pegawai</a></li>
              <li> <a href="<?php echo site_url('Man_sarprasC/ajukan_RAB')?>">RAB</a></li>
            </ul>
          </li>
         <!--  <li>
            <a href="<?php echo site_url('Man_sarprasC/kegiatan_pegawai')?>">
              <i class="icon_ol"></i>
              <span>Pengajuan Kegitan</span>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('Man_sarprasC/ajukan_barang')?>">
              <i class="icon_bag_alt"></i>
              <span>Pengajuan Barang</span>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('Man_sarprasC/ajukan_RAB')?>">
              <i class="icon_bag_alt"></i>
              <span>Pengajuan RAB</span>
            </a>
          </li> -->
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

    <!--main content start-->
    <?php echo $body; ?>
    <!--main content end-->
  </section>

  <div class="modal fade" id="modal_progress" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Detail Progress</h4>
        </div>
        <div class="modal-body">
          <div class="fetched-data"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- container section start -->
  <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.4.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>

  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

  <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
  <!-- custom select -->
  <script src="<?php echo base_url();?>assets/js/jquery.customSelect.min.js" ></script>
  <script src="<?php echo base_url();?>assets/js/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.autosize.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/jquery.placeholder.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/gdp-data.js"></script>  
  <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url();?>assets/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.min.js"></script>
  <script>


    $(document).ready(function() {
      var table = $('#example').DataTable();

      $("#example tfoot th").each( function ( i ) {
        var select = $('<select><option value=""></option></select>')
        .appendTo( $(this).empty() )
        .on( 'change', function () {
          table.column( i )
          .search( $(this).val() )
          .draw();
        } );

        table.column( i ).data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
      } );
    } );


    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }

    $(function() {
      $("#from").datepicker({
        defaultDate: new Date(),
        minDate: new Date(),
        onSelect: function(dateStr) 
        {         
          $("#to").datepicker("destroy");
          $("#to").val(dateStr);
          $("#to").datepicker({ minDate: new Date(dateStr)})
        }
      });
    });


      // js detail_progress
      $(document).ready(function(){
        $('#modal_progress').on('show.bs.modal', function (e) {
          var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'get',
              url : '<?php echo base_url().'Man_sarprasC/detail_progress/'?>'+rowid,
                //data :  'rowid='+ rowid, // $_POST['rowid'] = rowid
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });
      });

      $(function() {
        $("#tgl_lahir").datepicker({
          maxDate : "-20y"
        });
      });
    </script>

  </body>
  </html>
