<?php

// Páginas estáticas
Route::get('/', 'PagesController@index')->name('root');
Route::get('/contact', 'PagesController@contact')->name('contact')->middleware('auth');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/profile', 'PagesController@profile')->name('profile')->middleware('auth');

// Rutas para la entidad Books
Route::resource('/books', 'BooksController');
Route::resource('/publishers', 'PublisherController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users/{user}/books', 'UserBooksController@index')->name('userbooks.index');

//JAVASCRIPT
Route::get('/miPerfil/{tab}','PagesController@miPerfil');
Route::post('/books/createAjax','BooksController@crearLibroAjax');
Route::put('/books/editAjax/{id}','BooksController@editarLibroAjax');
Route::delete('/books/deleteAjax/{id}','BooksController@eliminarLibroAjax');
Route::get('/books/showAjax/{id}','BooksController@mostrarLibroAjax');
Route::post('/books/searchAjax', 'BooksController@buscarAjax');