<!doctype html>
<html lang="en">

<head>
  <title>MAHA TOUR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../assets/img/7.png" rel="icon">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/style.css">
  <script src="../sweetalert/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../sweetalert/dist/sweetalert2.min.css">

</head>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url(../assets/img/logomahatour.jpg);">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <div class="row">
                <h3 class="col-lg-9">Login Admin</h3>
                <a href="../index.php" type="button" class="col-lg-3 btn btn-primary">Kembali</a>
              </div>
              <form action="cekloginadmin.php" method="post" class="signin-form">
                <div class="form-group mb-3">
                  <label class="label" for="name">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <?php
  session_start();
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

</body>

</html>