<?php

use Illuminate\Http\Response as HttpResponse;

class SmokeTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->prepareDbForTests();
        $this->credentials = ['email' => "admin@example.com", 'password' => "admin"];
    }

    /**
     * Test for unauthorised access
     */
    public function testUnauthenticated()
    {
        $response = $this->call('GET', '/api/dogs');
        $this->seeJson(['error' => 'token_not_provided']);
        $this->assertEquals(HttpResponse::HTTP_BAD_REQUEST, $response->status());
    }

    /**
     * @return array
     */
    public function protectedUrls()
    {
        return [
            ['POST', '/api/dogs', [], HttpResponse::HTTP_UNPROCESSABLE_ENTITY],
            ['POST', '/api/dogs', ['name' => 'test', 'age' => 5], HttpResponse::HTTP_OK],
            ['GET', '/api/dogs', [], HttpResponse::HTTP_OK],
            ['GET', '/api/dogs/61', [], HttpResponse::HTTP_INTERNAL_SERVER_ERROR],
            ['GET', '/api/dogs/1', [], HttpResponse::HTTP_OK],
            ['DELETE', '/api/dogs/1', [], HttpResponse::HTTP_OK],
            ['PUT', '/api/dogs/1', [], HttpResponse::HTTP_UNPROCESSABLE_ENTITY],
            ['PUT', '/api/dogs/1', ['name' => 'test', 'age' => 5], HttpResponse::HTTP_OK],
        ];
    }

    /**
     * @param string $method
     * @param string $url
     * @param string $status
     *
     * @dataProvider protectedUrls
     */
    public function testProtectedUrls($method, $url, $parameters, $status)
    {
        $response = $this->call('POST', '/api/login', $this->credentials);
        $responseContent = json_decode($response->content());
        $token = $responseContent->token;
        $response = $this->call(
            $method,
            $url,
            $parameters,
            [], //cookies
            [], //files
            ['HTTP_Authorization' => 'Bearer ' . $token], // server
            []
        );
        $this->assertEquals($status, $response->status());
    }

    public function testLogin()
    {
        $response = $this->call('POST', '/api/login', $this->credentials);
        $this->assertEquals(HttpResponse::HTTP_OK, $response->status());
    }

}