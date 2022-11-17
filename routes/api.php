<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('products', [ProductController::class, 'all']);
//  membuat APi untuk products dengan class/file yg dinamakan ProductController dan method "all"
Route::get('categories', [ProductCategoryController::class, 'all']);
//  membuat APi untuk categories dengan class/file yg dinamakan ProductCategoryController dan method "all"

Route::post('register', [UserController::class, 'register']);
//  membuat APi untuk register dengan class/file yg dinamakan UserController dan method "register"
Route::post('login', [UserController::class, 'login']);
//  membuat APi untuk login dengan class/file yg dinamakan UserController dan method "login"

Route::middleware('auth:sanctum')->group(function(){
// middleware digunakan untuk mengecek data tersebut digunakan atau tidak
    Route::get('user', [UserController::class, 'fetch']);
    //  membuat APi untuk User dengan class/file yg dinamakan UserController dan method "fetch (mengambil data user)" menggunakan auth sanctum
    Route::post('user', [UserController::class, 'updateProfile']);
    //  membuat APi untuk User dengan class/file yg dinamakan UserController dan method "updateProfile (update data user)" menggunakan auth sanctum
    Route::post('logout', [UserController::class, 'logout']);
    //  membuat APi untuk logout dengan class/file yg dinamakan UserController dan method "logout (keluar)" menggunakan auth sanctum

    Route::get('transactions', [TransactionController::class, 'all']);
    //  membuat APi untuk transactions dengan class/file yg dinamakan UserController dan method "transactions" menggunakan auth sanctum
    Route::post('checkout', [TransactionController::class, 'checkout']);Route::post('checkout', [TransactionController::class, 'checkout']);
    //  membuat APi untuk checkout dengan class/file yg dinamakan UserController dan method "checkout" menggunakan auth sanctum


});




