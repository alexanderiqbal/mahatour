<?php

include("../../../koneksi.php");
session_start();
if (isset($_POST['simpan'])) {

  $kodepaket = $_POST['kodepaket'];
  $idjamaah = $_POST['idjamaah'];
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $tgl = $_POST['tgl'];
  $kelamin = $_POST['kelamin'];
  $alamat = $_POST['alamat'];
  $nohp = $_POST['nohp'];
  $paket = $_POST['umroh'];
  $perwakilan = $_POST['perwakilan'];


  $sqlm = mysqli_query($koneksi, "INSERT INTO jamaah values ('$kodepaket',
  '$idjamaah',
  '$nama',
  '$nik',
  '$tgl',
  '$kelamin',
  '$alamat',
  '$nohp',
  '$paket',
  '$perwakilan')");

  if ($sqlm) {
    header("location:../../datapesananjamaah.php");
    $_SESSION['pesan'] = 'Jamaah Berhasil Mendaftar Paket Umroh';
  } else {
    header("location:../../datadiri.php");
    $_SESSION['alert'] = 'Jamaah Gagal Mendaftar, Silahkan Coba Lagi';
  }
}
