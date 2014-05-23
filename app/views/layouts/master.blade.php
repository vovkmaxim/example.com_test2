<!doctype html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        
        @section('header')
        <title>General title</title>
        @show
        @section('styles')
        {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css') }}
        {{ HTML::style(URL::asset('styles/base.css')) }}
        @show
    </head>
    <body style="background-color:#FFFFF0;">
        <div class="menu">
            @section('menu')
            @include('layouts.link')
            @show
        </div>
        
        <div class="conteiner" style="margin-top: 100">
            @section('body')

            @show        
            @section('content')
            @show
        </div>
    </body>
</html>