@extends('layouts.app')

@section('title', 'New Publisher')

@section('content')
<h1>Add New Publisher</h1>
<form action="/publishers" method="post" novalidate>

    @csrf

    @include('public.publishers.partials.form')

    <button type="submit" class="btn btn-primary">Save Publisher</button>
</form>
@endsection

@push('scripts')

       <script src="{{ mix('/js/validaciones/validacionEditorial.js') }}" defer ></script>

@endpush
