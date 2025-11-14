<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;


/*
|--------------------------------------------------------------------------
| Rotas Públicas (sem autenticação)
|--------------------------------------------------------------------------
| Aqui ficam apenas as páginas que qualquer pessoa pode acessar
| (login, registro, links públicos, etc)
|--------------------------------------------------------------------------
*/

// Redireciona a raiz para o login
Route::get('/', function () {
    return redirect()->route('login');
})->name('root');

// Página pública de links
Route::view('/link', 'link.index')->name('link');

// Páginas de autenticação (Fortify usa essas views)
Route::prefix('authentication')->name('authentication.')->group(function () {
    Route::view('login', 'exemplos.authentication.login')->name('login');
    Route::view('register', 'exemplos.authentication.register')->name('register');
    Route::view('recover-password', 'exemplos.authentication.recover-password')->name('recover.password');
    Route::view('reset-password', 'exemplos.authentication.reset-password')->name('reset.password');
});

// Páginas diversas (erros, manutenção, etc)
Route::prefix('miscellaneous')->name('miscellaneous.')->group(function () {
    Route::view('starter', 'exemplos.miscellaneous.starter')->name('starter');
    Route::view('comming-soon', 'exemplos.miscellaneous.comming-soon')->name('comming.soon');
    Route::view('maintenance', 'exemplos.miscellaneous.maintenance')->name('maintenance');
    Route::view('404', 'exemplos.miscellaneous.404')->name('404');
    Route::view('500', 'exemplos.miscellaneous.500')->name('500');
    Route::view('403', 'exemplos.miscellaneous.403')->name('403');
});


/*
|--------------------------------------------------------------------------
| Rotas Protegidas (autenticadas)
|--------------------------------------------------------------------------
| Todas as rotas aqui dentro só funcionam se o usuário estiver logado
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard principal (pós-login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Página "home" opcional
    Route::get('/home', fn () => view('home.index'))->name('home');

    /*
    |--------------------------------------------------------------------------
    | Usuários
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

        Route::put('/{user}/password', [UserController::class, 'updatePassword'])->name('password.update');
        Route::put('/{user}/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::put('/{user}/roles', [UserController::class, 'updateRoles'])->name('roles.update');
        Route::put('/{user}/status', [UserController::class, 'updateStatus'])->name('status.update');
        Route::put('/{user}/menus', [UserController::class, 'updateMenus'])->name('menus.update');
        Route::put('/{user}/avatar', [UserController::class, 'updateAvatar'])->name('avatar.update');

        Route::get('/export-csv', [UserController::class, 'exportCsv'])->name('export.csv');
        Route::get('/export-pdf', [UserController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/phones', [UserController::class, 'phones'])->name('phones');
    });



    /*
    |--------------------------------------------------------------------------
    | Perfil do Usuário Logado
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/avatar', [ProfileController::class, 'updateAvatar'])->name('avatar');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });

    /*
    |--------------------------------------------------------------------------
    | Menus e Roles
    |--------------------------------------------------------------------------
    */
    Route::resource('menus', MenuController::class);
    Route::resource('roles', RoleController::class);

    /*--------------------------------------------------------------------------
    | Configurações do Sistema
    |--------------------------------------------------------------------------*/
        
   

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');



    /*
    |--------------------------------------------------------------------------
    | Páginas de Exemplo (somente logado)
    |--------------------------------------------------------------------------
    */
    Route::view('email', 'exemplos.email.index')->name('email');
    Route::view('chat', 'exemplos.chat.index')->name('chat');
    Route::view('calendar', 'exemplos.calendar.index')->name('calendar');
    Route::view('invoice-create', 'exemplos.invoice.create')->name('invoice.create');
    Route::view('invoice-details', 'exemplos.invoice.details')->name('invoice.details');
    Route::view('ecommerce-report', 'exemplos.ecommerce.index')->name('ecommerce.report');
    Route::view('product', 'exemplos.product.index')->name('product.index');
    Route::view('product/edit', 'exemplos.product.edit')->name('product.edit');
    Route::view('order', 'exemplos.order.index')->name('order.index');
    Route::view('order/show', 'exemplos.order.show')->name('order.show');
    Route::view('customer', 'exemplos.customer.index')->name('customer.index');
    Route::view('chart', 'exemplos.chart.index')->name('chart.index');
    Route::view('icons', 'exemplos.icons.index')->name('icons.index');
    Route::view('typography', 'exemplos.typography.index')->name('typography.index');

    Route::prefix('common')->name('common.')->group(function () {
        Route::view('accordion', 'exemplos.common.accordion')->name('accordion');
        Route::view('alert', 'exemplos.common.alert')->name('alert');
        Route::view('avatar', 'exemplos.common.avatar')->name('avatar');
        Route::view('badge', 'exemplos.common.badge')->name('badge');
        Route::view('button', 'exemplos.common.button')->name('button');
        Route::view('card', 'exemplos.common.card')->name('card');
        Route::view('carousel', 'exemplos.common.carousel')->name('carousel');
        Route::view('drawer', 'exemplos.common.drawer')->name('drawer');
        Route::view('dropdown', 'exemplos.common.dropdown')->name('dropdown');
        Route::view('list-group', 'exemplos.common.list-group')->name('list.group');
        Route::view('modal', 'exemplos.common.modal')->name('modal');
        Route::view('pagination', 'exemplos.common.pagination')->name('pagination');
        Route::view('progress-bar', 'exemplos.common.progress-bar')->name('progress.bar');
        Route::view('spinner', 'exemplos.common.spinner')->name('spinner');
        Route::view('tabs', 'exemplos.common.tabs')->name('tabs');
        Route::view('toast', 'exemplos.common.toast')->name('toast');
        Route::view('tooltip', 'exemplos.common.tooltip')->name('tooltip');
        Route::view('skeleton', 'exemplos.common.skeleton')->name('skeleton');
    });

    Route::prefix('form')->name('form.')->group(function () {
        Route::view('input', 'exemplos.form.input')->name('input');
        Route::view('input-group', 'exemplos.form.input-group')->name('input.group');
        Route::view('textarea', 'exemplos.form.textarea')->name('textarea');
        Route::view('checkbox', 'exemplos.form.checkbox')->name('checkbox');
        Route::view('radio', 'exemplos.form.radio')->name('radio');
        Route::view('toggle', 'exemplos.form.toggle')->name('toggle');
        Route::view('select', 'exemplos.form.select')->name('select');
        Route::view('datepicker', 'exemplos.form.datepicker')->name('datepicker');
        Route::view('editor', 'exemplos.form.editor')->name('editor');
        Route::view('uploader', 'exemplos.form.uploader')->name('uploader');
        Route::view('layout', 'exemplos.form.form-layout')->name('layout');
        Route::view('validation', 'exemplos.form.form-validation')->name('validation');
    });

    Route::prefix('table')->name('table.')->group(function () {
        Route::view('basic', 'exemplos.table.basic')->name('basic');
        Route::view('data', 'exemplos.table.data')->name('data');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::view('list', 'exemplos.user.list')->name('list');
        Route::view('profile', 'exemplos.user.profile')->name('profile');
    });
});
