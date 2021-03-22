<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kasir</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
    $Tr  =  $_GET['Tr'];
  ?>

  <div class="content margin-bottom-200">
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

        <input type="hidden" name="Tr" value="<?php echo $Tr ?>">
        <label>Barang</label>
        <select name="barang_id" class="form">
          <?php
            $selectDataBarang  = "SELECT * FROM barang WHERE stok_barang != 0";
            $queryDataBarang   = mysqli_query($host, $selectDataBarang);
            while ($dataBarang = mysqli_fetch_assoc($queryDataBarang) ) {
          ?>
          <option value="<?= $dataBarang['id_barang'] ?>"><?= $dataBarang['nama_barang'] . " == " . "Sisa Stok " . $dataBarang['stok_barang']  ?></option>
          <?php } ?>
        </select>

        <label>Jumlah</label>
        <input type="number" name="jumlahQty" class="form" value="1">

        <input type="submit" value="Simpan" name="simpanBarang" class="btn btn-hijau">
      </form>
    </div>

    <h2>Barang</h2>
    <div class="kotak-table">
      <table class="table-responsive">
        <tr>
          <td>No</td>
          <td>Nama Barang</td>
          <td>Qty</td>
          <td>Harga Satuan</td>
          <td>Subtotal</td>
        </tr>

        <?php
          $no           = 1;
          $dataKasir    = "SELECT * FROM kasir INNER JOIN barang ON kasir.barang_id_kasir = barang.id_barang  WHERE nomor_transaksi_kasir = '$Tr' ";
          $queryKasir   = mysqli_query($host, $dataKasir);
          $cekDataKasir = mysqli_num_rows($queryKasir);
          while ($dataKasir  = mysqli_fetch_assoc($queryKasir) ) {

        ?> 
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $dataKasir['nama_barang'] ?></td>
          <td>
            <?= $dataKasir['qty_kasir'] ?>
            <a href="edit.php?Tr=<?php echo $Tr ?>&barang_id=<?php echo $dataKasir['barang_id_kasir'] ?>&page=barangkeluar" class="btn btn-kuning"> -</a>
          </td>
          <td><?= "Rp. " . number_format($dataKasir['harga_barang'],0,',','.') ?></td>
          <td><?= "Rp. " . number_format($dataKasir['sub_total_kasir'],0,',','.') ?></td>
        </tr>
        <?php } ?>
        <tr>
          <?php

            //! Sum SubTotal 
            $sumSubtotal      = "SELECT SUM(sub_total_kasir) AS grand_total FROM kasir ";
            $querySumSubtotal = mysqli_query($host, $sumSubtotal);
            $grandTotal       = mysqli_fetch_assoc($querySumSubtotal);

            //! Select Data Transaksi
            $selectDataTr   = "SELECT * FROM transaksi WHERE nomor_transaksi = '$Tr' ";
            $queryTr        = mysqli_query($host, $selectDataTr);
            $dataTr         = mysqli_fetch_assoc($queryTr);  
          ?>
          <td colspan="4">Grand Total</td>
          <td colspan="1"> : <?php echo "Rp. " . number_format($grandTotal['grand_total'],0,',','.') ?></td>
        </tr>
      </table>
    </div>
    <form action="../../backend/barang_keluar/barang_keluar.php" method="POST">
      <input type="hidden" name="Tr" value="<?php echo $Tr?>">
      <input type="hidden" name="grandTotal" value="<?php echo $grandTotal['grand_total']?>">
      <input type="hidden" name="total_data_barang" value="<?php echo $cekDataKasir?>">
      <input type="hidden" name="nama_pembeli" value="<?php echo $dataTr['nama_pembeli']?>">

      <button type="submit" class="btn btn-hijau margin-20-0" name="simpanTransaksi">Simpan</button>
    </form>

  </div>

</body>
</html>