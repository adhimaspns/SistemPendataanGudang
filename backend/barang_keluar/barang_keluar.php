<?php

  include '../../database/koneksi.php';

  if (isset($_POST['simpan_transaksi'])) {
    
    //! Variabel
    $nama_pembeli = ucwords(strtolower($_POST['nama_pembeli'])); 
    $keterangan   = ucwords(strtolower($_POST['keterangan'])); 

    //! baca current date
    $today = date("Ymd");

    //! Membuat Nomor Transaksi 
      // cari nomor_transaksi transaksi terakhir yang berawalan tanggal hari ini
      $query = "SELECT MAX(nomor_transaksi) AS last FROM transaksi WHERE nomor_transaksi LIKE '$today%'";
      $hasil = mysqli_query($host,$query);
      $data  = mysqli_fetch_array($hasil);
      $lastNoTransaksi = $data['last'];
      
      // baca nomor urut transaksi dari id transaksi terakhir 
      $lastNoUrut = substr($lastNoTransaksi, 8, 4); 
      
      // nomor urut ditambah 1
      $nextNoUrut = $lastNoUrut + 1;
      
      // membuat format nomor transaksi berikutnya
      $nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
    //! Akhir Membuat Nomor Transaksi

    //! Simpan Transaksi
    $simpanDataTransaksi      = "INSERT INTO transaksi VALUES(0, '$nextNoTransaksi', '$nama_pembeli', '$keterangan', '$today')"; 
    $querySimpanDataTransaksi = mysqli_query($host, $simpanDataTransaksi);

    if ($querySimpanDataTransaksi) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$nextNoTransaksi&page=barangkeluar';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_keluar/index.php?page=barangkeluar';
        </script>
      ";
    }
  }

  if (isset($_POST['simpanBarang'])) {

    //! Variabel
    $barang_id  = $_POST['barang_id']; 
    $jumlahQty  = $_POST['jumlahQty'];
    $Tr         = $_GET['Tr']; 
    $hariIni    = date('Ymd');


    //! Select Harga Barang
    $selectHargaBarang    = "SELECT * FROM barang WHERE id_barang = '$barang_id' ";
    $queryHargaBarang     = mysqli_query($host, $selectHargaBarang);
    $DatahargaBarang      = mysqli_fetch_assoc($queryHargaBarang); 
    $hargaBarang          = $DatahargaBarang['harga_barang'];

    //! Select Data Barang Where barang_id tabel kasir
    $selectDataKasir      = "SELECT * FROM kasir WHERE barang_id_kasir = '$barang_id' AND nomor_transaksi_kasir = '$Tr' ";
    $queryDataKasir       = mysqli_query($host, $selectDataKasir);
    $dataKasir            = mysqli_fetch_assoc($queryDataKasir);
    $cekDataKasir         = mysqli_num_rows($queryDataKasir);

    //! Aritmatika
    $subtotalBarang    = $jumlahQty * $hargaBarang;

    if ($cekDataKasir = 0) {
      $subtotal  = $jumlahQty * $hargaBarang;

      //! Insert Data Kasir 
      $insertKasir      = "INSERT INTO kasir VALUES(0, '$hariIni', '$Tr', '$barang_id', '$jumlahQty', '$hargaBarang', '$subtotal' )";
      $queryInsertKasir = mysqli_query($host, $insertKasir);

      //! Insert Data Detail Transaksi 
      $insertDetailTransaksi  = "INSERT INTO detail_transaksi VALUES(0, '$hariIni', '$Tr', '$barang_id', '$jumlahQty', '$hargaBarang', '$subtotal')";
      $queryDetailTransaksi   = mysqli_query($host, $insertDetailTransaksi);

      //! Select Stok Barang
      $selectStokBarang  = "SELECT * FROM barang WHERE id_barang = '$barang_id' ";
      $queryStokBarang   = mysqli_query($host, $selectStokBarang);
      $dataBarang        = mysqli_fetch_assoc($queryStokBarang);
      $stokBarang        = $dataBarang['stok_barang'];

      //! Aritmatika
      $qtyKurangBarang = $stokBarang - $jumlahQty; 

      //! Update Stok barang
      $updateStokBarang      = "UPDATE barang SET stok_barang = '$qtyKurangBarang' WHERE id_barang = '$barang_id' ";
      $queryUpdateStokBarang = mysqli_query($host, $updateStokBarang);

      if ($queryUpdateStokBarang) {
        echo "
          <script>
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      } else {
        echo "
          <script>
            alert('Operasi Gagal');
            window.location.href='../../frontend/barang_keluar/kasir.php?Tr=$Tr&page=barangkeluar';
          </script>
        ";
      }

    } else {

      //! Select Stok Kasir
      $selectStokKasir   = "SELECT * FROM kasir WHERE barang_id_kasir = '$barang_id' AND nomor_transaksi_kasir = '$Tr' ";
      $queryStokKasir    = mysqli_query($host, $selectStokKasir);
      $dataKasir         = mysqli_fetch_assoc($queryStokKasir);
      $stokKasir         = $dataKasir['qty_kasir'];

      //! Aritmatika 
      $qtyAkhir  = $stokKasir + $jumlahQty;
      $sub_total = $qtyAkhir * $hargaBarang;
    }
    
  }

?>