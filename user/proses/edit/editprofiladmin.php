<?php

include "../../../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $nohp = $_POST['nohp'];
  $username = $_POST['username'];
  $pasw = $_POST['pasw'];

  $sqlm = mysqli_query($koneksi, "UPDATE user set
  nama='$nama', 
  nohp='$nohp',
  username = '$username',
  pasw = '$pasw' WHERE iduser='$id'");

  header("location:../../index.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Profil Anda Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Profil Anda Gagal Di Edit';
  }
}
