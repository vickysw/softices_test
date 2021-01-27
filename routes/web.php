<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlotController;
use App\Models\User;
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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     $user = User::where('role' , 1)->get();
//     return view('dashboard',compact('user' ) );
// })->name('dashboard');

// Route::group(['middleware' => 'auth'], function () { 
//     Route::post('slot_save',[SlotController::class, 'Store'])->name('slot_save');
//     Route::post('getslot',[SlotController::class, 'getslot'])->name('getslot');
//     Route::post('bookslot',[SlotController::class, 'bookslot'])->name('bookslot');
    
// });