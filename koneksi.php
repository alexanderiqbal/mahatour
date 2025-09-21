<?php
$koneksi = mysqli_connect(
  "localhost", //Hostname
  "root", //Username
  "", //Password 
  "mahatour" //Nama Database
);

if (mysqli_connect_errno()) {
  echo "Koneksi Database Gagal" . mysqli_connect_error();
}
