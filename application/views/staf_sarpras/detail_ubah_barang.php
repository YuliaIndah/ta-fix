
<form class="form-horizontal" action="<?php echo base_url(); ?>Staf_sarprasC/ubah_data_barang" method="post">
    <div class="form-group">
        <label class="control-label col-sm-5" for="nama_kegiatan" style="text-align: left;">Nama Barang</label>
        <div class="col-sm-5">
            <p class="form-control-static"> <?php echo ": ".$ubah_barang->nama_barang; ?> </p>
            
        </div>
         <input type="hidden" name="kode_fk" value="<?php echo $ubah_barang->kode_barang?>"> <!-- buat input ke tabel progress -->
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5" for="status" name="kode_jenis_barang" id="kode_jenis_barang" style="text-align: left;">Jenis Barang</label>
        <div class="col-sm-5">
            <select class="form-control" name="kode_jenis_barang" id="kode_jenis_barang">
                <!-- <option> ----- pilih nama progress ----- </option> -->
                <?php 
                print_r($pilihan_jenis_barang);exit();
                foreach ($pilihan_jenis_barang as $value) {
                    ?>
                    <option value="<?php echo $value->kode_jenis_barang ;?>"> <?php echo $value->nama_jenis_barang ;?> </option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-5"></div>
        <div class="col-sm-5">
            <button class="btn btn-info">Simpan</button>
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button> -->
        </div>
    </div>
</form>
<script type="text/javascript">
    // js 
    $(document).ready(function(){
       $('#mySelect option[value="<?php echo $pilihan_jenis_barang->nama_jenis_barang ;?>"]').attr('selected', true)
    });

</script>
