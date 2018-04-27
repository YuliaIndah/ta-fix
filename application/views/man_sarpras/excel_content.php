 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
 <table border="1" width="100%">

  <thead>

   <tr>

    <th>No</th>
    <th>Nama Barang</th>
    <th>Nama Item Pengajuan Barang</th>
    <th>Nama Pengaju</th>
    <th>Jabatan Pengaju</th>
    <th>Merk</th>
    <th>Tgl Pengajuan</th>
    <th>Harga Satuan</th>
    <th>Jumlah</th>
    <th>Url</th>
    <th>Total Harga</th>

  </tr>

</thead>

<tbody>

  <?php $no=1; foreach($data_rab as $barang) { ?>
  
  <tr>

    <td><?php echo $no ?></td>
    <td><?php echo $barang->nama_barang ?></td>
    <td><?php echo $barang->nama_item_pengajuan ?></td>
    <td><?php 
                     // mendapatkan nama pengaju dari kode item pengajuan berdasarkan id
    $nama_pengaju = $Man_sarprasM->get_data_item_pengajuan_by_id($barang->kode_item_pengajuan)->result()[0]->nama;
    echo $nama_pengaju;
    ?>
  </td>
  <td>
    <?php 
                    // mendapatkan nama jabatan dari kode item pengajuan berdasarkan id
    $jabatan      = $Man_sarprasM->get_data_item_pengajuan_by_id($barang->kode_item_pengajuan)->result()[0]->nama_jabatan;
                    // mendapatkan kode jabatan dari kode item pengajuan berdasarkan id
    $kode_jabatan = $Man_sarprasM->get_data_item_pengajuan_by_id($barang->kode_item_pengajuan)->result()[0]->kode_jabatan;
                    // mendapatkan nama unit dari kode item pengajuan berdasarkan id
    $unit         = $Man_sarprasM->get_data_item_pengajuan_by_id($barang->kode_item_pengajuan)->result()[0]->nama_unit;
                    // mendapatkan kode unit dari kode item pengajuan berdasarkan id
    $kode_unit    = $Man_sarprasM->get_data_item_pengajuan_by_id($barang->kode_item_pengajuan)->result()[0]->kode_unit;
                    //menampilkan nama jabatan dan unit dari pengaju item pengajuan
    $jabatan = $jabatan." ".$unit;
    echo $jabatan;
    ?>
  </td>
  <td><?php echo $barang->merk ?></td>
  <td><?php echo $barang->tgl_item_pengajuan;?></td>
  <td><?php echo $barang->harga_satuan ?></td>
  <td><?php echo $barang->jumlah;?></td>
  <?php 
  $jumlah = $barang->jumlah;
  $harga = $barang->harga_satuan;
                  //menghitung hasil total biaya item pengajuan dari perkalian harga satuan dengan jumlah barang
  $total = $jumlah*$harga;
  ?>
  <td><?php echo $barang->url ?></td>
  <td><?php echo $total;?></td>

</tr>

<?php $no++; } ?>

</tbody>

</table>