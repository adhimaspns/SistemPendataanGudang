<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda</title>
  <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
  <?php
    include '../../../database/koneksi.php';
    include '../../layouts/sidebar.php';
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Laporan Barang Masuk</h2>

    <h2>Data Laporan Barang Masuk</h2>
    <div class="kotak-table">
      <table class="table-responsive">
        <tr>
          <th>No</th>
          <th>Tanggal Barang Masuk</th>
          <th>Nama Pengirim</th>
          <th>Nama Barang</th>
          <th>Stok Barang</th>
          <th>Harga Satuan Barang</th>
          <th>Subtotal</th>
        </tr>

        <?php
          $no                 = 1;
          $selectDataLaporan  = "SELECT * FROM laporan_brg_masuk";
          $queryDataLaporan   = mysqli_query($host, $selectDataLaporan);
          while ($data = mysqli_fetch_assoc($queryDataLaporan) ) {

          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= date('d M Y', strtotime($data['tgl_masuk']))  ?></td>
            <td><?= $data['nama_pengirim'] ?></td>
            <td><?= $data['nama_brg'] ?></td>
            <td><?= $data['stok_masuk'] . " " . $data['stn_brg_masuk'] ?></td>
            <td><?= "Rp. " . number_format($data['harga_satuan'],0,',','.') ?></td>
            <td><?= "Rp. " . number_format($data['sbttl_brg_masuk'],0,',','.')  ?></td>
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