<?php
session_start();
$_SESSION['login'] = false;
unset($_SESSION['user']);
unset($_SESSION['cart']['arrCart']);

header('location:../');
