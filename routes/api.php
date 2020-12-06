<?php

Route::group([

    'middleware' => 'api',
    //'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');


Route::Post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::Get('/salary', 'Api\SalaryController@AllSalary');
Route::Get('/view-salary/{id}', 'Api\SalaryController@ViewSalary');
Route::Get('/edit/salary/{id}', 'Api\SalaryController@EditSalary');
Route::Post('/salary/update/{id}', 'Api\SalaryController@UpdateSalary');

Route::Post('/product/updatestock/{id}', 'Api\ProductController@UpdateStock');

Route::Get('/getting/product/{id}', 'Api\PosController@GetProduct');

// Add To Cart 

Route::Get('/addtocart/{id}', 'Api\CartController@AddToCart');
Route::Get('/cart/product', 'Api\CartController@FetchProduct');
Route::Get('/delete/cart/{id}', 'Api\CartController@DeleteProduct');

Route::Get('/increment/{id}', 'Api\CartController@increment');
Route::Get('/decrement/{id}', 'Api\CartController@decrement');


// Vats Route

Route::Get('/vats', 'Api\CartController@vats');

Route::Post('/orderdone', 'Api\PosController@OrderDone');

Route::Get('/orders', 'Api\OrderController@TodayOrder');
Route::Get('/order/details/{id}', 'Api\OrderController@OrderDetails');
Route::Get('/order/orderdetails/{id}', 'Api\OrderController@OrderDetailsAll');

Route::Post('/search/order', 'Api\PosController@SearchOrderDate');

Route::Get('/today/sell', 'Api\PosController@TodaySell');
Route::Get('/today/income', 'Api\PosController@TodayIncome');
Route::Get('/today/due', 'Api\PosController@TodayDue');
Route::Get('/today/expense', 'Api\PosController@TodayExpense');
Route::Get('/today/stockout', 'Api\PosController@Stockout');
