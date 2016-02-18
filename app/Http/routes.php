<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth',function () {
    $company = App\Src\Company\Company::orderByRaw("RAND()")->first();
    dd($company);
    return view('welcome');
}]);

//Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
Route::group(['prefix' => 'api/v1'], function () {

    Route::get('categories/{id}', 'CategoryController@show');
    Route::get('categories', 'CategoryController@index');

    /* company */
    Route::get('company/{id}', ['as' => 'view_company', 'uses' => 'CompanyController@show']);
    Route::get('companies', ['uses' => 'CompanyController@index']);

    /* list available timing */
    Route::get('/timings', 'TimingController@getAvailableTimings');

    /* create an appointment */
    Route::post('appointment/make',
        ['as' => 'create_appointment', 'uses' => 'AppointmentController@createAppointment']);

    /* Auth Routes */
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    Route::post('auth/activate', 'Auth\AuthController@postActivate');

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
