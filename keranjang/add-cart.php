<?php
session_start();

$products = $_SESSION["products"];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$id = $_GET['id'];
	$jumlah = $_GET['jumlah'];
	// $nama = $_GET['nama'];
	// $harga = $_GET['harga'];

	$all_setted = isset($id) && isset($jumlah);

	if ($all_setted) {
		$_SESSION['cart']['arrCart'][$id]['harga'] = $products[$id]['price'];
		$_SESSION['cart']['arrCart'][$id]['nama'] = $products[$id]['name'];
		$_SESSION['cart']['arrCart'][$id]['jumlah'] = $jumlah;
	}
}
header('location:..\detail_produk\index.php?id=' . $id . '&jumlah=' . $jumlah);
