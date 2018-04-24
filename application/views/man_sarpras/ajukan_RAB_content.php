<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">

       <!-- Alert -->
       <?php 
       $data=$this->session->flashdata('sukses');
       if($data!=""){ ?>
       <div class="alert alert-success"><strong>Sukses! </strong> <?=$data;?></div>
       <?php } ?>
       <?php 
       $data2=$this->session->flashdata('error');
       if($data2!=""){ ?>
       <div class="alert alert-danger"><strong> Error! </strong> <?=$data2;?></div>
       <?php } ?>
       <!-- sampai sini -->
       <h3 class="page-header" style="margin-top: 0;"><i class="fa fa-pencil"></i>Barang Diajukan</h3>
     </div>
   </div>
   <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                <thead>
                  <tr class="text-center">
                    <!-- <th>No. Identitas</th> -->
                    <th>Nama Pengajuan Barang</th>
                    <th>Nama Pengaju</th>
                    <th>Jabatan Pengaju</th>
                    <th>Gambar</th>
                    <th>Tgl Pengajuan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data_barang_setuju as $barang_setuju) {
                    ?>
                    <tr class="text-center" >
                      <td> 
                       <a href="#" data-toggle="modal" data-target="#modal-<?php echo $barang_setuju->kode_item_pengajuan; ?>"><?php echo $barang_setuju->nama_item_pengajuan ?></a>
                     </td>
                     <td><?php 
                     // mendapatkan nama pengaju dari kode item pengajuan berdasarkan id
                     $pengaju = $Man_sarprasM->get_data_item_pengajuan_by_id($barang_setuju->kode_item_pengajuan)->result()[0]->nama;
                     echo $pengaju;
                     ?>
                   </td>
                   <td>
                    <?php 
                    // mendapatkan nama jabatan dari kode item pengajuan berdasarkan id
                    $jabatan      = $Man_sarprasM->get_data_item_pengajuan_by_id($barang_setuju->kode_item_pengajuan)->result()[0]->nama_jabatan;
                    // mendapatkan kode jabatan dari kode item pengajuan berdasarkan id
                    $kode_jabatan = $Man_sarprasM->get_data_item_pengajuan_by_id($barang_setuju->kode_item_pengajuan)->result()[0]->kode_jabatan;
                    // mendapatkan nama unit dari kode item pengajuan berdasarkan id
                    $unit = $Man_sarprasM->get_data_item_pengajuan_by_id($barang_setuju->kode_item_pengajuan)->result()[0]->nama_unit;
                    // mendapatkan kode unit dari kode item pengajuan berdasarkan id
                    $kode_unit = $Man_sarprasM->get_data_item_pengajuan_by_id($barang_setuju->kode_item_pengajuan)->result()[0]->kode_unit;
                    //menampilkan nama jabatan dan unit dari pengaju item pengajuan
                    echo $jabatan." ".$unit;
                    ?>
                  </td>
                  <td><center><img style="height: 60px;" src="<?php echo base_url();?>assets/file_gambar/<?php echo $barang_setuju->file_gambar;?>"></center></td>
                  <td><?php echo $barang_setuju->tgl_item_pengajuan;?></td>
                  <td><?php echo $barang_setuju->jumlah;?></td>
                  <?php 
                  $jumlah = $barang_setuju->jumlah;
                  $harga = $barang_setuju->harga_satuan;
                  //menghitung hasil total biaya item pengajuan dari perkalian harga satuan dengan jumlah barang
                  $total = $jumlah*$harga;
                  ?>
                  <td><?php echo $total;?></td>
                  <td><?php echo $barang_setuju->status_pengajuan;?></td>
                  <td><center>
                    <div class="btn-group">
                      <a href="#" data-toggle="modal" data-target="" title="Pilih" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span></a>
                      <a href="" id="custId" data-toggle="tooltip" data-toggle="tooltip" title="Tunda" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pushpin"></span></a>
                    </div>
                  </center>
                </td>
              </tr>

              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<div class="text-center">
  <div class="credits">
    <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</section>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
