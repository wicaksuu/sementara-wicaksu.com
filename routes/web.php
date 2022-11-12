<?php

use App\Http\Controllers\ApiOrderController;
use App\Http\Controllers\ApiWicak;
use App\Http\Controllers\ReloadController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Produk\Addbot;
use App\Http\Livewire\Produk\Store;
use App\Http\Livewire\Produk\Varian;
use App\Http\Livewire\Store\Addvarian;
use App\Http\Livewire\Store\BotLog;
use App\Http\Livewire\Store\GlobalBotLog;
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
// API
Route::any('/reset', [ApiWicak::class, 'reset']);
Route::any('/getcookie', [ApiWicak::class, 'getcookie']);
Route::any('/addproducts', [ApiWicak::class, 'addProducts']);
Route::any('/addvarians', [ApiWicak::class, 'addVarians']);
Route::any('/update', [ApiWicak::class, 'update']);

// bot routing
Route::post('/getorder', [ApiOrderController::class, 'getorder']);
// End API

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', Dashboard::class)->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->group(function () {
    Route::get('/dashboard-admin', Dashboard::class)->name('dashboard-admin');
    Route::get('/varian-admin', Varian::class)->name('varian-admin');
    Route::get('/store-admin', Store::class)->name('store-admin');
    Route::get('/addbot/admin/{id}', Addbot::class)->name('addbot-admin');
    Route::get('/addstore/varian/admin/{id}', Addvarian::class)->name('addstore-varian-admin');
    Route::get('/bot/log/admin/{id}', BotLog::class)->name('bot-log-admin');
    Route::get('/global-bot-log', GlobalBotLog::class)->name('global-log-admin');
    Route::get('/reload/admin/{id}', [BotLog::class, 'reload'])->name('reload-admin');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:wicaksu'
])->group(function () {
    Route::get('/dashboard-wicaksu', Dashboard::class)->name('dashboard-wicaksu');
});
