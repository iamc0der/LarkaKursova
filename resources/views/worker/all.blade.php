@extends('main')
@section('content')
    <div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
        @include('worker.filter')
        <div class="col-sm-6 col-md-8">
            <!--CONTENT HERE -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Работники</h3>
                </div>
                <div class="panel-body">
                    @foreach($workers as $worker)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> {{$worker->fio}}</h3>
                        </div>
                        <div class="panel-body">
                            <div><span class="glyphicon glyphicon-home"></span>
                                <b> Отделение: </b>
                                <a href="department/{{$worker->department->id}}">
                                    {{$worker->department->name." м.".$worker->department->city->region_name}}</a>
                            </div>
                            <br/>
                            <div>
                                <span class="glyphicon glyphicon-calendar"></span>
                                <b> Работает от : </b>{{$worker->registred_at}}</div>
                        </div>
                        <div class="panel-footer">
                            <a href="/worker/destroy/{{$worker->id}}" class="right">Уволить</a>
                        </div>
                    </div>
                     @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-star"></span>
                        Лучшие работники
                        <span class="glyphicon glyphicon-star"></span>
                    </h3>
                </div>
                <div class="panel-body">
                    @foreach($topWorkers as $top)
                    <span class="glyphicon glyphicon-user"> {{$top->name}}</span>
                    <span class="glyphicon glyphicon-book pull-right"> {{$top->packages}}</span>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
  <!--  <script>

        $(document).ready(function(){
            $.get("json_get_cities", function(data, status){
                console.log(data);
                citiesParams = data;
            });
            console.log("loaded");
            $("#cities").val("0");
            $("#departments").val("0");
        });
    </script>
    -->
    @endsection