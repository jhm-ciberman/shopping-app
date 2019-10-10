<?php

Route::get('/', 'DashboardController@handle')->name('dashboard');

Route::prefix('/{resource}')->name('resources.')->group(function() {
    Route::get('/', 'ResourceIndexController@handle')->name('index');
    Route::post('/', 'ResourceStoreController@handle')->name('store');
    Route::get('/create', 'ResourceCreateController@handle')->name('create');

    Route::get('/{resourceId}', 'ResourceShowController@handle')->name('show');
    Route::get('/{resourceId}/edit', 'ResourceEditController@handle')->name('edit');
    Route::put('/{resourceId}', 'ResourceUpdateController@handle')->name('update');
    Route::get('/{resourceId}/attach/{relatedResource}', 'ResourceAttachFormController@handle')->name('attach');
    Route::put('/{resourceId}/attach/{relatedResource}', 'ResourceAttachController@handle')->name('attach');
    Route::delete('/{resourceId}', 'ResourceDestroyController@handle')->name('destroy');
});

