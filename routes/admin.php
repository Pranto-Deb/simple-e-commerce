<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TagController;


Route::group(['prefix' => 'admin', 'as'=>'admin.'], function(){

    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('brand', BrandController::class)->except('show');
    Route::resource('size', SizeController::class)->except('create', 'show', 'edit');
    Route::resource('tag', TagController::class)->except('create', 'show', 'edit');
});

Route::post('/subcat', [ProductController::class, 'subCategory'])->name('subcat');
