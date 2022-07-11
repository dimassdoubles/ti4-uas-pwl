<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $jumlah = $_GET['jumlah'];

    if ($jumlah > 1) {
        $jumlah -= 1;
    }
}

header('location:index.php?id=' . $id . '&jumlah=' . $jumlah);
