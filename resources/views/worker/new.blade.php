@extends('main')
@section('content')
    @foreach($errors->all() as $error)
        <div class="errors">{{$error}}</div>
    @endforeach
<div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
    <!-- CONTENT HERE-->
    <h1 class="page-header">Регистрация работника</h1>
    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open() !!}
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Ф.И.О</span>
                    <input type="text" name="fio"class="form-control" placeholder="Иванов И.И">
                </div><br/>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Логин</span>
                    <input type="text" name="login"class="form-control" placeholder="Логин">
                </div><br/>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">Пароль</span>
                    <input type="password" name="password"class="form-control">
                    <input type="hidden" name="department_id" value="{{$department}}">
                </div><br/>
                <div class="col-sm-4 col-md-4">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Зарегистрировать</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!--END CONTENT-->
</div>
    @endsection