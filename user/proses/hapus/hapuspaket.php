<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];

$sqlm = mysqli_query($koneksi, "DELETE FROM paket WHERE idpaket='$id'");

header("location:../../datapaket.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Paket Umroh Berhasil Di Hapus';
} else {
  $_SESSION['alert'] = 'Paket Umroh Gagal Di Hapus';
}
