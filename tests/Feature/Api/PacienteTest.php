<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class PacienteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function can_get_all_pacientes()
    {
        $token = $this->user_login();
        $response = $this->json('GET', 'api/auth/paciente/show', [   
                            'Accept' => 'application/json',
                            'AUTHORIZATION' => 'Bearer ' . $token
                        ])
                        ->assertStatus(200);
                        // ->assertJsonStructure([
                        //     [
                        //         'pac_nome', 'pac_dataNascimento'
                        //     ],
                        // ]);

    }

    /** @test */
    public function can_create_paciente()
    {
        $token = $this->user_login();
        $client = [
            'pac_nome'     =>  'Carlos Roberto dos Teste',
            'pac_dataNascimento'    =>  '16/07/1989',
        ];
        $response = $this->json('POST', 'api/auth/paciente/store', $client , [   
                            'Accept' => 'application/json',
                            'AUTHORIZATION' => 'Bearer ' . $token
                        ])
                        ->assertStatus(200);
    }

    //função somente para pegar token jwt
    public function user_login()
    {
        $userData = [
            "email" => "frankley@gmail.com",
            "password" => "12345678",
        ];

        $response = $this->json('POST', 'api/auth/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
            ]);
        return $response['access_token'];
    }
}
