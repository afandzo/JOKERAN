<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\BossController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobDetailController;
use App\Http\Controllers\JobDetailDetailController;
use App\Http\Controllers\ReportController;

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
Route::group(['middleware' => 'guest'], function () {

Route::get('/', function () {
    return view('login.index', []);
})->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

});

Route::group(['middleware' => 'auth'], function () {

    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // #####-------BOSS-------#####
    Route::get('/boss', [BossController::class, 'index'])->name('boss');
    Route::post('/tambah-data-boss', [BossController::class, 'tambahDataBoss']);
    Route::post('/update-data-boss/{id}', [BossController::class, 'updateDataBoss']);
    Route::get('/delete-data-boss/{id}', [BossController::class, 'deleteDataBoss']);

    // #####-------SERVICE-------#####
    Route::get('/service', [ServiceController::class, 'index'])->name('service');
    Route::post('/tambah-data-service', [ServiceController::class, 'tambahDataService']);
    Route::post('/update-data-service/{id}', [ServiceController::class, 'updateDataService']);
    Route::get('/delete-data-service/{id}', [ServiceController::class, 'deleteDataService']);
    
    // #####-------USER-------#####
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/tambah-data-user', [UserController::class, 'tambahDataUser']);
    Route::post('/update-data-user/{id}', [UserController::class, 'updateDataUser']);
    Route::get('/delete-data-user/{id}', [UserController::class, 'deleteDataUser']);
    Route::post('/user/setDefaultPassword/{id}', [UserController::class, 'setDefaultPassword']);

    // #####-------PROFILE-------#####
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

    // #####-------JOB-------#####
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // #####-------JOB HISTORY-------#####
    Route::get('/job_detail', [JobDetailController::class, 'index'])->name('job_detail.index');
    Route::delete('/job_detail/{id}', [JobDetailController::class, 'delete'])->name('job_detail.delete');

    Route::get('/job/{idtransaksi}/{kode}', [JobDetailDetailController::class, 'index'])->name('detail_job_detail.index');
    Route::post('/job/update/{idtransaksi}/{kode}', [JobDetailDetailController::class, 'update'])->name('detail_job_detail.update');
    
    Route::put('/job-update/{idTransaksi}', [JobDetailDetailController::class, 'update'])->name('detail_job_detail.update');

    // #####-------REPORT-------#####
    Route::get('/laporan-transaksi', [ReportController::class, 'index'])->name('laporan_transaksi');
    Route::post('/laporan-transaksi/cari', [ReportController::class, 'cari'])->name('laporan_cari');
    Route::get('/laporan-transaksi/cetak', [ReportController::class, 'cetak'])->name('laporan_cetak');
});