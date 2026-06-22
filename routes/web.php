<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'name' => 'Wedding Invitation API',
        'status' => 'active'
    ]);
});
