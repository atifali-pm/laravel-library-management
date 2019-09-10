<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_library()
    {
        $response = $this->post('/books', [
            'title'  => 'A cool title of the book',
            'author' => 'An author of the book',
        ]);

        $this->assertCount(1, Book::all());
        $response->assertRedirect('/books');

    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books',
                                [
                                    'title'  => '',
                                    'author' => 'A good author',
                                ]
        );
        $response->assertSessionHasErrors('title');

    }

    /** @test */
    public function an_author_is_required()
    {
        $response = $this->post('/books',
                                [
                                    'title'  => 'A nice title',
                                    'author' => '',
                                ]
        );

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->post('/books', ['title' => 'Book title', 'author' => 'Book author']);

        $book = Book::first();

        $response = $this->patch($book->path(), ['title' => 'A new title', 'author' => 'A new author']);

        $this->assertEquals('A new title', Book::first()->title);
        $this->assertEquals('A new author', Book::first()->author);
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_removed()
    {
        $this->post('/books', ['title' => 'A sample title', 'author' => 'A sample author']);

        $book = Book::first();

        $this->assertCount(1, Book::all());
        $this->assertEquals('A sample title', $book->title);

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');


    }

}
