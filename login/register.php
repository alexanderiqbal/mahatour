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

</head>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ">

          <div>
            <div class="row">
              <h3 class="col-lg-9">Registrasi</h3>
              <a href="logincustomer.php" type="button" class="col-lg-3 btn btn-primary">Kembali</a>
            </div>
            <form action="prosesregistrasi.php" method="post" class="signin-form">
              <div class="row">
                <div class="col-lg-6">
                  <?php
                  include '../koneksi.php';
                  $query = "SELECT MAX(idjamaah) AS max_id FROM jamaah";
                  $result = mysqli_query($koneksi, $query);
                  $row = mysqli_fetch_assoc($result);
                  $max_id = $row['max_id'];

                  // Jika tidak ada data, mulai dari "J001"
                  if ($max_id == null) {
                    $new_id = "J001";
                  } else {
                    // Ambil angka dari format "J000" (substr untuk ambil angka)
                    $numeric_part = intval(substr($max_id, 1)); // Mengambil angka setelah "J"

                    // Tambahkan 1 ke angka tersebut
                    $new_numeric_part = $numeric_part + 1;

                    // Format ulang menjadi "J000"
                    $new_id = "J" . str_pad($new_numeric_part, 3, "0", STR_PAD_LEFT);
                  }
                  ?>


                  <input type="text" class="form-control" hidden name="id" value="<?= $new_id ?>" required>
                  <div class="form-group mb-3">
                    <label class="label" for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Anda" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">NIK</label>
                    <input type="number" class="form-control" name="nik" Required placeholder="Harga Paket Umroh">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleSelectGender">Jenis Kelamin</label>
                    <select class="form-control" name="kelamin" Required id="exampleSelectGender">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Pria">Pria</option>
                      <option value="Wanita">Wanita</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">

                  <div class="form-group">
                    <label for="exampleInputName1">No Hp</label>
                    <input type="number" class="form-control" name="nohp" Required placeholder="Masukan No Hp">
                  </div>

                  <div class="form-group mb-3">
                    <label class="label" for="name">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>

                  <div class="form-group mb-3">
                    <label class="label" for="password">Password</label>
                    <input type="password" class="form-control" name="pasw" placeholder="Password" required>
                  </div>
                  <div class="form-group ">
                    <label for="exampleTextarea1">Alamat</label>
                    <textarea class="form-control" required name="alamat" id="exampleTextarea1" rows="5"></textarea>
                  </div>
                </div>

                <div class="form-group text-center">
                  <button type="submit" name="simpan" class="form-control btn btn-primary rounded submit px-3">Daftar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>