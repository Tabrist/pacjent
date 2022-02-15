<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesTest extends TestCase {

    protected static $token = null;

    public function setUp(): void {
        parent::setUp();
        if (self::$token === null) {
            $payload = ['email' => 'admin@patient.com', 'password' => 'patient'];
            $response = json_decode($this->json('POST', 'api/login', $payload)->content(), true);
            self::$token = $response['data']['api_token'];
        }
    }

    public function testShouldReturnAllCategories() {
        $response = $this->json('GET', 'api/categories', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);
    }

    public function testShouldReturnOneCategoryItem() {
        $response = $this->json('GET', 'api/categories/1', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id', 'name', 'tests']]);
    }

    public function testShouldReturnNotFoundWhenCategoryNotExist() {
        $response = $this->json('GET', 'api/categories/999', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldNotAddNewCategoryWithoutName() {
        $payload = [];
        $response = $this->json('POST', 'api/categories', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name field is required.'],
            ]
        ]);
    }

    public function testShouldAddNewCategory() {
        $payload = ['name' => 'test category name'];
        $response = $this->json('POST', 'api/categories', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['id', 'name', 'tests']]);
    }

    public function testShouldNotEditNotExistCategory() {
        $payload = ['name' => 'test category name'];
        $response = $this->json('PUT', 'api/categories/999', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldEditExistCategory() {
        $payload = ['name' => 'test update category name'];
        $response = $this->json('PUT', 'api/categories/1', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id', 'name', 'tests']]);
    }

    public function testShouldNotDeleteNotExistCategory() {
        $response = $this->json('DELETE', 'api/categories/999', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldDeleteCategory() {
        $response = $this->json('DELETE', 'api/categories/2', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'true'
        ]);
    }

}
