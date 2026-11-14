<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\AdminAuthController;
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
    return view('index');
})->name('welcome');

Route::post('/post-contact-info',[ContactController::class,"PostMailContact"])->name('postMailContact');

Route::get('/contact',function(){
    return view('contact');
})->name('contact');


// Admin Authentication Routes
Route::prefix('panel')->group(function () {
    // Admin Login Routes
    Route::get('/login',[AdminAuthController::class,'showLoginForm'])->name('panel.login');
    Route::post('/login',[AdminAuthController::class, 'login'])->name('panel.postlogin');
    Route::post('/logout',[AdminAuthController::class,'logout'])->name('panel.logout');

    // Other Admin Routes...
});

Route::middleware(['auth:admin'])->group(function () {
    // Admin Dashboard Routes
    Route::get('/panel',[PanelController::class,'index'])->name('panel.dashboard');
  
       //// Start Gestion des demandes ::::::::::
        
       Route::get('/panel/demandes/all',[App\Http\Controllers\ContactController::class,'index'])->name('all.demandes');
        
       Route::get('/panel/demande/{id}/delete',[App\Http\Controllers\ContactController::class,'simpledemandedelete'])->name('delete.demande');
       
       Route::post('/panel/demande/multi-delete',[App\Http\Controllers\ContactController::class,'multideletedemandes'])->name('multidelete.demandes');
       
    //    Route::post('/panel/demande/statu/change',[App\Http\Controllers\StatuController::class,'changestatu'])->name('change.demandestatu');
       
       
       ///// END  Gestion Des Demandes ::::://///
    // Route::get('/admin/{id}/profile',[App\Http\Controllers\PanelController::class,'editprofile'])->name('edit.adminprofile');
    // Route::post('/admin/edit-password',[App\Http\Controllers\PanelController::class,'editpassword'])->name('edit.memberpassword');
    // Route::post('/admin/edit-information',[App\Http\Controllers\PanelController::class,'editinformation'])->name('editinfo.member');
    //////// All Admin Routes Orders //////////
    // Other Admin Routes...
});