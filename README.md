# TelegramBots
[![Total Downloads](https://poser.pugx.org/kuvardin/telegram-bots-api/downloads)](https://packagist.org/packages/kuvardin/telegram-bots-api)

PHP library for make Telegram-bots.

## Using Examples
### Init bot
```
<?php
$token = '123456:AAAAAAAAAAAAAAA';
$username = 'ExampleBot';
$bot = new TelegramBotsApi\Bot($token, $username);
```

### Sending message
```
<?php
$chat_id = 123456789;
$message_text = 'Hi!';
$request = $bot->sendMessage($chat_id, $message_text);
try {
    $response = $request->sendRequest();
    echo 'Successful sended';
} catch (TelegramBotsApi\Exceptions\ApiError $e) {
    echo "Telegram API returns error: $e";
} catch (TelegramBotsApi\Exceptions\CurlError $e) {
    echo "Request sending error: $e";
}
```