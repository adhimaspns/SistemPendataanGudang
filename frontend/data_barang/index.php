<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Barang</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Data Barang</h2>

    <a href="../barang_masuk/form_tambah.php?page=databarang" class="btn btn-biru margin-20-0">
      Tambah Barang
    </a>

    <div class="kotak-table">
      <table class="table-responsive">
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Stok Barang</th>
          <th>Harga Satuan Barang</th>
          <th>Aksi</th>
        </tr>

        <?php

          $no        = 1;
          $sqlData   = "SELECT * FROM barang WHERE stok_barang != 0 ";
          $query     = mysqli_query($host, $sqlData);
          while ($data = mysqli_fetch_assoc($query) ) {

          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['kode_barang'] ?></td>
            <td><?= $data['nama_barang'] ?></td>
            <td><?= $data['stok_barang'] . " " . $data['satuan_stok_barang'] ?></td>
            <td><?= "Rp " . number_format($data['harga_barang'],0,',','.')  ?></td>
            <td>
              <a href="edit.php?kode_barang=<?= $data['kode_barang'] ?>&page=databarang" class="btn btn-kuning">
                Edit
              </a>
            </td>
          </tr>
          <?php } ?>
      </table>
    </div>
  </div>

</body>
</html>