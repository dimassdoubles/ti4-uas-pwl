<?php
session_start();
$total = $_GET['total'];

if (!($_SESSION['login'])) {
    header('location:../keranjang');
} else {
    $transaction_id = addTransaction($_SESSION['user']['id'], $total);
    $cart = $_SESSION['cart']['arrCart'];
    $success = true;
    foreach ($cart as $id => $product) {
        $status = addDetailTransaction($transaction_id, $id, $product['jumlah']);
        $success = $success && $status;
        unset($_SESSION['cart']['arrCart'][$id]);
    }

    if ($success) {
        header('location:../keranjang');
    }
}

function addDetailTransaction($transaction_id, $product_id, $quantity)
{
    $url = "http:/uas-pwl.test/api/detail-transaction";
    $parameter = [
        'transaction_id' => $transaction_id,
        'product_id' => $product_id,
        'quantity' => $quantity,
    ];

    $parameter_string = http_build_query($parameter);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    return $response['success'];
}

function addTransaction($user_id, $total)
{
    $url = "http:/uas-pwl.test/api/transaction";
    $parameter = [
        'user_id' => $user_id,
        'total' => $total,
    ];

    $parameter_string = http_build_query($parameter);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $data = $response['data'];
    return $data['id'];
}
