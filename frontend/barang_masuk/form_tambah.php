<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Tambah Barang Masuk</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Barang Masuk</h2>

    <div class="kotak-form">
      <h2>Form Tambah Barang Masuk</h2>
      <form action="../../backend/barang_masuk/barang_masuk.php" method="POST">

        <label>Nama Barang</label>
        <input type="text" class="form" name="nama_brg" placeholder="Beras">

        <label>Qty</label>
        <input type="number" class="form" name="stok_brg" placeholder="1000">

        <label>Satuan</label>
        <input type="text" class="form" name="satuan_brg" placeholder="Pcs/Kg/Ton/Dll">

        <label>Harga Satuan</label>
        <input type="text" class="form" name="harga_satuan" placeholder="15.000">

        <label>Pengirim</label>
        <input type="text" class="form" name="pengirim" placeholder="Nama PT/Instansi/Dll">

        <input type="submit" class="form-tombol" value="Submit" name="barang_masuk">
      </form>
    </div>
    <a href="../data_barang/index.php?page=databarang" class="btn btn-abu margin-20-0">
      Kembali
    </a>
  </div>

</body>
</html>