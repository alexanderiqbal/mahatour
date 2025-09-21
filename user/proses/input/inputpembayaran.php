<?php
include("../../../koneksi.php");
session_start();
if (isset($_POST['simpan'])) {

  $ekstensi_diperbolehkan    = array('png', 'jpg', 'JPEG');
  $nmfoto1 = $_FILES["foto1"]["name"];
  $x = explode('.', $nmfoto1);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['foto1']['size'];
  $lokfoto1 = $_FILES["foto1"]["tmp_name"];

  $idpembayaran = $_POST['id'];
  $idbooking = $_POST['idbooking'];
  $tgl = date('Y-m-d');
  $metode = $_POST['metode'];
  $nominal = $_POST['nominal'];
  $statusbayar = 'Unverified';

  move_uploaded_file($lokfoto1, "../../bukti/$nmfoto1");
  $sqlm = mysqli_query($koneksi, "INSERT INTO pembayaran values ('$idpembayaran','$idbooking','$tgl','$metode','$nominal','$nmfoto1','$statusbayar')");
  header("location:../../transaksipembayaran.php");
  if ($sqlm) { //jika simpan berhasil
    $_SESSION['pesan'] = 'Data Pembayaran Sukses dilakukan';
  } else { //jika gagal simpan 
    $_SESSION['alert'] = 'Data Pembayaran Gagal Di Input';
  }
}
