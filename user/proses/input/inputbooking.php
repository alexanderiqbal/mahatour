<?php

include("../../../koneksi.php");
session_start();
if (isset($_POST['simpan'])) {

  $query = mysqli_query($koneksi, "SELECT max(idbooking) as kodebooking FROM booking");
  $data = mysqli_fetch_array($query);
  $kodebooking = $data['kodebooking'];
  $urutan = (int) substr($kodebooking, 3, 3);
  $urutan++;
  $huruf = "BPU";
  $kodepesanan = $huruf . sprintf("%03s", $urutan);

  $iduser = $_POST['idjamaah'];
  $idpaket = $_POST['umroh'];
  $idwakil = $_POST['perwakilan'];
  $status = 'Belum Lunas';

  $sqlm = mysqli_query($koneksi, "INSERT into booking values ('$kodepesanan','$iduser','$idpaket','$idwakil','$status')");
  if ($sqlm) {
  header("location:../../databooking.php");
    $_SESSION['pesan'] = 'Booking Paket Umroh Berhasil Dilakukan';
  } else {
  header("location:../../datadiri.php");
    $_SESSION['alert'] = 'Booking Paket Umroh Gagal Dilakukan';
  }
}
