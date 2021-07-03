<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;





Route::group(['prefix' => 'admin', 'as'=>'admin.'], function(){

    Route::resource('product', ProductController::class)->except('create', 'show', 'edit', 'destroy');

});
