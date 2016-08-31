<?php
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->prepareDbForTests();
    }

    public function testJwtAuth()
    {
        $credentials = JWTAuth::attempt(['email' => "admin@example.com", 'password' => "admin"]);
        $this->assertNotFalse($credentials);
    }
}