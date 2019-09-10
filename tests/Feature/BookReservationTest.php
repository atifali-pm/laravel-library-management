<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'  => 'A cool title of the book',
            'author' => 'An author of the book',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

    }

    /** @test */
    public function a_title_is_required()
    {
        //$this->withoutExceptionHandling();
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
        $this->withoutExceptionHandling();

        $this->post('/books', ['title' => 'Book title', 'author' => 'Book author']);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, ['title' => 'A new title', 'author' => 'A new author']);

        $response->assertOk();

        $this->assertEquals('A new title', Book::first()->title);
        $this->assertEquals('A new author', Book::first()->author);
    }

}
