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
  if ($sqlm) { //jika simpan berhasil
    $query_booking = "SELECT * FROM booking INNER JOIN paket ON booking.idpaketumroh = paket.idpaket WHERE idbooking ='$idbooking'";
    $result_booking = mysqli_query($koneksi, $query_booking);


    // Loop melalui setiap kode booking
    while ($row_booking = mysqli_fetch_assoc($result_booking)) {
      $kode_booking = $row_booking['idbooking'];
      $harga_paket = $row_booking['harga'];

      // Hitung total cicilan untuk kode booking ini
      $query_cicilan = "SELECT SUM(nominal) as total_cicilan FROM pembayaran WHERE kdbooking = '$kode_booking'";
      $result_cicilan = mysqli_query($koneksi, $query_cicilan);

      $row_cicilan = mysqli_fetch_assoc($result_cicilan);
      $total_cicilan = $row_cicilan['total_cicilan'] ? $row_cicilan['total_cicilan'] : 0;

      // Cek apakah total cicilan sudah sama dengan harga paket
      if ($total_cicilan >= $harga_paket) {
        // Update status menjadi 'lunas' jika sudah lunas
        $update_query = "UPDATE booking SET statusbooking = 'Lunas' WHERE idbooking = '$kode_booking'";
        if (mysqli_query($koneksi, $update_query)) {
          header("location:../../rekapcicilan.php");
          $_SESSION['pesan'] = 'Status booking untuk kode booking ' . $kode_booking . ' sudah Lunas';
        } else {
          header("location:../../rekapcicilan.php");
          $_SESSION['alert'] = 'Data Pembayaran Gagal Di Input';
        }
      } else {
        header('location:../../history.php');
        $_SESSION['pesan'] = 'Pembayaran Berhasil';
      }
    }
  } else { //jika gagal simpan 
    header("location:../../transaksipembayaran.php");
    $_SESSION['alert'] = 'Data Pembayaran Gagal Di Input';
  }
}
