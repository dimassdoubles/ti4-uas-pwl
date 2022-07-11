<?php
session_start();
$products = $_SESSION["products"];

if (!(array_key_exists('login', $_SESSION))) {
  $_SESSION['login'] = false;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
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
            <a class="nav-link robotext fw400 fs24 active" href="./">Shop</a>
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

  <!-- product card -->
  <div class="row ps-4 pe-4 pb-5">

    <?php
    foreach ($products as $key => $value) {

      echo '
          <div class="col-sm-4 p-2 mb-5 mt-5">
            <a class="nodecor bg-red block" href="../detail_produk?id=' . $key . '&jumlah=1">
              <div>
                <img class="imgwidth" src="http://uas-pwl.test/image/' . $_SESSION["products"][$key]['image'] . '" alt="">
                <div class="robotext fs24 fcdarkgrey mt-5">' . $value['name'] . '</div>
                <div class="robotext fs24 fcgrey">Rp ' . number_format($value['price']) . '</div>
              </div>
            </a>
          </div>
        ';
    }
    ?>

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