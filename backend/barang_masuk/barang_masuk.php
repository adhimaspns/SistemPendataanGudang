<?php

  include '../../database/koneksi.php';


  // echo "Berhasil";

  //! Barang Masuk
  if (isset($_POST['barang_masuk'])) {
    
    //! Variabel
    $nama_brg      = ucwords(strtolower($_POST['nama_brg'])); 
    $stok_brg      = $_POST['stok_brg']; 
    $satuan_brg    = ucwords(strtolower($_POST['satuan_brg'])); 
    $harga_satuan  = $_POST['harga_satuan']; 
    $pengirim      = ucwords(strtolower($_POST['pengirim'])); 

    
    //! Sistem
    $tanggal_hari_ini  = date('Ymd');
    
    //! Membuat Kode Otomatis
    $sqlKodeOtomatis    = "SELECT MAX(kode_barang) AS kode_otomatis FROM laporan_brg_masuk ";
    $queryKodeOtomatis  = mysqli_query($host, $sqlKodeOtomatis);
    $dataKodeBarang     = mysqli_fetch_array($queryKodeOtomatis);
    $kodeBarang         = $dataKodeBarang['kode_otomatis'];

    //! Aritmatika
    $sub_total    = $harga_satuan * $stok_brg; 

    //! Mengambil Angka Dari Kode Barang Terbesar
    $urutan  = (int) substr($kodeBarang, 3, 6);
    
    //! $urutan ditambah 1
    $urutan++; 

    //! Membentuk Kode Barang Otomatis
    $huruf        = "BRG";
    $kode_barang  = $huruf . sprintf("%06s", $urutan);


    //! Simpan Data Ke Table Barang
    $sqlDataBarang   = "INSERT INTO barang VALUES(0, '$kode_barang', '$nama_brg', '$stok_brg', '$satuan_brg', '$harga_satuan')";
    $queryDataBarang = mysqli_query($host, $sqlDataBarang); 

    //! Simpan Data Ke Table laporan Barang Masuk
    $sqlLaporanBrgMasuk   = "INSERT INTO laporan_brg_masuk VALUES(0, '$tanggal_hari_ini', '$kode_barang', '$nama_brg', '$stok_brg', '$satuan_brg', '$harga_satuan', '$sub_total', '$pengirim' )";
    $querylaporanBrgMasuk = mysqli_query($host, $sqlLaporanBrgMasuk);
    
    if ($querylaporanBrgMasuk) {
      echo "
        <script>
          window.location.href='../../frontend/data_barang/index.php?page=databarang';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/barang_masuk/form_tambah.php?page=brgmsuk';
        </script>
      ";
    }

  } 

  //! Edit Barang Masuk 
  if (isset($_POST['edit_barang_masuk'])) {

    //! Variabel
    $kode_barang   = $_POST['kode_barang']; 
    $nama_brg      = ucwords(strtolower($_POST['nama_brg'])); 
    $stok_brg      = $_POST['stok_brg']; 
    $satuan_brg    = ucwords(strtolower($_POST['satuan_brg'])); 
    $harga_satuan  = $_POST['harga_satuan']; 
    $pengirim      = ucwords(strtolower($_POST['pengirim'])); 

    //! Sistem
    $tanggal_hari_ini  = date('Ymd');
    //! Aritmatika
    $sub_total    = $harga_satuan * $stok_brg;

    //! Update Data Barang 
    $sqlDataBarang   = "UPDATE barang SET nama_barang = '$nama_brg', stok_barang = '$stok_brg', satuan_stok_barang = '$satuan_brg', harga_barang = '$harga_satuan' WHERE kode_barang = '$kode_barang' "; 
    $queryDataBarang = mysqli_query($host, $sqlDataBarang);

    //! Update Data Laporan Barang Masuk 
    $sqlDataLaporanBarang   = "UPDATE laporan_brg_masuk SET nama_brg = '$nama_brg', stok_masuk = '$stok_brg', stn_brg_masuk = '$satuan_brg', harga_satuan = '$harga_satuan', sbttl_brg_masuk = '$sub_total', nama_pengirim = '$pengirim' WHERE kode_barang = '$kode_barang' "; 
    $queryDataLaporanBarang = mysqli_query($host, $sqlDataLaporanBarang);


    if ($queryDataLaporanBarang) {
      echo "
        <script>
          window.location.href='../../frontend/data_barang/index.php?page=databarang';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Operasi Gagal');
          window.location.href='../../frontend/data_barang/edit.php.php?page=databarang';
        </script>
      ";
    }


  }


?>