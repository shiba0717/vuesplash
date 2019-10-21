<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Http\Request; // ★ 追加

class RegisterApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testRegisterApiTest(){
        $data = [
            'name' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => $user->name]);
    }

//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
}
