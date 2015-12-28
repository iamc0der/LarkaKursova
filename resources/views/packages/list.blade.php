@extends('main')
@section('content')
    <div class="col-sm-8 col-sm-offset-3 col-md-9 col-md-offset-2 main">
        <!-- CONTENT HERE-->
        @foreach($packages as $package)
        <div class="panel panel-default">
            <div class="panel-body">
                <div><b>Відправлення №: </b><a href="/package/{{$package->ttn}}">{{$package->ttn}}</a></div><br/>
                <div><b>  Відділення відправник:</b>{{$package->senderDepartment->city->region_name}},
                {{$package->senderDepartment->name, $package->senderDepartment->adress }}</div><br/>
                <div><b>  Отримувач:</b> {{$package->sender->name, $package->sender->name}}
                    <a title="Видать посилку" href=""><span class="glyphicon glyphicon-check pull-right"></span></a>
                </div>
            </div>
        </div>
        @endforeach
        <!--END CONTENT-->
    </div>
 @endsection