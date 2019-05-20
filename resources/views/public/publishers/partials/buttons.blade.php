@auth
<a href="/publishers/{{ $publisher->id }}/edit" class="btn btn-warning btn-sm mr-2 float-right">Edit</a>
<form action="/publishers/{{ $publisher->id }}" method="post" class="mr-2 float-right">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm">Delete Publiser</button>
</form>
@endauth
