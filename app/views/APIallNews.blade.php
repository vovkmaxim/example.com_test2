@extends('layouts.master')
    @section('header')
        <title>news List</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    @endsection    
    @section('content')
    <h3>Hello its News list</h3><br>

    <div class="container">
            <div class="row">
                @foreach($news as $item)
                <div>
                    <table  width="800px" align="canter">
                        <tr  class="text-success"><a href="http://example.com/api-one-news/{{$item->id}}" ><h4>{{$item->title}}</h4></a></tr>
                    <tr>
                        <td>{{$item->description}}</td>
                    </tr>
                    <tr>
                        <td align="right"><p class="text-success"><em>{{$item->author}}</em></p></td>
                    </tr>
                    <tr>
                        <td align="right"><a href="http://example.com/api-delete-news/{{$item->id}}" >DELETE</a></td>
                    </tr>
                    <tr>
                        <td align="right"><a href="http://example.com/api-change-news/{{$item->id}}" >CHANGE NEWS</a></td>
                    </tr>
                        
                    </table>      
                </div>
<!--                    <table border="3px" width="800px" align="canter">
                        <tr><td colspan="2" align="center"><a href="http://example.com/api-one-news/{{$item->id}}" >Read more this news(API)</a></td></tr> 
                        <tr><td colspan="2" align="center"><a href="http://example.com/api-delete-news/{{$item->id}}" >DELETE this news(API)</a></td></tr>  
                        <tr><td colspan="2" align="center"><a href="http://example.com/api-change-news/{{$item->id}}" > API - - CHANGE News</a></td></tr> 
                        <tr><td>News titled</td><td>{{$item->title}}</td></tr> 
                        <tr><td>News description's</td><td>{{$item->description}}</td></tr> 
                        <tr><td>News author</td><td>{{$item->author}}</td></tr> 
                    </table>    -->
                @endforeach
            </div>
    </div>
    @endsection