<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Nota Transaksi</title>
</head>
<body>
  <?php
    include '../../database/koneksi.php';
    $Tr = $_GET['Tr'];

    //! Select Data Transaksi
    $selectTransaksi   = "SELECT * FROM transaksi WHERE nomor_transaksi = '$Tr' "; 
    $queryTransaksi    = mysqli_query($host, $selectTransaksi);
    $dataTransaksi     = mysqli_fetch_assoc($queryTransaksi);

    //! Select Detail Transaksi 
    $selectDetail      = "SELECT * FROM detail_transaksi WHERE nomor_transaksi_detail =  '$Tr' ";
    $queryDetail       = mysqli_query($host, $selectDetail);
    $dataDetail        = mysqli_fetch_assoc($queryDetail);
    
    //! Select Laporan Barang Keluar
    $selectLaporan     = "SELECT * FROM laporan_brg_keluar WHERE no_tr_brg_keluar = '$Tr' "; 
    $queryLaporan      = mysqli_query($host, $selectLaporan);
    $dataLaporan       = mysqli_fetch_assoc($queryLaporan);
  ?>
  <center>
    <div class="heading margin-bottom-50">
      <h1 class="teks-center">PT. Gudang Mlaten Makmur Tbk.</h1>
      <table>
        <tr>
          <td><b class="teks-rata-kiri">Tanggal Transaksi </b></td>
          <td> : <?= date('d M Y', strtotime($dataLaporan['tanggal_brg_keluar'])) ?></td>
        </tr>
        <tr>
          <td><b class="teks-rata-kiri">Nomor Transaksi </b></td>
          <td> : <?= $dataLaporan['no_tr_brg_keluar'] ?></td>
        </tr>
        <tr>
          <td><b class="teks-rata-kiri">Nama Pembeli</b></td>
          <td> : <?= $dataLaporan['nama_pembeli'] ?></td>
        </tr>
        <tr>
          <td><b class="teks-rata-kiri">Total Pembayaran</b></td>
          <td> : <?= "Rp. " . number_format($dataLaporan['total'],0,',','.') ?></td>
        </tr>
      </table>
    </div>
    <h2>Detail Barang</h2>
    <div class="kotak-table">
      <table border="1">
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Qty</th>
          <th>Harga Satuan</th>
          <th>Sub Total</th>
        </tr>
        <?php
          $no                = 1 ;
          $selectDataDetail  = "SELECT * FROM detail_transaksi INNER JOIN barang ON detail_transaksi.barang_id_detail = barang.id_barang WHERE nomor_transaksi_detail = '$Tr' ";
          $queryDetail       = mysqli_query($host, $selectDataDetail);
          while ($detail   = mysqli_fetch_assoc($queryDetail) ) {
            
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $detail['kode_barang'] ?></td>
          <td><?= $detail['nama_barang'] ?></td>
          <td><?= $detail['qty_detail'] . " " . $detail['satuan_stok_barang'] ?></td>
          <td><?= "Rp. " . number_format($detail['harga_barang'],0,',','.') ?></td>
          <td><?= "Rp. " . number_format($detail['sub_total_detail'],0,',','.') ?></td>
        </tr>
        <?php } ?>
        <tr>
          <?php
            $sumSubTotal   = "SELECT SUM(sub_total_detail) AS grandtotal FROM detail_transaksi WHERE nomor_transaksi_detail = '$Tr'";
            $querySum      = mysqli_query($host, $sumSubTotal);
            $grandTotal    = mysqli_fetch_assoc($querySum);
          ?>
          <td colspan="5" class="backg-hitam teks-putih">Grand Total</td>
          <td colspan="1" class="backg-hitam teks-putih"><?= "Rp. " . number_format($grandTotal['grandtotal'],0,',','.') ?></td>
        </tr>
      </table>
    </div>
  </center>

  <script>
		window.print();
	</script>
  
</body>
</html>