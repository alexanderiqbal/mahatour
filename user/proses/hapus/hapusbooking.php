<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];

$sqlm = mysqli_query($koneksi, "DELETE FROM booking WHERE idbooking='$id'");

header("location:../../jamaahbooking.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Data Booking Berhasil Di Hapus';
} else {
  $_SESSION['alert'] = 'Data Booking Gagal Di Hapus';
}
