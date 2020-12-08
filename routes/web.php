<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Auth::routes();

require_once dirname(__DIR__)."/routes/Admin/admin.php";
require_once dirname(__DIR__)."/routes/Courier/courier.php";
require_once dirname(__DIR__)."/routes/Employee/employee.php";
require_once dirname(__DIR__)."/routes/Importer/importer.php";
require_once dirname(__DIR__)."/routes/Merchant/merchant.php";

