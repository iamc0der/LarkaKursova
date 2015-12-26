<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
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

    public function getJSONCities(){
        $query = "
select distance.id as ID, distance.region_name as REGION
from departments
inner join distance on distance.id = city_id
group by (distance.id)";
        $cities = DB::select($query);
        $obj = json_encode($cities);
        //$obj = mb_ereg_replace('"ID"','ID',$obj);
        //$obj = mb_ereg_replace('"REGION"','REGION',$obj);
        return $obj;
    }
    public function getJSONDepartments($city_id){

        $query = "
select departments.id as ID, departments.name as DEPARTMENT
from departments WHERE city_id = ?";
        $cities = DB::select($query,array($city_id));
        $obj = json_encode($cities);
        return $obj;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
       return View::make('department.new');
    }
    public function postCreate(){
        $rules = array('name'=>'required|min:6|max:100','address'=>'required|min:6|max:100',
            'weight_limit'=>'required','city_id'=>'required','phone'=>'required');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('new-department')->withErrors($validator);
        }

        $department = new Department();
        $department->name = Input::get('name');
        $department->phone = Input::get('phone');
        $department->adress = Input::get('address');
        $department->city_id = intval(Input::get('city_id'));
        $department->weight_limit =intval(Input::get('weight_limit'));
        $department->save();

        return Redirect::route('departments');

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
