<?php

session_start();
$products = $_SESSION["products"];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $transaction = $_GET["transaction"];
    $id = $_GET["id"];

    if ($transaction == 1) {
        if ($products[$id]["stock"] > $_SESSION["cart"]["arrCart"][$id]["jumlah"]) {
            $_SESSION["cart"]["arrCart"][$id]["jumlah"] += 1;
        }
    } else if ($transaction == -1) {
        $_SESSION["cart"]["arrCart"][$id]["jumlah"] -= 1;
        if ($_SESSION["cart"]["arrCart"][$id]["jumlah"] < 1) {
            unset($_SESSION["cart"]["arrCart"][$id]);
        }
    } else if ($transaction == 0) {
        unset($_SESSION["cart"]["arrCart"][$id]);
    }
}

header("location: index.php");
