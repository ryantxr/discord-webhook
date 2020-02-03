<?php
require __DIR__.'/../vendor/autoload.php';

use Ryantxr\Discord\Webhook\Client;
use Ryantxr\Discord\Webhook\Embed;


class ExampleApp2
{

    public function __construct($config)
    {
        $this->config = $config['webhook'];
    }

    public function run($msg)
    {
        $embed = new Embed;
        $embed->title('A new post from example')
            ->author('Justin', 'https://bdsmlr.com', 'https://discordapp.com/assets/28174a34e77bb5e5310ced9f95cb480b.png')
            ->field('Field 1', 'Some cool text', true )
            ->field('Field 2', 'Another cool text', true )
            ->color(15158332)
            ;
        $this->client()->send($embed, $msg);
        
    }
    
    public function client()
    {
        // $client = new Client('https://discordapp.com/api/webhooks/599299000599969813/8l1NaBI3R5WABJNe35PfMkfz7ARwKm7gc2ystuc78n0kqt3fJdxvvd5Bv6C6LhqX6lQK');
        $client = new Client($this->config['url']);
        return $client;
    }
}

$config = require __DIR__ . '/config.php';
if ( count($argv) > 1 ) {
    (new ExampleApp2($config))->run($argv[1]);
}