@extends('layouts.app')

@section('title', 'Book Info')

@section('content')
    <div class="row">
        @if( $book->cover )
        <div class="col-3">
                <img class="img-fluid" src="http://ibdb.test/storage/{{ $book->cover }}" alt="">
        </div>
        @endif
        <div class="col">
                <h2>{{ $book->title }}</h2>
                <h4>{{ str_plural("Author", $book->authors->count())}}: {{ $book->authors->pluck('name')->implode(', ') }}</h4>
                <h4>Publisher: {{ $book->publisher->name }}</h4>
                <p>{{ $book->description }}</p>
            
                @include('public.books.partials.buttons')
        </div>
    </div>
    

@endsection
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush