<?php

include("../../../koneksi.php");
session_start();
if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $jenkel = $_POST['jenkel'];
  $nohp = $_POST['nohp'];
  $username = $_POST['username'];
  $pasw = $_POST['pasw'];
  $alm = $_POST['alamat'];
  $level = 'perwakilan';

  $sqlm = mysqli_query($koneksi, "INSERT into perwakilan values ('$id','$nama','$jenkel','$nohp','$username','$pasw','$alm','$level')");
  header("location:../../dataperwakilan.php");
  if ($sqlm) {
    $_SESSION['pesan'] = 'Data Perwakilan Berhasil Di Input';
  } else {
    $_SESSION['pesan'] = 'Data Perwakilan Gagal Di Input';
  }
}
