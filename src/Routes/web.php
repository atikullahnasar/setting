<?php

use atikullahnasar\setting\Http\Controllers\CustomPageController;
use atikullahnasar\setting\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->prefix('beft')->group(function () {

    Route::resource('custom-pages', CustomPageController::class);
    Route::post('custom-pages/{custom_page}/toggle-status', [CustomPageController::class, 'toggleStatus'])->name('custom-pages.toggle-status');

    Route::get('settings/login', [SettingController::class, 'loginSettings'])->name('settings.login');
    Route::post('settings/login', [SettingController::class, 'updateloginSettings'])->name('settings.login.update');

    Route::get('footer-settings', [SettingController::class, 'footerSettings'])->name('footer-settings.index');
    Route::get('site-settings', [SettingController::class, 'settings'])->name('settings.index');
    Route::get('homepage-settings', [SettingController::class, 'homepageSettings'])->name('homepage.settings');
    Route::post('allsettings', [SettingController::class, 'update'])->name('allsettings.update');
});