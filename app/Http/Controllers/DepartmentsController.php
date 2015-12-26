<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return View::make('department.all',['title'=>'Отделения']);
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
        $moneyPerMonth = DB::select('CALL department_money_per_month_statistic(?)',array($id));
        $months = array();
        $monthsSet = array('January','February',
            'March','April','May','June','July','August','September','October',
            'November','December');
        #$values = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $values = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($moneyPerMonth as $stat){
            $values[array_search($stat->month,$monthsSet)]=$stat->value;
        };
        #return json_encode($months);
        $dept = Department::find($id);
        $workers = $dept->workers();
        $objMoney = json_encode($values);
        $obMonth = json_encode($monthsSet);
        return View::make('department.detail',['department'=>$dept,'workers'=>$workers,'months'=>$obMonth,'money'=>$objMoney,'category'=>4]);
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
