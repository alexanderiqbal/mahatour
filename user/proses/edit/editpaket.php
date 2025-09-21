<?php

include "../../../koneksi.php";
session_start();

if (isset($_POST['simpan'])) {

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $hrg = $_POST['hrg'];
  $tgl = $_POST['tgl'];
  $program = $_POST['program'];
  $seat = $_POST['seat'];
  $hotel = $_POST['hotel'];
  $maskapai = $_POST['maskapai'];
  $fasilitas = $_POST['fasilitas'];


  $sqlm = mysqli_query($koneksi, "UPDATE paket set
  nama_paket='$nama', 
  harga='$hrg',
  tgl_pergi = '$tgl',
  lama_program = '$program',
  total_seat = '$seat',
  hotel = '$hotel',
  maskapai = '$maskapai',
  fasilitas = '$fasilitas' WHERE idpaket='$id'");

  header("location:../../datapaket.php");


  if ($sqlm) {
    $_SESSION['pesan'] = 'Data Paket Berhasil Di Edit';
  } else {
    $_SESSION['alert'] = 'Data Paket Gagal Di Edit';
  }
}
