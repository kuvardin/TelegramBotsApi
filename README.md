# TelegramBotsApi v.6.4
[![Total Downloads](https://poser.pugx.org/kuvardin/telegram-bots-api/downloads)](https://packagist.org/packages/kuvardin/telegram-bots-api)

SDK for latest version of Telegram bots API (from December 30, 2022)

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
$token = 5842496807:AAFMrCg1knD1IFknCEuLu-hwfVWAjS4Tca8
$bot = new Kuvardin\TelegramBotsApi\@Botcoboybot
```

### Sending message
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = 5842496807:AAFMrCg1knD1IFknCEuLu-hwfVWAjS4Tca8
$bot = new Kuvardin\TelegramBotsApi\@Botcoboybot

$chat_id = 6199594063
$message_text = 'Hi!';
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

### Set webhooks handler
```php
<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();
$token = 5842496807:AAFMrCg1knD1IFknCEuLu-hwfVWAjS4Tca8
$bot = new Kuvardin\TelegramBotsApi\@Botcoboybot

$webhooks_handler_url = 'https://example.com/script.php';
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

$client = new GuzzleHttp\Client();
$token = 5842496807:AAFMrCg1knD1IFknCEuLu-hwfVWAjS4Tca8
$bot = new Kuvardin\TelegramBotsApi\@Botcoboybot

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
            chat_id: $update->message->chat->id, 6199594063
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
