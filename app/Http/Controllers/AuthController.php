<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{

    public function getLogin(){

        if(Auth::check()){
            return Redirect::route('user-test');
        }else
        return View::make('login',['title'=>'Вход в систему']);
    }
    public function getLogout(){
        Auth::logout();
       return  Redirect::route('user-login');
    }
    public function postLogin(){

        $rules = array('login'=>'required','password'=>'required');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('user-login')->withErrors($validator);
        }
        $auth = Auth::attempt(array('login'=>Input::get('login'),
            'password'=>Input::get('password')),false);
        if(!$auth){
            return Redirect::route('user-login')->withErrors(array('Ошибка авторицации'));
        }
        if(is_null(Auth::user()->worker_id)){

            return Redirect::route('departments');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){
        return Auth::user();
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
