@extends('main')
@section('content')
    <div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
        <!-- CONTENT HERE-->
        <h1 class="page-header">Регистрация посилки</h1>
        <div class="panel panel-default">
            <div class="panel-body">
        <form action="$" method="post">
            <div class="col-md-5" id="senderInfo">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Інформація про відправника</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label" for="sender_name">Назва фірми або П.І.Б особи:</label>
                            <div>
                                <input type="text" name="sender_name" class="form-control" id="sender_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="senderPhone">Телефон:</label>
                            <div>
                                <input type="text" name="sender_phone" class="form-control" id="senderPhone">
                            </div>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="payer" value="1">Плательщик</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 " id="receiverInfo">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Інформація про отримувача</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label" for="receiverCity">Місто:</label>
                            <div>
                                <input type="text" name="department_city" class="form-control" id="receiverCity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="receiverName">Назва фірми або П.І.Б особи:</label>
                            <div>
                                <input type="text" name="receiver_name" class="form-control" id="receiverName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="receiverName">Філія одержувач:</label>
                            <div>
                                <input type="text" name="receiver_department" class="form-control" id="receiverName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="receiverPhone">Телефон:</label>
                            <div>
                                <input type="text" name="receiver_phone" class="form-control" id="receiverPhone">
                            </div>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="payer" value="2">Плательщик</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Інформація про відправлення</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Тип відправлення</h3>
                                </div>
                                <div class="panel-body">
                                    @foreach(\App\PackageType::all() as $type)
                                    <div class="radio">
                                        <label><input type="radio" name="package_type" value="{{$type->id}}">{{$type->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="receiverPhone">Вага :</label>
                                <div>
                                    <input type="number" name="weight" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Тип пакування</h3>
                                </div>
                                <div class="panel-body">
                                    @foreach(\App\PackingType::all() as $type)
                                    <div class="radio">
                                        <label><input type="radio" name="packing_type" value="{{$type->id}}">{{$type->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary btn-block">Зарегистрировать</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
    @endsection