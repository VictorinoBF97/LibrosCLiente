@extends('layouts.app')

@section('title', 'About IBDB')

@section('content')
<h1>Publisher List</h1>

    <div class="d-flex justify-content-center">
        {{ $publishers->links() }}
    </div>

    @forelse($publishers as $publisher)
    <div class="card mb-2">
        <div class="card-header">
            {{ $publisher->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $publisher->url }}</h5>
            <h5 class="card-title">{{ $publisher->email }}</h5>
            <p class="card-text">{{ $publisher->address }}</p>

            @include('public.publishers.partials.buttons')

            <a href="/publishers/{{ $publisher->slug }}" class="btn btn-primary btn-sm mr-2 float-right">More Info</a>
      </div>
    </div>
    @empty
      <p>No hay libros</p>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $publishers->links() }}
    </div>
@endsection
