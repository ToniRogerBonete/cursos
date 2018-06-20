<?php
Auth::routes();

Route::get('/','HomeController@index');
Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth','prefix' => 'painel'], function () {
    Route::any('{all}', function () {
        return view('layouts.app-painel');
    })->where(['all' => '.*']);
});

Route::group(['middleware' => 'auth','prefix' => 'api'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('curso', 'CourseController');
    Route::resource('category', 'CategoryController');
    Route::resource('level', 'LevelController');
    Route::resource('file', 'FileController');
    Route::resource('discipline', 'DisciplineController');
    Route::post('/discipline/ordem', 'DisciplineController@ordem');
    Route::resource('content', 'ContentController');
    Route::post('/content/ordem', 'ContentController@ordem');
    Route::resource('question', 'QuestionController');
    Route::resource('response', 'ResponseController');
    Route::resource('document', 'DocumentController');
});