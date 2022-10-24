<?php
require __DIR__.'/../vendor/autoload.php';

use Ryantxr\Discord\Webhook\Client;

class ExampleApp1
{
    public function __construct($config)
    {
        $this->config = $config['webhook'];
    }

    public function run($msg)
    {
        $this->client()->message($msg);
        
    }
    
    public function client()
    {
        $client = new Client($this->config['url']);
        return $client;
    }
}

$config = require __DIR__ . '/config.php';
if ( count($argv) > 1 ) {
    (new ExampleApp1($config))->run($argv[1]);
}