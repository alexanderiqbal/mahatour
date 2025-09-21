<?php

include "../../../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $kelamin = $_POST['kelamin'];
  $alamat = $_POST['alamat'];
  $nohp = $_POST['nohp'];
  $usernam = $_POST['username'];
  $pasw = $_POST['pasw'];


  $sqlm = mysqli_query($koneksi, "UPDATE perwakilan set
  nama_wakil='$nama', 
  jenkel = '$kelamin',
  nohp = '$nohp',
  user_wakil = '$usernam',
  pass = '$pasw',
  alamat = '$alamat' WHERE idperwakilan='$id'");

  header("location:../../index.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Profil Anda Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Profil Anda Gagal Di Edit';
  }
}
