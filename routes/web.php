<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Users
    Route::get('users', [MainController::class, 'users'])->name('users');

    // Form Surat
    Route::get('inputsurat', [MainController::class, 'inputsurat'])->name('inputsurat');

    // Asset Lending
    Route::get('peminjamanasset', [MainController::class, 'peminjamanasset'])->name('peminjamanasset');

    // Assets
    Route::get('assetscall', [MainController::class, 'assetscall'])->name('assetscall');
    Route::get('assetsdash', [MainController::class, 'assetsdash'])->name('assetsdash');
    Route::get('assetscreate', [MainController::class, 'assetscreate'])->name('assetscreate');
    Route::get('assetsdephed', [MainController::class, 'assetsdephed'])->name('assetsdephed');
    Route::get('assetsfirst', [MainController::class, 'assetsfirst'])->name('assetsfirst');
    Route::get('assetssecond', [MainController::class, 'assetssecond'])->name('assetssecond');
    Route::get('assetsdirector', [MainController::class, 'assetsdirector'])->name('assetsdirector');
    Route::get('assetsdata', [MainController::class, 'assetsdata'])->name('assetsdata');
    Route::get('dataasset', [MainController::class, 'dataasset'])->name('dataasset');
    Route::get('scurity', [MainController::class, 'scurity'])->name('scurity');

    //Action
    Route::post('upload_profile', [MainController::class, 'upload_profile'])->name('upload_profile');
    Route::post('upload_surat', [MainController::class, 'upload_surat'])->name('upload_surat');
    Route::post('actionshowdata', [MainController::class, 'actionshowdata'])->name('actionshowdata');
    Route::post('actionshowdatawmulti', [MainController::class, 'actionshowdatawmulti'])->name('actionshowdatawmulti');
    Route::post('actionlistdata', [MainController::class, 'actionlistdata'])->name('actionlistdata');
    Route::post('actionedit', [MainController::class, 'actionedit'])->name('actionedit');
    Route::post('actioneditwmulti', [MainController::class, 'actioneditwmulti'])->name('actioneditwmulti');
    Route::post('actiondelete', [MainController::class, 'actiondelete'])->name('actiondelete');
    Route::post('actionadd', [MainController::class, 'actionadd'])->name('actionadd');
    Route::post('addform', [MainController::class, 'addform'])->name('addform');
    Route::post('actioneditform', [MainController::class, 'actioneditform'])->name('actioneditform');
    Route::post('detaildataassets', [MainController::class, 'detaildataassets'])->name('detaildataassets');
    

    

    // Asset Lending

});
