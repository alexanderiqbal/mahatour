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

  <!-- partial:partials/_sidebar.html -->
  <!-- partial -->

  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row d-flex">
            <h1 class="card-title col-lg-12 text-center">Laporan Riwayat Pembayaran</h1>
            <p class="col-lg-12 text-center">Tanggal : <?= date('d-M-Y') ?></p>
          </div>
          <div class="">
            <table class=" table-bordered wrap text-center">
              <thead class="table-title">
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Nama Jamaah</th>
                  <th>Tgl</th>
                  <th>Paket</th>
                  <th>Harga</th>
                  <th>Saldo Terakhir</th>
                  <th>Nominal</th>
                  <th>Sisa</th>
                  <th>Bukti</th>
                  <th>Perwakilan</th>
                </tr>
              </thead>
              <?php
              include '../koneksi.php';
              $searchTerm = isset($_GET['pencarian']) ? mysqli_real_escape_string($koneksi, $_GET['pencarian']) : '';

              $no = 1;

              $datapembayaran = mysqli_query($koneksi, "SELECT *,COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS saldo_terakhir,
              p.harga - COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS sisa_pembayaran 
              FROM pembayaran pm LEFT JOIN booking b ON pm.kdbooking = b.idbooking LEFT JOIN paket p ON b.idpaketumroh = p.idpaket LEFT JOIN jamaah j ON b.iduser = j.idjamaah LEFT JOIN perwakilan per ON b.idnamaperwakilan = per.idperwakilan WHERE pm.statusbayar = 'Verifikasi' AND j.namajamaah LIKE '%$searchTerm%' ORDER BY idpembayaran ASC");
              while ($arraypembayaran = mysqli_fetch_array($datapembayaran)) {


              ?>
                <tbody>
                  <tr style="word-break: break-all;">
                    <td><?= $no++; ?></td>
                    <td><?= $arraypembayaran['idpembayaran'] ?></td>
                    <td><?= $arraypembayaran['namajamaah'] ?></td>
                    <td><?= date('d-M-Y', strtotime($arraypembayaran['tglbayar'])) ?></td>
                    <td><?= htmlspecialchars($arraypembayaran['nama_paket'])  ?></td>
                    <td><?= "Rp " . number_format($arraypembayaran['harga'], 0, 0, '.')  ?></td>
                    <td><?= "Rp " . number_format($arraypembayaran['saldo_terakhir'], 0, 0, '.') ?></td>
                    <td><?= "Rp " . number_format($arraypembayaran['nominal'], 0, 0, '.') ?></td>
                    <td><?= "Rp " . number_format($arraypembayaran['sisa_pembayaran'], 0, 0, '.') ?></td>
                    <td><img src="bukti/<?= $arraypembayaran['bukti'] ?>" style="height: 80px; width: 80px;" alt="logo"></td>
                    <td><?= $arraypembayaran['nama_wakil']  ?></td>
                  </tr>
                </tbody>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.print();
  </script>
  <style>
    @media print {
      @page {
        size: A4 landscape;
        margin: 1mm;
      }

      table {
        table-layout: fixed;
        border-collapse: collapse;
        width: 100%;


      }

      th,
      td {
        word-wrap: normal;
        word-break: break-word;
        white-space: initial;
        font-size: 10px;
        text-wrap: wrap;
        padding: 5px;
        overflow-wrap: normal;


      }

      td {
        max-width: 150px;
        word-break: break-all;

      }
    }
  </style>
  <!-- main-panel ends -->

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