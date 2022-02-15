<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase {

    public function testShouldBlockLoginWithoutCredential() {
        $response = $this->json('POST', 'api/login');

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.']
            ]
        ]);
    }

    public function testShouldBlockLoginWrongCredential() {

        $payload = ['email' => 'admin@patient.com', 'password' => 'wrong-patient'];
        $response = $this->json('POST', 'api/login', $payload);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => ['These credentials do not match our records.'],
            ]
        ]);
    }

    public function testShouldReturnToken() {

        $payload = ['email' => 'admin@patient.com', 'password' => 'patient'];
        $response = $this->json('POST', 'api/login', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
                'api_token',
            ],
        ]);
    }

}
