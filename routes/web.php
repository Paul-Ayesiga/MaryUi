<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\LoanProducts;
use App\Livewire\Loans;
use App\Livewire\ViewLoan;
use App\Http\Controllers\SocialLoginController;
use App\Livewire\ChartWidget as LivewireChartWidget;
use App\Livewire\ClientAccount;
use App\Livewire\Transactions;

Route::middleware(['auth','verified','role:admin|staff|client'])->group(function(){

Route::get('/dashboard',Dashboard::class)->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


    Route::prefix('loans')->name('loans.')->group(function(){
        Route::get('/index', Loans::class)->name('index');
        Route::get('/{id}/show',ViewLoan::class)->name('show');
        Route::get('/loan_products',LoanProducts::class)->name('loan_products');
        // Route::get('/create', AddLoan::class)->name('create');
        // Route::get('{id}/edit', EditClient::class)->name('edit');
    });


    Route::prefix('transactions')->name('transactions.')->group(function(){
        Route::get('/index', Transactions::class)->name('index');
        // Route::get('/{id}/show',ViewLoan::class)->name('show');
        // Route::get('/create', AddLoan::class)->name('create');
        // Route::get('{id}/edit', EditClient::class)->name('edit');
    });

    Route::prefix('accounts')->name('accounts.')->group(function(){
        Route::get('/index', ClientAccount::class)->name('index');
        // Route::get('/{id}/show',ViewLoan::class)->name('show');
        // Route::get('/create', AddLoan::class)->name('create');
        // Route::get('{id}/edit', EditClient::class)->name('edit');
    });

    Route::get('/expenses',LivewireChartWidget::class);
});

// social login routes
Route::get('/socialite/{driver}',[SocialLoginController::class, 'toProvider'])->where('driver','google|github');
Route::get('/auth/{driver}/login',[SocialLoginController::class, 'handleCallback'])->where('driver','google|github');

require __DIR__.'/auth.php';

