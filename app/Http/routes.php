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
    #'middleware' => 'admin'
])->before('auth');

Route::post('/departments',[
    'uses'=>'DepartmentsController@filter',
    #'middleware' => 'admin'
])->before('auth');

Route::get('/workers/filtered',[
    'as'=>'worker-filter',
    'uses'=>'WorkerController@filter',
    #'middleware' => 'admin'
])->before('auth');
Route::get('json_get_cities',[
    'as'=>'json-cities',
    'uses'=>'DepartmentsController@getJSONCities',
    #'middleware' => 'admin'
])->before('auth');

Route::get('json_get_all_regions',[
    'as'=>'json-regions',
    'uses'=>'DepartmentsController@getJSONRegions',
    #'middleware' => 'admin'
])->before('auth');

Route::get('json_get_departments/{city_id}',[
    'as'=>'json-city-departments',
    'uses'=>'DepartmentsController@getJSONDepartments',
    #'middleware' => 'admin'
])->before('auth');
Route::post('/login',[
    'uses'=>'AuthController@postLogin'
]);


Route::get('/workers',[
    'as'=>'workers',
    'uses'=>'WorkerController@index',
    #'middleware' => 'admin'
])->before('auth');
Route::post('/workers',[
    'uses'=>'WorkerController@postFilter',
    #'middleware' => 'admin'
])->before('auth');

Route::get('/worker/destroy/{id}',[
    'as'=>'worker-destroy',
    'uses'=>'WorkerController@destroy',
    #'middleware' => 'admin'
])->before('auth');

############# DEPARTMENTS #############

Route::get('/department/new',[
    'as'=>'new-department',
    'uses'=>'DepartmentsController@getCreate'
]);
Route::post('/department/new',[
    'uses'=>'DepartmentsController@postCreate',
    #'middleware' => 'admin'
]);

Route::get('/department/{id}',[
    'as'=>'department',
    'uses'=>'DepartmentsController@show',
    #'middleware' => 'admin'
])->before('auth');

Route::get('/department/{id}/edit',[
    'as'=>'edit-department',
    'uses'=>'DepartmentsController@edit',
    #'middleware' => 'admin'
])->before('auth');

Route::post('/department/{id}/edit',[
    'uses'=>'DepartmentsController@postEdit',
    #'middleware' => 'admin'
])->before('auth');

################## WORKER @@@@@@@@@@@@@@
Route::get('/worker/new/{dept_id}',[
    'as'=>'new-worker',
    'uses'=>'WorkerController@getCreate'
]);
Route::post('/worker/new/{dept_id}',[
    'uses'=>'WorkerController@postCreate'
]);




##################### PACKAGES ####################

Route::get('packages',[
    'as'=>'new-packages',
    'uses'=>'PackageController@getNew'
]);

Route::post('packages',[
    'uses'=>'PackageController@postNew'
]);

Route::get('/package/{id}',[
    'as'=>'info-package',
    'uses'=>'PackageController@show'
]);

Route::post('/package/',[
    'uses'=>'PackageController@search',
    'as'=>'search-package'
]);
Route::get('/packages/list/',[
    'uses'=>'PackageController@index',
    'as'=>'list-packages'
]);


##################3 CLIENT #################
Route::get('/json_get_client_name/{number}',[
    'uses'=>'ClientController@jsonGetNameByPhone'
]);
