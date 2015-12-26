@extends('main')
@section('content')
<div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
    <!-- CONTENT HERE-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{$department->name}}, {{$department->adress}}</h3>
        </div>
        <div class="panel-body">
            <div><b>Місто: </b>{{$department->city->region_name}}</div><br/>
            <div><b>Адресса: </b>{{$department->adress}}</div><br/>
            <div><b>Телефон: </b>{{$department->phone}}</div><br/>
            <div><b>Обмеження: </b> До {{$department->weight_limit}} кг.</div><br/>
            <h3>Працівники</h3>
            <div class="panel panel-default">
                <div class="panel-body">
                    @foreach($department->workers as $worker)
                    <div>
                        <span class="glyphicon glyphicon-user"> {{ $worker->fio}}</span>
                        <a href="/worker/destroy/{{$worker->id}}" class="pull-right">Уволить</a>
                    </div><br/>
                    @endforeach
                </div>
            </div>
            <h3>Доходи отделения</h3>
            <div>
                <canvas height="595" style="width: 860px; height: 595px;" id="canvas" width="860"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

    var barChartData = {
        labels : {!! $months !!},
        datasets : [
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,0.8)",
                highlightFill : "rgba(151,187,205,0.75)",
                highlightStroke : "rgba(151,187,205,1)",
                data :{!! $money !!}
            }
        ]

    }
    window.onload = function(){
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive : true
        });
    }

</script>
@endsection