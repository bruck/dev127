<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testSendMessage()
    {
        $data = [
	    'email' => 'alice@example.com',
	    'message' => 'Lorem Ipsum etc.',
            'widget_id' => '111',
        ];

	$response = $this->json('POST','api/newmessage',$data);
	$response->assertStatus(201);
        $response->assertJson(['status' => 'false']);
	$last_insert_id = $response->getData()->last_insert_id;
	$response->assert(is_numeric($last_insert_id));

	//test missing email
        unset($data['email']);
        $response = $this->json('POST','api/newmessage',$data);
        $response->assertStatus(400);
        $response->assertJson(['status' => 'false']);
	$response->assertJson(['message' => 'No email address provided']);

	//test invalid email
	$data['email'] = 'qwerty';
        $response = $this->json('POST','api/newmessage',$data);
        $response->assertStatus(400);
        $response->assertJson(['status' => 'false']);
	$response->assertJson(['message' => 'Invalid email address']);

	//test empty message
	unset($data['message']);
        $response = $this->json('POST','api/newmessage',$data);
        $response->assertStatus(400);
        $response->assertJson(['status' => 'false']);
	$response->assertJson(['message' => 'Empty message']);



    }
}
