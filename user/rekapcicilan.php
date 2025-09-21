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
                    <h4 class="card-title col-lg-9">Rekapitulasi Cicilan Umroh Saya</h4>
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
                      <tbody>
                        <?php
                        $no = 1;

                        $iduser = $_SESSION['id'];
                        $sisapembayaran = 0;
                        $saldoterakhir = 0;
                        $sql = mysqli_query($koneksi, "SELECT 
                      *,
                      COALESCE((
                          SELECT SUM(pm2.nominal)
                          FROM pembayaran pm2
                          WHERE pm2.kdbooking = pm.kdbooking
                          AND pm2.statusbayar = 'Verifikasi'
                            -- Menambah nominal untuk pembayaran verifikasi hingga baris saat ini
                      ), 0) AS saldo_terakhir,
                      p.harga - COALESCE((
                          SELECT SUM(pm2.nominal)
                          FROM pembayaran pm2
                          WHERE pm2.kdbooking = pm.kdbooking
                          AND pm2.statusbayar = 'Verifikasi'
                          
                      ), 0) AS sisa_pembayaran
                  FROM 
                      pembayaran pm
                  LEFT JOIN 
                      booking b ON pm.kdbooking = b.idbooking
                  LEFT JOIN 
                      paket p ON b.idpaketumroh = p.idpaket
                  LEFT JOIN 
                      jamaah j ON b.iduser = j.idjamaah  -- Menghubungkan tabel booking dengan jamaah berdasarkan iduser
                      LEFT JOIN
                       perwakilan per ON b.idnamaperwakilan = per.idperwakilan
                  WHERE 
                      b.iduser = '$iduser'  -- Ganti dengan iduser yang sesuai
                  GROUP BY 
b.idbooking
                  
                  ");

                        while ($row = mysqli_fetch_assoc($sql)) { ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['idjamaah'] ?></td>
                            <td><?= $row['namajamaah'] ?></td>
                            <td><?= $row['nama_paket'] ?></td>
                            <td><?= "Rp " . number_format($row['harga'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($row['saldo_terakhir'], 0, 0, '.'); ?></td>
                            <td><?= "Rp " . number_format($row['sisa_pembayaran'], 0, 0, '.'); ?></td>
                            <td><?= $row['nama_wakil'] ?></td>
                            <td><?= $row['statusbooking'] ?></td>
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
  ?>
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