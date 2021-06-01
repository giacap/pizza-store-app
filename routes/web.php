<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;



use Illuminate\Http\Request;
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

//welcome page
Route::get('/', function () {
    return view('welcome');
});



Route::post('/logout', [LogoutController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);








//show all pizzas
Route::get('/pizzas', [PizzaController::class, 'index'])->middleware('auth');



//create a pizza -- admin only
Route::get('/pizzas/admin/create', [PizzaController::class, 'create'])->middleware('auth');
Route::post('/pizzas', [PizzaController::class, 'store']);

//update a pizza -- admin only
Route::get('/pizzas/admin/edit', [PizzaController::class, 'editView'])->middleware('auth');
Route::get('/pizzas/admin/edit/{slug}', [PizzaController::class, 'edit'])->whereAlphaNumeric('slug')->middleware('auth');
Route::delete('/pizzas/admin/edit/delete', [PizzaController::class, 'delete']);
Route::post('/pizzas/admin/edit/update', [PizzaController::class, 'update']);

//see orders -- admin only
Route::get('/pizzas/admin/orders', [PizzaController::class, 'orders'])->middleware('auth');





//make order for a pizza
Route::post('/pizzas/makeorder', [PizzaController::class, 'makeorder']);


//show pizza details
Route::get('/pizzas/{slug}', [PizzaController::class, 'find'])->whereAlphaNumeric('slug')->middleware('auth');




//find pizzas by category
Route::get('/pizzas/cat/{slug}', [PizzaController::class, 'findByCat'])->whereAlphaNumeric('slug')->middleware('auth');