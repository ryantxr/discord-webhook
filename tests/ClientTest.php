<?php

use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

// use GuzzleHttp\Psr7\Response;

/**
*  Corresponding Class to test Client class
*  @author Ryan Teixeira
*/
class ClientTest extends TestCase
{
    
    /**
     * Just check if the Client has no syntax error 
     *
     * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
     * any typo before you even use this library in a real project.
     * @test
     */
    public function smoke()
    {
        $var = new \Ryantxr\Discord\Webhook\Client('');
        $this->assertTrue(is_object($var));
        unset($var);
    }
    
    /**
     * 
     * Test to see if we can send a message
     * @test
     */
    public function can_send_message()
    {
        $channel = 'some-channel';
        $guzzleMock = $this->createMock(GuzzleHttpClientInterface::class);
        $guzzleMock
            ->expects($this->once())
            ->method('send')
            ->willReturn(new Response());
        $client = new \Ryantxr\Discord\Webhook\Client($channel, $guzzleMock);
        $response = $client->message('test');
        $this->assertEquals(200, $response['code']);
    }

}
