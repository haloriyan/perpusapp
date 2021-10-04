<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "VisitorController@index")->name('visitor.index');

Route::group(['prefix' => "admin"], function () {
    Route::get('login', "AdminController@loginPage")->name('admin.loginPage');
    Route::post('login', "AdminController@login")->name('admin.login');
    Route::get('logout', "AdminController@logout")->name('admin.logout');
    
    Route::get('dashboard', "AdminController@dashboard")->name('admin.dashboard')->middleware('Admin');
    Route::get('profile', "AdminController@profile")->name('admin.profile')->middleware('Admin');

    Route::group(['prefix' => "user"], function () {
        Route::get('visitor', "AdminController@visitor")->name('admin.visitor')->middleware('Admin');

        Route::group(['prefix' => "admin"], function () {
            Route::post('store', "AdminController@store")->name('admin.admin.store')->middleware('Admin');
            Route::post('update', "AdminController@update")->name('admin.admin.update')->middleware('Admin');
            Route::post('update-password', "AdminController@updatePassword")->name('admin.admin.updatePassword')->middleware('Admin');
            Route::get('delete', "AdminController@delete")->name('admin.admin.delete')->middleware('Admin');
            Route::get('/', "AdminController@admin")->name('admin.admin')->middleware('Admin');
        });
    });

    Route::group(['prefix' => "buku"], function () {
        Route::post('store', "BukuController@store")->name('admin.buku.store')->middleware('Admin');
        Route::post('update', "BukuController@update")->name('admin.buku.update')->middleware('Admin');
        Route::get('delete/{id}', "BukuController@delete")->name('admin.buku.delete')->middleware('Admin');
        Route::get('/', "AdminController@buku")->name('admin.buku')->middleware('Admin');
    });
    
    Route::group(['prefix' => "layanan-perpustakaan"], function () {
        Route::post('store', "LayananController@store")->name('admin.layanan.store')->middleware('Admin');
        Route::get('/{id}/edit', "LayananController@edit")->name('admin.layanan.edit')->middleware('Admin');
        Route::post('update', "LayananController@update")->name('admin.layanan.update')->middleware('Admin');
        Route::get('delete/{id}', "LayananController@delete")->name('admin.layanan.delete')->middleware('Admin');
        Route::get('/', "AdminController@layananPerpustakaan")->name('admin.layananPerpustakaan')->middleware('Admin');
    });

    Route::group(['prefix' => "jadwal-perpustakaan"], function () {
        Route::post('update', "JadwalController@update")->name('admin.jadwal.update')->middleware('Admin');
        Route::get('/', "AdminController@jadwalPerpustakaan")->name('admin.jadwal')->middleware('Admin');
    });
    
    Route::get('/', function() {
        return redirect()->route('admin.loginPage');
    });
});
