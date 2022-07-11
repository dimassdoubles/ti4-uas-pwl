<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET['id'];
  $jumlah = $_GET['jumlah'];
}

$products = $_SESSION["products"];

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

</head>

<body>
  <!-- navigation bar -->
  <nav class="navbar navbar-expand-lg bg-light ps-4 pe-4">
    <div class="container-fluid">
      <a class="navbar-brand montext fw700 fs36" href="../">Home Decor</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link robotext fw400 fs24" aria-current="page" href="../">Home</a>
            <a class="nav-link robotext fw400 fs24 active" href="../shop/">Shop</a>
            <a class="nav-link robotext fw400 fs24" href="../keranjang">Keranjang</a>
            <?php
            if (($_SESSION['login'])) {
              echo '<a class="nav-link robotext fw400 fs24" href="../login/logout.php">Logout</a>';
            } else {
              echo '<a class="nav-link robotext fw400 fs24" href="../login">Login</a>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <!-- produk info -->
  <div class="container-fluid ps-4 pe-4 mt-5 mb-5">
    <div class="row">
      <div class="col-lg-4">
        <img class="img-fluid" src="http://uas-pwl.test/image/<?= $products[$id]['image'] ?>" alt="">
      </div>

      <div class="col-lg-8 align-self-center">
        <p class="montext fs32 fw700"><?= $products[$id]['name'] ?></p>
        <p class="robotext fs24 fw500 fcdarkgrey pb-5">Rp <?= number_format($products[$id]['price']) ?></p>
        <!-- <p>Tombol Jumlah</p> -->
        <div class="d-block">
          <a href="substract-jumlah.php?id=<?= $id ?>&jumlah=<?= $jumlah ?>">
            <button class="sizebtnjumlah margin0">-</button>
          </a>
          <button class="sizebtnjumlah margin0 noverticalborder"><?= $jumlah ?></button>
          <a href="add-jumlah.php?id=<?= $id ?>&jumlah=<?= $jumlah ?>">
            <button class="sizebtnjumlah margin0">+</button>
          </a>

        </div>
        <br style="clear:both">
        <div class="d-block pt-3">
          <a class="btn btn-dark rounded-0 btndarkgrey p-3 robotext fs24 fw300" href="../keranjang/add-cart.php?id=<?= $id ?>&jumlah=<?= $jumlah ?>">Tambah Ke Keranjang</a>
        </div>


      </div>
    </div>

  </div>

  <!-- produk description -->
  <div class="container-fluid ps-4 pe-4 mb-5">
    <p class="montext fs32 fw700">Deskripsi</p>
    <p class="robotext fs24 fw300 fcdarkgrey">Aenean lacus orci, molestie vel elit sit amet, placerat dictum nunc. Integer a lorem in magna ornare elementum sed sit amet leo. Nullam et magna a turpis tempus egestas. Quisque viverra et dolor id accumsan. Quisque vel sagittis neque. Suspendisse porttitor volutpat ex vitae placerat. Mauris posuere tellus et ante tincidunt dictum. Vestibulum at dapibus nibh. Vivamus rutrum finibus risus vitae tempor. Nam scelerisque est diam, sit amet pharetra odio posuere vitae. Proin volutpat cursus venenatis. Vestibulum justo est, faucibus et tincidunt et, posuere sed urna.</p>


  </div>

  <!-- footer -->
  <div class="container-fluid bglightgrey pt-5 pb-5 d-none d-sm-block">
    <div class="row ps-4 pe-4">
      <div class="col-sm-4">
        <p class="montext fs36 fw700">Home Decor</p>
        <p class="robotext fs24 fw300 fcgrey">Jalan Pagansaan Timur No. 54, kota Semarang, Jawa Tengah.</p>
        <p class="robotext fs24 fw300 fcgrey">58152</p>
      </div>

      <div class="col-sm-4">
        <p class="montext fs36 fw700">Contact Us</p>
        <p class="robotext fs24 fw300 fcgrey">+62-871-234-568</p>
        <p class="robotext fs24 fw300 fcgrey">lorem@ipsum.com</p>
      </div>

      <div class="col-sm-4">
        <p class="montext fs36 fw700">Follow Us</p>
      </div>

    </div>

  </div>
</body>

</html>