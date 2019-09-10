<?php

Route::post('/books', 'BooksController@store');
Route::patch('/books/{book}', 'BooksController@update');
