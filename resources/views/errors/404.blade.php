@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('button')
<a class="btn btn-info btn-lg" href="{{ route('home') }}">Back to Home</a>
@endsection
