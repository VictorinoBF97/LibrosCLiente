@component('mail::message')
# New Book: {{ $book->title }}

{{ $book->description }}
@component('mail::button', ['url' => url('/books/'. $book->slug)])
Book Info
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
