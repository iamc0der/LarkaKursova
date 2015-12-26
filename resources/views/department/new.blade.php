@extends('main')
@section('content')
    @foreach($errors->all() as $error)
        <div class="errors">{{$error}}</div>
    @endforeach
    <div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
    <h1 class="page-header">Регистрация отделения</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open() !!}
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Название</span>
                    <input type="text" name="name"class="form-control" placeholder="Отделение №">
                </div><br/>
                <select class="form-control" name="city_id" id="cities">
                    <option value="3">Житомир</option>
                </select>
                <br/>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Вулиця</span>
                    <input type="text" name="address" class="form-control" placeholder="Вулиця Т.Шевченка 12">
                </div><br/>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">Телефон</span>
                <input type="text" name="phone"class="form-control" placeholder="номер">
            </div><br/>
                <div class="col-sm-6 col-md-8">
                    <div>Ограниечение веса
                        <input type="number" name="weight_limit">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Зарегистрировать</button>
                </div>


            {!! Form::close() !!}
        </div>
    </div>
    </div>
    @endsection