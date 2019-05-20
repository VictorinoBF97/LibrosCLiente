@extends('layouts.app')

@section('title', 'Profile IBDB')

@section('content')
<h1>Perfil</h1>
<!-- Boton que muestre un alert con los datos del perfil -->
<ul class="nav nav-pills mb-3" id="myTabPill" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="miPerfil" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Mi perfil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="misAmigos" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Mis amigos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="misLibros" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Mis libros</a>
  </li>
</ul>
<div class="tab-content" id="tab-content">
  <div class="tab-pane fade show active" id="tabContent" role="tabpanel" aria-labelledby="pills-home-tab">
  <button id="idAlerta" type="submit" data-dismiss="modal" aria-label="Close" class="btn btn-primary">
    Ver mis datos
    </button>
  </div>
</div>


@endsection

@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush