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
                    <h4 class="card-title col-lg-9">Data Booking Paket Umroh</h4>
                  </div>
                  <form class="forms-sample">
                    <?php
                    $iduser = $_SESSION['id'];
                    $databooking = mysqli_query($koneksi, "SELECT * FROM booking 
                    INNER JOIN jamaah ON booking.iduser = jamaah.idjamaah
                    INNER JOIN paket ON booking.idpaketumroh = paket.idpaket
                    INNER JOIN perwakilan ON booking.idnamaperwakilan = perwakilan.idperwakilan
                    WHERE iduser = '$iduser' AND statusbooking = 'Belum Lunas'");
                    $jumdata = mysqli_num_rows($databooking);
                    if ($jumdata > 0) {
                      $arraydata = mysqli_fetch_array($databooking);
                      $tgl = $arraydata['tgl_pergi'];
                      $tglpergi = date('d-M-Y', strtotime($tgl));
                    ?>
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3">Kode Booking</label>
                        <div class="col-sm-9">
                          <label class="text-bold"><?= $arraydata['idbooking'] ?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3">Paket Umroh</label>
                        <div class="col-sm-9">
                          <label><?= $arraydata['nama_paket']  ?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3">Tanggal Keberangkatan</label>
                        <div class="col-sm-9">

                          <label><?= $tglpergi; ?></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3">Harga Paket</label>
                        <div class="col-sm-9">
                          <label><?= "Rp " . number_format($arraydata['harga'], 0, 0, '.')  ?></label>
                        </div>
                      </div>
                      <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal<?= $arraydata['idbooking'] ?>">Edit</a>

                      <div id="myModal<?= $arraydata['idbooking'] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-dialog-scrollable">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <h4 class="modal-title col-lg-10">Edit Data Booking <?= $arraydata['idbooking'] ?></h4>
                              <button type="button" class="col-lg-2 btn btn-warning" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body  ">
                              <form method="POST" action="proses/edit/editdatabooking.php" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label>Paket Umroh</label>
                                  <input name="idpaket" hidden value="<?= $arraydata['idbooking'] ?>">
                                  <select class="form-select" name="umroh" Required id="exampleSelectGender" onchange="changeValues(this.value)">
                                    <option value="">Pilih Paket Umroh</option>
                                    <?php
                                    $querypaket = mysqli_query($koneksi, "SELECT * FROM paket");
                                    while ($datapaket = mysqli_fetch_array($querypaket)) {
                                      echo "<option value=$datapaket[idpaket]> $datapaket[nama_paket]</option>";
                                    } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Nama Perwakilan</label>
                                  <select class="form-select" name="perwakilan" Required id="exampleSelectGender">
                                    <option value="">Pilih Nama Perwakilan</option>
                                    <?php
                                    $querywakil = mysqli_query($koneksi, "SELECT * FROM perwakilan");
                                    while ($datawakil = mysqli_fetch_array($querywakil)) {
                                      echo "<option value=$datawakil[idperwakilan]> $datawakil[nama_wakil]</option>";
                                    } ?>
                                  </select>
                                </div>

                                <center> <button type="submit" name="simpan" class="btn btn-warning btn-fw">Simpan</button></center>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php } ?>
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