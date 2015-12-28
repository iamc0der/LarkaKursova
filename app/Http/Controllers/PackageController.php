<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentDepartment = Auth::user()->worker->department->id;
        $packages = Package::where('receiver_department_id',$currentDepartment)->get();
       return View::make('packages.list',['packages'=>$packages]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::where('ttn',$id)->first();
        if(is_null($package)) return "Not Found!";
        else
        return View::make('packages.info',['package'=>$package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
    public function search(){

        $ttn = Input::get('package_ttn');
        return Redirect::action('PackageController@show',['id'=>$ttn]);
    }
    public function getNew(){

        return View::make('packages.new');
    }

    public function postNew(){
        $params = null;
        $rules = array('sender_name'=>'required','sender_phone'=>'required|min:9|max:9',
            'receiver_name'=>'required','receiver_phone'=>'required|min:9|max:9',
            'payer'=>'required','packing_type'=>'required','package_type'=>'required',
            'department'=>'required','weight'=>'required');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('packages')->withErrors($validator);
        }

        $usr = Auth::user();
        if($usr->isWorker()){

            $currentDepartment = $usr->worker->department->id;
            $currentWorker = $usr->worker->id;
            $params = array((int)Input::get('sender_phone'),Input::get('sender_name'),
                (int)Input::get('receiver_phone'),Input::get('receiver_name'),
                $currentDepartment,Input::get('department'),(int)Input::get('weight'),
                (int)Input::get('packing_type'),(int)Input::get('package_type'),
                $currentWorker,(int)Input::get('payer'));
            DB::statement('CALL regis_package(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',$params);
        }
        return Redirect::route('departments');

    }
    /*IN sender_phone INTEGER(9),IN sender_name VARCHAR(45),
 IN receiver_phone INTEGER(9), IN receiver_name VARCHAR(45),
 IN sender_dept INTEGER, IN receiver_dept INTEGER,
 IN package_weight FLOAT, IN pking_type_id INTEGER,
 IN pkg_type_id INTEGER, IN worker_id INTEGER, IN payer_code INTEGER(1)*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
