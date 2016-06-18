<?php

Route::group(['middleware' => 'api', 'namespace' => 'Api','prefix' => 'api/v1'], function () {

    /* Auth Routes */
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    Route::post('auth/activate', 'Auth\AuthController@postActivate');
    Route::post('auth/login/token', 'Auth\AuthController@loginUsingToken');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@show');

    /* company */
    Route::get('companies', 'CompanyController@index');
    Route::get('companies/{id}/show', 'CompanyController@show');
    Route::get('companies/{id}/employees', 'CompanyController@getEmployees');
    Route::get('companies/{id}/holidays', 'CompanyController@getHolidays');
    Route::get('companies/{companyId}/services/{serviceId}/timings', 'CompanyController@getTimings');
    Route::get('companies/markers', 'CompanyController@getMarkers');

    Route::resource('users','UserController');

    Route::resource('services','ServiceController');

    Route::get('timings', 'TimingController@index');

    /* auth::api routes */
    Route::get('favorites','ProfileController@getFavorites');
    Route::get('appointments','ProfileController@getAppointments');

    Route::post('appointments/make','ProfileController@makeAppointment');
    Route::post('appointments/cancel','ProfileController@cancelAppointment');

    //make favorite
    Route::post('companies/favorite','ProfileController@favoriteCompany');
});

/*********************************************************************************************************
 * Admin Routes
 ********************************************************************************************************/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web','admin']], function () {
    Route::resource('companies.employees', 'CompanyEmployeeController');
    Route::resource('companies.services', 'CompanyServiceController');
    Route::resource('companies.appointments', 'CompanyAppointmentController');
    Route::resource('companies', 'CompanyController');
    Route::resource('services', 'ServiceController');
    Route::resource('users', 'UserController');
    Route::get('/', 'HomeController@dashboard');
});
    
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
});
