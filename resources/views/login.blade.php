@extends('main')
@section('login')
        @foreach($errors->all() as $error)
                <div class="errors">{{$error}}</div>
        @endforeach
<div class="container">
        {!! Form::open(array('routs'=>'user-login','class'=>'form-signin','role'=>'form')) !!}
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" name="login" placeholder="Login" required autofocus>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <label class="checkbox">
            <input type="checkbox" name ="remember"value="remember"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        {!! Form::close() !!}

</div> <!-- /container -->
@endsection