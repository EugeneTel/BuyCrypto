<?php
Route::group(['prefix' => 'ikas/parser'], function () {
    Route::get('/cryptowatchcontroller/parse', ['as' => 'cryptowatch.parse', 'uses' => 'CryptowatchController@parse']);
    Route::get('/cryptowatchcontroller/update/{id}', ['as' => 'cryptowatch.update', 'uses' => 'CryptowatchController@update']);
});