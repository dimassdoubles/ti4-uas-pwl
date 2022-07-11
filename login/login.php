<?php
session_start();

$_SESSION['login'] = false;

$username = $_POST['username'];
$password = $_POST['password'];

$url = "http:/uas-pwl.test/api/user/login";
$parameter = [
    'username' => $username,
    'password' => $password,
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
if ($response['success']) {
    $_SESSION['login'] = true;
    $_SESSION['user']['id'] = $data['id'];
    $_SESSION['user']['name'] = $data['name'];
    $_SESSION['user']['username'] = $data['username'];
    header('location:../');
} else {
    header('location:./');
}
