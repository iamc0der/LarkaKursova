@extends('main')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="filter-panel">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(array('class'=>'navbar-form navbar-left','role'=>'search')) !!}
                        <div class="form-group">
                            Город:
                            <select class="form-control" name="city" id="cities">
                                <option value="0">Все города</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Применить</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @foreach($departments as $department)
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
                    <a href="department/{{$department->id}}"><span class="glyphicon glyphicon-info-sign"></span></a>
                    <a href="worker/new/{{$department->id}}"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="/department/{{$department->id}}/edit"><span class="glyphicon glyphicon-wrench"></span></a>
                </div>
            </div>
            @endforeach
    </div>
    <script>
        function getJSONFromUrl(url){
            $.get(url, function (data, status) {
                //console.log(data);
                obj = $.parseJSON(data);//[{ID:'1',REGION:"VINITSYA"}];
                return obj;
            });
        }

        function fillSelect(selectId, data,current){
            $.each(data, function (i, item) {
                $('#'+selectId).append($('<option>', {
                    value: item.ID,
                    text : item.VALUE
                }));
            });
            $("#cities").val(current);
        }
        $(document).ready(function() {
            $.get("json_get_cities", function (data, status) {
                // console.log(getJSONFromUrl('json_get_cities'));
                citiesParams = $.parseJSON(data);//[{ID:'1',REGION:"VINITSYA"}];
                fillSelect('cities',citiesParams,{!! $selectedCity !!});
            });

            console.log("GOGG");
        });
    </script>

@endsection