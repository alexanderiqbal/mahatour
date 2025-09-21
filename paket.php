<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MAHA TOUR</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/7.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <script src="sweetalert/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert/dist/sweetalert2.min.css">


</head>

<body class="portfolio-details-page">

  <?php include 'header.php'; ?>

  <main class="main">
    <style>
      .star {
        font-size: 20px;
        color: gold;
        /* Warna bintang */
      }

      .star-empty {
        color: lightgray;
        /* Warna bintang kosong */
      }
    </style>

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>List Paket Umroh</h1>
              <p class="mb-0">Berikut Daftar Paket Umroh yang tersedia di MAHA TOUR.</p>
            </div>
          </div>
        </div>
      </div>

    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <?php
          include 'koneksi.php';
          $sisaseat = 0;
          $datakat = mysqli_query($koneksi, "SELECT *, COUNT(booking.idpaketumroh) AS totalbooking from paket LEFT JOIN booking ON paket.idpaket = booking.idpaketumroh GROUP BY idpaket ORDER BY tgl_pergi ASC");

          while ($data = mysqli_fetch_array($datakat)) {
            $sisaseat = (int)$data['total_seat'] - (int)$data['totalbooking'];
            $hotels[] = $data;

            foreach ($hotels as $hotel) {
              $rating = $hotel['hotel'];
              $stars = '';
              for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                  $stars .= '<span class="star">&#9733;</span>'; // Bintang terisi
                } else {
                  $stars .= '<span class="star star-empty">&#9734;</span>'; // Bintang kosong
                }
              }
            }


          ?>
            <div class="col-lg-4 bordered">
              <div class="portfolio-info" style="background-color: goldenrod;" data-aos="fade-up" data-aos-delay="200">

                <div class="form-group bordered">
                  <center>
                    <h4 style="border-bottom: 2;"><?= $data['nama_paket']; ?></h4>
                    <ul>
                      <li><strong><?= "Tanggal pergi : <br> " . date('d M Y', strtotime($data['tgl_pergi']))  ?></strong></li>
                      <li><strong><?= "Lama Program : " .  $data['lama_program'] . " Hari" ?></strong></li>
                      <li><strong><?= "Total Pax : " .  $data['total_seat'] . " Pax" ?></strong></li>
                      <li><strong><?= "Available Pax : " .  $sisaseat . " Pax" ?></strong></li>
                      <li><strong><?= "Hotel : " .  $stars ?></strong></li>
                      <li><strong><?= "Maskapai : " .  $data['maskapai'] ?></strong></li>
                      <li><strong>Harga Paket : <br>Rp <?= number_format($data['harga'], 0, ',', '.');  ?></strong></li>

                      <li><strong></strong></li>

                    </ul>
                    <p class="form-label"></p>
                    <p class="form-label"></p>

                  </center>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>

      </div>

    </section><!-- /Portfolio Details Section -->

  </main>

  <?php include 'footer.php'; ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>