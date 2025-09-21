<?php

include("../koneksi.php");
session_start();
if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $tgl = $_POST['tgl'];
  $kelamin = $_POST['kelamin'];
  $alamat = $_POST['alamat'];
  $nohp = $_POST['nohp'];
  $username = $_POST['username'];
  $pasw = $_POST['pasw'];
  $level = 'jamaah';

  $sqlm = mysqli_query($koneksi, "INSERT into jamaah values ('$id','$nama','$nik','$tgl','$kelamin','$alamat','$nohp','$username','$pasw','$level')");
  header("location:logincustomer.php");
  if ($sqlm) {
    $_SESSION['pesan'] = 'Registrasi Berhasil Di Lakukan';
  } else {
    $_SESSION['pesan'] = 'Registrasi Gagal Di Lakukan';
  }
}
