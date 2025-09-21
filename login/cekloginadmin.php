<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND pasw = '$password'");
$cek = mysqli_fetch_assoc($login);

if ($cek['username'] == $username && $cek['pasw'] == $password) {
  //Jika Login Berhasil
  header("location:../user/index.php");
  $_SESSION['pesan'] = 'Selamat Datang ' . $cek['nama'] . ' Dalam Web MAHA TOUR';
  $_SESSION['username'] = $username;
  $_SESSION['nama'] = $cek['nama'];
  $_SESSION['id'] = $cek['iduser'];
  $_SESSION['jabatan'] = $cek['level'];
} else {
  header("location:loginadmin.php");
  $_SESSION['alert'] = 'Username / Password Salah';
}
