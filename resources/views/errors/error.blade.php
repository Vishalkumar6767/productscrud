@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="error-title">Error</h4>
    <ul class="error-list">
        @foreach($errors as $error)
            <li class="error-item">{{ $error }}</li>
        @endforeach
    </ul>
    <a href="{{ url()->previous() }}" class="btn btn-primary error-btn">Go Back</a>
</div>
@endsection
@php
   
    $isErrorPage = true;
@endphp