<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function store()
    {
        Book::create($this->getValidate());

        return redirect('/books');
    }

    public function update(Book $book)
    {
        $book->update($this->getValidate());

        return redirect('/books/' . $book->id);

    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
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
