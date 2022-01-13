<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Wgnsy\Currency\App\Models\Currency;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'  => 'api'
], function () {
    Route::get('/kurs/{code}',function($code){
        $api = Currency::where('code',$code)->first();//response()->json(Currency::where('code',$code)->first()->details);
        if(!$api) return response()->json(['Waluta '.$code.' nie istnieje.']);
        return response()->json($api);
    });
});

