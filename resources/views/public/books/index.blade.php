@extends('layouts.app')

@section('title', 'About IBDB')

@section('content')
<h1>Book List</h1>

    @if(session('message'))
    <div class="alert alert-primary" role="alert">
            {{ session('message') }}
    </div>
    @endif

    <div class="form-row">
    <form id="searchForm">
        <div class="form-group">
            <label for="searchInput">Buscar por nombre</label>
            <input id="searchInput" class="form-control" name="searchInput" type="text">

            <label for="searchType">Filtro</label>
            <select id="searchType" class="form-control" name="searchType">
                <option value="" selected>---Author---</option>
                <option value="1">Gerard Villagómez</option>
                <option value="2">Inés Abreu</option>
                <option value="3">Berta Piña</option>
                <option value="4">Andrea Tamayo</option>
                <option value="5">Mateo Leal</option>
                
            </select>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkBox" id="searchCheck" value="1">
            <label class="form-check-label" for="searchCheck">Filtro por título</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="searchCheck2" value="2">
            <label class="form-check-label" for="searchCheck2">Filtro por descripción</label>
        </div> 

        <!--Botón del filtro de búsqueda-->
        <button id="botonBusqueda" class="btn btn-primary" type="submit">Buscar
            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </form>
</div>

<div id="mostrarBusqueda">
  
</div>

    
    @forelse($books as $book)
    <div id="libro{{ $book->id }}" class="book-card card mb-2">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <img class="img-fluid" src="{{ $book->cover }}" alt="">
                </div>
                <div class="col">
                    <h5 class="card-title">User: <a href="{{ route('userbooks.index', $book->user->slug) }}" title="{{ $book->user->name }}'s book list">{{ $book->user->name }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ str_plural("Author", $book->authors->count())}}: {{ $book->authors->pluck('name')->implode(', ') }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Publisher: {{ $book->publisher->name }}</h6>
                    <p class="card-text">{{ str_limit($book->description, 300) }}</p>

                    @include('public.books.partials.buttons')

                    <a href="/books/{{ $book->slug }}" data-accion='show' data-book="{{ $book->id }}" class="btn btn-primary btn-sm mr-2 float-right">More Info</a>
                </div>
            </div>
      </div>
    </div>
    @empty
      <p>No hay libros</p>
    @endforelse
        
    {{-- MODAL CONFIRMAR BORRAR --}}
    <div class="modal" data-accion="eliminar" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro que desea eliminar el libro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type="button" id="confirmarEliminar" data-elemento-borrar="" class="btn btn-primary">SI</button>
      </div>
    </div>
  </div>
</div>

  {{-- MODAL MOSTRAR INFORMACIÓN --}}
  <div class="modal" id="modalShow" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información del libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="info">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

{{-- SPINNER --}}
<div class="spinner-border" id="spinner" role="status">
        <span class="sr-only">Loading...</span>
</div>

{{-- MODAL PAGINAR --}}



@endsection
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
    <script src="{{ mix('/js/paginate/paginate.js') }}" defer></script>
@endpush