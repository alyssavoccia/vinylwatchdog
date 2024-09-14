<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Browse\ProductView;
use App\Livewire\Dashboard\Dasboard;

Route::view('/', 'welcome')
    ->name('landing');

Route::get('/browse', Dasboard::class)
    ->name('browse');

Route::get('/recommended-products', Dasboard::class)
    ->name('recommended-products');

Route::get('/dashboard', Dasboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/browse/{vinylId}/{slug}', ProductView::class) 
    ->name('product-view');

require __DIR__.'/auth.php';