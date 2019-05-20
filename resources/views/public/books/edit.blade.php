@extends('layouts.app')

@section('title', 'Update book')

@section('content')
<h1>Edit Book</h1>
<form action="/books/{{ $book->id }}" data-book="{{ $book->id }}" method="post" id="formularioEditar" enctype="multipart/form-data" novalidate>

    @csrf
    @method('patch')

    @include('public.books.partials.form')

    <button type="submit" class="btn btn-primary">Update Book</button>
</form>
@endsection
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush
