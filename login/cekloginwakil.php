<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($koneksi, "SELECT * FROM perwakilan WHERE user_wakil = '$username' AND pass = '$password'");
$cek = mysqli_fetch_assoc($login);

if ($cek['user_wakil'] == $username && $cek['pass'] == $password) {
  //Jika Login Berhasil
  header("location:../user/index.php");
  $_SESSION['pesan'] = 'Selamat Datang ' . $cek['nama_wakil'] . ' Dalam Web MAHA TOUR';
  $_SESSION['username'] = $username;
  $_SESSION['nama'] = $cek['nama_wakil'];
  $_SESSION['id'] = $cek['idperwakilan'];
  $_SESSION['jabatan'] = $cek['level'];
} else {
  header("location:loginperwakilan.php");
  $_SESSION['alert'] = 'Username / Password Salah';
}
