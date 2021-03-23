<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barang Keluar</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
    
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Barang Keluar</h2>

    <div class="kotak-form">
      <h2>Form Barang Keluar</h2>
      <form action="../../backend/barang_keluar/barang_keluar.php" method="POST">

        <label>Nama Pembeli</label>
        <input type="text" class="form" name="nama_pembeli" placeholder="Arie">

        <label>Keterangan</label>
        <textarea name="keterangan" class="form" cols="30" rows="10" placeholder="Tambahkan Keterangan(opsional)"></textarea>

        <input type="submit" class="form-tombol" value="Simpan" name="simpan_transaksi">
      </form>
    </div>

    <!-- <a href="form_tambah.php?page=barangkeluar" class="btn btn-biru">
      Tambah Barang Keluar
    </a> -->
  </div>

</body>
</html>