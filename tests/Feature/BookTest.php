<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Str;
use App\Enums\UserTypeEnum;

class BookTest extends TestCase
{
    public function test_user_register(): void
    {
        $response = $this->postJson(
            '/api/auth/register',
            [
                'name' => 'test3',
                'email' => 'test3@gmail.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'user_type' => UserTypeEnum::Manager,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_user_login(): void
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'test3@gmail.com',
                'password' => 'password',
            ]
        );

        $response->assertStatus(200);
    }

    public function test_get_books(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            []
        );
        $response = $this->get('/api/v1/books');

        $response->assertStatus(200);
    }

    public function test_create_book(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->postJson(
            '/api/v1/books',
            [
                'title' => Str::random(10),
                'description' => Str::random(50),
                'publisher' => Str::random(10),
                'author' => Str::random(10),
                'price' => 20,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_update_book(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->putJson(
            '/api/v1/books/1',
            [
                'title' => Str::random(10),
                'description' => Str::random(50),
                'publisher' => Str::random(10),
                'author' => Str::random(10),
                'price' => 20,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_borrow_book(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->postJson(
            '/api/v1/book/borrow',
            [
                'book_id' => 1,
            ]
        );

        $response->assertStatus(200);
    }

    public function test_delete_book(): void
    {
        Passport::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->delete('/api/v1/books/2');

        $response->assertStatus(200);
    }
}
