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


  $sqlm = mysqli_query($koneksi, "UPDATE jamaah set
  namajamaah='$nama', 
  nik='$nik',
  tgllahir = '$tgl',
  kelamin = '$kelamin',
  alamat = '$alamat',
  nomorhp = '$nohp' WHERE idjamaah='$id'");

  header("location:../../datajamaah.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Data Jamaah Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Data Jamaah Gagal Di Edit';
  }
}
