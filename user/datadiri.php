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
                    <h4 class="card-title col-lg-9">Form Booking Paket Umroh</h4>
                  </div>

                  <form method="post" action="proses/input/inputbooking.php" enctype="multipart/form-data" class="forms-sample">
                    <?php
                    $idjamaah = $_SESSION['id'];
                    $datajamaah = mysqli_query($koneksi, "SELECT * FROM jamaah WHERE idjamaah = '$idjamaah'");
                    while ($queryjamaah = mysqli_fetch_array($datajamaah)) {
                      $tgl = $queryjamaah['tgllahir'];
                      $tglinput = date('d-M-Y', strtotime($tgl));
                    ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Nama Jamaah</label>
                        <input type="text" class="form-control" disabled name="nama" value="<?= $queryjamaah['namajamaah'] ?>">
                        <input type="text" class="form-control" hidden name="idjamaah" value="<?= $_SESSION['id']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">NIK</label>
                        <input type="number" disabled class="form-control" name="nik" value="<?= $queryjamaah['nik'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Tanggal Lahir</label>
                        <input type="text" disabled class="form-control" name="tgl" value="<?= $tglinput;  ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Jenis Kelamin</label>
                        <input type="text" class="form-control" disabled name="jenkel" value="<?= $queryjamaah['kelamin'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Alamat</label>
                        <textarea class="form-control" disabled name="alamat" id="exampleTextarea1" rows="5"><?= $queryjamaah['alamat'] ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">No Hp</label>
                        <input type="number" class="form-control" name="nohp" disabled value="<?= $queryjamaah['nomorhp'] ?>">
                      </div>
                    <?php } ?>
                    <div class="form-group">
                      <label for="exampleSelectGender">Paket Umroh</label>
                      <select class="form-select" name="umroh" Required id="exampleSelectGender" onchange="changeValues(this.value)">
                        <option value="">Pilih Paket Umroh</option>
                        <?php
                        $id = $_SESSION['id'];
                        $querypaket = mysqli_query($koneksi, "SELECT * FROM paket WHERE NOT EXISTS (SELECT * FROM booking WHERE paket.idpaket = booking.idpaketumroh AND iduser = '$id')  ");
                        while ($datapaket = mysqli_fetch_assoc($querypaket)) { ?>
                          <option value="<?= $datapaket['idpaket'] ?>"> <?= $datapaket['nama_paket'] ?></option>";
                        <?php  } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Nama Perwakilan</label>
                      <select class="form-select" name="perwakilan" Required id="exampleSelectGender">
                        <option value="">Pilih Nama Perwakilan</option>
                        <?php
                        $querywakil = mysqli_query($koneksi, "SELECT * FROM perwakilan");
                        while ($datawakil = mysqli_fetch_array($querywakil)) {
                          echo "<option value=$datawakil[idperwakilan]> $datawakil[nama_wakil]</option>";
                        } ?>
                      </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary me-2">Submit</button>
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