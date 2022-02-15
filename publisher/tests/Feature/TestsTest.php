<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestsTest extends TestCase {

    protected static $token = null;

    public function setUp(): void {
        parent::setUp();
        if (self::$token === null) {
            $payload = ['email' => 'admin@patient.com', 'password' => 'patient'];
            $response = json_decode($this->json('POST', 'api/login', $payload)->content(), true);
            self::$token = $response['data']['api_token'];
        }
    }

    public function testShouldReturnAllTests() {
        $response = $this->json('GET', 'api/tests', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);
    }

    public function testShouldReturnOneTestItem() {
        $response = $this->json('GET', 'api/tests/1', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id', 'name', 'code', 'categories']]);
    }

    public function testShouldReturnNotFoundWhenTestNotExist() {
        $response = $this->json('GET', 'api/tests/999', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldNotAddNewTestWithoutName() {
        $payload = [];
        $response = $this->json('POST', 'api/tests', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name field is required.'],
                'code' => ['The code field is required.'],
            ]
        ]);
    }

    public function testShouldAddNewTest() {
        $payload = ['name' => 'test name', 'code' => 999];
        $response = $this->json('POST', 'api/tests', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'true'
        ]);
    }

    public function testShouldNotEditNotExistTest() {
        $payload = ['name' => 'test update name', 'code' => 998];
        $response = $this->json('PUT', 'api/tests/999', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldEditExistTest() {
        $payload = ['name' => 'test update name', 'code' => 998];
        $response = $this->json('PUT', 'api/tests/1', $payload, ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'true'
        ]);
    }

    public function testShouldNotDeleteNotExistTest() {
        $response = $this->json('DELETE', 'api/tests/999', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(404);
    }

    public function testShouldDeleteCategory() {
        $response = $this->json('DELETE', 'api/tests/2', [], ['Authorization' => 'Bearer ' . self::$token]);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'true'
        ]);
    }

}
