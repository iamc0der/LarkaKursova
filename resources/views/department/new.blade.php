@extends('main')
@section('content')
    @foreach($errors->all() as $error)
        <div class="errors">{{$error}}</div>
    @endforeach
    <div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
    <h1 class="page-header">{{$formName}}</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open() !!}
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Название</span>
                    <input type="text" name="name"class="form-control"
                           placeholder="{{isset($old_name)? $old_name:'Отделение №'}}">
                </div><br/>
                <select class="form-control" name="city_id" id="cities">
                </select>
                <br/>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Вулиця</span>
                    <input type="text" name="address" class="form-control"
                           placeholder="{{isset($old_adress)? $old_adress:'Вулиця'}}">
                </div><br/>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Телефон</span>
                <input type="text" name="phone"class="form-control"
                       placeholder="{{isset($old_phone)? $old_phone:'Телефон'}}">
            </div><br/>
                <div class="col-sm-6 col-md-8">
                    <div>Ограниечение веса
                        <input type="number" name="weight_limit"
                               value="{{isset($old_weight_limit)? $old_weight_limit:0}}">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Зарегистрировать</button>
                </div>


            {!! Form::close() !!}
        </div>
    </div>
    </div>
    <script>
        function prepareSelect(selectId){
            $("#" + selectId + " option").each(function() {
                $(this).remove();
            })
        }
        function fillSelect(selectId, data,current){
            prepareSelect(selectId);
            $.each(data, function (i, item) {
                $('#'+selectId).append($('<option>', {
                    value: item.ID,
                    text : item.VALUE
                }));
            });
            $("#cities").val(current);
        }
        $(document).ready(function() {
            $.get("/json_get_all_regions", function (data, status) {
                // console.log(getJSONFromUrl('json_get_cities'));
                citiesParams = $.parseJSON(data);//[{ID:'1',REGION:"VINITSYA"}];
                fillSelect('cities',citiesParams,{{isset($old_city_id)? $old_city_id:1}});
            });
        });
    </script>
    @endsection