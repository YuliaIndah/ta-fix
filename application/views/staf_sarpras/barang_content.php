<section id="main-content">
  <section class="wrapper">            
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header" style="margin-top: 0;"><i class="fa fa-pencil"></i>Daftar Barang</h3>
      </div>
    </div>
    
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
        <div class="card mb-3">
          <div class="card-header">
            <div class="card-body">
              <a class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="icon_plus_alt2"> </i> Tambah Barang</a>
              <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($data_barang as $barang) {
                        ?>
                        <tr>
                          <td><?php echo $barang->nama_barang; ?></td>
                          <td><?php echo $barang->nama_jenis_barang; ?></td>
                          <td>
                              <a href="#myModal1" id="custId" data-toggle="modal" data-id="<?php echo $barang->kode_barang;?>" data-toggle="tooltip" title="Aksi" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                          </td>
                        </tr>

                        <?php
                        # code...
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- project team & activity end -->

      </section>
      <div class="text-center">
        <div class="credits">
          <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </section>

<!-- Modal Tambah Barang -->
    <div aria-hidden="true" aria-labelledby="myModal" role="dialog" tabindex="-1" id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Tambah Barang</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url('Staf_sarprasC/post_tambah_barang');?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
              <div class="form-group">
                <label class="col-lg-4 col-sm-2 control-label">Nama Barang :</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-4 col-sm-2 control-label" for="jenis_barang"> Jenis Barang :</label>
                <div class="col-lg-8">
                   <select class="form-control" name="kode_jenis_barang" id="kode_jenis_barang">
                <option value="">---- Pilih Jenis Barang ---- </option>
                <?php 
                foreach ($jenis_barang as $pilihan_jenis_barang) {
                  ?>
                  <option value="<?php echo $pilihan_jenis_barang->kode_jenis_barang ;?>"> <?php echo $pilihan_jenis_barang->nama_jenis_barang ;?> </option>
                  <?php
                }
                ?>
              </select>
              <span class="text-danger" style="color: red;"><?php echo form_error('kode_jenis_barang'); ?></span>  
                </div>
              </div>
            </div>
             <div class="modal-footer">
              <button class="btn btn-info" type="submit"> Simpan </button>
              <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- END Modal Tambah Barang -->

<!-- modal ubah barang -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ubah Barang</h4>
        </div>
        <div class="modal-body">
          <div class="fetched-data"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

<script>
$(document).ready(function() {
      // Untuk sunting
      $('#myModal').on('show.bs.modal', function (event) {
          
        });
    });
</script>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
    // js 
    $(document).ready(function(){
      $('#myModal1').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
              type : 'get',
              url : '<?php echo base_url().'Staf_sarprasC/ubah_barang/'?>'+rowid,
                //data :  'rowid='+ rowid, // $_POST['rowid'] = rowid
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
              }
            });
          });
    });

  </script>
