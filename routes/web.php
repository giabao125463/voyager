<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('export/{anket_type}', '\App\Http\Controllers\Admin\AnketResultController@export')->name('export');
Route::get('/print/{id}', 'HomeController@print')->name('anket.print');
Route::get('/verify', 'HomeController@show')->name('anket.verify');
Route::post('/verify', 'HomeController@verify');
Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['prefix' => 'anket', 'middleware' => ['anket.access']], function () {
    Route::get('/{anketId}', 'HomeController@anket')->name('anket.create');
    Route::get('edit/{resultId}', 'HomeController@edit')->name('anket.edit')->where('resultId', '[0-9]+');
    Route::get('view/{historyId}/{resultId}', 'HomeController@view')->name('anket.view')->where('resultId', '[0-9]+');
    Route::post('submit', 'SurveyController@submit')->name('anket.submit');
});
Route::get('header/{anketId}', 'HomeController@pageHeader')->name('anket.page_header');

Route::post('signin', 'Auth\LoginController@signin')->name('signin');
Auth::routes([
    'register' => false, // Registration Routes...
    'reset'    => false, // Password Reset Routes...
    'verify'   => false, // Email Verification Routes...
]);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('login', function () {
        return redirect()->route('login');
    })->name('voyager.login');

    Route::group(['prefix' => 'anket-accesses'], function () {
        Route::post('create', '\App\Http\Controllers\Admin\AnketAccessController@create')->name('anket_accesses.create');
        Route::post('edit', '\App\Http\Controllers\Admin\AnketAccessController@edit')->name('anket_accesses.edit');
        Route::post('createWithSurvey', '\App\Http\Controllers\Admin\AnketAccessController@createWithSurvey')->name('anket_accesses.createWithSurvey');
        Route::post('update', '\App\Http\Controllers\Admin\AnketAccessController@updatePatient')->name('anket_accesses.updatePatient');
        Route::post('delete/{id}', '\App\Http\Controllers\Admin\AnketAccessController@delete')->name('anket_accesses.delete');
        Route::post('doctors', '\App\Http\Controllers\Admin\AnketAccessController@loadDoctors')->name('anket_accesses.doctors');
    });

    Route::group(['prefix' => 'hospitals'], function () {
        Route::post('create', '\App\Http\Controllers\Admin\HospitalController@create')->name('hospitals.create');
        Route::post('edit/{hospital}', '\App\Http\Controllers\Admin\HospitalController@edit')->name('hospitals.edit');
        Route::post('delete/{id}', '\App\Http\Controllers\Admin\HospitalController@delete')->name('hospitals.delete');
    });

    Route::group(['prefix' => 'doctor'], function () {
        Route::post('create', '\App\Http\Controllers\Admin\DoctorController@create')->name('doctor.create');
        Route::post('update', '\App\Http\Controllers\Admin\DoctorController@update')->name('doctor.update');
        Route::post('delete/{id}', '\App\Http\Controllers\Admin\DoctorController@delete')->name('doctor.delete');
    });

    Route::group(['prefix' => 'executives'], function () {
        Route::post('create', '\App\Http\Controllers\Admin\ExecutiveController@create')->name('executives.create');
        Route::post('update', '\App\Http\Controllers\Admin\ExecutiveController@update')->name('executives.update');
    });

    Route::group(['prefix' => 'ankets'], function () {
        Route::get('/', '\App\Http\Controllers\Admin\AnketController@index')->name('admin.ankets.index');
        Route::get('/qr-code/{qr_code}/{hospital_id}/{anket_id}', '\App\Http\Controllers\Admin\AnketController@qrCodeGen')->name('admin.ankets.qrCodeGen');
    });

    Route::group(['prefix' => 'anket-results'], function () {
        Route::get('history/{id}', '\App\Http\Controllers\Admin\AnketResultController@history')->name('anket_result.history');
    });
});
