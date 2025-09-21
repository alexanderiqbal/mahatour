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
  $sql = "SELECT *,COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS saldo_terakhir,
  p.harga - COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS sisa_pembayaran 
  FROM pembayaran pm LEFT JOIN booking b ON pm.kdbooking = b.idbooking LEFT JOIN paket p ON b.idpaketumroh = p.idpaket LEFT JOIN jamaah j ON b.iduser = j.idjamaah LEFT JOIN perwakilan per ON b.idnamaperwakilan = per.idperwakilan WHERE pm.statusbayar = 'Verifikasi' AND j.namajamaah LIKE '%$search%' LIMIT $limit OFFSET $offset";
} else {
  // Jika tidak ada pencarian, ambil semua data
  $sql = "SELECT *,COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS saldo_terakhir,
  p.harga - COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS sisa_pembayaran 
  FROM pembayaran pm LEFT JOIN booking b ON pm.kdbooking = b.idbooking LEFT JOIN paket p ON b.idpaketumroh = p.idpaket LEFT JOIN jamaah j ON b.iduser = j.idjamaah LEFT JOIN perwakilan per ON b.idnamaperwakilan = per.idperwakilan WHERE pm.statusbayar = 'Verifikasi' LIMIT $limit OFFSET $offset";
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
                  <form action="" method="get">
                    <div class="row d-flex">
                      <h4 class="card-title col-lg-4">Riwayat Pembayaran</h4>
                      <div class="col-lg-6">
                        <input class="form-control" placeholder="Masukan Nama Jamaah" type="text" name="cari" value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
                      </div>
                      <div class="col-lg-2">
                        <button class="btn btn-warning" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                  <?php $searchTerm = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : ''; ?>
                  <form method="get" action="cetakriwayat.php" target="_blank">
                    <input hidden name="pencarian" value="<?= htmlspecialchars($searchTerm); ?>">
                    <button class="col-lg-2 btn btn-primary" style="text-align: center;" type="submit"><i class="icon-printer"></i></button>
                  </form>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-bordered text-center">
                      <thead class="table-title">
                        <tr>
                          <th>No</th>
                          <th>ID</th>
                          <th>Nama Jamaah</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Paket</th>
                          <th>Harga</th>
                          <th>Saldo Terakhir</th>
                          <th>Nominal Pembayaran</th>
                          <th>Sisa Pembayaran</th>
                          <th>Bukti</th>
                          <th>Perwakilan</th>
                        </tr>
                      </thead>
                      <?php
                      if ($result->num_rows > 0) {
                        $no = $offset + 1;
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <tbody>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $row['idpembayaran'] ?></td>
                              <td><?= $row['namajamaah'] ?></td>
                              <td><?= date('d-M-Y', strtotime($row['tglbayar'])) ?></td>
                              <td><?= $row['nama_paket'] ?></td>
                              <td><?= "Rp " . number_format($row['harga'], 0, 0, '.')  ?></td>
                              <td><?= "Rp " . number_format($row['saldo_terakhir'], 0, 0, '.') ?></td>
                              <td><?= "Rp " . number_format($row['nominal'], 0, 0, '.') ?></td>
                              <td><?= "Rp " . number_format($row['sisa_pembayaran'], 0, 0, '.') ?></td>
                              <td><a data-bs-toggle="modal" data-bs-target="#myModal<?= $row['idpembayaran'] ?>"><img src="bukti/<?= $row['bukti'] ?>" style="height: 80px; width: 100px;" alt="logo"></a></td>
                              <td><?= $row['nama_wakil']  ?></td>
                            </tr>
                          </tbody>
                          <div id="myModal<?= $row['idpembayaran'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-xl modal-dialog-scrollable ">
                              <!-- konten modal-->
                              <div class="modal-content">
                                <!-- heading modal -->
                                <div class="modal-header">
                                  <h4 class="modal-title col-lg-10">Bukti Pembayaran <?= $row['idpembayaran'] ?></h4>
                                  <button type="button" class="col-lg-2 btn btn-warning" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <!-- body modal -->
                                <div class="modal-body  ">
                                  <img src="bukti/<?= $row['bukti'] ?>" style="max-width: 500px; max-height: 500px;" alt="logo">
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php }
                      } else { ?>
                        <tr>
                          <td colspan="10">Data Tidak Ditemukan</td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                  <?php
                  if (!empty($search)) {
                    $sql_total = "SELECT COUNT(*) AS total,COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS saldo_terakhir,
                    p.harga - COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS sisa_pembayaran 
                    FROM pembayaran pm LEFT JOIN booking b ON pm.kdbooking = b.idbooking LEFT JOIN paket p ON b.idpaketumroh = p.idpaket LEFT JOIN jamaah j ON b.iduser = j.idjamaah LEFT JOIN perwakilan per ON b.idnamaperwakilan = per.idperwakilan WHERE pm.statusbayar = 'Verifikasi' AND j.namajamaah LIKE '%$search%'";
                  } else {
                    $sql_total = "SELECT COUNT(*) AS total,COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS saldo_terakhir,
                    p.harga - COALESCE((SELECT SUM(pm2.nominal)FROM pembayaran pm2 WHERE pm2.kdbooking = pm.kdbooking AND pm2.statusbayar = 'Verifikasi' AND pm2.idpembayaran <= pm.idpembayaran), 0) AS sisa_pembayaran 
                    FROM pembayaran pm LEFT JOIN booking b ON pm.kdbooking = b.idbooking LEFT JOIN paket p ON b.idpaketumroh = p.idpaket LEFT JOIN jamaah j ON b.iduser = j.idjamaah LEFT JOIN perwakilan per ON b.idnamaperwakilan = per.idperwakilan WHERE pm.statusbayar = 'Verifikasi'";
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