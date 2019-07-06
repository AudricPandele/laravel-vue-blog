<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiAccessTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if cannot get false url.
     * @test
     * @return void
     */
    public function cannotGetFalse()
    {
        $response = $this->get("/api/falseurl");

        $response->assertStatus(404);
    }

    /**
     * Test if cannot get posts if unlogged.
     * @test
     * @return void
     */
    public function cannotGetPostsIfUnlogged()
    {
        $response = $this->get("/api/posts");

        $response
            ->assertStatus(200)
            ->assertJson([
                "error" => "Unauthorized",
            ]);
    }

    /**
     * Test if cannot get posts if unlogged.
     * @test
     * @return void
     */
    public function canRegister()
    {
        $user = [
            "name" => "test user",
            "email" => "test@test.fr",
            "password" => "abcd",
            "password_confirmation" => "abcd",
            "role" => 2
        ];

        $response = $this->json("POST", "/api/auth/register", $user);

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);

        $user = User::where("email", "=", "test@test.fr")->firstOrFail();
        if ($user) {
            $user->delete();
        }
    }

    /**
     * Test if cannot get posts if unlogged.
     * @test
     * @return void
     */
    public function canLogin()
    {
        $response = $this->json("POST", "/api/auth/login", ["email" => "admin@test.com", "password" => "admin"]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);
    }
}
