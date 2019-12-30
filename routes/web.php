<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Define the routes for your Frontend pages here
|
*/

Route::get('/', [
    'as' => 'home', 'uses' => 'FrontendController@home'
]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Route group for Backend prefixed with "admin".
| To Enable Authentication just remove the comment from Admin Middleware
|
*/
Route::patch('change-password/{id}', 'EmployeeController@changePassword')->name('change.password');

// Billing
Route::group(['prefix' => 'api'], function () {
    Route::get('payment', 'PaymentController@getPayment')->name('payment.get');

});

Route::group([
    'prefix' => 'admin',
     'middleware' => 'admin'
], function () {

    // Dashboard
    //----------------------------------

    Route::get('/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);

    Route::get('/dashboard/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);



    // Login, Register & Maintenance Pages
    //----------------------------------

    Route::get('login-2', [
        'as' => 'admin.login-2', 'uses' => 'Demo\PagesController@login2'
    ]);

    Route::get('login-3', [
        'as' => 'admin.login-3', 'uses' => 'Demo\PagesController@login3'
    ]);

    Route::get('register-2', [
        'as' => 'admin.register-2', 'uses' => 'Demo\PagesController@register2'
    ]);

    Route::get('register-3', [
        'as' => 'admin.register-3', 'uses' => 'Demo\PagesController@register3'
    ]);

    Route::get('maintenance', [
        'as' => 'admin.maintenance', 'uses' => 'Demo\PagesController@maintenance'
    ]);


    // Users
    Route::group(['prefix' => 'manage-users'], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');
    });

    // Employees
    Route::group(['prefix' => 'manage-employees'], function () {
        Route::resource('employees', 'EmployeeController');
        Route::resource('attendance', 'AttendanceController');
        Route::get('designations-fetch', 'EmployeeController@fetch')->name('designations.fetch');
        Route::get('lga-fetch', 'EmployeeController@fetchLga')->name('lga.fetch');
    });

    // Customers
    Route::group(['prefix' => 'manage-customers'], function () {
        Route::resource('customers', 'CustomerController');
    });

    // Customers
    Route::group(['prefix' => 'manage-store'], function () {
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('brands', 'BrandController');
    });

    // Billing
//    Route::group(['prefix' => 'manage-payment'], function () {
//        Route::get('make-payment', 'PaymentController@index')->name('payment.index');
//        Route::get('payment', 'PaymentController@getPayment')->name('payment.get');
//        Route::post('payment', 'PaymentController@makePayment')->name('payment.post');
//        Route::resource('billing', 'BillingController');
//        Route::get('generate-bill', 'BillingController@generateBill')->name('generate.bill');
//        Route::get('zones', 'ZoneController@getZones')->name('zones.fetch');
//        Route::get('get-bills', 'BillingController@billToPDF')->name('zones.fetch');
//        Route::resource('payment-type', 'PaymentTypeController');
//
//    });


    // Settings
    //----------------------------------

    Route::group(['prefix' => 'settings'], function () {

        Route::resource('zones', 'ZoneController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('designations', 'DesignationController');
        Route::resource('countries', 'CountryController');
        Route::resource('states', 'StateController');
        Route::resource('lgas', 'LGAController');

    });
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
| Guest routes cannot be accessed if the user is already logged in.
| He will be redirected to '/" if he's logged in.
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('login', [
        'as' => 'login', 'uses' => 'AuthController@login'
    ]);

    Route::get('register', [
        'as' => 'register', 'uses' => 'AuthController@register'
    ]);

    Route::post('login', [
        'as' => 'login.post', 'uses' => 'AuthController@postLogin'
    ]);

    Route::get('forgot-password', [
        'as' => 'forgot-password.index', 'uses' => 'ForgotPasswordController@getEmail'
    ]);

    Route::post('/forgot-password', [
        'as' => 'send-reset-link', 'uses' => 'ForgotPasswordController@postEmail'
    ]);

    Route::get('/password/reset/{token}', [
        'as' => 'password.reset', 'uses' => 'ForgotPasswordController@GetReset'
    ]);

    Route::post('/password/reset', [
        'as' => 'reset.password.post', 'uses' => 'ForgotPasswordController@postReset'
    ]);

    Route::get('auth/{provider}', 'AuthController@redirectToProvider');

    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
});

Route::get('logout', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);

Route::get('install', [
    'as' => 'logout', 'uses' => 'AuthController@logout'
]);
