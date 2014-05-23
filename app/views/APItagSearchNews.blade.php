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
        {{ Form::close() }}
        {{ Form::open(array('url' => 'api-tag-search-news', 'method' => 'post','name'=>'search','class'=>'form-inline form-search pull-left')) }}
        {{ Form::text('tag',NULL,array('class' => 'form-control','id'=>'searchInput','placeholder'=>'Tag search news')) }}
        {{ Form::submit('Search News',array('type'=>'button','class' => 'btn btn-large btn-block btn-primary')) }}
        {{ Form::close() }}
    @endsection
