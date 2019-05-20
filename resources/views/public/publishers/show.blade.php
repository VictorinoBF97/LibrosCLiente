@extends('layouts.app')

@section('title', 'Publisher Info')

@section('content')
    <h2>{{ $publisher->name }}</h2>
    <h4>{{ $publisher->email }}</h4>
    <h4>{{ $publisher->url }}</h4>
    <p>{{ $publisher->address }}</p>

    @include('public.publishers.partials.buttons')
    
@endsection
