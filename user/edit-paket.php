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
          $no = 1;
          $id = $_GET['id'];
          $query = mysqli_query($koneksi, "SELECT * FROM paket WHERE idpaket = '$id'");
          $data = mysqli_fetch_array($query);
          ?>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row d-flex">
                    <h4 class="card-title col-lg-9">Edit Data Paket Umroh</h4>
                    <a type="button" class="col-lg-3 mb-2 btn btn-primary" href="datapaket.php" style="float: right;">Kembali</a>
                  </div>
                  <form method="post" action="proses/edit/editpaket.php" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">ID Paket</label>
                      <input type="text" class="form-control" disabled value="<?= $data['idpaket'] ?>">
                      <input type="text" class="form-control" hidden name="id" value="<?= $data['idpaket'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Paket</label>
                      <input type="text" class="form-control" name="nama" Required value="<?= $data['nama_paket'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Harga Paket</label>
                      <input type="number" class="form-control" name="hrg" Required value="<?= $data['harga'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Tanggal Keberangkatan</label>
                      <input type="date" class="form-control" name="tgl" Required value="<?= $data['tgl_pergi'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Lama Program</label>
                      <input type="number" class="form-control" name="program" Required value="<?= $data['lama_program'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Total Seat</label>
                      <input type="number" class="form-control" name="seat" Required value="<?= $data['total_seat'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Hotel Bintang</label>
                      <select class="form-select" name="hotel" Required id="exampleSelectGender">
                        <option value="">Masukan Tipe Hotel</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Nama Maskapai</label>
                      <input type="text" Required class="form-control" name="maskapai" value="<?= $data['maskapai'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Fasilitas</label>
                      <textarea class="form-control" required name="fasilitas" id="exampleTextarea1" rows="5"><?= $data['fasilitas'] ?></textarea>
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