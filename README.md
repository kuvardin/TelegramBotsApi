# TelegramBotsApi v.4.6
[![Total Downloads](https://poser.pugx.org/kuvardin/telegram-bots-api/downloads)](https://packagist.org/packages/kuvardin/telegram-bots-api)

SDK for latest version of Telegram bots API (from January 23, 2020)

## Using Examples
### Installing
```bash
composer require "kuvardin/telegram-bots-api: dev-master"
```

### Init bot
```php
<?php
$token = '123456:AAAAAAAAAAAAAAA';
$username = 'ExampleBot';
$bot = new TelegramBotsApi\Bot($token, $username);
```

### Sending message
```php
<?php
$token = '123456:AAAAAAAAAAAAAAA';
$username = 'ExampleBot';
$bot = new TelegramBotsApi\Bot($token, $username);

$chat_id = 123456789;
$message_text = 'Hi!';
$request = $bot->sendMessage($chat_id, $message_text);
try {
    $response = $request->sendRequest();
    echo 'Successful sent';
} catch (TelegramBotsApi\Exceptions\ApiError $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (TelegramBotsApi\Exceptions\CurlError $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Set webhooks handler
```php
<?php
$token = '123456:AAAAAAAAAAAAAAA';
$username = 'ExampleBot';
$bot = new TelegramBotsApi\Bot($token, $username);

$webhooks_handler_url = 'https://example.com/script.php';
$request = $bot->setWebhook($webhooks_handler_url);
try {
    $request->sendRequest();
    echo 'Success';
} catch (TelegramBotsApi\Exceptions\ApiError $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (TelegramBotsApi\Exceptions\CurlError $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Receive incoming updates via an outgoing webhook
```php
<?php
$token = '123456:AAAAAAAAAAAAAAA';
$username = 'ExampleBot';
$bot = new TelegramBotsApi\Bot($token, $username);

$input = file_get_contents('php://input');
if ($input === false || $input === '') {
    throw new Error('Input is empty');
}

$input_decoded = json_decode($input, true, 512, JSON_THROW_ON_ERROR);
if (!is_array($input_decoded)) {
    throw new Error("Input are not JSON array: $input");
}

$request = null;
$update = new TelegramBotsApi\Types\Update($input_decoded);

switch ($update->getAction()) {
    case TelegramBotsApi\Types\Update::ACT_MESSAGE:
        $request = $bot->sendMessage($update->message->chat->id, 'Hi!');
        break;
    
    case TelegramBotsApi\Types\Update::ACT_EDITED_MESSAGE:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_CHANNEL_POST:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_EDITED_CHANNEL_POST:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_INLINE_QUERY:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_CHOSEN_INLINE_RESULT:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_CALLBACK_QUERY:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_SHIPING_QUERY:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_PRE_CHECKOUT_QUERY:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_POLL:
        // ...
        break;

    case TelegramBotsApi\Types\Update::ACT_POLL_ANSWER:
        // ...
        break;
}

if ($request !== null) {
    header('Content-Type: application/json');
    echo json_encode($request->getRequestData(), JSON_THROW_ON_ERROR);
}
```