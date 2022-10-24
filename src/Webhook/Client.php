<?php namespace Ryantxr\Discord\Webhook;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Request;

/**
 *  Discord webhook client
 *
 *  This is a client to communicate to discord using a webhook
 *
 *  @author yourname
 */
class Client
{
    /**  @var string $url webhook url */
    protected $url;
    /**  @var string $username discord username (optional) */
    protected $username;
    /**  @var string $avatar avatar url (optional) */
    protected $avatar;
    protected $client; // The guzzle client

    /**
     * Constructor
     * 
     * @param string|array $arg a webhook url string or an array with url, username, avatar
     */
    public function __construct($arg)
    {
        if ( is_string($arg) ) {
            $this->url = $arg;
        } elseif ( is_array($arg) ) {
            $this->url = $arg['url'] ?? null;
            $this->username = $arg['username'] ?? null;
            $this->avatar = $arg['avatar'] ?? null;
        }
        $this->client = new Guzzle;
    }

    /**
     * Send the message to the discord channel.
     *
     * @param string $text A string containing the message to send
     *
     * @return void
     */
    public function message($text)
    {
        $this->post($text);
    }

    /**
     * Send the embed and message to discord channel.
     *
     * @param \Ryantxr\Discord\Webhook\Embed $embed The embed object
     * @param string $message the message to send
     *
     * @return void
     */
    public function send(Embed $embed, string $message)
    {
        $arr['embeds'] = [$embed->toArray()];
        $arr['content'] = $message;
        $this->post($arr);
    }
    
    /**
     * Post to the api endpoint.
     *
     * @param mixed $data the data to send
     *
     * @return array
     */
    protected function post($data) : array
    {
        $response = null;
        if ( is_string($data) ) {
            $request = new Request('POST', $this->url);
            $params = [
                'json' => [
                    'content' => $data
                ]
            ];
            $response = $this->client->send($request, $params);
        } elseif ( is_array($data) ) {
            $request = new Request('POST', $this->url, ['Content-Type' => 'application/json']);
            // print_r($data);
            $params = [
                'json' => $data
            ];
            $response = $this->client->send($request, $params);
        }
        if ( is_object($response) ) {
            $code = $response->getStatusCode(); // 200
            $reason = $response->getReasonPhrase(); // OK
            $body = $response->getBody();
        } else {
            $code = $reason = $body = null;
        }

        // echo "code = $code\n";
        // echo "reason = $reason\n";
        // echo "body = $body\n";
        return compact('code', 'body', 'reason');
    }
}