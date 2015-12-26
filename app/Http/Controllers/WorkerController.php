<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::all();
        $topWorkers = DB::select('CALL top_10_workers()');
        return View::make('worker.all', ['workers' => $workers,'topWorkers'=>$topWorkers]);
    }

    public function filter(){

        return Input::get();
    }
    public function getCreate($department_id)
    {
        return View::make('worker.new',['department'=>$department_id]);
    }
    public function postCreate($dept_id){

        $rules = array('fio'=>'required|min:6|max:140','login'=>'required|min:6|max:80',
            'password'=>'required|max:60');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('new-worker')->withErrors($validator);
        }
        $hashed = (string) Hash::make(Input::get('password'));
        $params = array(Input::get('fio'),intval($dept_id),
            Input::get('login'),$hashed);
        DB::statement('CALL worker_registration(?,?,?,?)',$params);

        return Redirect::route('workers');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Worker::destroy($id);
        return redirect()->back();
    }
}
