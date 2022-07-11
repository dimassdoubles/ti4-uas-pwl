<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $jumlah = $_GET['jumlah'];
    if ($jumlah < $_SESSION["products"][$id]["stock"]) {
        $jumlah += 1;
    }
}

header('location:index.php?id=' . $id . '&jumlah=' . $jumlah);
