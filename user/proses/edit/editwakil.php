<?php

include "../../../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $jenkel = $_POST['jenkel'];
  $nohp = $_POST['nohp'];
  $alamat = $_POST['alamat'];


  $sqlm = mysqli_query($koneksi, "UPDATE perwakilan set
  nama_wakil='$nama', 
  jenkel='$jenkel',
  nohp = '$nohp',
  alamat = '$alamat' WHERE idperwakilan='$id'");

  header("location:../../dataperwakilan.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Data Perwakilan Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Data Perwakilan Gagal Di Edit';
  }
}
