<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Kuvardin\TelegramBotsApi\Bot;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use Kuvardin\TelegramBotsApi\Exceptions\TelegramBotsApiException;

require 'vendor\autoload.php';

$api_token = $argv[1] ?? null;
$chat_id = $argv[2] ?? null;

if (empty($api_token) || empty($chat_id)) {
    exit("Usage: php test/send_message.php %token% %chat_id%\n");
}

$client = new Client([
    RequestOptions::VERIFY => false,
]);

$bot = new Bot($client, $api_token);

$message_text = 'Current DateTime is <b>' . (new DateTime('now'))->format('Y.m.d H:i:s') . '</b>';
$request = $bot->sendMessage($chat_id, $message_text, parse_mode: ParseMode::HTML);

try {
    $message = $request->sendRequest();
    echo "Message #{$message->message_id} successfully sent to chat with ID {$message->chat->id}\n";
} catch (TelegramBotsApiException $api_exception) {
    echo "API error #{$api_exception->getCode()}: {$api_exception->getMessage()}\n";
} catch (GuzzleException $exception) {
    echo get_class($exception), " #{$exception->getCode()}: {$exception->getMessage()}\n";
}

