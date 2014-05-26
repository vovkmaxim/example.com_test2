@extends('layouts.master')
    @section('header')
    	<title>Send message's</title>
    @endsection
    
    @section('content')
<div class="container">
        
        @if (!$errors->isEmpty())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    
        <div>
            
            {{ Form::open(array('url' => 'send-mail', 'files' => true)) }}
                <div>{{ Form::text('subject', null, array('class' => 'form-control', 'placeholder' => 'Subject')) }}</div><br>

                <div>{{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'You email')) }}</div><br>

                <div>{{ Form::textarea('message', null, array('class' => 'form-control', 'placeholder' => 'Message')) }}</div><br>

                {{ Form::file('file',array('class' => 'btn btn-lg btn-primary ')) }}
                <br>
                {{ Form::submit('Send...',array('class' => 'btn btn-lg btn-primary ')) }}

            {{ Form::close() }}  

        </div>
</div>    
    @endsection
