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
                  <div class="row d-flex">
                    <h4 class="card-title col-lg-9">Rekapitulasi Cicilan Umroh Jamaah Saya</h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered text-center">
                      <thead class="table-title">
                        <tr>
                          <th>No</th>
                          <th>ID Jamaah</th>
                          <th>Nama</th>
                          <th>Pkt Umroh</th>
                          <th>Harga</th>
                          <th>Saldo Terakhir</th>
                          <th>Sisa Pembayaran</th>
                          <th>Perwakilan</th>
                          <th>Keterangan</th>
                        </tr>
                      </thead>
                      <?php
                      $no = 1;
                      $saldoterakhir = 0;
                      $sisapembayaran = 0;
                      $datapembayaran = mysqli_query($koneksi, "SELECT *, SUM(nominal) as totalnominal FROM pembayaran 
                      INNER JOIN booking ON booking.idbooking = pembayaran.kdbooking 
                      INNER JOIN jamaah ON jamaah.idjamaah = booking.iduser
                      INNER JOIN paket ON paket.idpaket = booking.idpaketumroh
                      INNER JOIN perwakilan ON perwakilan.idperwakilan = booking.idnamaperwakilan
                      WHERE booking.idnamaperwakilan = '$_SESSION[id]' AND statusbayar = 'Verifikasi' GROUP BY idbooking ORDER BY idpembayaran ASC");
                      while ($arraypembayaran = mysqli_fetch_array($datapembayaran)) {

                        if ($arraypembayaran['totalnominal'] == $arraypembayaran['harga']) {
                          $sisapembayaran = 0;
                        } else {
                          $sisapembayaran = $arraypembayaran['harga'] - $arraypembayaran['nominal'];
                        }
                        $keterangan = $sisapembayaran > 0 ? "Belum Lunas" : "Lunas";
                      ?>
                        <tbody>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $arraypembayaran['idjamaah'] ?></td>
                            <td><?= $arraypembayaran['namajamaah'] ?></td>
                            <td><?= $arraypembayaran['nama_paket'] ?></td>
                            <td><?= "Rp " . number_format($arraypembayaran['harga'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($arraypembayaran['totalnominal'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($sisapembayaran, 0, 0, '.'); ?></td>
                            <td><?= $arraypembayaran['nama_wakil'] ?></td>
                            <td><?= $arraypembayaran['statusbooking'] ?></td>
                          </tr>
                        </tbody>
                      <?php } ?>
                    </table>
                  </div>
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