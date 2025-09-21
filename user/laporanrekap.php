<?php
include '../koneksi.php';

// Tentukan batas data per halaman
$limit = 10;

// Dapatkan nomor halaman saat ini
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

// Hitung offset
$offset = ($page - 1) * $limit;

// Cek apakah ada pencarian
$search = "";
if (isset($_GET['cari'])) {
  $search = $_GET['cari'];
}
$sisapembayaran = 0;
$saldoterakhir = 0;

// Query untuk mengambil data dengan atau tanpa pencarian
if (!empty($search)) {
  // Jika ada pencarian, tambahkan kondisi WHERE
  $sql = "SELECT *, SUM(nominal) as totalnominal FROM pembayaran 
  INNER JOIN booking ON booking.idbooking = pembayaran.kdbooking 
  INNER JOIN jamaah ON jamaah.idjamaah = booking.iduser
  INNER JOIN paket ON paket.idpaket = booking.idpaketumroh
  INNER JOIN perwakilan ON perwakilan.idperwakilan = booking.idnamaperwakilan
  WHERE statusbayar LIKE 'Verifikasi' AND namajamaah LIKE '%$search%' GROUP BY idbooking LIMIT $limit OFFSET $offset ";
} else {
  // Jika tidak ada pencarian, ambil semua data
  $sql = "SELECT *, SUM(nominal) as totalnominal FROM pembayaran 
  INNER JOIN booking ON booking.idbooking = pembayaran.kdbooking 
  INNER JOIN jamaah ON jamaah.idjamaah = booking.iduser
  INNER JOIN paket ON paket.idpaket = booking.idpaketumroh
  INNER JOIN perwakilan ON perwakilan.idperwakilan = booking.idnamaperwakilan
  WHERE statusbayar LIKE 'Verifikasi' GROUP BY idbooking LIMIT $limit OFFSET $offset ";
}

$result = $koneksi->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MAHA TOUR</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/vendors/chartist/chartist.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/vertical-light-layout/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/img/7.png" />
  <script src="../sweetalert/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../sweetalert/dist/sweetalert2.min.css">
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'header.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form method="get" action="">
                    <div class="row d-flex">
                      <h4 class="card-title col-lg-4">Rekapitulasi Cicilan</h4>
                      <div class="col-lg-6">
                        <input class="form-control" placeholder="Masukan Nama Jamaah" type="text" name="cari" value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
                      </div>
                      <div class="col-lg-2">
                        <button class="btn btn-warning" type="submit">Cari</button>
                      </div>
                  </form>
                  <?php $searchTerm = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : ''; ?>
                  <form method="get" action="cetaklaporan.php" target="_blank">
                    <input hidden name="pencarian" value="<?= htmlspecialchars($searchTerm); ?>">
                    <button class="col-lg-2 btn btn-primary" style="text-align: center;" type="submit"><i class="icon-printer"></i></button>
                  </form>
                </div>
                <br>
                <div class="table-responsive">
                  <table class="table table-bordered text-center">
                    <thead class="table-title">
                      <tr>
                        <th>No</th>
                        <th>ID Jamaah</th>
                        <th>Nama Jamaah</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Saldo Terakhir</th>
                        <th>Sisa Pembayaran</th>
                        <th>Perwakilan</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>

                    <?php
                    if ($result->num_rows > 0) {
                      $no = $offset + 1;
                      while ($row = $result->fetch_assoc()) {

                        if ($row['totalnominal'] == $row['harga']) {
                          $sisapembayaran = 0;
                        } else {
                          $sisapembayaran = $row['harga'] - $row['nominal'];
                        }
                    ?>
                        <tbody>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['idjamaah'] ?></td>
                            <td><?= $row['namajamaah'] ?></td>
                            <td><?= $row['nama_paket'] ?></td>
                            <td><?= "Rp " . number_format($row['harga'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($row['totalnominal'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($sisapembayaran, 0, 0, '.'); ?></td>
                            <td><?= $row['nama_wakil'] ?></td>
                            <td><?= $row['statusbooking'] ?></td>
                          </tr>
                        </tbody>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="11">Data Tidak Ditemukan</td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
                <?php
                if (!empty($search)) {
                  $sql_total = "SELECT COUNT(*) AS total,SUM(nominal) as totalnominal FROM pembayaran 
                  INNER JOIN booking ON booking.idbooking = pembayaran.kdbooking 
                  INNER JOIN jamaah ON jamaah.idjamaah = booking.iduser
                  INNER JOIN paket ON paket.idpaket = booking.idpaketumroh
                  INNER JOIN perwakilan ON perwakilan.idperwakilan = booking.idnamaperwakilan
                  WHERE statusbayar LIKE 'Verifikasi' AND namajamaah LIKE '%$search%' GROUP BY idbooking";
                } else {
                  $sql_total = "SELECT COUNT(*) AS total, SUM(nominal) as totalnominal FROM pembayaran 
                  INNER JOIN booking ON booking.idbooking = pembayaran.kdbooking 
                  INNER JOIN jamaah ON jamaah.idjamaah = booking.iduser
                  INNER JOIN paket ON paket.idpaket = booking.idpaketumroh
                  INNER JOIN perwakilan ON perwakilan.idperwakilan = booking.idnamaperwakilan
                  WHERE statusbayar LIKE 'Verifikasi' GROUP BY idbooking";
                }

                $result_total = $koneksi->query($sql_total);
                $row_total = $result_total->fetch_assoc();
                $total_records = $row_total['total'];

                // Hitung total halaman
                $total_pages = ceil($total_records / $limit);

                // Buat link pagination
                for ($i = 1; $i <= $total_pages; $i++) { ?>
                  <div class="mt-2">
                    <a href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <?php include 'footer.php'; ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <?php
  if (isset($_SESSION['pesan'])) { ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: '<?= $_SESSION['pesan'] ?>',
        showConfirmButton: true,
        timer: 3000
      })
    </script>
  <?php
    unset($_SESSION['pesan']);
  }

  if (isset($_SESSION['alert'])) { ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: '<?= $_SESSION['alert'] ?>',
        showConfirmButton: true,
        timer: 3000
      })
    </script>
  <?php
    unset($_SESSION['alert']);
  } ?>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="assets/vendors/moment/moment.min.js"></script>
  <script src="assets/vendors/daterangepicker/daterangepicker.js"></script>
  <script src="assets/vendors/chartist/chartist.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/js/jquery.cookie.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>