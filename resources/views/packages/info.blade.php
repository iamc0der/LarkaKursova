@extends('main')
@section('content')
<div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
    <!-- CONTENT HERE-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Посилка №{{$package->ttn}}</h3>
        </div>
        <div class="panel-body">
            <div><b>Зареєстровано:</b> <span>{{$package->registred_at}}</span></div><br/>
            <div><b>Орієнтована дата прибуття:</b> <span>2015-12-16</span></div><br/>
            <div><b>Інспектор:</b> <span>{{$package->inspector->fio}}</span></div><br/>
            <div><b>Статус:</b>{{$package->package_status}}</div></br>
            <div><b>Вага:</b> <span>{{$package->weight}} Кг.</span></div><br/>
            <div><b>Вартість доставки:</b> <span>{{$package->shipping_cost}}</span></div><br/>
            <div><b>Платник:</b> <span>{{$package->payer}}</span></div><br/>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Информация про отправителя</h3>
                </div>
                <div class="panel-body">
                    <div><span class="glyphicon glyphicon-user"></span>{{$package->sender->name}}</div><br/>
                    <div><span class="glyphicon glyphicon-earphone"></span> +380-{{$package->sender->phone}}</div><br/>
                    <div>
                        <span class="glyphicon glyphicon-map-marker"></span>
                        {{$package->senderDepartment->city->region_name}}
                    </div><br/>
                    <div>
                        {{$package->senderDepartment->name}}, {{$package->senderDepartment->adress}}</div><br/>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Информация про получателя</h3>
                </div>
                <div class="panel-body">
                    <div><span class="glyphicon glyphicon-user"></span>{{$package->receiver->name}}</div><br/>
                    <div><span class="glyphicon glyphicon-earphone"></span> +380-{{$package->receiver->phone}}</div><br/>
                    <div>
                        <span class="glyphicon glyphicon-map-marker"></span>
                        {{$package->receiverDepartment->city->region_name}}
                    </div><br/>
                    <div><span></span>{{$package->receiverDepartment->name}},
                        {{$package->receiverDepartment->adress}}</div><br/>
                </div>
            </div>
        </div>
        <div class="panel-footer"><button id="report" onclick="disp()"><span class="glyphicon glyphicon-print"></span></button></div>
    </div>
    <!--END CONTENT-->
</div>
    <script>
        function disp(){
            var reportTemplate = "<body>" +
                "<span><b><h1>Накладна № {!! $package->ttn !!}</h1></b></span><hr/>" +
                "<span><b>Зарегистрировано: </b> {!! $package->registred_at !!}</span><br/>" +
                "<span><b>Сотрудник: </b> {!! $package->inspector->fio !!}</span><br/>" +
                "<span><b>Вес: </b> {!! $package->weight !!}</span><br/>" +
                "<span><b>Стоимость доставки: </b> {!! $package->shipping_cost !!}</span><br/>" +
                "<span><b><h2>Информация отправителя</h2></b></span><hr/>" +
                "<span><b>ФИО: </b> {!! $package->sender->name !!}</span><br/>" +
                "<span><b>Телефон: </b> {!! $package->sender->phone !!}</span><br/>" +
                "<span><b>Город: </b> {!! $package->senderDepartment->city->region_name !!}</span><br/>" +
                "<span><b>Отделение: </b> {!! $package->senderDepartment->name !!},{!! $package->senderDepartment->adress !!}</span><br/>" +
                "<span><b><h2>Информация получателя</h2></b></span><hr/>" +
                "<span><b>ФИО: </b> {!! $package->receiver->name !!}</span><br/>" +
                "<span><b>Телефон: </b> {!! $package->receiver->phone !!}</span><br/>" +
                "<span><b>Город: </b> {!! $package->receiverDepartment->city->region_name !!}</span><br/>" +
                "<span><b>Отделение: </b>{!! $package->receiverDepartment->name !!},{!! $package->receiverDepartment->adress !!}</span><br/>" +
            "</body>";



            var opened = window.open("");
            opened.document.write(reportTemplate);
            opened.print();
            opened.close();
        }
    </script>
@endsection