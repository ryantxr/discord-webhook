# Discord Webhook

This library provides a client for Discord Webhooks. With minimal code, you should be able to send a message to a Discord channel.

If you need to do more, like embeds and formatting, then you can do that too.

## Motivation

I looked at other libraries and they have been around for a long time. Credit to them for supporting embeds and some neat functionality. However, I didn't see a way to just send a message with a single line of code.
All I want to do is send a single text message to a channel.

This library is compatible with service containers.

## Getting Started

You can either copy the PHP files directly into your project or preferable just use composer.

Composer require command

`composer require ryantxr/discord-webhooks`

## Features

* Minimal code to send a message
* Compatible with service containers
* Unit-Testing with PHPUnit
* Easy to use to any framework or even a plain php file

## Usage

```php
<?php

use Ryantxr\Discord\Webhook\Client as Webhook;

$webhook = new Webhook( 'YOUR_DISCORD_WEBHOOK_URL' );
$webhook->message('This is a message');

```

## Embeds

Discord has ways to make more interesting posts using Embeds.

```php
use Ryantxr\Discord\Webhook\Client as Webhook;
use Ryantxr\Discord\Webhook\Embed;

// Get this from some config
$webhookConfig = [
    'url'   => 'YOUR_DISCORD_WEBHOOK_URL',
    'username'      => 'funnybot',
    'avatar'        => 'https://pbs.twimg.com/media/C51iiP9UYAIPpWP.png',


    ];
$webhook = new Webhook( $webhookConfig );

$embed = new Embed('SOME_URL_YOU_WANT');
$embed->title('This is a title')
            ->author('Justin', 'https://authors-website.com', 'https://discordapp.com/assets/28174a34e77bb5e5310ced9f95cb480b.png')
            ->field('Field 1', 'Some cool text', true )
            ->field('Field 2', 'Another cool text', true )
            ->color(15158332)
            ;

$webhook->send($embed, "A message goes here.");

```

Here's the official color list to colorize your embeds:

```javascript
DEFAULT: 0,
AQUA: 1752220,
GREEN: 3066993,
BLUE: 3447003,
PURPLE: 10181046,
GOLD: 15844367,
ORANGE: 15105570,
RED: 15158332,
GREY: 9807270,
DARKER_GREY: 8359053,
NAVY: 3426654,
DARK_AQUA: 1146986,
DARK_GREEN: 2067276,
DARK_BLUE: 2123412,
DARK_PURPLE: 7419530,
DARK_GOLD: 12745742,
DARK_ORANGE: 11027200,
DARK_RED: 10038562,
DARK_GREY: 9936031,
LIGHT_GREY: 12370112,
DARK_NAVY: 2899536
```
