<?php

  $host = mysqli_connect('localhost', 'root', '', 'SistemPendataanGudang');

  //! Cek Database
  if (!$host) {
    echo "Database Tidak Ditemukan";
  } 
?>