@extends('layouts.master')
    @section('header')
    	<title>Image upload</title>
    @endsection
    
    @section('content')
<div class="container">
    
    
    <?php
    $str = "";
    foreach ($images as $imag){
        $str .= Form::open(array('url' => 'delete-image', 'files' => true)).
                '<img alt="Laravel" src="http://example.com/uploads/images/original/'
                .$imag.'" width="100" height="111">  '
                .Form::hidden('image-name',$imag)
                .Form::submit('delete',array('class' => 'btn  '))
                .Form::close();
    }
    print_r("<pre>");
    echo $str;
    print_r("<pre>");
    
    ?>
    
        @if (!$errors->isEmpty())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        @if($imageCount)
        {{ Form::open(array('url' => 'upload-image', 'files' => true)) }}
        
            {{ Form::text('title') }}
            
            {{ Form::file('image') }}
            
            {{ Form::submit('Upload',array('class' => 'btn btn-lg btn-primary ')) }}
            
        {{ Form::close() }}
        @endif
    @endsection
</div>