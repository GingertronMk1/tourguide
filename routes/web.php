<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegionVenueController;
use App\Http\Controllers\VenueController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', HomeController::class);

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
    'region.venue' => RegionVenueController::class,
    'region' => RegionController::class,
    'area' => AreaController::class,
];

foreach($resourceControllers as $resource => $controller) {
    Route::resource($resource, $controller)->only($readOnlyMethods);
    Route::middleware('auth')->resource($resource, $controller)->except($readOnlyMethods);
}

require __DIR__.'/auth.php';
