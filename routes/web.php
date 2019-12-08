<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Area Akses
    Route::delete('areaAkses/destroy', 'AreaAksesController@massDestroy')->name('areaAkses.massDestroy');
    Route::resource('areaAkses', 'AreaAksesController');

    // Kunjungan
    Route::delete('kunjungan/destroy', 'KunjunganController@massDestroy')->name('kunjungan.massDestroy');
    Route::resource('kunjungan', 'KunjunganController');

    // Alat
    Route::delete('alat/destroy', 'AlatController@massDestroy')->name('alat.massDestroy');
    Route::resource('alat', 'AlatController');

    // Area
    Route::delete('area/destroy', 'AreaController@massDestroy')->name('area.massDestroy');
    Route::resource('area', 'AreaController');

    // Pengunjung
    Route::delete('pengunjung/destroy', 'PengunjungController@massDestroy')->name('pengunjung.massDestroy');
    Route::resource('pengunjung', 'PengunjungController');

    // Kartu Pengunjung
    Route::delete('kartu/destroy', 'KartuController@massDestroy')->name('kartu.massDestroy');
    Route::resource('kartu', 'KartuController');
});
