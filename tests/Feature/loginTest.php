<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class loginTest extends TestCase
{
    //會刷新/清空整個db
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testLogin()
    {
        $user = factory(User::class)->create();
        // dd($user);
        $response = $this->post('api/loginToken',['name'=>$user->name,'password'=>$user->password ]);
        // $response ->dump(); 
        // $this->addToAssertionCount($response);
        // $this->assertNull($response);
        // $response->assertSuccessful();
        $response->assertStatus(200);	
    }
}
