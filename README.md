# TelegramBotsApi v.6.2
[![Total Downloads](https://poser.pugx.org/kuvardin/telegram-bots-api/downloads)](https://packagist.org/packages/kuvardin/telegram-bots-api)

SDK for latest version of Telegram bots API (from August 12, 2022)

## Using Examples
### Installing
```bash
composer require "kuvardin/telegram-bots-api: dev-master"
```

### Init bot
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = '123456:AAAAAAAAAAAAAAA';
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);
```

### Sending message
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = '123456:AAAAAAAAAAAAAAA';
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);

$chat_id = 123456789;
$message_text = 'Hi!';
$request = $bot->sendMessage($chat_id, $message_text);

try {
    $message = $request->sendRequest();
    echo 'Successful sent';
} catch (Kuvardin\TelegramBotsApi\Exceptions\ApiError $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (Kuvardin\TelegramBotsApi\Exceptions\CurlError $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Set webhooks handler
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = '123456:AAAAAAAAAAAAAAA';
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);

$webhooks_handler_url = 'https://example.com/script.php';
$request = $bot->setWebhook($webhooks_handler_url);

try {
    $request->sendRequest();
    echo 'Success';
} catch (Kuvardin\TelegramBotsApi\Exceptions\ApiError $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (Kuvardin\TelegramBotsApi\Exceptions\CurlError $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Receive incoming updates via an outgoing webhook
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = '123456:AAAAAAAAAAAAAAA';
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);

$input = file_get_contents('php://input');
if ($input === false || $input === '') {
    throw new Error('Input is empty');
}

$input_decoded = json_decode($input, true, 512, JSON_THROW_ON_ERROR);
if (!is_array($input_decoded)) {
    throw new Error("Input are not JSON array: $input");
}

$request = null;
$update = new Kuvardin\TelegramBotsApi\Types\Update($input_decoded);

switch ($update->type) {
    case Kuvardin\TelegramBotsApi\Enums\Message:
        $request = $bot->sendMessage($update->message->chat->id, 'Hi!');
        break;
    
    case Kuvardin\TelegramBotsApi\Enums\EditedMessage:
        // ...
        break;

    case case Kuvardin\TelegramBotsApi\Enums\ChannelPost:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\EditedChannelPost:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\InlineQuery:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\ChosenInlineResult:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\CallbackQuery:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\ShippingQuery:
        // ...
        break;
    
    // ...
}

if ($request !== null) {
    header('Content-Type: application/json');
    echo json_encode($request->getRequestData(), JSON_THROW_ON_ERROR);
}
```