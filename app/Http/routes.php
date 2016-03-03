<?php

Route::get('test',function(\Illuminate\Http\Request $request){
//  $user =  App\Src\User\User::where('api_token',$request->get('api_token'))->first();
//    dd($user->load('favorites')->toArray());
//    Auth::loginUsingId(1);
//    dd(Auth::user());
});
Route::get('/', ['middleware' => 'auth',function () {
//    $company = App\Src\Company\Company::orderByRaw("RAND()")->first();
//    dd($company);
//    return view('welcome');
}]);

//Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
Route::group(['prefix' => 'api/v1'], function () {

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

    Route::get('timings', 'TimingController@index');

    /* auth::api routes */
    Route::get('favorites','ProfileController@getFavorites');
    Route::get('appointments','ProfileController@getAppointments');

    Route::post('appointments/make','ProfileController@makeAppointment');
    Route::post('appointments/{id}/cancel','ProfileController@cancelAppointment');

    //make favorite
    Route::get('companies/{id}/favorite','ProfileController@favoriteCompany');
    Route::get('companies/{id}/unfavorite','ProfileController@unFavoriteCompany');
});