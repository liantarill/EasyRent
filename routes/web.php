<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileCompletionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\VehicleController as CustomerVehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // jika sudah login arahkan sesuai role
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'customer') {
            return redirect()->route('customer.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }

    // jika belum login tampilkan form login (atau view welcome jika kamu mau)
    return view('welcome');
})->name('root');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/profile-completion', [ProfileCompletionController::class, 'index'])->name('profile-completion');
Route::post('/profile-completion/profile-picture', [ProfileCompletionController::class, 'uploadProfilePicture'])->name('profile-completion.uploadProfilePicture');
Route::post('/profile-completion/id-card', [ProfileCompletionController::class, 'uploadIdCard'])->name('profile-completion.uploadIdCard');
Route::get('/profile-completion/next', [ProfileCompletionController::class, 'nextPage'])->name('profile-completion.nextPage');
Route::get('/profile-completion/complete', [ProfileCompletionController::class, 'complete'])->name('profile-completion.complete');


Route::middleware(['auth', 'role:customer'])->name('customer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vehicles', [CustomerVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [CustomerVehicleController::class, 'show'])->name('vehicles.show');

    Route::get('/rents', function () {
        return 'Riwayat transaksi customer';
    })->name('rents.index');

    Route::get('/profile', [CustomerProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/profile-picture', [CustomerProfileController::class, 'updateProfilePicture'])->name('profile.picture');
    Route::post('/profile/id-card', [CustomerProfileController::class, 'updateIdCard'])->name('profile.id_card');
    Route::get('/profile/id-card/view', [CustomerProfileController::class, 'viewIdCard'])->name('profile.id_card.view');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vehicles', App\Http\Controllers\Admin\VehicleController::class);
    Route::resource('rents', App\Http\Controllers\Admin\RentController::class);
});
