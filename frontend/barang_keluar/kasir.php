<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
    $Tr  =  $_GET['Tr'];
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Barang Keluar</h2>

    <h2>Detail Data Transaksi</h2>
    <div class="kotak-form">
      <?php
        $selectDataTransaksi      = "SELECT * FROM transaksi WHERE nomor_transaksi = '$Tr' ";
        $querySelectDataTransaksi = mysqli_query($host, $selectDataTransaksi);
        $dataTransaksi            = mysqli_fetch_assoc($querySelectDataTransaksi);
      ?>
      <form>
        <label>Nomor Transaksi</label>
        <input type="text" class="form" value="<?= $dataTransaksi['nomor_transaksi']?>" readonly>

        <label>Nama Pembeli</label>
        <input type="text" class="form" value="<?= $dataTransaksi['nama_pembeli']?>" readonly>

        <label>Keterangan</label>
        <textarea class="form" cols="30" rows="10" readonly><?= $dataTransaksi['keterangan']?></textarea>
      </form>
    </div>

    <h2>Tambahkan Barang</h2>
    <div class="kotak-form">
      <form action="../../backend/barang_keluar/barang_keluar.php?Tr=<?php echo $Tr?>" method="POST">
        <label>Barang</label>
        <select name="barang_id" class="form">
          <?php
            $selectDataBarang  = "SELECT * FROM barang";
            $queryDataBarang   = mysqli_query($host, $selectDataBarang);
            while ($dataBarang = mysqli_fetch_assoc($queryDataBarang) ) {
          ?>
          <option value="<?= $dataBarang['id_barang'] ?>"><?= $dataBarang['nama_barang'] ?></option>
          <?php } ?>
        </select>

        <label>Jumlah</label>
        <input type="number" name="jumlahQty" class="form" value="1">

        <input type="submit" value="Simpan" name="simpanBarang" class="btn btn-hijau">
      </form>
    </div>
  </div>

</body>
</html>