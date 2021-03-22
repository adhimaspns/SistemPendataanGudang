<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Qty</title>
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

    <h2>Kurang Stok Barang</h2>
    <?php
      $Tr         = $_GET['Tr'];
      $barang_id  = $_GET['barang_id'];

      $sqlData    = "SELECT * FROM kasir INNER JOIN barang ON kasir.barang_id_kasir = barang.id_barang WHERE barang_id_kasir = '$barang_id' AND nomor_transaksi_kasir = '$Tr' ";
      $query      = mysqli_query($host, $sqlData);
      $data       = mysqli_fetch_assoc($query);
    ?>
    <div class="kotak-form">
      <form action="../../backend/barang_keluar/barang_keluar.php?Tr=<?php echo $Tr?>" method="POST">

        <input type="hidden" name="Tr" value="<?php echo $Tr ?>">
        <input type="hidden" name="barang_id" value="<?php echo $barang_id ?>">
        <input type="hidden" name="qty_kasir" value="<?php echo $data['qty_kasir'] ?>">
        <input type="hidden" name="harga_item_kasir" value="<?php echo $data['harga_item_kasir'] ?>">
        <input type="hidden" name="sub_total_kasir" value="<?php echo $data['sub_total_kasir'] ?>">
        <input type="hidden" name="stok_barang" value="<?php echo $data['stok_barang'] ?>">

        <label>Nama Barang</label>
        <input type="text" class="form" value="<?php echo $data['nama_barang']?>" readonly>

        <label>Qty Awal</label>
        <input type="text" class="form" value="<?php echo $data['qty_kasir']?>" readonly>
        

        <label>Jumlah Yang Dikurangi</label>
        <input type="number" name="jumlahQtKurang" class="form" >

        <input type="submit" value="Simpan" name="editQtyBarang" class="btn btn-hijau">
      </form>
    </div>
    <a href="kasir.php?Tr=<?php echo $Tr?>&page=barangkeluar" class="btn btn-abu margin-20-0">
      Kembali
    </a>
  </div>

</body>
</html>