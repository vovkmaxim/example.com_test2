@extends('layouts.master')
@section('header')
<title>Add new news(API)</title>
@endsection

@section('content')
@if (!$errors->isEmpty())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif

{{ Form::open(array('url' => 'api-create-news', 'method' => 'post','class'=>'form-inline form-search pull-center')) }}
<table align="center">
    <tr>
        <td> Title: </td>
        <td>{{ Form::text('title',NULL,array('class' => 'form-control','placeholder'=>'Title')) }}</td>
    </tr>
    <tr>
        <td> Author: </td>
        <td>{{ Form::text('author',NULL,array('class' => 'form-control','placeholder'=>'Author')) }}</td>
    </tr>
    <tr>
        <td> Description: </td>
        <td>{{ Form::textarea('description',NULL,array('class' => 'form-control','id'=>'searchInput','placeholder'=>'Description')) }}</td>
    </tr>
    <tr>
        <td> </td>
        <td>{{ Form::submit('CREATE NEWS',array('type'=>'button','class' => 'btn btn-primary')) }}</td>
    </tr>
</table>
{{ Form::close() }}
@endsection
