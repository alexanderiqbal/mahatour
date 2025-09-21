<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];
$validasi = 'Verifikasi';

$sqlm = mysqli_query($koneksi, "UPDATE pembayaran set statusbayar='$validasi' WHERE idpembayaran='$id'"); //Update status pembayaran menjadi validasi

$booking_result = mysqli_query($koneksi, "SELECT kdbooking FROM pembayaran WHERE idpembayaran = '$id'"); //Mengambil kdbooking dari tabel pembayaran
$booking_id = $booking_result->fetch_assoc()['kdbooking'];

$total_paid_result = mysqli_query($koneksi, "SELECT SUM(nominal) AS total_paid FROM pembayaran WHERE kdbooking = '$booking_id' AND statusbayar = 'Verifikasi'");
$total_paid = $total_paid_result->fetch_assoc()['total_paid'];

$package_result = mysqli_query($koneksi, "SELECT harga FROM paket JOIN booking ON paket.idpaket = booking.idpaketumroh WHERE booking.idbooking = '$booking_id'");
$package_price = $package_result->fetch_assoc()['harga'];

if ($total_paid >= $package_price) {
  $sql = "UPDATE booking SET statusbooking = 'Lunas' WHERE idbooking = '$booking_id'";
  if ($koneksi->query($sql) === TRUE) {
    echo "Status booking diubah menjadi lunas.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo "Total pembayaran belum mencukupi harga paket.";
}


header("location:../../validasipembayaran.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Pembayaran Berhasil Di Verifikasi';
} else {
  $_SESSION['pesan'] = 'Pembayaran Gagal Di Verfikasi';
}
