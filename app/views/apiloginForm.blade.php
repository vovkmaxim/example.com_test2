@extends('layouts.master')
    @section('header')
    	<title>Log In</title>
    @endsection
    
    @section('content')
        <div class="container">
                {{ Form::open(array('url' => 'api-login', 'method' => 'post','class' => 'form-signin')) }}
<!--    {{ Form::open(array('class' => 'form-signin')) }}-->
        <?php 
        $redirect = '/';
            if(!empty($url)){
                $redirect = $url;
            }
         echo $url;
        ?>
        @if (!$errors->isEmpty())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        {{ Form::hidden('redirect',$redirect) }}
        {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'login')) }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholde' => 'password')) }}

        <label class="checkbox">
            {{ Form::checkbox('remember-me', 1) }} Remember me
        </label>

        {{ Form::submit('Войти', array('class' => 'btn btn-lg btn-primary btn-block')) }}

    {{ Form::close() }}
</div>
    @endsection
