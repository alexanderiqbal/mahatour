<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];
$validasi = 'Ditolak';

$sqlm = mysqli_query($koneksi, "UPDATE pembayaran set statusbayar='$validasi' WHERE idpembayaran='$id'");

header("location:../../validasipembayaran.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Pembayaran Berhasil Di Tolak';
} else {
  $_SESSION['alert'] = 'Pembayaran Gagal Di Tolak';
}
