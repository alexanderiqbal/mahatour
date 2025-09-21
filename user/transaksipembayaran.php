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
          <?php
          include '../koneksi.php';
          $query = mysqli_query($koneksi, "SELECT max(idpembayaran) as kodepembayaran FROM pembayaran");
          $data = mysqli_fetch_array($query);
          $kodeBayar = $data['kodepembayaran'];

          $urutan = (int) substr($kodeBayar, 3, 3);

          $urutan++;

          $huruf = "PMB";
          $kodeBayar = $huruf . sprintf("%03s", $urutan);

          ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row d-flex">
                    <h4 class="card-title col-lg-9">Form Transaksi Pembayaran</h4>
                  </div>
                  <form method="post" action="proses/input/inputpembayaran.php" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">ID Pembayaran</label>
                      <input type="text" class="form-control" readonly name="id" value="<?= $kodeBayar; ?>" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Jamaah</label>
                      <input type="text" class="form-control" disabled name="nama" Required value="<?= $_SESSION['nama'] ?>">
                    </div>
                    <?php
                    $iduser = $_SESSION['id'];
                    $databooking = mysqli_query($koneksi, "SELECT p.nama_paket,b.idbooking,p.harga,j.alamat,j.nomorhp,p.tgl_pergi FROM booking b
                    INNER JOIN jamaah j ON b.iduser = j.idjamaah
                    INNER JOIN paket p ON b.idpaketumroh = p.idpaket
                    INNER JOIN perwakilan pw ON b.idnamaperwakilan = pw.idperwakilan
                    WHERE iduser = '$iduser' AND statusbooking = 'Belum Lunas'");
                    $jumdata = mysqli_num_rows($databooking);
                    if ($jumdata > 0) {
                      $arraydata = mysqli_fetch_array($databooking);
                      $tgl = $arraydata['tgl_pergi'];
                      $tglpergi = date('d-M-Y', strtotime($tgl));
                    ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Paket Umroh</label>
                        <input type="text" disabled class="form-control" value="<?= $arraydata['nama_paket'] ?>">
                        <input type="text" hidden name="idbooking" class="form-control" value="<?= $arraydata['idbooking'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Harga Paket</label>
                        <input type="text" disabled class="form-control" value="<?= "Rp " . number_format($arraydata['harga'], 0, 0, '.')  ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Alamat</label>
                        <textarea class="form-control" disabled name="alamat" id="exampleTextarea1" rows="5"><?= $arraydata['alamat'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Nomor HP</label>
                        <input type="number" disabled class="form-control" value="<?= $arraydata['nomorhp'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Metode Pembayaran</label>
                        <select class="form-select" name="metode" Required id="exampleSelectGender">
                          <option value="">Pilih Jenis Metode</option>
                          <option value="Cash">Cash</option>
                          <option value="Transfer">Transfer</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Nominal Pembayaran</label>
                        <input type="number" class="form-control" name="nominal" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="foto1" required>
                      </div>

                      <button type="submit" name="simpan" class="btn btn-primary me-2">Submit</button>
                    <?php } { ?>
                      <div hidden class="form-group">
                        <label for="exampleSelectGender">Metode Pembayaran</label>
                        <select disabled class="form-select" name="metode" Required id="exampleSelectGender">
                          <option value="">Pilih Jenis Metode</option>
                          <option value="Cash">Cash</option>
                          <option value="Transfer">Transfer</option>
                        </select>
                      </div>
                      <div hidden class="form-group">
                        <label for="exampleInputName1">Nominal Pembayaran</label>
                        <input disabled type="number" class="form-control" name="nominal" required>
                      </div>

                      <div hidden class="form-group">
                        <label for="exampleInputName1">Bukti Pembayaran</label>
                        <input disabled type="file" class="form-control" name="foto1" required>
                      </div>

                      <button hidden type="submit" name="simpan" class="btn btn-primary me-2">Submit</button>
                    <?php  } ?>
                  </form>
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