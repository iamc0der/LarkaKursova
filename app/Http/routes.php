<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $credentials = array();
    $credentials['password'] = Hash::make('worker');
    $credentials['email'] ='pwd@worker.com';
    $credentials['login'] ='WORKER';
    $credentials['name'] ='Работник 1';
    $credentials['worker_id'] =1;
    #\Illuminate\Support\Facades\Auth::logout();
   #$user = \App\User::create($credentials);

    return \Illuminate\Support\Facades\Auth::user();
});


Route::get('/login',[
    'as'=>'user-login',
    'uses'=>'AuthController@getLogin'
]);
Route::get('/logout',[
    'as'=>'user-logout',
    'uses'=>'AuthController@getLogout'
]);
Route::get('/departments',[
    'as'=>'departments',
    'uses'=>'DepartmentsController@index',
    'middleware' => 'admin'
])->before('auth');

Route::get('/department/{id}',[
    'as'=>'departments',
    'uses'=>'DepartmentsController@show',
    'middleware' => 'admin'
])->before('auth');

Route::post('/login',[
    'uses'=>'AuthController@postLogin'
]);


Route::get('/workers',[
    'as'=>'workers',
    'uses'=>'WorkerController@index',
    'middleware' => 'admin'
])->before('auth');
Route::get('/worker/destroy/{id}',[
    'as'=>'worker-destroy',
    'uses'=>'WorkerController@destroy',
    'middleware' => 'admin'
])->before('auth');