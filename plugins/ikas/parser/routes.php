<?php
Route::group(['prefix' => 'ikas/parser'], function () {
    Route::get('/cryptowatchcontroller/parse', ['as' => 'cryptowatch.parse', 'uses' => 'CryptowatchController@parse']);
});