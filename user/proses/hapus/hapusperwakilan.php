<?php

include "../../../koneksi.php";
session_start();



$id = $_GET['id'];

$sqlm = mysqli_query($koneksi, "DELETE FROM perwakilan WHERE idperwakilan='$id'");

header("location:../../dataperwakilan.php");


if ($sqlm) {
  $_SESSION['pesan'] = 'Perwakilan Berhasil Di Hapus';
} else {
  $_SESSION['alert'] = 'Perwakilan Gagal Di Hapus';
}
