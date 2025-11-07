<?php

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

Route::view('/', 'dashboard.index')->name('dashboard');

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

Route::prefix('user')->name('user.')->group(function () {
    Route::view('list', 'exemplos.user.list')->name('list');
    Route::view('profile', 'exemplos.user.profile')->name('profile');
});
Route::prefix('table')->name('table.')->group(function () {
    Route::view('basic', 'exemplos.table.basic')->name('basic');
    Route::view('data', 'exemplos.table.data')->name('data');
});

Route::prefix('authentication')->name('authentication.')->group(function () {
    Route::view('login', 'exemplos.authentication.login')->name('login');
    Route::view('register', 'exemplos.authentication.register')->name('register');
    Route::view('recover-password', 'exemplos.authentication.recover-password')->name('recover.password');
    Route::view('reset-password', 'exemplos.authentication.reset-password')->name('reset.password');
});

Route::prefix('miscellaneous')->name('miscellaneous.')->group(function () {
    Route::view('starter', 'exemplos.miscellaneous.starter')->name('starter');
    Route::view('comming-soon', 'exemplos.miscellaneous.comming-soon')->name('comming.soon');
    Route::view('maintenance', 'exemplos.miscellaneous.maintenance')->name('maintenance');
    Route::view('404', 'exemplos.miscellaneous.404')->name('404');
    Route::view('500', 'exemplos.miscellaneous.500')->name('500');
    Route::view('403', 'exemplos.miscellaneous.403')->name('403');
});
