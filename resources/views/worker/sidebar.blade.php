<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <form class="navbar-form">
            <input type="text" class="form-control" placeholder="Search TTN">
        </form>
    </ul>
    <ul class="nav nav-sidebar">
        <li class="active"><a href="#">Регистрация отправки</a></li>
        <li><a href="#">Видача посилки</a></li>
        <li><a href="#">Статистика по отделению</a></li>
    </ul>
</div>
<script>
    $('#my_button').click(function(){
        $.get('/test', function(response, status){
            console.log(response);
        });
    });
</script>