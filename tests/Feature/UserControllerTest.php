<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    protected $registerAPI = 'api/register';
    protected $loginAPI = 'api/login';

    /**
     * Test required fields of register API.
     *
     * @return void
     */
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', $this->registerAPI, ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    /**
     * Test register API.
     *
     * @return void
     */
    public function testRegister()
    {
        $userData = [
            "name" => "Test John Doe",
            "email" => "test@example.com",
            "password" => "Simform@123"
        ];

        $this->json('POST', $this->registerAPI, $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "success",
                "data" => [
                    "token",
                    "user" => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                    ]
                ],
                "message"
            ]);
    }

    /**
     * Test required fields of login API.
     *
     * @return void
     */
    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', $this->loginAPI, ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    /**
     * Test Login API.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->testRegister();
        $userData = [
            "email" => "test@example.com",
            "password" => "Simform@123"
        ];

        $this->json('POST', $this->loginAPI, $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "success",
                "data" => [
                    "token",
                    "user" => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                    ]
                ],
                "message"
            ]);
    }
}
