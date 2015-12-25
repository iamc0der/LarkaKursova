@extends('main')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @foreach(\App\Worker::all() as $worker)
            {{$worker->fio}}
        @endforeach
        @foreach(\App\Department::orderBy('city_id')->get() as $department)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$department->name}}, {{$department->adress}}</h3>
                </div>
                <div class="panel-body">
                    <div><b>Місто:</b><span> {{$department->city->region_name}}</span></div><br/>
                    <div><b>Обмеження: </b><span>До {{$department->weight_limit}}кг.</span></div><br/>
                    <div><b>Телефон: </b><span>+38-{{$department->phone}}</span></div><br/>
                    <div><b>Кількість працівників: </b><span> {{$department->workers->count()}}</span></div><br/>
                </div>
                <div class="panel-footer">
                    <a href="#{{$department->id}}" class="pull-right">Удалить</a>
                    <a href="#"><span class="glyphicon glyphicon-stats"></span></a>
                    <a href="department/{{$department->id}}"><span class="glyphicon glyphicon-info-sign"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-transfer"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-wrench"></span></a>
                </div>
            </div>
            @endforeach
    </div>
@endsection