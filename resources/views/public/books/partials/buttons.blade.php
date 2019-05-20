@auth
@can('touch', $book)
<a href="/books/{{ $book->id }}/edit" class="btn btn-warning btn-sm mr-2 float-right">Edit</a>
<form action="/books/{{ $book->id }}"  method="post" class="mr-2 float-right">
    @csrf
    @method('delete')
    <button data-accion="mostrar_modal" data-elemento="{{ $book->id }}" type="submit" class="btn btn-danger btn-sm">Delete Book</button>
</form>
@endcan
@endauth
