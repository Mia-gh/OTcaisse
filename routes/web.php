<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SellController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/ventes', [SellController::class, 'list'])->name('ventes');
    Route::get('/caisse', [SellController::class, 'index'])->name('dashboard');

    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);


    // New sale routes
    Route::get('/nouvelle-vente/{article}', [SellController::class, 'create'])->name('create');
    Route::post('addtosale/{article}', [SellController::class,'store'])->name('addtosale');

    // Cart routes
    Route::post('/addtocart', [SellController::class, 'addToCart'])->name('addtocart');
    Route::post('/updatecart', [SellController::class, 'updateCart'])->name('updatecart');
    // Route::delete('/cart/remove/{article}', [SellController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/confirmpurchase', [SellController::class, 'confirmPurchase'])->name('confirmPurchase');
    Route::get('/cart', [SellController::class, 'cart'])->name('cart');

});






// index affiche la liste des ventes actives.
// create affiche le formulaire de création d'une nouvelle vente.
// store crée une nouvelle vente dans la base de données à partir des données du formulaire.
// show affiche les détails d'une vente spécifique.
// edit affiche le formulaire de modification d'une vente existante.
// update met à jour une vente existante dans la base de données à partir des données du formulaire.
// destroy supprime une vente de la base de données.


//  Statistics routes
 Route::get('/statistics', [SellController::class, 'statistics'])->name('statistics');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
