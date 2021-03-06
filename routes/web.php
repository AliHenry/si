<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Define the routes for your Frontend pages here
|
*/

//Route::get('/', [
//    'as' => 'home', 'uses' => 'FrontendController@home'
//]);

Route::get('/', 'Front\FrontendController@home')->name('home');
Route::get('shop', 'Front\ShopController@shop')->name('shop');
Route::get('contact', 'Front\ContactController@index')->name('contact');
Route::get('cart', 'Front\CartController@index')->name('cart');
Route::get('checkout', 'Front\CheckoutController@index')->name('checkout');



/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Route group for Backend prefixed with "admin".
| To Enable Authentication just remove the comment from Admin Middleware
|
*/
Route::patch('change-password/{id}', 'EmployeeController@changePassword')->name('change.password');
//Route::get('edit-store-audit', 'StoreAuditController@EditStoreAudit')->name('store.audit.edit');

//// Billing
//Route::group(['prefix' => 'api'], function () {
//    Route::get('payment', 'PaymentController@getPayment')->name('payment.get');
//
//});

Route::group([
    'prefix' => 'admin',
     'middleware' => 'admin'
], function () {

    Route::get('download/{model}/{type}', 'DownloadController@download')->name('download');

    // Dashboard
    //----------------------------------

    Route::get('/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);

    Route::get('/dashboard/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@index'
    ]);

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::get('change-password', 'ProfileController@changePassword')->name('change.profile.password');



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

    // Manage store
    Route::group(['prefix' => 'manage-store'], function () {
        //Route::get('audits/fetch-product', 'StoreAuditController@fetchProduct');

        Route::get('release', 'ProductReleaseController@releaseProduct')->name('release.products.send');

        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('brands', 'BrandController');
        Route::resource('purchase', 'PurchaseController');
        Route::resource('suppliers', 'SupplierController');

        Route::get('release-invoice', 'InvoiceController@releaseInvoice')->name('release.invoice');

        Route::get('release-products', 'ProductReleaseController@index')->name('release.products.index');
        Route::get('release-products/{sell}', 'ProductReleaseController@show')->name('release.products.show');


    });
    Route::group(['prefix' => 'manage-expenditure'], function () {

        Route::resource('expenditure-types', 'TypeExpenditureController');
        Route::resource('expenditures', 'ExpenditureController');

    });

    // Sells
    Route::group(['prefix' => 'manage-sells'], function () {

        Route::get('add-to-cart', 'SellController@insertCart')->name('add.cart');
        Route::get('delete-to-cart', 'SellController@destroyCart')->name('delete.cart');
        Route::get('update-to-cart', 'SellController@updateCart')->name('update.cart.qty');
        Route::get('invoice', 'InvoiceController@paymentInvoice')->name('sell.invoice');

        Route::resource('types', 'PaymentTypeController');
        Route::resource('status', 'PaymentStatusController');
        Route::resource('sells', 'SellController');
        Route::resource('loans', 'LoanController');
        //Route::get('payment-invoice/{$id}', 'SellController@paymentInvoice')->name('sell.invoice');

//        Route::resource('brands', 'BrandController');
    });

    // Audit
    Route::group(['prefix' => 'manage-audits'], function () {
        Route::post('audits/audits-verification', 'StoreAuditController@verifyProduct');
        Route::post('audits/audits-unverified', 'StoreAuditController@unverifyProduct');
        Route::get('edit-store-audit', 'StoreAuditController@editStoreAudit')->name('store.audit.edit');
        Route::get('edit-store-report', 'StoreAuditController@reportStoreAudit')->name('store.audit.report');

        Route::resource('product-audits', 'StoreAuditController');
        Route::resource('audit-sells', 'SellController');

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

//        Route::resource('zones', 'ZoneController');
        Route::resource('banks', 'BankController');
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
