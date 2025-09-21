<?php
session_start();
require_once('../koneksi.php');
if (!isset($_SESSION['username'])) {
  header("location:../login/loginadmin.php");
  $_SESSION['pesan'] = 'Anda Telah Logout,Silahkan Login Kembali';
}
?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.php">
      <img src="../assets/img/logo.png" alt="logo" class="logo-dark" />
      <img src="assets/images/logo-light.svg" alt="logo-light" class="logo-light">
    </a>
    <a class="navbar-brand brand-logo-mini" href="../index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <h5 class="mb-0 font-weight-medium text-center d-none d-lg-flex">Aplikasi Tabungan Umroh Jama'ah Mahatour & Travel</h5>
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="font-weight-normal"> <?= $_SESSION['nama'] ?> </span></a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header">
            <p class="mb-1 mt-3"><?= $_SESSION['nama'] ?></p>
            <p class="font-weight-light text-muted mb-0"><?= $_SESSION['jabatan'] ?></p>
          </div>
          <?php
          $leveljabatan = $_SESSION['jabatan'];
          if ($leveljabatan == 'admin') { ?>
            <a class="dropdown-item" href="editprofil-admin.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile </a>
          <?php } else if ($leveljabatan == 'customer') { ?>
            <a class="dropdown-item" href="editprofil-jamaah.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile </a>
          <?php } else if ($leveljabatan == 'perwakilan') { ?>
            <a class="dropdown-item" href="editprofil-perwakilan.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile </a>
          <?php }
          ?>
          <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>