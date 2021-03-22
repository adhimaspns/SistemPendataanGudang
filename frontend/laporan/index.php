<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    include '../layouts/sidebar.php';
  ?>

  <div class="content">
    <h1>Sistem Pendataan Gudang</h1>
    <h2 class="teks-rata-kanan margin-top-50">Laporan</h2>

    <center class="margin-top-100">
      <a href="laporan_masuk/index.php?page=laporan" class="btn btn-biru">
        Laporan Barang Masuk
      </a>
      <a href="laporan_keluar/index.php?page=laporan" class="btn btn-merah">
        Laporan Barang Keluar
      </a>
    </center>

    <!-- <h2>Pratinjau Data Laporan</h2>
    <div class="kotak-table">
      <table class="table-responsive">
        <tr>
          <th>No</th>
          <th></th>
        </tr>
      </table>
    </div> -->
  </div>

</body>
</html>