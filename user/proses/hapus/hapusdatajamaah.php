<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];

$sqlm = mysqli_query($koneksi, "DELETE FROM jamaah WHERE idjamaah='$id'");

header("location:../../datajamaah.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Jamaah Berhasil Di Hapus';
} else {
  $_SESSION['alert'] = 'Jamaah Gagal Di Hapus';
}
