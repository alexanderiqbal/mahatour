<?php

include("../../../koneksi.php");
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

  $sqlm = mysqli_query($koneksi, "INSERT INTO paket values ('$id','$nama','$hrg','$tgl','$program','$seat','$hotel','$maskapai','$fasilitas')");
  header("location:../../datapaket.php");
  if ($sqlm) {
    $_SESSION['pesan'] = 'Data Paket Berhasil Di Input';
  } else {
    $_SESSION['alert'] = 'Data Paket Gagal Di Input';
  }
}
