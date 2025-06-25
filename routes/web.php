<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\CableEdit;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\Performance;

use App\Http\Livewire\Upload;
use App\Http\Livewire\Maintenance;
use App\Http\Livewire\CableList;
use App\Http\Livewire\Substations;
use App\Http\Livewire\SubstationImport;
use App\Http\Livewire\CableImport;
use App\Http\Livewire\SubstationList;
use App\Http\Livewire\SubstationShow;
use App\Http\Livewire\SubstationEdit;
use App\Http\Livewire\CableShow;
use App\Http\Livewire\SubstationMap;
use App\Http\Livewire\Report;
use App\Http\Livewire\MaintenanceList;

use App\Http\Controllers\CableController;

use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Livewire\SalesChart;
use App\Http\Livewire\Auth\Upload as AuthUpload;
use App\Models\Substation;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/maintenance', Maintenance::class)->name('maintenance');
    Route::get('/maintenance/breakdownlist', MaintenanceList::class)->name('maintenance list');
    Route::get('/profile', Upload::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/performance', Performance::class)->name('performance');

    // Admin-only routes for user management
    Route::middleware('can:admin-only')->group(function () {
        Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
        Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
    });

    Route::get('/upload', Upload::class)->name('upload');
    Route::get('/substations', SubstationList::class)->name('substations');
    Route::get('/cables', CableList::class)->name('cables');

    // Routes requiring 'edit-delete-access' (Admin only)
    Route::middleware('can:edit-delete-access')->group(function () {
        Route::get('/substations/import', SubstationImport::class)->name('substations import');
        Route::get('/cables/import', CableImport::class)->name('cables import');
        Route::get('/substation/{substation}/edit', SubstationEdit::class)->name('substation edit');
        Route::get('/cable/{cable}/edit', CableEdit::class)->name('cable edit');
    });

    Route::get('/substation/{substation}', SubstationShow::class)->name('substation show');
    Route::get('/cable/{cable}', CableShow::class)->name('cable show');
    Route::get('/report', \App\Http\Livewire\Report::class)->name('report');

    // Template download route for Upload blade
    Route::get('/download/template/{filename}', function($filename) {
        return Storage::download('private/' . $filename);
    })->name('download.template');

});


Route::prefix('substation')->group(function () {
    // Show route
    Route::get('/{id}', SubstationShow::class)->name('substation.show');
});