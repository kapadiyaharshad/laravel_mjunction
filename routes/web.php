<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });
    Route::group(['middleware' => ['auth']], function () {
        // Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::post('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
            //User export/import
            Route::post('import', 'UsersController@import')->name('users.import');
            Route::get('export', 'UsersController@export')->name('users.export');
        });

        //Profit center
        Route::group(['prefix' => 'profit_center'], function () {
            Route::get('/', 'ProfitCenterController@index')->name('profit_center.index');
            Route::get('/{profit_center}/show', 'ProfitCenterController@show')->name('profit_center.show');
            Route::get('/{profit_center}/edit', 'ProfitCenterController@edit')->name('profit_center.edit');
            Route::patch('/{profit_center}/update', 'ProfitCenterController@update')->name('profit_center.update');
            Route::get('/create', 'ProfitCenterController@create')->name('profit_center.create');
            Route::post('/create', 'ProfitCenterController@store')->name('profit_center.store');
            Route::delete('/{profit_center}/delete', 'ProfitCenterController@destroy')->name('profit_center.destroy');
        });

        //Payer code
        Route::group(['prefix' => 'payer_code'], function () {
            Route::get('/', 'PayerCodeController@index')->name('payer_code.index');
            Route::get('/{payer_code}/show', 'PayerCodeController@show')->name('payer_code.show');
            Route::get('/{payer_code}/edit', 'PayerCodeController@edit')->name('payer_code.edit');
            Route::patch('/{payer_code}/update', 'PayerCodeController@update')->name('payer_code.update');
            Route::get('/create', 'PayerCodeController@create')->name('payer_code.create');
            Route::post('/create', 'PayerCodeController@store')->name('payer_code.store');
            Route::delete('/{payer_code}/delete', 'PayerCodeController@destroy')->name('payer_code.destroy');
        });

        //Ecnc code
        Route::group(['prefix' => 'business_segment'], function () {
            Route::get('/', 'BusinessSegmentController@index')->name('business_segment.index');
            Route::get('/{business_segment}/show', 'BusinessSegmentController@show')->name('business_segment.show');
            Route::get('/{business_segment}/edit', 'BusinessSegmentController@edit')->name('business_segment.edit');
            Route::patch('/{business_segment}/update', 'BusinessSegmentController@update')->name('business_segment.update');
            Route::get('/create', 'BusinessSegmentController@create')->name('business_segment.create');
            Route::post('/create', 'BusinessSegmentController@store')->name('business_segment.store');
            Route::delete('/{business_segment}/delete', 'BusinessSegmentController@destroy')->name('ec_nc.destroy');
        });

        //Ecnc code
        Route::group(['prefix' => 'business_unit'], function () {
            Route::get('/', 'BusinessUnitController@index')->name('business_unit.index');
            Route::get('/{business_unit}/show', 'BusinessUnitController@show')->name('business_unit.show');
            Route::get('/{business_unit}/edit', 'BusinessUnitController@edit')->name('business_unit.edit');
            Route::patch('/{business_unit}/update', 'BusinessUnitController@update')->name('business_unit.update');
            Route::get('/create', 'BusinessUnitController@create')->name('business_unit.create');
            Route::post('/create', 'BusinessUnitController@store')->name('business_unit.store');
            Route::delete('/{business_unit}/delete', 'BusinessUnitController@destroy')->name('business_unit.destroy');
        });

         //Account type code
         Route::group(['prefix' => 'account_type'], function () {
            Route::get('/', 'AccountTypeController@index')->name('account_type.index');
            Route::get('/{account_type}/show', 'AccountTypeController@show')->name('account_type.show');
            Route::get('/{account_type}/edit', 'AccountTypeController@edit')->name('account_type.edit');
            Route::post('/{account_type}/update', 'AccountTypeController@update')->name('account_type.update');
            Route::get('/create', 'AccountTypeController@create')->name('account_type.create');
            Route::post('/create', 'AccountTypeController@store')->name('account_type.store');
            Route::delete('/{account_type}/delete', 'AccountTypeController@destroy')->name('account_type.destroy');
        });

        //Services code
        Route::group(['prefix' => 'service'], function () {
            Route::get('/', 'ServiceController@index')->name('service.index');
            Route::get('/{service}/show', 'ServiceController@show')->name('service.show');
            Route::get('/{service}/edit', 'ServiceController@edit')->name('service.edit');
            Route::patch('/{service}/update', 'ServiceController@update')->name('service.update');
            Route::get('/create', 'ServiceController@create')->name('service.create');
            Route::post('/create', 'ServiceController@store')->name('service.store');
            Route::delete('/{service}/delete', 'ServiceController@destroy')->name('service.destroy');
        });

        //Regions code
        Route::group(['prefix' => 'region'], function () {
            Route::get('/', 'RegionController@index')->name('region.index');
            Route::get('/{region}/show', 'RegionController@show')->name('region.show');
            Route::get('/{region}/edit', 'RegionController@edit')->name('region.edit');
            Route::patch('/{region}/update', 'RegionController@update')->name('region.update');
            Route::get('/create', 'RegionController@create')->name('region.create');
            Route::post('/create', 'RegionController@store')->name('region.store');
            Route::delete('/{region}/delete', 'RegionController@destroy')->name('region.destroy');
        });

        //Category code
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index')->name('category.index');
            Route::get('/{category}/show', 'CategoryController@show')->name('category.show');
            Route::get('/{category}/edit', 'CategoryController@edit')->name('category.edit');
            Route::patch('/{category}/update', 'CategoryController@update')->name('category.update');
            Route::get('/create', 'CategoryController@create')->name('category.create');
            Route::post('/create', 'CategoryController@store')->name('category.store');
            Route::delete('/{category}/delete', 'CategoryController@destroy')->name('category.destroy');
        });

        //Client code
        Route::group(['prefix' => 'client'], function () {
            Route::get('/', 'ClientController@index')->name('client.index');
            Route::get('/{client}/show', 'ClientController@show')->name('client.show');
            Route::get('/{client}/edit', 'ClientController@edit')->name('client.edit');
            Route::post('/{client}/update', 'ClientController@update')->name('client.update');
            Route::get('/create', 'ClientController@create')->name('client.create');
            Route::post('/create', 'ClientController@store')->name('client.store');
            Route::delete('/{client}/delete', 'ClientController@destroy')->name('client.destroy');
            //Client export/import
            Route::post('import', 'ClientController@import')->name('client.import');
            Route::get('export', 'ClientController@export')->name('client.export');
        });


         //Designation code
         Route::group(['prefix' => 'designation'], function () {
            Route::get('/', 'DesignationController@index')->name('designation.index');
            Route::get('/{designation}/show', 'DesignationController@show')->name('designation.show');
            Route::get('/{designation}/edit', 'DesignationController@edit')->name('designation.edit');
            Route::post('/{designation}/update', 'DesignationController@update')->name('designation.update');
            Route::get('/create', 'DesignationController@create')->name('designation.create');
            Route::post('/create', 'DesignationController@store')->name('designation.store');
            Route::delete('/{designation}/delete', 'DesignationController@destroy')->name('designation.destroy');
            //Client export/import
            Route::post('import', 'DesignationController@import')->name('designation.import');
            Route::get('export', 'DesignationController@export')->name('designation.export');
        });

        //Roles code
        Route::resource('roles', RolesController::class);

        //Permission code
        Route::resource('permissions', PermissionsController::class);

        //Get Account manager
        Route::post('get_account_manager','ClientController@get_account_manager');
    });
});
