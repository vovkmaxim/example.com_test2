@extends('layouts.master')
    @section('header')
        <title>Show search News</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    @endsection    
    @section('content')
    <h3>Hello its News & Reviews list</h3><br>

    <div class="container">
        @if ($success)
            @if ($success_news)
                <h3>Its News list</h3><br>
                <div class="row">
                    @foreach($news as $item)
                    <article class="col-md-5">
                        <table border="3px" width="800px" bgcolor="#E6E6FA" align="canter">
                            <tr><td>News ID</td><td>{{$item->id}}</td></tr> 
                            <tr><td>News rubric ID</td><td>{{$item->rubric_id}}</td></tr> 
                            <tr><td>News titled</td><td>{{$item->title}}</td></tr> 
                            <tr><td>News description's</td><td>{{$item->description}}</td></tr> 
                            <tr><td>News author</td><td>{{$item->author}}</td></tr> 
                        </table>
                    </article>
                    @endforeach
                </div>
            @endif
            @if (!$success_news)
                <div class="row"> No given news for this tag!!! </div>
            @endif
            @if ($success_review)
                <h3>Its Reviews list</h3><br>
                <div class="row">
                    @foreach($review as $item)
                    <article class="col-md-5">
                        <table border="3px" width="800px" bgcolor="#E6E6FA" align="canter">
                            <tr><td>Review rubric ID</td><td>{{$item->rubric_id}}</td></tr> 
                            <tr><td>Review titled</td><td>{{$item->title}}</td></tr> 
                            <tr><td>Review description's</td><td>{{$item->description}}</td></tr> 
                            <tr><td>Review author</td><td>{{$item->author}}</td></tr> 
                        </table>
                    </article>
                    @endforeach
                </div>        
            @endif
            
            @if (!$success_review)
                <div class="row"> No given reviews for this tag!!! </div>
            @endif
            
        @endif
        @if (!$success)
            <div class="row">{{ $message }}</div>
        @endif
    </div>
    @endsection