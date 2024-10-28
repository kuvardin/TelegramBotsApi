# TelegramBotsApi v.7.8

[![Latest Version](https://img.shields.io/github/release/kuvardin/telegrambotsapi.svg?style=flat-square)](https://github.com/kuvardin/TelegramBotsApi/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/kuvardin/telegram-bots-api.svg?style=flat-square)](https://packagist.org/packages/kuvardin/telegram-bots-api)

SDK for latest version of Telegram bots API (from July 31, 2024)

Author: https://t.me/kuvardin

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

$token = '123456:AAAAAAAAAAAAAAA';
$chat_id = 123456789;
$message_text = 'Hi!';

$client = new GuzzleHttp\Client();
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);
$request = $bot->sendMessage($chat_id, $message_text);

try {
    $message = $request->sendRequest();
    echo 'Successful sent';
} catch (Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

```php
<?php
require 'vendor/autoload.php';

$token = '123456:AAAAAAAAAAAAAAA';
$chat_id = 123456789;

$client = new GuzzleHttp\Client();
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);
$attached_files = new Kuvardin\TelegramBotsApi\AttachedFiles();

$request = $bot->sendMediaGroup(
    chat_id: $chat_id,
    media: [
        new Kuvardin\TelegramBotsApi\Types\InputMedia\Photo(
            media: $attached_files->attachByPath('photo1.jpg'),
            caption: 'First photo',
        ),
        new Kuvardin\TelegramBotsApi\Types\InputMedia\Video(
            media: $attached_files->attachByPath('video1.mp4'),
            caption: 'First video',
        ),
        new Kuvardin\TelegramBotsApi\Types\InputMedia\Video(
            media: $attached_files->attachByPath('video2.mp4'),
            caption: 'Second video',
        ),
    ],
);

$attached_files->attachToRequest($request);

try {
    $messages = $request->sendRequest();

    foreach ($messages as $message) {
        echo "Message #{$message->message_id} successfully sent to chat with ID {$message->chat->id}\n";
    }
} catch (Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Set webhooks handler
```php
<?php
require 'vendor/autoload.php';

$token = '123456:AAAAAAAAAAAAAAA';
$webhooks_handler_url = 'https://example.com/script.php';

$client = new GuzzleHttp\Client();
$bot = new Kuvardin\TelegramBotsApi\Bot($client, $token);
$request = $bot->setWebhook($webhooks_handler_url);

try {
    $request->sendRequest();
    echo 'Success';
} catch (Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException $e) {
    echo "API error #{$e->getCode()}: {$e->getMessage()}";
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    echo "cURL error #{$e->getCode()}: {$e->getMessage()}";
}
```

### Receive incoming updates via an outgoing webhook
```php
<?php
require 'vendor/autoload.php';

$token = '123456:AAAAAAAAAAAAAAA';

$client = new GuzzleHttp\Client();
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

switch ($update->getType()) {
    case Kuvardin\TelegramBotsApi\Enums\UpdateType::Message:
        $request = $bot->sendMessage(
            chat_id: $update->message->chat->id, 
            text: 'Hello <b>World</b>',
            parse_mode: Kuvardin\TelegramBotsApi\Enums\ParseMode::HTML,  
            reply_markup: new Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup([
                [ // Buttons row 1
                    new Kuvardin\TelegramBotsApi\Types\InlineKeyboardButton(
                        text: 'Open URL',
                        url: 'https://github.com/kuvardin',
                    ),
                    new Kuvardin\TelegramBotsApi\Types\InlineKeyboardButton(
                        text: 'Send callback command',
                        callback_data: 'like_it',
                    ),
                ],
                [ // Buttons row 2
                    // ...
                ],
                [ // Buttons row 3
                    // ...
                ],
                // ...
            ]),
        );
        break;
    
    case Kuvardin\TelegramBotsApi\Enums\UpdateType::EditedMessage:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::ChannelPost:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::EditedChannelPost:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::InlineQuery:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::ChosenInlineResult:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::CallbackQuery:
        // ...
        break;

    case Kuvardin\TelegramBotsApi\Enums\UpdateType::ShippingQuery:
        // ...
        break;
    
    // ...
}

if ($request !== null) {
    header('Content-Type: application/json');
    echo json_encode($request->getRequestData(), JSON_THROW_ON_ERROR);
}
```