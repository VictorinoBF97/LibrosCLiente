<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control {{ $errors->has('title')?"is-invalid":"" }}" id="title" name="title" placeholder="Introduce el título del libro" value="{{ isset($book)?$book->title:old('title') }}" required>
            <div id="erroresTitle" class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            @if( isset($book) )
            <img class="img-fluid" src="http://ibdb.test/storage/{{ $book->cover }}" alt="">
            @endif
            <label for="cover">Cover</label>
            <input type="file" class="form-control-file mt-1 {{ $errors->has('cover')?"is-invalid":"" }}" id="cover" name="cover">
            @if( $errors->has('cover'))
            <div class="invalid-feedback">
                {{ $errors->first('cover') }}
            </div>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control {{ $errors->has('email')?"is-invalid":"" }}" id="email" name="email" placeholder="Introduce tu email" value="{{ isset($book)?$book->email:old('email') }}" required>
    <div id="erroresEmail" class="invalid-feedback">
    </div>
</div>
<div class="form-group">
    <label for="author">Author</label>
    <select class="form-control {{ $errors->has('author')?"is-invalid":"" }}" id="author" name="author[]" multiple>
        @foreach($authors as $author)
            <option value="{{ $author->id }}"
                @if( !$errors->isEmpty() )
                    {{ in_array($author->id, old('author') ?? [] )?"selected":"" }}
                @elseif( isset($book) )
                    {{ $book->authors->contains($author->id)?"selected":"" }}
                @endif
            >{{ $author->name }}</option>
        @endforeach
    </select>
    @if( $errors->has('author') )
    <div class="invalid-feedback">
        {{ $errors->first('author') }}
    </div>
    @endif
</div>


<div class="form-group">
    <div class="row d-flex align-items-end">
        <div class="col-10">
            <label for="publisher">Publisher</label>
            <select class="custom-select {{ $errors->has('publisher')?"is-invalid":"" }}" id="publisher" name="publisher">
              <option value="">NINGUNO </option>
              @foreach($publishers as $publisher)

                  <option value="{{ $publisher->id }}"
                  @if( ! $errors->isEmpty() )
                    {{-- Aquí se entra cuando hay errores de validación --}}
                    {{ old('publisher')==$publisher->id?" selected":"" }}
                  @elseif( isset($book) )
                    {{-- Aquí se entra cuando se carga el formulario de edición de libro --}}
                    {{ $publisher->id==$book->publisher_id?"selected":"" }}
                  @endif
                  >{{ $publisher->name }}</option>
              @endforeach
            </select>
            
            <div id="erroresPublisher" class="invalid-feedback">
            </div>
            
        </div>
        <div class="col-2">
            <a class="btn btn-primary" href="{{ route('publishers.create') }}" target="_blank">New Publisher</a>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control {{ $errors->has('description')?"is-invalid":"" }}" id="description" name="description" rows="10" placeholder="Book Description" required>{{ isset($book)?$book->description:old('description') }}</textarea>
    @if( $errors->has('description'))
    <div class="invalid-feedback">
        {{ $errors->first('description') }}
    </div>
    @endif
</div>
<div class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" id="customCheck">
  <label class="custom-control-label" for="customCheck">Aceptar términos y condiciones</label>

    <div id="erroresCondiciones" class="invalid-feedback">
    </div>
</div>
<br>
{{-- MODAL DE DATOS INCOMPLETOS DEL FORMULARIO --}}
<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formulario incompleto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Debe de rellenar todos los campos del formulario</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


