<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Test Page</title>
    <!-- Bootstrap core CSS -->
    {!! Html::script('js/Chart.js')  !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    <!-- Custom styles for this template -->
    {!! Html::style('css/dashboard.css') !!}
    {!! Html::style('css/signin.css') !!}
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Администрирование</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="logout">{{Auth::user()->name}} <span class="glyphicon glyphicon-log-out"></span></a></li>
                    @else
                   <li><a href="login">Войти <span class="glyphicon glyphicon-log-in"></span></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <!--SIDEBAR HERE -->
            <!--CONTENT HERE -->
        @if(isset(Auth::user()->name))
            @include('admin.sidebar')
        @endif
            @yield('login')
            @yield('content')
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

{!! Html::script('js/jquery.min.js')  !!}
{!! Html::script('js/bootstrap.min.js')  !!}
{!! Html::script('js/docs.min.js')  !!}
<script>
    function selectCategory(pos){
        $('.category' + pos).addClass("active");
        console.log(pos);
    };
    //selectCategory();
</script>
<!-- select items script
<script>

    $(document).ready(function(){
        $.get("json_get_cities", function(data, status){
            console.log(data);
            citiesParams = $.parseJSON(data);//[{ID:'1',REGION:"VINITSYA"}];
            $.each(citiesParams, function (i, item) {
                $('#cities').append($('<option>', {
                    value: item.ID,
                    text : item.REGION
                }));
            });
        });
        console.log("loaded");
        $("#cities").val("0");
        $("#departments").val("0");
    });
    $("#cities").change(function(){
        $("#departments option").each(function() {
            $(this).remove();
        });
        $('#departments').append($('<option>', {
            value: 0,
            text: 'Все отделения'
        }));
        $.get("json_get_departments/" + this.value, function(data, status){
            console.log(data);
            citiesParams = $.parseJSON(data);//[{ID:'1',REGION:"VINITSYA"}];
            $.each(citiesParams, function (i, item) {
                $('#departments').append($('<option>', {
                    value: item.ID,
                    text : item.DEPARTMENT
                }));
            });
        });
    })
</script> -->
</body>
</html>