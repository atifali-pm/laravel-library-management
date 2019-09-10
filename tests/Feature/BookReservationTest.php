<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_added_to_library()
    {
        $response = $this->post('/books', [
            'title' => 'A cool title of the book',
            'author' => 'An author of the boook'
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

        $response->assertStatus(200);
    }
}
