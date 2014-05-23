@extends('layouts.master')
    @section('header')
    	<title>Serch News</title>
    @endsection

    @section('content')
    
    
    
    @if (!$errors->isEmpty())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
        @endif
        <div>
        {{ Form::open(array('url' => 'api-search-news', 'method' => 'post','name'=>'search','class'=>'form-inline form-search pull-left')) }}
        {{ Form::text('text_search',NULL,array('class' => 'form-control','id'=>'searchInput','placeholder'=>'Text search news')) }}
        {{ Form::submit('Search News',array('type'=>'button','class' => 'btn btn-primary')) }}  
        {{ Form::close() }}
        </div>
    @endsection
