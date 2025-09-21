<?php

include "../../../koneksi.php";
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


  $sqlm = mysqli_query($koneksi, "UPDATE jamaah set
  namajamaah='$nama', 
  nik='$nik',
  tgllahir = '$tgl',
  kelamin = '$kelamin',
  alamat = '$alamat',
  nomorhp = '$nohp',
  username = '$username', pasw = '$pasw' WHERE idjamaah='$id'");

  header("location:../../index.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Profil Anda Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Profil Anda Gagal Di Edit';
  }
}
