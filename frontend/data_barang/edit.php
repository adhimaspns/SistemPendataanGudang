<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Edit Barang Masuk</title>
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
      <h2>Form Edit Barang Masuk</h2>

      <?php
      $kode_barang  = $_GET['kode_barang'];

      $selectData  = "SELECT * FROM laporan_brg_masuk WHERE kode_barang = '$kode_barang' ";
      $queryData   = mysqli_query($host, $selectData);
      $data        = mysqli_fetch_assoc($queryData);
      ?>

      <form action="../../backend/barang_masuk/barang_masuk.php" method="POST">

        <label>Kode Barang</label>
        <input type="text" class="form" name="kode_barang" value="<?= $data['kode_barang'] ?>" readonly>

        <label>Nama Barang</label>
        <input type="text" class="form" name="nama_brg" value="<?= $data['nama_brg'] ?>">

        <label>Qty</label>
        <input type="number" class="form" name="stok_brg" value="<?= $data['stok_masuk'] ?>">

        <label>Satuan</label>
        <input type="text" class="form" name="satuan_brg" value="<?= $data['stn_brg_masuk'] ?>">

        <label>Harga Satuan</label>
        <input type="text" class="form" name="harga_satuan" value="<?= $data['harga_satuan'] ?>">

        <label>Pengirim</label>
        <input type="text" class="form" name="pengirim" value="<?= $data['nama_pengirim'] ?>">

        <input type="submit" class="form-tombol" value="Update" name="edit_barang_masuk">
      </form>
    </div>
    <a href="index.php?page=databarang" class="btn btn-abu margin-20-0">
      Kembali
    </a>
  </div>

</body>
</html>