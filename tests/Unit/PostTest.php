<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    function getHeader($token)
    {
        return array(["Authorization" => "Bearer " . $token, "content-type" => "application/x-www-form-urlencoded"]);
    }
    /**
     * Test if a connected user can get posts.
     * @test
     * @return void
     */
    public function canGetPostsIfLogged()
    {
        // Login
        $login = $this->json("POST", "/api/auth/login", ["email" => "admin@test.com", "password" => "admin"]);
        $token = $login->headers->get("authorization");

        // Get posts
        $response = $this->json("GET", "/api/posts", [], $this->getHeader($token));

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);;
    }

    /**
     * Test if a connected admin user can create post.
     * @test
     * @return void
     */
    public function canCreatePostsIfAdmin()
    {
        // Login admin
        $login = $this->json("POST", "/api/auth/login", ["email" => "admin@test.com", "password" => "admin"]);
        $token = $login->headers->get("authorization");

        // Create post
        $post = ["name" => "test post", "text" => "test post content"];

        $response = $this->json("POST", "/api/posts", $post, $this->getHeader($token));
        $new_post = json_decode($response->getContent(), true);
        $id = $new_post["post"]["_id"];

        // Delete after use
        $this->json("DELETE", "/api/posts/" . $id, [], $this->getHeader($token));

        $response
            ->assertStatus(201)
            ->assertJson([
                "status" => "success",
            ]);;
    }

    /**
     * Test if a connected admin user can delete post.
     * @test
     * @return void
     */
    public function canDeletePostsIfAdmin()
    {
        // Login admin
        $login = $this->json("POST", "/api/auth/login", ["email" => "admin@test.com", "password" => "admin"]);
        $token = $login->headers->get("authorization");

        $post = ["name" => "test post", "text" => "test post content"];

        // Create post
        $create = $this->json("POST", "/api/posts", $post, $this->getHeader($token));
        $new_post = json_decode($create->getContent(), true);
        $id = $new_post["post"]["_id"];

        // Delete post
        $response = $this->json("DELETE", "/api/posts/" . $id, [], $this->getHeader($token));

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);;
    }

    /**
     * Test if a connected admin user can update post.
     * @test
     * @return void
     */
    public function canUpdatePostsIfAdmin()
    {
        // Login admin
        $login = $this->json("POST", "/api/auth/login", ["email" => "admin@test.com", "password" => "admin"]);
        $token = $login->headers->get("authorization");

        // Create post
        $post = ["name" => "test post", "text" => "test post content"];

        $create = $this->json("POST", "/api/posts", $post, $this->getHeader($token));
        $new_post = json_decode($create->getContent(), true);
        $id = $new_post["post"]["_id"];

        // Update post
        $updated_post = ["name" => "test post updated", "text" => "test post content updated"];
        $response = $this->json("PUT", "/api/posts/" . $id, $updated_post, $this->getHeader($token));

        // Compoare updated post
        $get_new_post = $this->json("GET", "/api/posts/" . $id, [], $this->getHeader($token));
        $up_post = json_decode($get_new_post->getContent(), true);
        $new_name = $up_post["post"]["name"];
        $new_id = $up_post["post"]["_id"];

        $this->assertEquals("test post updated", $new_name);

        // Delete after use
        $this->json("DELETE", "/api/posts/" . $new_id, [], $this->getHeader($token));

        $response
            ->assertStatus(200)
            ->assertJson([
                "status" => "success",
            ]);;
    }

    /**
     * Test if a connected non-admin user cannot create post.
     * @test
     * @return void
     */
    public function cannotCreatePostsIfNotAdmin()
    {
        // Login non-admin
        $login = $this->json("POST", "/api/auth/login", ["email" => "user@test.com", "password" => "secret"]);
        $token = $login->headers->get("authorization");

        // Create new post
        $post = ["name" => "test post", "text" => "test post content"];

        $response = $this->json("POST", "/api/posts", $post, $this->getHeader($token));

        $response
            ->assertStatus(403)
            ->assertJson([
                "error" => "Unauthorized",
            ]);;
    }
}
