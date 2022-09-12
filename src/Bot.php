<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi;

use GuzzleHttp\Client;
use Kuvardin\TelegramBotsApi\Enums\ParseMode;
use Kuvardin\TelegramBotsApi\Types\ForceReply;
use Kuvardin\TelegramBotsApi\Types\ReplyKeyboardMarkup;
use Kuvardin\TelegramBotsApi\Types\ReplyKeyboardRemove;
use Psr\Http\Message\ResponseInterface;
use Kuvardin\TelegramBotsApi\Types\InlineKeyboardMarkup;
use RuntimeException;

/**
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Bot
{
    /**
     * @var Client GuzzleHTTP Client
     */
    protected Client $client;

    /**
     * @var string API token
     */
    protected string $token;

    /**
     * @var int|null Connection timeout in seconds
     */
    public ?int $connect_timeout_default = null;

    /**
     * @var int|null Read timeout in seconds
     */
    public ?int $read_timeout_default = null;

    /**
     * @var int|null Request timeout in seconds
     */
    public ?int $request_timeout_default = null;

    /**
     * @var ParseMode Default parse mode
     */
    public ParseMode $parse_mode_default = ParseMode::HTML;

    /**
     * @var string|null Last API request URI
     */
    public ?string $last_request_uri = null;

    /**
     * @var ResponseInterface|null Last response
     */
    public ?ResponseInterface $last_response = null;

    /**
     * @var mixed Last response decoded from JSON
     */
    public mixed $last_response_decoded = null;

    public function __construct(Client $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public static function filterString(string $text, ParseMode $parse_mode = null): string
    {
        switch ($parse_mode ?? ParseMode::HTML) {
            case ParseMode::HTML:
                return str_replace(['<', '>', '&', '"'], ['&lt;', '&gt;', '&amp;', '&quot;'], $text);

            case ParseMode::Markdown:
                return str_replace(['_', '*', '`', '['], ['\_', '\*', '\`', '\['], $text);

            case ParseMode::MarkdownV2:
                return str_replace(
                    ['_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+',
                        '-', '=', '|', '{', '}', '.', '!',],
                    ['\_', '\*', '\[', '\]', '\(', '\)', '\~', '\`', '\>', '\#', '\+',
                        '\-', '\=', '\|', '\{', '\}', '\.', '\!',],
                    $text);
        }

        throw new RuntimeException("Unknown parse mode: {$parse_mode->value}");
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Use this method to receive incoming updates using long polling (<a
     * href="https://en.wikipedia.org/wiki/Push_technology#Long_polling">wiki</a>).
     *
     * @param int|null $offset Identifier of the first update to be returned. Must be greater by one than the highest
     *     among the identifiers of previously received updates. By default, updates starting with the earliest
     *     unconfirmed update are returned. An update is considered confirmed as soon as getUpdates() is called with an
     *     <em>offset</em> higher than its <em>update_id</em>. The negative offset can be specified to retrieve updates
     *     starting from <em>-offset</em> update from the end of the updates queue. All previous updates will
     *     forgotten.
     * @param int|null $limit Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults
     *     to 100.
     * @param int|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be
     *     positive, short polling should be used for testing purposes only.
     * @param Enums\UpdateType[]|null $allowed_updates A JSON-serialized list of the update types you want your bot to
     *     receive. See Enums\UpdateType for a complete list of available update types. Specify an empty list to
     *     receive all update types except <em>chat_member</em> (default). If not specified, the previous setting will
     *     be used.<br><br>Please note that this parameter doesn't affect updates created before the call to the
     *     getUpdates, so unwanted updates may be received for a short period of time.
     */
    public function getUpdates(
        int $offset = null,
        int $limit = null,
        int $timeout = null,
        array $allowed_updates = null,
    ): Requests\RequestUpdates
    {
        return new Requests\RequestUpdates($this, 'getUpdates', [
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'allowed_updates' => $allowed_updates,
        ]);
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an
     * update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized
     * Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts.<br><br> If
     * you'd like to make sure that the webhook was set by you, you can specify secret data in the parameter
     * <em>secret_token</em>. If specified, the request will contain a header “X-Telegram-Bot-Api-Secret-Token” with
     * the secret token as content.
     *
     * @param string $url HTTPS URL to send updates to. Use an empty string to remove webhook integration
     * @param Types\InputFile|null $certificate Upload your public key certificate so that the root certificate in use
     *     can be checked. See our <a href="https://core.telegram.org/bots/self-signed">self-signed guide</a> for
     *     details.
     * @param string|null $ip_address The fixed IP address which will be used to send webhook requests instead of the
     *     IP address resolved through DNS
     * @param int|null $max_connections The maximum allowed number of simultaneous HTTPS connections to the webhook for
     *     update delivery, 1-100. Defaults to <em>40</em>. Use lower values to limit the load on your bot's server,
     *     and higher values to increase your bot's throughput.
     * @param string[]|null $allowed_updates A JSON-serialized list of the update types you want your bot to receive.
     *     For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these
     *     types. See Update for a complete list of available update types. Specify an empty list to receive all update
     *     types except <em>chat_member</em> (default). If not specified, the previous setting will be used.<br>Please
     *     note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted
     *     updates may be received for a short period of time.
     * @param bool|null $drop_pending_updates Pass <em>True</em> to drop all pending updates
     * @param string|null $secret_token A secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in
     *     every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is
     *     useful to ensure that the request comes from a webhook set by you.
     */
    public function setWebhook(
        string $url,
        Types\InputFile $certificate = null,
        string $ip_address = null,
        int $max_connections = null,
        array $allowed_updates = null,
        bool $drop_pending_updates = null,
        string $secret_token = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setWebhook', [
            'url' => $url,
            'certificate' => $certificate,
            'ip_address' => $ip_address,
            'max_connections' => $max_connections,
            'allowed_updates' => $allowed_updates,
            'drop_pending_updates' => $drop_pending_updates,
            'secret_token' => $secret_token,
        ]);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates().
     *
     * @param bool|null $drop_pending_updates Pass <em>True</em> to drop all pending updates
     */
    public function deleteWebhook(
        bool $drop_pending_updates = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteWebhook', [
            'drop_pending_updates' => $drop_pending_updates,
        ]);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. If the bot is using getUpdates(), will
     * return an object with the <em>url</em> field empty.
     */
    public function getWebhookInfo(): Requests\RequestWebhookInfo
    {
        return new Requests\RequestWebhookInfo($this, 'getWebhookInfo');
    }

    /**
     * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic
     * information about the bot in form of a User object.
     */
    public function getMe(): Requests\RequestUser
    {
        return new Requests\RequestUser($this, 'getMe');
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You
     * <strong>must</strong> log out the bot before running it locally, otherwise there is no guarantee that the bot
     * will receive updates. After a successful call, you can immediately log in on a local server, but will not be
     * able to log in back to the cloud Bot API server for 10 minutes.
     *
     */
    public function logOut(): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'logOut');
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another. You need to delete
     * the webhook before calling this method to ensure that the bot isn't launched again after server restart. The
     * method will return error 429 in the first 10 minutes after the bot is launched.
     *
     */
    public function close(): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'close');
    }

    /**
     * Use this method to send text messages.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $text Text of the message to be sent, 1-4096 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the message text. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message
     *     text, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_web_page_preview Disables link previews for links in this message
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendMessage(
        int|string $chat_id,
        string $text,
        Enums\ParseMode $parse_mode = null,
        array $entities = null,
        bool $disable_web_page_preview = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'entities' => $entities,
            'disable_web_page_preview' => $disable_web_page_preview,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to forward messages of any kind. Service messages can't be forwarded.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent (or channel
     *     username in the format &#64;channelusername)
     * @param int $message_id Message identifier in the chat specified in <em>from_chat_id</em>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the forwarded message from forwarding and saving
     */
    public function forwardMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        bool $disable_notification = null,
        bool $protect_content = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'forwardMessage', [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
        ]);
    }

    /**
     * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The
     * method is analogous to the method forwardMessage(), but the copied message doesn't have a link to the original
     * message.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent (or channel
     *     username in the format &#64;channelusername)
     * @param int $message_id Message identifier in the chat specified in <em>from_chat_id</em>
     * @param string|null $caption New caption for media, 0-1024 characters after entities parsing. If not specified,
     *     the original caption is kept
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the new caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the new caption, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function copyMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessageId
    {
        return new Requests\RequestMessageId($this, 'copyMessage', [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send photos.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $photo Photo to send. Pass a file_id as String to send a photo that exists on the
     *     Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet,
     *     or upload a new photo using multipart/form-data. The photo must be at most 10 MB in size. The photo's
     *     width and height must not exceed 10000 in total. Width and height ratio must be at most 20. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param string|null $caption Photo caption (may also be used when resending photos by <em>file_id</em>), 0-1024
     *     characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the photo caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendPhoto(
        int|string $chat_id,
        Types\InputFile $photo,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendPhoto', [
            'chat_id' => $chat_id,
            'photo' => $photo,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your
     * audio must be in the .MP3 or .M4A format.  Bots can currently send audio files of up to 50 MB in size, this
     * limit may be changed in the future.<br><br>For sending voice messages, use the sendVoice() method instead.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $audio Audio file to send. Pass a file_id as String to send an audio file that exists on
     *     the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the
     *     Internet, or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param string|null $caption Audio caption, 0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the audio caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param int|null $duration Duration of the audio in seconds
     * @param string|null $performer Performer
     * @param string|null $title Track name
     * @param Types\InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the
     *     file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A
     *     thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using
     *     multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending
     *     Files »</a>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendAudio(
        int|string $chat_id,
        Types\InputFile $audio,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        int $duration = null,
        string $performer = null,
        string $title = null,
        Types\InputFile $thumb = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendAudio', [
            'chat_id' => $chat_id,
            'audio' => $audio,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'duration' => $duration,
            'performer' => $performer,
            'title' => $title,
            'thumb' => $thumb,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send general files. Bots can currently send files of any type of up to 50 MB in size, this
     * limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $document File to send. Pass a file_id as String to send a file that exists on the
     *     Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet,
     *     or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param Types\InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the
     *     file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A
     *     thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using
     *     multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending
     *     Files »</a>
     * @param string|null $caption Document caption (may also be used when resending documents by <em>file_id</em>),
     *     0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the document caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_content_type_detection Disables automatic server-side content type detection for files
     *     uploaded using multipart/form-data
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendDocument(
        int|string $chat_id,
        Types\InputFile $document,
        Types\InputFile $thumb = null,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        bool $disable_content_type_detection = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendDocument', [
            'chat_id' => $chat_id,
            'document' => $document,
            'thumb' => $thumb,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'disable_content_type_detection' => $disable_content_type_detection,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as
     * Document). Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $video Video to send. Pass a file_id as String to send a video that exists on the
     *     Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet,
     *     or upload a new video using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $width Video width
     * @param int|null $height Video height
     * @param Types\InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the
     *     file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A
     *     thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using
     *     multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending
     *     Files »</a>
     * @param string|null $caption Video caption (may also be used when resending videos by <em>file_id</em>), 0-1024
     *     characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the video caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $supports_streaming Pass <em>True</em>, if the uploaded video is suitable for streaming
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendVideo(
        int|string $chat_id,
        Types\InputFile $video,
        int $duration = null,
        int $width = null,
        int $height = null,
        Types\InputFile $thumb = null,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        bool $supports_streaming = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendVideo', [
            'chat_id' => $chat_id,
            'video' => $video,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'supports_streaming' => $supports_streaming,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). Bots can currently send
     * animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $animation Animation to send. Pass a file_id as String to send an animation that exists
     *     on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from
     *     the Internet, or upload a new animation using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param int|null $duration Duration of sent animation in seconds
     * @param int|null $width Animation width
     * @param int|null $height Animation height
     * @param Types\InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the
     *     file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A
     *     thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using
     *     multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending
     *     Files »</a>
     * @param string|null $caption Animation caption (may also be used when resending animation by <em>file_id</em>),
     *     0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the animation caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendAnimation(
        int|string $chat_id,
        Types\InputFile $animation,
        int $duration = null,
        int $width = null,
        int $height = null,
        Types\InputFile $thumb = null,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendAnimation', [
            'chat_id' => $chat_id,
            'animation' => $animation,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice
     * message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as
     * Audio or Document). Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in
     * the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $voice Audio file to send. Pass a file_id as String to send a file that exists on the
     *     Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet,
     *     or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param string|null $caption Voice message caption, 0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the voice message caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param int|null $duration Duration of the voice message in seconds
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendVoice(
        int|string $chat_id,
        Types\InputFile $voice,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        int $duration = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendVoice', [
            'chat_id' => $chat_id,
            'voice' => $voice,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'duration' => $duration,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send
     * video messages.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $video_note Video note to send. Pass a file_id as String to send a video note that exists
     *     on the Telegram servers (recommended) or upload a new video using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>. Sending video
     *     notes by a URL is currently unsupported
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $length Video width and height, i.e. diameter of the video message
     * @param Types\InputFile|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for the
     *     file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A
     *     thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using
     *     multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass
     *     “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under
     *     &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More info on Sending
     *     Files »</a>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendVideoNote(
        int|string $chat_id,
        Types\InputFile $video_note,
        int $duration = null,
        int $length = null,
        Types\InputFile $thumb = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendVideoNote', [
            'chat_id' => $chat_id,
            'video_note' => $video_note,
            'duration' => $duration,
            'length' => $length,
            'thumb' => $thumb,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files
     * can be only grouped in an album with messages of the same type.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputMedia[] $media A JSON-serialized array describing messages to be sent, must include 2-10 items
     * @param bool|null $disable_notification Sends messages <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent messages from forwarding and saving
     * @param int|null $reply_to_message_id If the messages are a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     */
    public function sendMediaGroup(
        int|string $chat_id,
        array $media,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
    ): Requests\RequestMessages
    {
        return new Requests\RequestMessages($this, 'sendMediaGroup', [
            'chat_id' => $chat_id,
            'media' => $media,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
        ]);
    }

    /**
     * Use this method to send point on the map.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period Period in seconds for which the location will be updated (see <a
     *     href="https://telegram.org/blog/live-locations">Live Locations</a>, should be between 60 and 86400.
     * @param int|null $heading For live locations, a direction in which the user is moving, in degrees. Must be
     *     between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius For live locations, a maximum distance for proximity alerts about
     *     approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendLocation(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        float $horizontal_accuracy = null,
        int $live_period = null,
        int $heading = null,
        int $proximity_alert_radius = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendLocation', [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'horizontal_accuracy' => $horizontal_accuracy,
            'live_period' => $live_period,
            'heading' => $heading,
            'proximity_alert_radius' => $proximity_alert_radius,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its <em>live_period</em> expires
     * or editing is explicitly disabled by a call to stopMessageLiveLocation().
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $heading Direction in which the user is moving, in degrees. Must be between 1 and 360 if
     *     specified.
     * @param int|null $proximity_alert_radius Maximum distance for proximity alerts about approaching another chat
     *     member, in meters. Must be between 1 and 100000 if specified.
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageLiveLocation(
        int|string $chat_id,
        int $message_id,
        float $latitude,
        float $longitude,
        float $horizontal_accuracy = null,
        int $heading = null,
        int $proximity_alert_radius = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'editMessageLiveLocation', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'horizontal_accuracy' => $horizontal_accuracy,
            'heading' => $heading,
            'proximity_alert_radius' => $proximity_alert_radius,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its <em>live_period</em> expires
     * or editing is explicitly disabled by a call to stopMessageLiveLocation().
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $heading Direction in which the user is moving, in degrees. Must be between 1 and 360 if
     *     specified.
     * @param int|null $proximity_alert_radius Maximum distance for proximity alerts about approaching another chat
     *     member, in meters. Must be between 1 and 100000 if specified.
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageLiveLocationInline(
        string $inline_message_id,
        float $latitude,
        float $longitude,
        float $horizontal_accuracy = null,
        int $heading = null,
        int $proximity_alert_radius = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'editMessageLiveLocation', [
            'inline_message_id' => $inline_message_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'horizontal_accuracy' => $horizontal_accuracy,
            'heading' => $heading,
            'proximity_alert_radius' => $proximity_alert_radius,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to stop updating a live location message before <em>live_period</em> expires.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Required if <em>inline_message_id</em> is not specified. Identifier of the message with
     *     live location to stop
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function stopMessageLiveLocation(
        int|string $chat_id,
        int $message_id,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'stopMessageLiveLocation', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to stop updating a live location message before <em>live_period</em> expires.
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function stopMessageLiveLocationInline(
        string $inline_message_id,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'stopMessageLiveLocation', [
            'inline_message_id' => $inline_message_id,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send information about a venue.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Foursquare identifier of the venue
     * @param string|null $foursquare_type Foursquare type of the venue, if known. (For example,
     *     “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id Google Places identifier of the venue
     * @param string|null $google_place_type Google Places type of the venue. (See <a
     *     href="https://developers.google.com/places/web-service/supported_types">supported types</a>.)
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendVenue(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        string $foursquare_id = null,
        string $foursquare_type = null,
        string $google_place_id = null,
        string $google_place_type = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendVenue', [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            'foursquare_id' => $foursquare_id,
            'foursquare_type' => $foursquare_type,
            'google_place_id' => $google_place_id,
            'google_place_type' => $google_place_type,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send phone contacts.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a <a
     *     href="https://en.wikipedia.org/wiki/VCard">vCard</a>, 0-2048 bytes
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove keyboard
     *     or to force a reply from the user.
     */
    public function sendContact(
        int|string $chat_id,
        string $phone_number,
        string $first_name,
        string $last_name = null,
        string $vcard = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendContact', [
            'chat_id' => $chat_id,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'vcard' => $vcard,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send a native poll.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $question Poll question, 1-300 characters
     * @param string[] $options A JSON-serialized list of answer options, 2-10 strings 1-100 characters each
     * @param bool|null $is_anonymous <em>True</em>, if the poll needs to be anonymous, defaults to <em>True</em>
     * @param Enums\PollType|null $type Poll type, “quiz” or “regular”, defaults to “regular”
     * @param bool|null $allows_multiple_answers <em>True</em>, if the poll allows multiple answers, ignored for polls
     *     in quiz mode, defaults to <em>False</em>
     * @param int|null $correct_option_id 0-based identifier of the correct answer option, required for polls in quiz
     *     mode
     * @param string|null $explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp
     *     icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after entities parsing
     * @param string|null $explanation_parse_mode Mode for parsing entities in the explanation. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $explanation_entities A JSON-serialized list of special entities that appear
     *     in the poll explanation, which can be specified instead of <em>parse_mode</em>
     * @param int|null $open_period Amount of time in seconds the poll will be active after creation, 5-600. Can't
     *     be used together with <em>close_date</em>.
     * @param int|null $close_date Point in time (Unix timestamp) when the poll will be automatically closed. Must be
     *     at least 5 and no more than 600 seconds in the future. Can't be used together with <em>open_period</em>.
     * @param bool|null $is_closed Pass <em>True</em>, if the poll needs to be immediately closed. This can be useful
     *     for poll preview.
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendPoll(
        int|string $chat_id,
        string $question,
        array $options,
        bool $is_anonymous = null,
        Enums\PollType $type = null,
        bool $allows_multiple_answers = null,
        int $correct_option_id = null,
        string $explanation = null,
        string $explanation_parse_mode = null,
        array $explanation_entities = null,
        int $open_period = null,
        int $close_date = null,
        bool $is_closed = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendPoll', [
            'chat_id' => $chat_id,
            'question' => $question,
            'options' => $options,
            'is_anonymous' => $is_anonymous,
            'type' => $type?->value,
            'allows_multiple_answers' => $allows_multiple_answers,
            'correct_option_id' => $correct_option_id,
            'explanation' => $explanation,
            'explanation_parse_mode' => $explanation_parse_mode,
            'explanation_entities' => $explanation_entities,
            'open_period' => $open_period,
            'close_date' => $close_date,
            'is_closed' => $is_closed,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to send an animated emoji that will display a random value.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Enums\DiceType|null $type Type on which the dice throw animation is based. Currently, must be one of
     *     Enums\DiceType::*. Dice can have values 1-6 for Dice, Darts and Bowling, values 1-5 for Basketball and
     *     Soccer, and values 1-64 for SlotMachine. Defaults to Enums\DiceType::Dice
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendDice(
        int|string $chat_id,
        Enums\DiceType $type = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendDice', [
            'chat_id' => $chat_id,
            'emoji' => $type?->getEmoji(),
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is
     * set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
     * Returns <em>True</em> on success.<br><br> We only recommend using this method when a response from the bot will
     * take a <strong>noticeable</strong> amount of time to arrive.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Enums\Action $action Type of action to broadcast
     */
    public function sendChatAction(
        int|string $chat_id,
        Enums\Action $action,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'sendChatAction', [
            'chat_id' => $chat_id,
            'action' => $action->value,
        ]);
    }

    /**
     * Use this method to get a list of profile pictures for a user.
     *
     * @param int $user_id Unique identifier of the target user
     * @param int|null $offset Sequential number of the first photo to be returned. By default, all photos are
     *     returned.
     * @param int|null $limit Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults
     *     to 100.
     */
    public function getUserProfilePhotos(
        int $user_id,
        int $offset = null,
        int $limit = null,
    ): Requests\RequestUserProfilePhotos
    {
        return new Requests\RequestUserProfilePhotos($this, 'getUserProfilePhotos', [
            'user_id' => $user_id,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
     * files of up to 20MB in size. The file can then be downloaded via the link
     * https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;, where &lt;file_path&gt; is taken from the
     * response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can
     * be requested by calling getFile() again.
     *
     * @param string $file_id File identifier to get info about
     */
    public function getFile(string $file_id): Requests\RequestFile
    {
        return new Requests\RequestFile($this, 'getFile', [
            'file_id' => $file_id,
        ]);
    }

    public function getFileUrl(string $file_path): string
    {
        return "https://api.telegram.org/file/bot{$this->token}/$file_path";
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels,
     * the user will not be able to return to the chat on their own using invite links, etc., unless <a
     * href="https://core.telegram.org/bots/api#unbanchatmember">unbanned</a> first. The bot must be an administrator
     * in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on
     * success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target supergroup or
     *     channel (in the format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param int|null $until_date Date when the user will be unbanned, unix time. If user is banned for more than 366
     *     days or less than 30 seconds from the current time they are considered to be banned forever. Applied for
     *     supergroups and channels only.
     * @param bool|null $revoke_messages Pass <em>True</em> to delete all messages from the chat for the user that is
     *     being removed. If <em>False</em>, the user will be able to see messages in the group that were sent before
     *     the user was removed. Always <em>True</em> for supergroups and channels.
     */
    public function banChatMember(
        int|string $chat_id,
        int $user_id,
        int $until_date = null,
        bool $revoke_messages = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'banChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'until_date' => $until_date,
            'revoke_messages' => $revoke_messages,
        ]);
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will <strong>not</strong>
     * return to the group or channel automatically, but will be able to join via link, etc. The bot must be an
     * administrator for this to work. By default, this method guarantees that after the call the user is not a member
     * of the chat, but will be able to join it. So if the user is a member of the chat they will also be
     * <strong>removed</strong> from the chat. If you don't want this, use the parameter <em>only_if_banned</em>.
     * Returns <em>True</em> on success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target supergroup or
     *     channel (in the format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $only_if_banned Do nothing if the user is not banned
     */
    public function unbanChatMember(
        int|string $chat_id,
        int $user_id,
        bool $only_if_banned = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'unbanChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'only_if_banned' => $only_if_banned,
        ]);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this
     * to work and must have the appropriate administrator rights. Pass <em>True</em> for all permissions to lift
     * restrictions from a user. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param Types\ChatPermissions $permissions A JSON-serialized object for new user permissions
     * @param int|null $until_date Date when restrictions will be lifted for the user, unix time. If user is restricted
     *     for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted
     *     forever
     */
    public function restrictChatMember(
        int|string $chat_id,
        int $user_id,
        Types\ChatPermissions $permissions,
        int $until_date = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'restrictChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'permissions' => $permissions,
            'until_date' => $until_date,
        ]);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in
     * the chat for this to work and must have the appropriate administrator rights. Pass <em>False</em> for all
     * boolean parameters to demote a user.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $is_anonymous Pass <em>True</em>, if the administrator's presence in the chat is hidden
     * @param bool|null $can_manage_chat Pass <em>True</em>, if the administrator can access the chat event log, chat
     *     statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups
     *     and ignore slow mode. Implied by any other administrator privilege
     * @param bool|null $can_post_messages Pass <em>True</em>, if the administrator can create channel posts, channels
     *     only
     * @param bool|null $can_edit_messages Pass <em>True</em>, if the administrator can edit messages of other users
     *     and can pin messages, channels only
     * @param bool|null $can_delete_messages Pass <em>True</em>, if the administrator can delete messages of other
     *     users
     * @param bool|null $can_manage_video_chats Pass <em>True</em>, if the administrator can manage video chats
     * @param bool|null $can_restrict_members Pass <em>True</em>, if the administrator can restrict, ban or unban chat
     *     members
     * @param bool|null $can_promote_members Pass <em>True</em>, if the administrator can add new administrators with a
     *     subset of their own privileges or demote administrators that he has promoted, directly or indirectly
     *     (promoted by administrators that were appointed by him)
     * @param bool|null $can_change_info Pass <em>True</em>, if the administrator can change chat title, photo and
     *     other settings
     * @param bool|null $can_invite_users Pass <em>True</em>, if the administrator can invite new users to the chat
     * @param bool|null $can_pin_messages Pass <em>True</em>, if the administrator can pin messages, supergroups only
     */
    public function promoteChatMember(
        int|string $chat_id,
        int $user_id,
        bool $is_anonymous = null,
        bool $can_manage_chat = null,
        bool $can_post_messages = null,
        bool $can_edit_messages = null,
        bool $can_delete_messages = null,
        bool $can_manage_video_chats = null,
        bool $can_restrict_members = null,
        bool $can_promote_members = null,
        bool $can_change_info = null,
        bool $can_invite_users = null,
        bool $can_pin_messages = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'promoteChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'is_anonymous' => $is_anonymous,
            'can_manage_chat' => $can_manage_chat,
            'can_post_messages' => $can_post_messages,
            'can_edit_messages' => $can_edit_messages,
            'can_delete_messages' => $can_delete_messages,
            'can_manage_video_chats' => $can_manage_video_chats,
            'can_restrict_members' => $can_restrict_members,
            'can_promote_members' => $can_promote_members,
            'can_change_info' => $can_change_info,
            'can_invite_users' => $can_invite_users,
            'can_pin_messages' => $can_pin_messages,
        ]);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param string $custom_title New custom title for the administrator; 0-16 characters, emoji are not allowed
     */
    public function setChatAdministratorCustomTitle(
        int|string $chat_id,
        int $user_id,
        string $custom_title,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatAdministratorCustomTitle', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'custom_title' => $custom_title,
        ]);
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is <a
     * href="https://core.telegram.org/bots/api#unbanchatsenderchat">unbanned</a>, the owner of the banned chat
     * won't be able to send messages on behalf of <strong>any of their channels</strong>. The bot must be an
     * administrator in the supergroup or channel for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $sender_chat_id Unique identifier of the target sender chat
     */
    public function banChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'banChatSenderChat', [
            'chat_id' => $chat_id,
            'sender_chat_id' => $sender_chat_id,
        ]);
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an
     * administrator for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $sender_chat_id Unique identifier of the target sender chat
     */
    public function unbanChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'unbanChatSenderChat', [
            'chat_id' => $chat_id,
            'sender_chat_id' => $sender_chat_id,
        ]);
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group
     * or a supergroup for this to work and must have the <em>can_restrict_members</em> administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format @supergroupusername)
     * @param Types\ChatPermissions $permissions A JSON-serialized object for new default chat permissions
     */
    public function setChatPermissions(
        int|string $chat_id,
        Types\ChatPermissions $permissions,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatPermissions', [
            'chat_id' => $chat_id,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is
     * revoked. The bot must be an administrator in the chat for this to work and must have the appropriate
     * administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     */
    public function exportChatInviteLink(
        int|string $chat_id,
    ): Requests\RequestString
    {
        return new Requests\RequestString($this, 'exportChatInviteLink', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for
     * this to work and must have the appropriate administrator rights. The link can be revoked using the method
     * revokeChatInviteLink().
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string|null $name Invite link name; 0-32 characters
     * @param int|null $expire_date Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Maximum number of users that can be members of the chat simultaneously after
     *     joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request <em>True</em>, if users joining the chat via the link need to be approved
     *     by chat administrators. If <em>True</em>, <em>member_limit</em> can't be specified
     */
    public function createChatInviteLink(
        int|string $chat_id,
        string $name = null,
        int $expire_date = null,
        int $member_limit = null,
        bool $creates_join_request = null,
    ): Requests\RequestChatInviteLink
    {
        return new Requests\RequestChatInviteLink($this, 'createChatInviteLink', [
            'chat_id' => $chat_id,
            'name' => $name,
            'expire_date' => $expire_date,
            'member_limit' => $member_limit,
            'creates_join_request' => $creates_join_request,
        ]);
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the
     * chat for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $invite_link The invite link to edit
     * @param string|null $name Invite link name; 0-32 characters
     * @param int|null $expire_date Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Maximum number of users that can be members of the chat simultaneously after
     *     joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request <em>True</em>, if users joining the chat via the link need to be approved
     *     by chat administrators. If <em>True</em>, <em>member_limit</em> can't be specified
     */
    public function editChatInviteLink(
        int|string $chat_id,
        string $invite_link,
        string $name = null,
        int $expire_date = null,
        int $member_limit = null,
        bool $creates_join_request = null,
    ): Requests\RequestChatInviteLink
    {
        return new Requests\RequestChatInviteLink($this, 'editChatInviteLink', [
            'chat_id' => $chat_id,
            'invite_link' => $invite_link,
            'name' => $name,
            'expire_date' => $expire_date,
            'member_limit' => $member_limit,
            'creates_join_request' => $creates_join_request,
        ]);
    }

    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is
     * automatically generated. The bot must be an administrator in the chat for this to work and must have the
     * appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier of the target chat or username of the target channel (in the format
     *     &#64;channelusername)
     * @param string $invite_link The invite link to revoke
     */
    public function revokeChatInviteLink(
        int|string $chat_id,
        string $invite_link,
    ): Requests\RequestChatInviteLink
    {
        return new Requests\RequestChatInviteLink($this, 'revokeChatInviteLink', [
            'chat_id' => $chat_id,
            'invite_link' => $invite_link,
        ]);
    }

    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work
     * and must have the <em>can_invite_users</em> administrator right.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     */
    public function approveChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'approveChatJoinRequest', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work
     * and must have the <em>can_invite_users</em> administrator right.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     */
    public function declineChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'declineChatJoinRequest', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot
     * must be an administrator in the chat for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $photo New chat photo, uploaded using multipart/form-data
     */
    public function setChatPhoto(
        int|string $chat_id,
        Types\InputFile $photo,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatPhoto', [
            'chat_id' => $chat_id,
            'photo' => $photo,
        ]);
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     */
    public function deleteChatPhoto(int|string $chat_id): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteChatPhoto', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $title New chat title, 1-255 characters
     */
    public function setChatTitle(
        int|string $chat_id,
        string $title,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatTitle', [
            'chat_id' => $chat_id,
            'title' => $title,
        ]);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an
     * administrator in the chat for this to work and must have the appropriate administrator rights.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string|null $description New chat description, 0-255 characters
     */
    public function setChatDescription(
        int|string $chat_id,
        string $description = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatDescription', [
            'chat_id' => $chat_id,
            'description' => $description,
        ]);
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat,
     * the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages'
     * administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of a message to pin
     * @param bool|null $disable_notification Pass <em>True</em>, if it is not necessary to send a notification to all
     *     chat members about the new pinned message. Notifications are always disabled in channels and private chats.
     */
    public function pinChatMessage(
        int|string $chat_id,
        int $message_id,
        bool $disable_notification = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'pinChatMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'disable_notification' => $disable_notification,
        ]);
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private
     * chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages'
     * administrator right in a supergroup or 'can_edit_messages' administrator right in a channel.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int|null $message_id Identifier of a message to unpin. If not specified, the most recent pinned message
     *     (by sending date) will be unpinned.
     */
    public function unpinChatMessage(
        int|string $chat_id,
        int $message_id = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'unpinChatMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must
     * be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator
     * right in a supergroup or 'can_edit_messages' administrator right in a channel.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     */
    public function unpinAllChatMessages(
        int|string $chat_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'unpinAllChatMessages', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     *     (in the format &#64;channelusername)
     */
    public function leaveChat(int|string $chat_id): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'leaveChat', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.).
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     *     (in the format &#64;channelusername)
     */
    public function getChat(int|string $chat_id): Requests\RequestChat
    {
        return new Requests\RequestChat($this, 'getChat', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects
     * that contains information about all chat administrators except other bots. If the chat is a group or a
     * supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     *     (in the format &#64;channelusername)
     */
    public function getChatAdministrators(int|string $chat_id): Requests\RequestChatMembers
    {
        return new Requests\RequestChatMembers($this, 'getChatAdministrators', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get the number of members in a chat.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     *     (in the format &#64;channelusername)
     */
    public function getChatMemberCount(int|string $chat_id): Requests\RequestInteger
    {
        return new Requests\RequestInteger($this, 'getChatMemberCount', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get information about a member of a chat.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     *     (in the format &#64;channelusername)
     * @param int $user_id Unique identifier of the target user
     */
    public function getChatMember(
        int|string $chat_id,
        int $user_id,
    ): Requests\RequestChatMember
    {
        return new Requests\RequestChatMember($this, 'getChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat
     * for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em>
     * optionally returned in getChat() requests to check if the bot can use this method.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format @supergroupusername)
     * @param string $sticker_set_name Name of the sticker set to be set as the group sticker set
     */
    public function setChatStickerSet(
        int|string $chat_id,
        string $sticker_set_name,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatStickerSet', [
            'chat_id' => $chat_id,
            'sticker_set_name' => $sticker_set_name,
        ]);
    }

    /**
     * Use this method to send answers to callback queries sent from <a
     * href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboards</a>. The answer
     * will be displayed to the user as a notification at the top of the chat screen or as an alert. On success,
     * <em>True</em> is returned.
     *
     * @param string $callback_query_id Unique identifier for the query to be answered
     * @param string|null $text Text of the notification. If not specified, nothing will be shown to the user, 0-200
     *     characters
     * @param bool|null $show_alert If <em>True</em>, an alert will be shown by the client instead of a notification at
     *     the top of the chat screen. Defaults to <em>false</em>.
     * @param string|null $url URL that will be opened by the user's client. If you have created a <a
     *     href="https://core.telegram.org/bots/api#game">Game</a> and accepted the conditions via <a
     *     href="https://t.me/botfather">@Botfather</a>, specify the URL that opens your game — note that this will
     *     only work if the query comes from a <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardbutton"><em>callback_game</em></a>
     *     button.<br><br>Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot
     *     with a parameter.
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the callback query may be
     *     cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
     */
    public function answerCallbackQuery(
        string $callback_query_id,
        string $text = null,
        bool $show_alert = null,
        string $url = null,
        int $cache_time = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'answerCallbackQuery', [
            'callback_query_id' => $callback_query_id,
            'text' => $text,
            'show_alert' => $show_alert,
            'url' => $url,
            'cache_time' => $cache_time,
        ]);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat
     * for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em>
     * optionally returned in getChat() requests to check if the bot can use this method.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the
     *     format @supergroupusername)
     */
    public function deleteChatStickerSet(int|string $chat_id): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteChatStickerSet', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to change the list of the bot's commands. See <a
     * href="https://core.telegram.org/bots#commands">documentation</a> for more details about bot commands.
     *
     * @param Types\BotCommand[] $commands A JSON-serialized list of bot commands to be set as the list of the
     *     bot's commands. At most 100 commands can be specified.
     * @param Types\BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the
     *     commands are relevant. Defaults to <a
     *     href="https://core.telegram.org/bots/api#botcommandscopedefault">BotCommandScopeDefault</a>.
     * @param string|null $language_code A two-letter ISO 639-1 language code. If empty, commands will be applied to
     *     all users from the given scope, for whose language there are no dedicated commands
     */
    public function setMyCommands(
        array $commands,
        Types\BotCommandScope $scope = null,
        string $language_code = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setMyCommands', [
            'commands' => $commands,
            'scope' => $scope,
            'language_code' => $language_code,
        ]);
    }

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language. After
     * deletion, <a href="https://core.telegram.org/bots/api#determining-list-of-commands">higher level commands</a>
     * will be shown to affected users.
     *
     * @param Types\BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the
     *     commands are relevant. Defaults to <a
     *     href="https://core.telegram.org/bots/api#botcommandscopedefault">BotCommandScopeDefault</a>.
     * @param string|null $language_code A two-letter ISO 639-1 language code. If empty, commands will be applied to
     *     all users from the given scope, for whose language there are no dedicated commands
     */
    public function deleteMyCommands(
        Types\BotCommandScope $scope = null,
        string $language_code = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteMyCommands', [
            'scope' => $scope,
            'language_code' => $language_code,
        ]);
    }

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language. Returns
     * Array of BotCommand on success. If commands aren't set, an empty list is returned.
     *
     * @param Types\BotCommandScope|null $scope A JSON-serialized object, describing scope of users. Defaults to <a
     *     href="https://core.telegram.org/bots/api#botcommandscopedefault">BotCommandScopeDefault</a>.
     * @param string|null $language_code A two-letter ISO 639-1 language code or an empty string
     */
    public function getMyCommands(
        Types\BotCommandScope $scope = null,
        string $language_code = null,
    ): Requests\RequestBotCommands
    {
        return new Requests\RequestBotCommands($this, 'getMyCommands', [
            'scope' => $scope,
            'language_code' => $language_code,
        ]);
    }

    /**
     * Use this method to change the bot's menu button in a private chat, or the default menu button.
     *
     * @param int|null $chat_id Unique identifier for the target private chat. If not specified, default bot's menu
     *     button will be changed
     * @param Types\MenuButton|null $menu_button A JSON-serialized object for the new bot's menu button. Defaults
     *     to <a href="https://core.telegram.org/bots/api#menubuttondefault">MenuButtonDefault</a>
     */
    public function setChatMenuButton(
        int $chat_id = null,
        Types\MenuButton $menu_button = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setChatMenuButton', [
            'chat_id' => $chat_id,
            'menu_button' => $menu_button,
        ]);
    }

    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu
     * button. Returns <a href="https://core.telegram.org/bots/api#menubutton">MenuButton</a> on success.
     *
     * @param int|null $chat_id Unique identifier for the target private chat. If not specified, default bot's menu
     *     button will be returned
     */
    public function getChatMenuButton(int $chat_id = null): Requests\RequestMenuButton
    {
        return new Requests\RequestMenuButton($this, 'getChatMenuButton', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to change the default administrator rights requested by the bot when it's added as an
     * administrator to groups or channels. These rights will be suggested to users, but they are free to modify
     * the list before adding the bot.
     *
     * @param Types\ChatAdministratorRights|null $rights A JSON-serialized object describing new default administrator
     *     rights. If not specified, the default administrator rights will be cleared.
     * @param bool|null $for_channels Pass <em>True</em> to change the default administrator rights of the bot in
     *     channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
     */
    public function setMyDefaultAdministratorRights(
        Types\ChatAdministratorRights $rights = null,
        bool $for_channels = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setMyDefaultAdministratorRights', [
            'rights' => $rights,
            'for_channels' => $for_channels,
        ]);
    }

    /**
     * Use this method to get the current default administrator rights of the bot.
     *
     * @param bool|null $for_channels Pass <em>True</em> to get default administrator rights of the bot in channels.
     *     Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
     */
    public function getMyDefaultAdministratorRights(bool $for_channels = null): Requests\RequestChatAdministratorRights
    {
        return new Requests\RequestChatAdministratorRights($this, 'getMyDefaultAdministratorRights', [
            'for_channels' => $for_channels,
        ]);
    }

    /**
     * Use this method to edit text and <a href="https://core.telegram.org/bots/api#games">game</a> messages.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param string $text New text of the message, 1-4096 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the message text. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message
     *     text, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_web_page_preview Disables link previews for links in this message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageText(
        int|string $chat_id,
        int $message_id,
        string $text,
        Enums\ParseMode $parse_mode = null,
        array $entities = null,
        bool $disable_web_page_preview = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => $text,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'entities' => $entities,
            'disable_web_page_preview' => $disable_web_page_preview,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit text and <a href="https://core.telegram.org/bots/api#games">game</a> messages
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param string $text New text of the message, 1-4096 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the message text. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message
     *     text, which can be specified instead of <em>parse_mode</em>
     * @param bool|null $disable_web_page_preview Disables link previews for links in this message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageTextInline(
        string $inline_message_id,
        string $text,
        Enums\ParseMode $parse_mode = null,
        array $entities = null,
        bool $disable_web_page_preview = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'editMessageText', [
            'inline_message_id' => $inline_message_id,
            'text' => $text,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'entities' => $entities,
            'disable_web_page_preview' => $disable_web_page_preview,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit captions of messages.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param string|null $caption New caption of the message, 0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the message caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageCaption(
        int|string $chat_id,
        int $message_id,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'editMessageCaption', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit captions of messages.
     *
     * @param string $inline_message_id Required if <em>chat_id</em> and <em>message_id</em> are not specified.
     *     Identifier of the inline message
     * @param string|null $caption New caption of the message, 0-1024 characters after entities parsing
     * @param Enums\ParseMode|null $parse_mode Mode for parsing entities in the message caption. See <a
     *     href="https://core.telegram.org/bots/api#formatting-options">formatting options</a> for more details.
     * @param Types\MessageEntity[]|null $caption_entities A JSON-serialized list of special entities that appear in
     *     the caption, which can be specified instead of <em>parse_mode</em>
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageCaptionInline(
        string $inline_message_id,
        string $caption = null,
        Enums\ParseMode $parse_mode = null,
        array $caption_entities = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'editMessageCaption', [
            'inline_message_id' => $inline_message_id,
            'caption' => $caption,
            'parse_mode' => $parse_mode?->value ?? $this->parse_mode_default->value,
            'caption_entities' => $caption_entities,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message
     * album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a
     * photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously
     * uploaded file via its file_id or specify a URL.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param Types\InputMedia $media A JSON-serialized object for a new media content of the message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageMedia(
        int|string $chat_id,
        int $message_id,
        Types\InputMedia $media,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'editMessageMedia', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'media' => $media,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message
     * album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a
     * photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously
     * uploaded file via its file_id or specify a URL.
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param Types\InputMedia $media A JSON-serialized object for a new media content of the message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageMediaInline(
        string $inline_message_id,
        Types\InputMedia $media,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'editMessageMedia', [
            'inline_message_id' => $inline_message_id,
            'media' => $media,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit only the reply markup of messages.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageReplyMarkup(
        int|string $chat_id,
        int $message_id,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'editMessageReplyMarkup', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to edit only the reply markup of messages.
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function editMessageReplyMarkupInline(
        string $inline_message_id,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'editMessageReplyMarkup', [
            'inline_message_id' => $inline_message_id,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to stop a poll which was sent by the bot.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the original message with the poll
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new message <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>.
     */
    public function stopPoll(
        int|string $chat_id,
        int $message_id,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestPoll
    {
        return new Requests\RequestPoll($this, 'stopPoll', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:<br>- A message
     * can only be deleted if it was sent less than 48 hours ago.<br>- A dice message in a private chat can only be
     * deleted if it was sent more than 24 hours ago.<br>- Bots can delete outgoing messages in private chats, groups,
     * and supergroups.<br>- Bots can delete incoming messages in private chats.<br>- Bots granted
     * <em>can_post_messages</em> permissions can delete outgoing messages in channels.<br>- If the bot is an
     * administrator of a group, it can delete any message there.<br>- If the bot has <em>can_delete_messages</em>
     * permission in a supergroup or a channel, it can delete any message there.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param int $message_id Identifier of the message to delete
     */
    public function deleteMessage(
        int|string $chat_id,
        int $message_id,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to send static .WEBP, <a href="https://telegram.org/blog/animated-stickers">animated</a> .TGS,
     * or <a href="https://telegram.org/blog/video-stickers-better-reactions">video</a> .WEBM stickers.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param Types\InputFile $sticker Sticker to send. Pass a file_id as String to send a file that exists on the
     *     Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .WEBP file from the
     *     Internet, or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional
     *     interface options. A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>, <a
     *     href="https://core.telegram.org/bots#keyboards">custom reply keyboard</a>, instructions to remove reply
     *     keyboard or to force a reply from the user.
     */
    public function sendSticker(
        int|string $chat_id,
        Types\InputFile $sticker,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendSticker', [
            'chat_id' => $chat_id,
            'sticker' => $sticker,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to get a sticker set.
     *
     * @param string $name Name of the sticker set
     */
    public function getStickerSet(string $name): Requests\RequestStickerSet
    {
        return new Requests\RequestStickerSet($this, 'getStickerSet', [
            'name' => $name,
        ]);
    }

    /**
     * Use this method to get information about custom emoji stickers by their identifiers.
     *
     * @param string[] $custom_emoji_ids List of custom emoji identifiers. At most 200 custom emoji identifiers can be
     *     specified.
     * @return Requests\RequestStickers
     */
    public function getCustomEmojiStickers(array $custom_emoji_ids): Requests\RequestStickers
    {
        return new Requests\RequestStickers($this, 'getCustomEmojiStickers', [
            'custom_emoji_ids' => $custom_emoji_ids,
        ]);
    }

    /**
     * Use this method to upload a .PNG file with a sticker for later use in <em>createNewStickerSet</em> and
     * <em>addStickerToSet</em> methods (can be used multiple times).
     *
     * @param int $user_id User identifier of sticker file owner
     * @param Types\InputFile $png_sticker <strong>PNG</strong> image with the sticker, must be up to 512 kilobytes in
     *     size, dimensions must not exceed 512px, and either width or height must be exactly 512px. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     */
    public function uploadStickerFile(
        int $user_id,
        Types\InputFile $png_sticker,
    ): Requests\RequestFile
    {
        return new Requests\RequestFile($this, 'uploadStickerFile', [
            'user_id' => $user_id,
            'png_sticker' => $png_sticker,
        ]);
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus
     * created. You <strong>must</strong> use exactly one of the fields <em>png_sticker</em>, <em>tgs_sticker</em>, or
     * <em>webm_sticker</em>.
     *
     * @param int $user_id User identifier of created sticker set owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g.,
     *     <em>animals</em>). Can contain only english letters, digits and underscores. Must begin with a letter,
     *     can't contain consecutive underscores and must end in &quot;_by_&lt;bot_username&gt;&quot;.
     *     &lt;bot_username&gt; is case insensitive. 1-64 characters.
     * @param string $title Sticker set title, 1-64 characters
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param Types\InputFile|null $png_sticker <strong>PNG</strong> image with the sticker, must be up to 512
     *     kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass
     *     a <em>file_id</em> as a String to send a file that already exists on the Telegram servers, pass an HTTP URL
     *     as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param Types\InputFile|null $tgs_sticker <strong>TGS</strong> animation with the sticker, uploaded using
     *     multipart/form-data. See <a href="https://core.telegram.org/stickers#animated-sticker-requirements">
     *     https://core.telegram.org/stickers#animated-sticker-requirements</a> for technical requirements
     * @param Types\InputFile|null $webm_sticker <strong>WEBM</strong> video with the sticker, uploaded using
     *     multipart/form-data. See <a href="https://core.telegram.org/stickers#video-sticker-requirements">
     *     https://core.telegram.org/stickers#video-sticker-requirements</a> for technical requirements
     * @param Enums\StickerType|null $sticker_type Type of stickers in the set, pass “regular” or “mask”.
     *     Custom emoji sticker sets can't be created via the Bot API at the moment. By default, a regular sticker
     *     set is created.
     * @param Types\MaskPosition|null $mask_position A JSON-serialized object for position where the mask should be
     *     placed on faces
     */
    public function createNewStickerSet(
        int $user_id,
        string $name,
        string $title,
        string $emojis,
        Types\InputFile $png_sticker = null,
        Types\InputFile $tgs_sticker = null,
        Types\InputFile $webm_sticker = null,
        Enums\StickerType $sticker_type = null,
        Types\MaskPosition $mask_position = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'createNewStickerSet', [
            'user_id' => $user_id,
            'name' => $name,
            'title' => $title,
            'emojis' => $emojis,
            'png_sticker' => $png_sticker,
            'tgs_sticker' => $tgs_sticker,
            'webm_sticker' => $webm_sticker,
            'sticker_type' => $sticker_type?->value,
            'mask_position' => $mask_position,
        ]);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. You <strong>must</strong> use exactly one of
     * the fields <em>png_sticker</em>, <em>tgs_sticker</em>, or <em>webm_sticker</em>. Animated stickers can be added
     * to animated sticker sets and only to them. Animated sticker sets can have up to 50 stickers. Static sticker sets
     * can have up to 120 stickers.
     *
     * @param int $user_id User identifier of sticker set owner
     * @param string $name Sticker set name
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param Types\InputFile|null $png_sticker <strong>PNG</strong> image with the sticker, must be up to 512
     *     kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass
     *     a <em>file_id</em> as a String to send a file that already exists on the Telegram servers, pass an HTTP URL
     *     as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>
     * @param Types\InputFile|null $tgs_sticker <strong>TGS</strong> animation with the sticker, uploaded using
     *     multipart/form-data. See <a href="https://core.telegram.org/stickers#animated-sticker-requirements"><a
     *     href="https://core.telegram.org/stickers#animated-sticker-requirements">https://core.telegram.org/stickers#animated-sticker-requirements</a></a>
     *     for technical requirements
     * @param Types\InputFile|null $webm_sticker <strong>WEBM</strong> video with the sticker, uploaded using
     *     multipart/form-data. See <a href="https://core.telegram.org/stickers#video-sticker-requirements"><a
     *     href="https://core.telegram.org/stickers#video-sticker-requirements">https://core.telegram.org/stickers#video-sticker-requirements</a></a>
     *     for technical requirements
     * @param Types\MaskPosition|null $mask_position A JSON-serialized object for position where the mask should be
     *     placed on faces
     */
    public function addStickerToSet(
        int $user_id,
        string $name,
        string $emojis,
        Types\InputFile $png_sticker = null,
        Types\InputFile $tgs_sticker = null,
        Types\InputFile $webm_sticker = null,
        Types\MaskPosition $mask_position = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'addStickerToSet', [
            'user_id' => $user_id,
            'name' => $name,
            'emojis' => $emojis,
            'png_sticker' => $png_sticker,
            'tgs_sticker' => $tgs_sticker,
            'webm_sticker' => $webm_sticker,
            'mask_position' => $mask_position,
        ]);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     *
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     */
    public function setStickerPositionInSet(
        string $sticker,
        int $position,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setStickerPositionInSet', [
            'sticker' => $sticker,
            'position' => $position,
        ]);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot.
     *
     * @param string $sticker File identifier of the sticker
     */
    public function deleteStickerFromSet(string $sticker): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'deleteStickerFromSet', [
            'sticker' => $sticker,
        ]);
    }

    /**
     * Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets
     * only. Video thumbnails can be set only for video sticker sets only.
     *
     * @param string $name Sticker set name
     * @param int $user_id User identifier of the sticker set owner
     * @param Types\InputFile|null $thumb A <strong>PNG</strong> image with the thumbnail, must be up to 128 kilobytes
     *     in size and have width and height exactly 100px, or a <strong>TGS</strong> animation with the thumbnail up
     *     to 32 kilobytes in size; see <a href="https://core.telegram.org/stickers#animated-sticker-requirements"><a
     *     href="https://core.telegram.org/stickers#animated-sticker-requirements">https://core.telegram.org/stickers#animated-sticker-requirements</a></a>
     *     for animated sticker technical requirements, or a <strong>WEBM</strong> video with the thumbnail up to 32
     *     kilobytes in size; see <a href="https://core.telegram.org/stickers#video-sticker-requirements"><a
     *     href="https://core.telegram.org/stickers#video-sticker-requirements">https://core.telegram.org/stickers#video-sticker-requirements</a></a>
     *     for video sticker technical requirements. Pass a <em>file_id</em> as a String to send a file that already
     *     exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet,
     *     or upload a new one using multipart/form-data. <a
     *     href="https://core.telegram.org/bots/api#sending-files">More info on Sending Files »</a>. Animated sticker
     *     set thumbnails can't be uploaded via HTTP URL.
     */
    public function setStickerSetThumb(
        string $name,
        int $user_id,
        Types\InputFile $thumb = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setStickerSetThumb', [
            'name' => $name,
            'user_id' => $user_id,
            'thumb' => $thumb,
        ]);
    }

    /**
     * Use this method to send answers to an inline query. No more than <strong>50</strong> results per query are
     * allowed.
     *
     * @param string $inline_query_id Unique identifier for the answered query
     * @param Types\InlineQueryResult[] $results A JSON-serialized array of results for the inline query
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the inline query may be
     *     cached on the server. Defaults to 300.
     * @param bool|null $is_personal Pass <em>True</em>, if results may be cached on the server side only for the user
     *     that sent the query. By default, results may be returned to any user who sends the same query
     * @param string|null $next_offset Pass the offset that a client should send in the next query with the same text
     *     to receive more results. Pass an empty string if there are no more results or if you don't support
     *     pagination. Offset length can't exceed 64 bytes.
     * @param string|null $switch_pm_text If passed, clients will display a button with specified text that switches
     *     the user to a private chat with the bot and sends the bot a start message with the parameter
     *     <em>switch_pm_parameter</em>
     * @param string|null $switch_pm_parameter <a href="https://core.telegram.org/bots#deep-linking">Deep-linking</a>
     *     parameter for the /start message sent to the bot when user presses the switch button. 1-64 characters, only
     *     A-Z, a-z, 0-9, _ and - are
     *     allowed.<br><br><em>Example:</em> An inline bot that sends YouTube videos can ask the user to connect the
     *     bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect
     *     your YouTube account' button above the results, or even before showing any. The user presses the button,
     *     switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to
     *     return an OAuth link. Once done, the bot can offer a <a
     *     href="https://core.telegram.org/bots/api#inlinekeyboardmarkup"><em>switch_inline</em></a> button so that the
     *     user can easily return to the chat where they wanted to use the bot's inline capabilities.
     */
    public function answerInlineQuery(
        string $inline_query_id,
        array $results,
        int $cache_time = null,
        bool $is_personal = null,
        string $next_offset = null,
        string $switch_pm_text = null,
        string $switch_pm_parameter = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'answerInlineQuery', [
            'inline_query_id' => $inline_query_id,
            'results' => $results,
            'cache_time' => $cache_time,
            'is_personal' => $is_personal,
            'next_offset' => $next_offset,
            'switch_pm_text' => $switch_pm_text,
            'switch_pm_parameter' => $switch_pm_parameter,
        ]);
    }

    /**
     * Use this method to set the result of an interaction with a <a href="https://core.telegram.org/bots/webapps">Web
     * App</a> and send a corresponding message on behalf of the user to the chat from which the query originated.
     *
     * @param string $web_app_query_id Unique identifier for the query to be answered
     * @param Types\InlineQueryResult $result A JSON-serialized object describing the message to be sent
     */
    public function answerWebAppQuery(
        string $web_app_query_id,
        Types\InlineQueryResult $result,
    ): Requests\RequestSentWebAppMessage
    {
        return new Requests\RequestSentWebAppMessage($this, 'answerWebAppQuery', [
            'web_app_query_id' => $web_app_query_id,
            'result' => $result,
        ]);
    }

    /**
     * Use this method to send invoices.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the
     *     format &#64;channelusername)
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for
     *     your internal processes.
     * @param string $provider_token Payments provider token, obtained via <a
     *     href="https://t.me/botfather">Botfather</a>
     * @param string $currency Three-letter ISO 4217 currency code, see <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">more on currencies</a>
     * @param Types\LabeledPrice[] $prices Price breakdown, a JSON-serialized list of components (e.g. product price,
     *     tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $max_tip_amount The maximum accepted amount for tips in the <em>smallest units</em> of the
     *     currency (integer, <strong>not</strong> float/double). For example, for a maximum tip of US$
     *     1.45 pass max_tip_amount = 145. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param int[]|null $suggested_tip_amounts A JSON-serialized array of suggested amounts of tips in the
     *     <em>smallest units</em> of the currency (integer, <strong>not</strong> float/double). At most 4 suggested
     *     tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased
     *     order and must not exceed <em>max_tip_amount</em>.
     * @param string|null $start_parameter Unique deep-linking parameter. If left empty, <strong>forwarded
     *     copies</strong> of the sent message will have a <em>Pay</em> button, allowing multiple users to pay directly
     *     from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent message will
     *     have a <em>URL</em> button with a deep link to the bot (instead of a <em>Pay</em> button), with the value
     *     used as the start parameter
     * @param string|null $provider_data A JSON-serialized data about the invoice, which will be shared with the
     *     payment provider. A detailed description of required fields should be provided by the payment provider.
     * @param string|null $photo_url URL of the product photo for the invoice. Can be a photo of the goods or a
     *     marketing image for a service. People like it better when they see what they are paying for.
     * @param int|null $photo_size Photo size
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass <em>True</em>, if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Pass <em>True</em>, if you require the user's phone number to complete
     *     the order
     * @param bool|null $need_email Pass <em>True</em>, if you require the user's email address to complete the
     *     order
     * @param bool|null $need_shipping_address Pass <em>True</em>, if you require the user's shipping address to
     *     complete the order
     * @param bool|null $send_phone_number_to_provider Pass <em>True</em>, if user's phone number should be sent to
     *     provider
     * @param bool|null $send_email_to_provider Pass <em>True</em>, if user's email address should be sent to
     *     provider
     * @param bool|null $is_flexible Pass <em>True</em>, if the final price depends on the shipping method
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>. If
     *     empty, one 'Pay total price' button will be shown. If not empty, the first button must
     *     be a Pay button.
     */
    public function sendInvoice(
        int|string $chat_id,
        string $title,
        string $description,
        string $payload,
        string $provider_token,
        string $currency,
        array $prices,
        int $max_tip_amount = null,
        array $suggested_tip_amounts = null,
        string $start_parameter = null,
        string $provider_data = null,
        string $photo_url = null,
        int $photo_size = null,
        int $photo_width = null,
        int $photo_height = null,
        bool $need_name = null,
        bool $need_phone_number = null,
        bool $need_email = null,
        bool $need_shipping_address = null,
        bool $send_phone_number_to_provider = null,
        bool $send_email_to_provider = null,
        bool $is_flexible = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendInvoice', [
            'chat_id' => $chat_id,
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $provider_token,
            'currency' => $currency,
            'prices' => $prices,
            'max_tip_amount' => $max_tip_amount,
            'suggested_tip_amounts' => $suggested_tip_amounts,
            'start_parameter' => $start_parameter,
            'provider_data' => $provider_data,
            'photo_url' => $photo_url,
            'photo_size' => $photo_size,
            'photo_width' => $photo_width,
            'photo_height' => $photo_height,
            'need_name' => $need_name,
            'need_phone_number' => $need_phone_number,
            'need_email' => $need_email,
            'need_shipping_address' => $need_shipping_address,
            'send_phone_number_to_provider' => $send_phone_number_to_provider,
            'send_email_to_provider' => $send_email_to_provider,
            'is_flexible' => $is_flexible,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to create a link for an invoice.
     *
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for
     *     your internal processes.
     * @param string $provider_token Payment provider token, obtained via <a
     *     href="https://t.me/botfather">BotFather</a>
     * @param string $currency Three-letter ISO 4217 currency code, see <a
     *     href="https://core.telegram.org/bots/payments#supported-currencies">more on currencies</a>
     * @param Types\LabeledPrice[] $prices Price breakdown, a JSON-serialized list of components (e.g. product price,
     *     tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $max_tip_amount The maximum accepted amount for tips in the <em>smallest units</em> of the
     *     currency (integer, <strong>not</strong> float/double). For example, for a maximum tip of US$ 1.45 pass
     *     max_tip_amount = 145. See the <em>exp</em> parameter in <a
     *     href="https://core.telegram.org/bots/payments/currencies.json">currencies.json</a>, it shows the number of
     *     digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param int[]|null $suggested_tip_amounts A JSON-serialized array of suggested amounts of tips in the
     *     <em>smallest units</em> of the currency (integer, <strong>not</strong> float/double). At most 4 suggested
     *     tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased
     *     order and must not exceed <em>max_tip_amount</em>.
     * @param string|null $provider_data JSON-serialized data about the invoice, which will be shared with the payment
     *     provider. A detailed description of required fields should be provided by the payment provider.
     * @param string|null $photo_url URL of the product photo for the invoice. Can be a photo of the goods or a
     *     marketing image for a service.
     * @param int|null $photo_size Photo size in bytes
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass <em>True</em> if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Pass <em>True</em> if you require the user's phone number to complete the
     *     order
     * @param bool|null $need_email Pass <em>True</em> if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address Pass <em>True</em> if you require the user's shipping address to
     *     complete the order
     * @param bool|null $send_phone_number_to_provider Pass <em>True</em> if the user's phone number should be sent to
     *     the provider
     * @param bool|null $send_email_to_provider Pass <em>True</em> if the user's email address should be sent to the
     *     provider
     * @param bool|null $is_flexible Pass <em>True</em> if the final price depends on the shipping method
     */
    public function createInvoiceLink(
        string $title,
        string $description,
        string $payload,
        string $provider_token,
        string $currency,
        array $prices,
        int $max_tip_amount = null,
        array $suggested_tip_amounts = null,
        string $provider_data = null,
        string $photo_url = null,
        int $photo_size = null,
        int $photo_width = null,
        int $photo_height = null,
        bool $need_name = null,
        bool $need_phone_number = null,
        bool $need_email = null,
        bool $need_shipping_address = null,
        bool $send_phone_number_to_provider = null,
        bool $send_email_to_provider = null,
        bool $is_flexible = null,
    ): Requests\RequestString
    {
        return new Requests\RequestString($this, 'createInvoiceLink', [
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $provider_token,
            'currency' => $currency,
            'prices' => $prices,
            'max_tip_amount' => $max_tip_amount,
            'suggested_tip_amounts' => $suggested_tip_amounts,
            'provider_data' => $provider_data,
            'photo_url' => $photo_url,
            'photo_size' => $photo_size,
            'photo_width' => $photo_width,
            'photo_height' => $photo_height,
            'need_name' => $need_name,
            'need_phone_number' => $need_phone_number,
            'need_email' => $need_email,
            'need_shipping_address' => $need_shipping_address,
            'send_phone_number_to_provider' => $send_phone_number_to_provider,
            'send_email_to_provider' => $send_email_to_provider,
            'is_flexible' => $is_flexible,
        ]);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter <em>is_flexible</em> was specified, the
     * Bot API will send an Update with a <em>shipping_query</em> field to the bot. Use this method to reply to shipping
     * queries.
     *
     * @param string $shipping_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify <em>True</em> if delivery to the specified address is possible and False if there are
     *     any problems (for example, if delivery to the specified address is not possible)
     * @param Types\ShippingOption[]|null $shipping_options Required if <em>ok</em> is <em>True</em>. A JSON-serialized
     *     array of available shipping options.
     * @param string|null $error_message Required if <em>ok</em> is False. Error message in human readable form that
     *     explains why it is impossible to complete the order (e.g. &quot;Sorry, delivery to your desired address is
     *     unavailable'). Telegram will display this message to the user.
     */
    public function answerShippingQuery(
        string $shipping_query_id,
        bool $ok,
        array $shipping_options = null,
        string $error_message = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'answerShippingQuery', [
            'shipping_query_id' => $shipping_query_id,
            'ok' => $ok,
            'shipping_options' => $shipping_options,
            'error_message' => $error_message,
        ]);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the
     * form of an Update with the field <em>pre_checkout_query</em>. Use this method to respond to such pre-checkout
     * queries.<br><br>
     * <strong>Note:</strong> The Bot API must receive an answer within 10 seconds after the pre-checkout
     * query was sent.
     *
     * @param string $pre_checkout_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify <em>True</em> if everything is alright (goods are available, etc.) and the bot is ready
     *     to proceed with the order. Use <em>False</em> if there are any problems.
     * @param string|null $error_message Required if <em>ok</em> is <em>False</em>. Error message in human readable
     *     form that explains the reason for failure to proceed with the checkout (e.g. &quot;Sorry, somebody just
     *     bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please
     *     choose a different color or garment!&quot;). Telegram will display this message to the user.
     */
    public function answerPreCheckoutQuery(
        string $pre_checkout_query_id,
        bool $ok,
        string $error_message = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'answerPreCheckoutQuery', [
            'pre_checkout_query_id' => $pre_checkout_query_id,
            'ok' => $ok,
            'error_message' => $error_message,
        ]);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be
     * able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you
     * returned the error must change).<br><br>
     * Use this if the data submitted by the
     * user doesn't satisfy the standards your service requires for any reason. For example, if a birthday date
     * seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in
     * the error message to make sure the user knows how to correct the issues.
     *
     * @param int $user_id User identifier
     * @param Types\PassportElementError[] $errors A JSON-serialized array describing the errors
     */
    public function setPassportDataErrors(
        int $user_id,
        array $errors,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setPassportDataErrors', [
            'user_id' => $user_id,
            'errors' => $errors,
        ]);
    }

    /**
     * Use this method to send a game.
     *
     * @param int $chat_id Unique identifier for the target chat
     * @param string $game_short_name Short name of the game, serves as the unique identifier for the game. Set up your
     *     games via <a href="https://t.me/botfather">Botfather</a>.
     * @param bool|null $disable_notification Sends the message <a
     *     href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a
     *     notification with no sound.
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id If the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply Pass <em>True</em>, if the message should be sent even if the
     *     specified replied-to message is not found
     * @param Types\InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an <a
     *     href="https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating">inline keyboard</a>. If
     *     empty, one 'Play game_title' button will be shown. If not empty, the first button must launch the
     *     game.
     */
    public function sendGame(
        int $chat_id,
        string $game_short_name,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        Types\InlineKeyboardMarkup $reply_markup = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'sendGame', [
            'chat_id' => $chat_id,
            'game_short_name' => $game_short_name,
            'disable_notification' => $disable_notification,
            'protect_content' => $protect_content,
            'reply_to_message_id' => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * Use this method to set the score of the specified user in a game message. Returns an error, if the new score is
     * not greater than the user's current score in the chat and <em>force</em> is <em>False</em>.
     *
     * @param int $chat_id Unique identifier for the target chat
     * @param int $message_id Identifier of the sent message
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass <em>True</em>, if the high score is allowed to decrease. This can be useful when
     *     fixing mistakes or banning cheaters
     * @param bool|null $disable_edit_message Pass <em>True</em>, if the game message should not be automatically
     *     edited to include the current scoreboard
     */
    public function setGameScore(
        int $chat_id,
        int $message_id,
        int $user_id,
        int $score,
        bool $force = null,
        bool $disable_edit_message = null,
    ): Requests\RequestMessage
    {
        return new Requests\RequestMessage($this, 'setGameScore', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'user_id' => $user_id,
            'score' => $score,
            'force' => $force,
            'disable_edit_message' => $disable_edit_message,
        ]);
    }

    /**
     * Use this method to set the score of the specified user in a game message. Returns an error, if the new score is
     * not greater than the user's current score in the chat and <em>force</em> is <em>False</em>.
     *
     * @param string $inline_message_id Required if <em>chat_id</em> and <em>message_id</em> are not specified.
     *     Identifier of the inline message
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass <em>True</em>, if the high score is allowed to decrease. This can be useful when
     *     fixing mistakes or banning cheaters
     * @param bool|null $disable_edit_message Pass <em>True</em>, if the game message should not be automatically
     *     edited to include the current scoreboard
     */
    public function setGameScoreInline(
        string $inline_message_id,
        int $user_id,
        int $score,
        bool $force = null,
        bool $disable_edit_message = null,
    ): Requests\RequestVoid
    {
        return new Requests\RequestVoid($this, 'setGameScore', [
            'inline_message_id' => $inline_message_id,
            'user_id' => $user_id,
            'score' => $score,
            'force' => $force,
            'disable_edit_message' => $disable_edit_message,
        ]);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of
     * their neighbors in a game.
     *
     * @param int $chat_id Unique identifier for the target chat
     * @param int $message_id Identifier of the sent message
     * @param int $user_id Target user id
     */
    public function getGameHighScores(
        int $chat_id,
        int $message_id,
        int $user_id,
    ): Requests\RequestGameHighScores
    {
        return new Requests\RequestGameHighScores($this, 'getGameHighScores', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of
     * their neighbors in a game.
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param int $user_id Target user id
     */
    public function getGameHighScoresInline(
        string $inline_message_id,
        int $user_id,
    ): Requests\RequestGameHighScores
    {
        return new Requests\RequestGameHighScores($this, 'getGameHighScores', [
            'inline_message_id' => $inline_message_id,
            'user_id' => $user_id,
        ]);
    }
}