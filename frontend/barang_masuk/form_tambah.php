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
      <form action="/action_page.php">
        <label>Nama Barang</label>
        <input type="text" class="form" name="" placeholder="Beras">

        <label>Qty</label>
        <input type="number" class="form" name="" placeholder="1000">

        <label>Satuan</label>
        <input type="text" class="form" name="" placeholder="Pcs/Kg/Ton/Dll">

        <label>Pengirim</label>
        <input type="text" class="form" name="" placeholder="Nama PT/Instansi/Dll">

        <label>Harga Satuan</label>
        <input type="text" class="form" name="" placeholder="15.000">

        <input type="submit" class="form-tombol" value="Submit">
      </form>
    </div>
  </div>

</body>
</html>