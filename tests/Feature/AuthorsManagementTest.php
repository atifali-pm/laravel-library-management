<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorsManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/author', ['name' => 'Atif', 'dob' => '07/13/1981']);


        $response->assertOk();

        $this->assertCount(1, Author::all());

        $this->assertInstanceOf(Carbon::class, Author::first()->dob);
        $this->assertEquals('1981/13/07', Author::first()->dob->format('Y/d/m'));
    }
}
