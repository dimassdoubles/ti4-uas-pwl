<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Hello World!';
});

Route::get('/image/{image}', function ($image) {
    $image_path = "storage/products/{$image}";
    $file = File::get($image_path);
    $type = File::mimeType($image_path);

    $response = Response::make($file);
    $response->header("Content-Type", $type);
    return $response;
});
