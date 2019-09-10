<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        Book::create($this->getValidate());
    }

    public function update(Book $book)
    {
        $book->update($this->getValidate());

    }

    /**
     * @return mixed
     */
    protected function getValidate()
    {
        return \request()->validate(
            [
                'title'  => 'required',
                'author' => 'required',
            ]
        );
    }

}
