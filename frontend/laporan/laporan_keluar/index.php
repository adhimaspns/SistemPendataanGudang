<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Barang Keluar</title>
  <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
  <?php
    include '../../../database/koneksi.php';
    include '../../layouts/sidebar.php';
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Laporan Barang Keluar</h2>

    <h2>Data Laporan Barang Keluar</h2>
    <div class="kotak-table">
      <table class="table-responsive">
        <tr>
          <th>No</th>
          <th>Tanggal Barang Keluar</th>
          <th>Nomor Transaksi</th>
          <th>Jumlah Barang Keluar</th>
          <th>Total Pembayaran</th>
          <th>Nama Pembeli</th>
          <th>Aksi</th>
        </tr>

        <?php
          $no                 = 1;
          $selectDataLaporan  = "SELECT * FROM laporan_brg_keluar";
          $queryDataLaporan   = mysqli_query($host, $selectDataLaporan);
          while ($data = mysqli_fetch_assoc($queryDataLaporan) ) {

          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= date('d M Y', strtotime($data['tanggal_brg_keluar']))  ?></td>
            <td><?= $data['no_tr_brg_keluar'] ?></td>
            <td><?= $data['jumlah_barang_keluar'] ?></td>
            <td><?= "Rp. " . number_format($data['total'],0,',','.') ?></td>
            <td><?= $data['nama_pembeli'] ?></td>
            <td>
              <a target="blank" href="../../barang_keluar/cetak_nota.php?Tr=<?php echo $data['no_tr_brg_keluar'] ?>" class="btn btn-biru">
                Cetak Nota
              </a>
            </td>
          </tr>
          <?php } ?>
      </table>
    </div>
    <a href="../index.php?page=laporan" class="btn btn-abu margin-20-0">
      Kembali
    </a>
  </div>

</body>
</html>