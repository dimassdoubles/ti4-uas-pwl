<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;800&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
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
                        <a class="nav-link robotext fw400 fs24" href="../shop">Shop</a>
                        <a class="nav-link robotext fw400 fs24 active" href="./">Keranjang</a>
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

    <div class="container-fluid mt-5">
        <p class="d-lg-none d-block ps-4 pe-4 montext fs24 fw500">Pesanan Anda</p>
        <div class="d-none d-lg-block">
            <div class="row ps-4 pe-4">
                <div class="col-lg-6 montext fs24 fw500">
                    Produk
                </div>
                <div class="col-lg-2 montext fs24 fw500">
                    Jumlah
                </div>
                <div class="col-lg-2 montext fs24 fw500">
                    Hapus
                </div>
                <div class="col-lg-2 montext fs24 fw500">
                    Total
                </div>
            </div>
        </div>


        <div class="row ps-4 pe-4">
            <hr class="mt-3 mb-3 linestyle">
        </div>

        <?php
        if (isset($_SESSION['cart']['arrCart'])) {

            $keranjang = $_SESSION['cart']['arrCart'];
            $total = 0;

            foreach ($keranjang as $key => $value) {
                $total += $value['harga'] * $value['jumlah'];
                echo '
                        <div class="row ps-4 pe-4">
                        <div class="col-lg-2">
                            <img class="img-fluid" src="http://uas-pwl.test/image/' . $_SESSION["products"][$key]['image'] . '" alt="">
                        </div>
                        <div class="col-lg-8 align-self-center">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a class="nodecor fcdarkgrey" href="../detail_produk/index.php?id=' . $key . '&jumlah=' . $value['jumlah'] . '">
                                        <p class="montext fs24 fw500">' . $value["nama"] . '</p>
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-6 align-self-center">
                                            <div class="d-block">
                                                
                                                <a href="update-cart.php?id=' . $key . '&transaction=-1">
                                                    <button class="sizebtnjumlah margin0">-</button>
                                                </a>

                                                <button class="sizebtnjumlah margin0 noverticalborder">' . $value['jumlah'] . '</button>


                                                <a href="update-cart.php?id=' . $key . '&transaction=1">
                                                    <button class="sizebtnjumlah margin0">+</button>
                                                </a>
                                            </div>
                                            <br style="clear:both">
                                        </div>
            
                                        <div class="col-6 align-self-center text-lg-start text-end">
                                            <a class="nodecor montext fs38 fw300 fcdarkgrey" href="update-cart.php?id=' . $key . '&transaction=0">X</a>
                                        </div>
                                    </div>
                                </div>
            
                            </div>
                        </div>
            
            
                        <div class="col-lg-2 align-self-center">
                            <p class="robotext fs24 fw500 fcdarkgrey">Rp ' . number_format($value['harga'] * $value['jumlah']) . '</p>
                        </div>
                    </div>
            
                    <div class="row ps-4 pe-4">
                        <hr class="mt-3 mb-3 linestyle">
                    </div>
                    ';
            }
        }
        ?>

        <?php
        if ($total > 0) {
            // total harga
            echo '
                <div class="row ps-4 pe-4 mt-5 mb-5">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2 robotext fs32 fw500">' . number_format($total) . '</div>
                </div>

            ';

            // tombol checkout
            echo '
                    <!-- tombol checkout -->
                    <div class="row ps-4 pe-4 mb-5">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                            <a class="d-block btn btn-dark rounded-0 btndarkgrey robotext fs24 fw300 " href="../checkout/index.php?total=' . $total . '">Checkout</a>
                        </div>
                    </div>
                    
                ';
        } else {
            echo '
                <div class="container-fluid">
                    <div class="col-lg-6 montext fs24 fw500 ms-3">
                        Keranjang Kosong.
                    </div>
                </div>
            ';
        }
        ?>

    </div>

</body>

</html>