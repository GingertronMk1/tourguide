<?php

declare(strict_types=1);

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AreaRegionController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\VenuePDFController;
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

/**
 * Base Laravel routes
 */
Route::get('/', HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * My routes
 */
$readOnlyMethods = ['index', 'show'];

$resourceControllers = [
    'venue' => VenueController::class,
    'region' => RegionController::class,
    'area' => AreaController::class,
    'area.region' => AreaRegionController::class,
];

foreach ($resourceControllers as $resource => $controller) {
    Route::resource($resource, $controller)->only($readOnlyMethods);
    Route::middleware('auth')->resource($resource, $controller)->except($readOnlyMethods);
}

Route::get('/venue/{venue}/pdf', VenuePDFController::class)->name('venue.pdf');

Route::middleware('auth')->group(function () {
    Route::resource('activity-log', ActivityLogController::class)->only('index');
    Route::resource('asset', AssetController::class)
        ->only(['store', 'show', 'delete']);
});

require __DIR__.'/auth.php';
