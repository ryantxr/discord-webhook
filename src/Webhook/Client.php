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

	public function __construct($arg)
	{
		if ( is_string($arg) ) {
			$this->url = $arg;
		} elseif ( is_array($arg) ) {
			$this->url = $arg['url'] ?? null;
			$this->username = $arg['username'] ?? null;
			$this->avatar = $arg['avatar'] ?? null;
		}
	}

	/**
	 * message
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
	 * message
	 *
	 * @param Ryantxr\Discord\Webhook\Embed $arg
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
	 * post
	 *
	 * 
	 * 
	 *
	 * @param string $message the message to send
	 *
	 * @return string
	 */
	protected function post($data)
	{
		$client = new Guzzle;
		
		
		if ( is_string($data) ) {
			$request = new Request('POST', $this->url);
			$response = $client->send($request, [
				'json' => [
					'content' => $data
					]
					]);
		} elseif ( is_array($data) ) {
			$request = new Request('POST', $this->url, ['Content-Type' => 'application/json']);
			print_r($data);
			$response = $client->send($request, [
			'json' => $data
			]);
		}

		$code = $response->getStatusCode(); // 200
		$reason = $response->getReasonPhrase(); // OK
		$body = $response->getBody();

		// echo "code = $code\n";
		// echo "reason = $reason\n";
		// echo "body = $body\n";
		return compact('code', 'body', 'reason');
	}
}