<?php

include "../../../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {

  $id = $_POST['idpaket'];
  $umroh = $_POST['umroh'];
  $perwakilan = $_POST['perwakilan'];

  if ($id || $umroh || $perwakilan != null) {

    $sqlm = mysqli_query($koneksi, "UPDATE booking set idpaketumroh='$umroh', idnamaperwakilan='$perwakilan' WHERE idbooking=$id");

    header("location:../../databooking.php");


    if ($sqlm) {
      $_SESSION['pesan'] = 'Data Booking Berhasil Di Edit';
    } else {
      $_SESSION['alert'] = 'Data Booking Gagal Di Edit';
    }
  }
} else {
  header('location:../../databooking.php');
  $_SESSION['alert'] = 'Data Tidak Boleh Kosong';
}
