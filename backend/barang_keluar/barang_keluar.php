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
    $Tr         = $_POST['Tr']; 
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

    if ($cekDataKasir == 0) {
      $subtotal  = $jumlahQty * $hargaBarang;

      //! Insert Data Kasir 
      $insertKasir      = "INSERT INTO kasir VALUES(0, '$hariIni', '$Tr', '$barang_id', '$jumlahQty', '$hargaBarang', '$subtotal' )";
      $queryInsertKasir = mysqli_query($host, $insertKasir);

      $insertKasir;

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

      //! Select Stok Barang
      $selectBarang   = "SELECT * FROM barang WHERE id_barang = '$barang_id' ";
      $queryBarang    = mysqli_query($host, $selectBarang);
      $dataBarang     = mysqli_fetch_assoc($queryBarang);
      $stokBarang     = $dataBarang['stok_barang']; 

      //! Aritmatika 
      $qtyAkhir  = $stokKasir + $jumlahQty;
      $sub_total = $qtyAkhir * $hargaBarang;
      $stokAkhir = $stokBarang - $qtyAkhir;

      //! Update Qty Kasir 
      $updateQtyKasir   = "UPDATE kasir SET qty_kasir = '$qtyAkhir', sub_total_kasir = '$sub_total' WHERE barang_id_kasir = '$barang_id' AND nomor_transaksi_kasir = '$Tr'";
      $queryQtyKasir    = mysqli_query($host, $updateQtyKasir);

      echo $updateQtyKasir;
      
      //! Update Qty Detail Transaksi
      $updateQtyDetail  = "UPDATE detail_transaksi SET qty_detail = '$qtyAkhir', sub_total_detail = '$sub_total' WHERE barang_id_detail ='$barang_id' AND nomor_transaksi_detail = '$Tr'";
      $queryQtyDetail   = mysqli_query($host, $updateQtyDetail);

      //! Update Stok Barang 
      $updateStokBarang   = "UPDATE barang SET stok_barang = '$stokAkhir' WHERE id_barang = '$barang_id' ";
      $queryStokBarang    = mysqli_query($host, $updateStokBarang);

      if ($queryStokBarang) {
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
    }

  }

  if (isset($_POST['editQtyBarang'])) {

    //! Variabel 
    $Tr               = $_POST['Tr']; 
    $barang_id        = $_POST['barang_id']; 
    $jumlahQtKurang   = $_POST['jumlahQtKurang']; 
    $qty_kasir        = $_POST['qty_kasir']; 
    $harga_item_kasir = $_POST['harga_item_kasir']; 
    $sub_total_kasir  = $_POST['sub_total_kasir']; 
    $stok_barang      = $_POST['stok_barang']; 

    //! Aritmatika
    $qtyAkhir        = $qty_kasir - $jumlahQtKurang;
    $stokAkhirBarang = $stok_barang + $jumlahQtKurang; 
    $subtotal        = $qtyAkhir * $harga_item_kasir;

    //! Update Stok Barang 
    $updateStokBarang    = "UPDATE barang SET stok_barang = '$stokAkhirBarang' WHERE id_barang = '$barang_id' ";
    $queryStokBarang     = mysqli_query($host, $updateStokBarang);

    //! Update Qty & Stok Kasir
    $updateKasir      = "UPDATE kasir SET qty_kasir = '$qtyAkhir', sub_total_kasir = '$subtotal' WHERE barang_id_kasir = '$barang_id' AND nomor_transaksi_kasir = '$Tr' ";
    $queryUpdateKasir = mysqli_query($host, $updateKasir); 

    //! Update Qty & Stok Detail Transaksi
    $updateKasir      = "UPDATE detail_transaksi SET qty_detail = '$qtyAkhir', sub_total_detail = '$subtotal' WHERE barang_id_detail = '$barang_id' AND nomor_transaksi_detail = '$Tr' ";
    $queryUpdateKasir = mysqli_query($host, $updateKasir); 

    if ($queryUpdateKasir) {
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
  }

  if (isset($_POST['simpanTransaksi'])) {

    //! Variabel 
    $Tr                  = $_POST['Tr']; 
    $grandTotal          = $_POST['grandTotal']; 
    $total_data_barang   = $_POST['total_data_barang']; 
    $nama_pembeli        = $_POST['nama_pembeli']; 
    $tgl_hari_ini        = date('Ymd');

    //! Insert Laporan Barang Keluar
    $insertLaporanKeluar   = "INSERT INTO laporan_brg_keluar VALUES(0, '$tgl_hari_ini', '$Tr', '$total_data_barang', '$grandTotal', '$nama_pembeli')"; 
    $queryInsertLaporan    = mysqli_query($host, $insertLaporanKeluar);

    //! Hapus Data Kasir Sesuai Nomor Transaksi
    $hapusKasir      = "DELETE FROM kasir WHERE nomor_transaksi_kasir = '$Tr' ";
    $queryHapusKasir = mysqli_query($host, $hapusKasir);

    if ($queryHapusKasir) {
      echo "
        <script>
          window.location.href='../../frontend/barang_keluar/nota.php?Tr=$Tr&page=barangkeluar';
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
  }

?>