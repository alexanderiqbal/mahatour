<?php
if ($_SESSION['jabatan'] == 'admin') {
?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item navbar-brand-mini-wrapper">
        <a class="nav-link navbar-brand brand-logo-mini" href="index.php"><img src="../assets/img/7.png" alt="logo" /></a>
      </li>
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="text-wrapper">
            <p class="profile-name"><?= $_SESSION['nama'] ?></p>
            <p class="designation"><?= $_SESSION['jabatan'] ?></p>
          </div>

        </a>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Dashboard</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category"><span class="nav-link">Data Master</span></li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Data Master</span>
        </a>
        <div class="collapse" id="icons">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="datajamaah.php">Data Jamaah</a></li>
            <li class="nav-item"> <a class="nav-link" href="jamaahbooking.php">Data Jamaah Booking</a></li>
            <li class="nav-item"> <a class="nav-link" href="dataperwakilan.php">Data Perwakilan</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="datapaket.php" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Paket Umroh</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-title">Data Pembayaran</span>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="validasipembayaran.php">Validasi Pembayaran</a></li>
            <li class="nav-item"> <a class="nav-link" href="riwayatpembayaran.php">Riwayat Pembayaran</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category"><span class="nav-link">Laporan</span></li>
      <li class="nav-item">
        <a class="nav-link" href="laporanrekap.php" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Rekapitulasi Cicilan</span>
        </a>
      </li>
    </ul>
  </nav>
<?php } else if ($_SESSION['jabatan'] == 'jamaah') { ?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item navbar-brand-mini-wrapper">
        <a class="nav-link navbar-brand brand-logo-mini" href="index.php"><img src="../assets/img/7.svg" alt="logo" /></a>
      </li>
      <li class="nav-item nav-profile">
        <a href="index.php" class="nav-link">
          <div class="text-wrapper">
            <p class="profile-name"><?= $_SESSION['nama'] ?></p>
            <p class="designation"><?= $_SESSION['jabatan'] ?></p>
          </div>

        </a>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Dashboard</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category"><span class="nav-link">Data Master</span></li>
      <?php
      $id = $_SESSION['id'];
      $status = mysqli_query($koneksi, "SELECT * FROM booking 
      WHERE iduser = '$id' AND statusbooking ='Belum Lunas' ORDER BY idbooking DESC LIMIT 1 ");
      $numrows = mysqli_num_rows($status);
      if ($numrows > 0) { ?>
        <li class="nav-item">
          <a class="nav-link" href="databooking.php">
            <span class="menu-title">Data Booking</span>
          </a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="datadiri.php">
            <span class="menu-title">Booking Paket Umroh</span>
          </a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="paketumroh.php" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Paket Umroh</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-title">Data Pembayaran</span>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="transaksipembayaran.php">Transaksi Pembayaran</a></li>
            <li class="nav-item"> <a class="nav-link" href="history.php">Riwayat Pembayaran</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category"><span class="nav-link">Laporan</span></li>
      <li class="nav-item">
        <a class="nav-link" href="rekapcicilan.php" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Rekapitulasi Cicilan</span>
        </a>
      </li>
    </ul>
  </nav>
<?php
} else if ($_SESSION['jabatan'] == 'perwakilan') { ?>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item navbar-brand-mini-wrapper">
        <a class="nav-link navbar-brand brand-logo-mini" href="index.php"><img src="../assets/img/7.svg" alt="logo" /></a>
      </li>
      <li class="nav-item nav-profile">
        <a href="index.php" class="nav-link">
          <div class="text-wrapper">
            <p class="profile-name"><?= $_SESSION['nama'] ?></p>
            <p class="designation"><?= $_SESSION['jabatan'] ?></p>
          </div>

        </a>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Dashboard</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category"><span class="nav-link">Data Master</span></li>
      <li class="nav-item">
        <a class="nav-link" href="listjamaah.php">
          <span class="menu-title">Data Jama'ah</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="paketumroh.php">
          <span class="menu-title">Data Paket</span>
        </a>
      </li>
      <li class="nav-item nav-category"><span class="nav-link">Laporan</span></li>
      <li class="nav-item">
        <a class="nav-link" href="rekapcicilanwakil.php" aria-expanded="false" aria-controls="icons">
          <span class="menu-title">Laporan Rekapitulasi Cicilan</span>
        </a>
      </li>
    </ul>
  </nav>
<?php
}
?>