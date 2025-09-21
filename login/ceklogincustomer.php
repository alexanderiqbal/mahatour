<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM jamaah WHERE username = '$username' AND pasw = '$password'");
$cek = mysqli_fetch_assoc($login);

if ($cek['username'] == $username && $cek['pasw'] == $password) {
  //Jika Login Berhasil
  header("location:../user/index.php");
  $_SESSION['pesan'] = 'Selamat Datang ' . $cek['namajamaah'] . ' Dalam Web MAHA TOUR';
  $_SESSION['username'] = $username;
  $_SESSION['nama'] = $cek['namajamaah'];
  $_SESSION['id'] = $cek['idjamaah'];
  $_SESSION['jabatan'] = $cek['level'];
} else {
  header("location:logincustomer.php");
  $_SESSION['alert'] = 'Username / Password Salah';
}
