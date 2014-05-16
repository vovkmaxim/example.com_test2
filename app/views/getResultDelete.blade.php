@extends('layouts.master')
    @section('content')
        @if ($success)
            <div class="alert alert-danger"> {{ $message }} </div>
        @endif
        @if (!$success && !empty($message) )
            <div class="alert alert-danger"> {{ $message }} </div>
        @endif    	
    @endsection 