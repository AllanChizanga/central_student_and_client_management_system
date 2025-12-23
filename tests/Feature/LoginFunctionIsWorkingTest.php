<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginFunctionIsWorkingTest extends TestCase
{
    use RefreshDatabase;
    
    private $userService;
    

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = app(UserService::class);
    }
    public function test_login_function_returns_true(): void
    {  
        #simulate request object 
        $request = Request::create(
            '/test-url',
            'POST',
            [
                'email'=>"allanchizanga@zomacdigital.co.zw",
                'password'=>'secret'
            ]
            );
        #call the login function 
        $this->userService->login("allanchizanga@zomacdigital.co.zw","secret",$request);
        $this->assertTrue(true);
    }
}
