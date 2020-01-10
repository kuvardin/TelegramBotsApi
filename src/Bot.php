<?php

namespace TelegramBotsApi;

use TelegramBotsApi\Exceptions\Error;

/**
 * Class Bot
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Bot
{
    public const PARSE_MODE_HTML = 'HTML';
    public const PARSE_MODE_MARKDOWN = 'Markdown';
    public const PARSE_MODE_MARKDOWN_V2 = 'MarkdownV2';
    public const PARSE_MODE_DEFAULT = self::PARSE_MODE_HTML;

    public const ACTION_TYPING = 'typing'; // for text messages
    public const ACTION_UPLOAD_PHOTO = 'upload_photo'; // for photos
    public const ACTION_RECORD_VIDEO = 'record_video'; // for videos
    public const ACTION_UPLOAD_VIDEO = 'upload_video'; // for videos
    public const ACTION_RECORD_AUDIO = 'record_audio'; // for audio files
    public const ACTION_UPLOAD_AUDIO = 'upload_audio'; // for audio files
    public const ACTION_UPLOAD_DOCUMENT = 'upload_document'; // for general files
    public const ACTION_FIND_LOCATION = 'find_location'; // for location data
    public const ACTION_RECORD_VIDEO_NOTE = 'record_video_note'; // for video notes
    public const ACTION_UPLOAD_VIDEO_NOTE = 'upload_video_note'; // for video notes

    /**
     * @var string
     */
    protected string $token;

    /**
     * @var Username
     */
    protected Username $username;

    /**
     * @var string
     */
    protected string $default_parse_mode = self::PARSE_MODE_DEFAULT;

    /**
     * Bot constructor.
     *
     * @param string $token
     * @param string $username
     * @throws Error
     */
    public function __construct(string $token, string $username)
    {
        $this->token = $token;
        $this->username = new Username($username);
    }

    /**
     * @param string $url
     * @param string $text
     * @param string $parse_mode
     * @param bool $filter
     * @return string
     * @throws Error
     */
    public static function genLink(string $url, string $text, string $parse_mode = self::PARSE_MODE_DEFAULT, bool $filter = false): string
    {
        if ($filter) {
            $text = self::filterstring($text, $parse_mode);
        }

        switch ($parse_mode) {
            case self::PARSE_MODE_HTML:
                return "<a href=\"$url\">$text</a>";

            case self::PARSE_MODE_MARKDOWN_V2:
            case self::PARSE_MODE_MARKDOWN:
                return "[$text]($url)";

        }

        throw new Error("Unknown parse mode: $parse_mode");
    }

    /**
     * @param string $text
     * @param string $parse_mode
     * @return string
     * @throws Error
     */
    public static function filterString(string $text, string $parse_mode = self::PARSE_MODE_DEFAULT): string
    {
        switch ($parse_mode) {
            case self::PARSE_MODE_HTML:
                return str_replace(['<', '>', '&', '"'], ['&lt;', '&gt;', '&amp;', '&quot;'], $text);

            case self::PARSE_MODE_MARKDOWN:
                return str_replace(['_', '*', '`', '['], ['\_', '\*', '\`', '\['], $text);

            case self::PARSE_MODE_MARKDOWN_V2:
                return str_replace(
                    ['_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+',
                        '-', '=', '|', '{', '}', '.', '!',],
                    ['\_', '\*', '\[', '\]', '\(', '\)', '\~', '\`', '\>', '\#', '\+',
                        '\-', '\=', '\|', '\{', '\}', '\.', '\!',],
                    $text);

        }

        throw new Error("Unknown parse mode: {$parse_mode}");
    }

    /**
     * @param string $action
     * @return bool
     */
    public static function checkAction(string $action): bool
    {
        return $action === self::ACTION_TYPING ||
            $action === self::ACTION_UPLOAD_PHOTO ||
            $action === self::ACTION_RECORD_VIDEO ||
            $action === self::ACTION_UPLOAD_VIDEO ||
            $action === self::ACTION_RECORD_AUDIO ||
            $action === self::ACTION_UPLOAD_AUDIO ||
            $action === self::ACTION_UPLOAD_DOCUMENT ||
            $action === self::ACTION_FIND_LOCATION ||
            $action === self::ACTION_RECORD_VIDEO_NOTE ||
            $action === self::ACTION_UPLOAD_VIDEO_NOTE;
    }

    /**
     * @param string $parse_mode
     * @return bool
     */
    public static function checkParseMode(string $parse_mode): bool
    {
        return $parse_mode === self::PARSE_MODE_HTML ||
            $parse_mode === self::PARSE_MODE_MARKDOWN ||
            $parse_mode === self::PARSE_MODE_MARKDOWN_V2;
    }

    /**
     * @return string
     */
    public function getDefaultParseMode(): string
    {
        return $this->default_parse_mode;
    }

    /**
     * @param string $parse_mode
     * @return $this
     * @throws Error
     */
    public function setDefaultParseMode(string $parse_mode): self
    {
        if (!self::checkParseMode($parse_mode)) {
            throw new Error("Unknown parse mode: {$parse_mode}");
        }
        $this->default_parse_mode = $parse_mode;
        return $this;
    }

    /**
     * Getting bot ID from token
     *
     * @return int
     */
    public function getId(): int
    {
        return (int)substr($this->token, 0, strpos($this->token, ':'));
    }

    /**
     * Getting bot token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Getting bot username
     *
     * @return Username
     */
    public function getUsername(): Username
    {
        return $this->username;
    }

    /**
     * @param string|null $start_command
     * @param bool|null $start_group
     * @param string $url_format
     * @return string
     */
    public function getBotUrl(string $start_command = null, bool $start_group = null, string $url_format = Username::URL_FORMAT_DEFAULT): string
    {
        $get_params = [];

        if ($start_command !== null) {
            $get_params['start'] = $start_command;
        }

        if ($start_group) {
            $get_params['startgroup'] = 'true';
        }

        return $this->username->getUrl($url_format) .
            (empty($get_params) ? '' : '?' . http_build_query($get_params));
    }


    /**
     * Use this method to receive incoming updates using long polling (wiki).
     * An Array of Update objects is returned.
     *
     * @param int|null $offset Identifier of the first update to be returned. Must be greater by one than
     * the highest among the identifiers of previously received updates. By default, updates starting with
     * the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates
     * is called with an offset higher than its update_id. The negative offset can be specified to retrieve
     * updates starting from -offset update from the end of the updates queue.
     * All previous updates will forgotten.
     * @param int|null $limit Limits the number of updates to be retrieved. Values between 1—100 are
     * accepted. Defaults to 100.
     * @param int|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short
     * polling. Should be positive, short polling should be used for testing purposes only.
     * @param string[]|null $allowed_updates List the types of updates you want your bot to receive.
     * For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates
     * of these types. See Update for a complete list of available update types. Specify an empty list
     * to receive all updates regardless of type (default). If not specified, the previous setting will
     * be used. Please note that this parameter doesn't affect updates created before the call to
     * the getUpdates, so unwanted updates may be received for a short period of time.
     * @return Requests\GetUpdates
     */
    public function getUpdates(int $offset = null, int $limit = null, int $timeout = null,
        array $allowed_updates = null): Requests\GetUpdates
    {
        return new Requests\GetUpdates($this->token, [
            'offset' => $offset,
            'limit' => $limit,
            'timeout' => $timeout,
            'allowed_updates' => $allowed_updates,
        ]);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there
     * is an update for the bot, we will send an HTTPS POST request to the specified url, containing
     * a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount
     * of attempts. Returns True on success.
     *
     * @param string $url HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @param string|null $certificate Upload your public key certificate so that the root certificate in use
     * can be checked. See our self-signed guide for details.
     * @param int|null $max_connections Maximum allowed number of simultaneous HTTPS connections to the
     * webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot‘s
     * server, and higher values to increase your bot’s throughput.
     * @param string[]|null $allowed_updates List the types of updates you want your bot to receive.
     * For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of
     * these types. See Update for a complete list of available update types. Specify an empty list to receive
     * all updates regardless of type (default). If not specified, the previous setting will be used.
     * Please note that this parameter doesn't affect updates created before the call to the setWebhook,
     * so unwanted updates may be received for a short period of time.
     * @return Requests\SetWebhook
     */
    public function setWebhook(string $url, string $certificate = null, int $max_connections = null,
        array $allowed_updates = null): Requests\SetWebhook
    {
        return new Requests\SetWebhook($this->token, [
            'url' => $url,
            'certificate' => $certificate,
            'max_connections' => $max_connections,
            'allowed_updates' => $allowed_updates,
        ]);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates.
     * Returns True on success. Requires no parameters.
     *
     * @return Requests\DeleteWebhook
     */
    public function deleteWebhook(): Requests\DeleteWebhook
    {
        return new Requests\DeleteWebhook($this->token);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns
     * a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @return Requests\GetWebhookInfo
     */
    public function getWebhookInfo(): Requests\GetWebhookInfo
    {
        return new Requests\GetWebhookInfo($this->token);
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information
     * about the bot in form of a User object.
     *
     * @return Requests\GetMe
     */
    public function getMe(): Requests\GetMe
    {
        return new Requests\GetMe($this->token);
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $text Text of the message to be sent
     * @return Requests\SendMessage
     */
    public function sendMessage($chat_id, string $text): Requests\SendMessage
    {
        return (new Requests\SendMessage($this->token, [
            'chat_id' => $chat_id,
            'text' => $text,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to forward messages of any kind. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent
     * (or channel username in the format @channelusername)
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @return Requests\ForwardMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id): Requests\ForwardMessage
    {
        return new Requests\ForwardMessage($this->token, [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $photo Photo to send. Pass a file_id as string to send a photo that exists on
     * the Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get a photo from
     * the Internet, or upload a new photo using multipart/form-data.
     * @param string|null $caption Photo caption (may also be used when resending photos by file_id), 0-1024 characters
     * @return Requests\SendPhoto
     */
    public function sendPhoto($chat_id, string $photo, string $caption = null): Requests\SendPhoto
    {
        return (new Requests\SendPhoto($this->token, [
            'chat_id' => $chat_id,
            'photo' => $photo,
            'caption' => $caption,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $audio Audio file to send. Pass a file_id as string to send an audio file that exists
     * on the Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get an audio file
     * from the Internet, or upload a new one using multipart/form-data.
     * @param string|null $caption Audio caption, 0-1024 characters
     * @param int|null $duration Duration of the audio in seconds
     * @param string|null $performer Performer
     * @param string|null $title Track name
     * @param string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for
     * the file  is supported server-side. The thumbnail should be in JPEG format and less than 200 kB
     * in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded
     * using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you
     * can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>.
     * @return Requests\SendAudio
     */
    public function sendAudio($chat_id, string $audio, string $caption = null, int $duration = null,
        string $performer = null, string $title = null, string $thumb = null): Requests\SendAudio
    {
        return (new Requests\SendAudio($this->token, [
            'chat_id' => $chat_id,
            'audio' => $audio,
            'caption' => $caption,
            'duration' => $duration,
            'performer' => $performer,
            'title' => $title,
            'thumb' => $thumb,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently
     * send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $document File to send. Pass a file_id as string to send a file that exists on the
     * Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get a file from
     * the Internet, or upload a new one using multipart/form-data.
     * @param string|null $caption Document caption (may also be used when resending documents by file_id),
     * 0-1024 characters
     * @param string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for
     * the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size.
     * A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded using
     * multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass
     * “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>.
     * @return Requests\SendDocument
     */
    public function sendDocument($chat_id, string $document, string $caption = null,
        string $thumb = null): Requests\SendDocument
    {
        return (new Requests\SendDocument($this->token, [
            'chat_id' => $chat_id,
            'document' => $document,
            'thumb' => $thumb,
            'caption' => $caption,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as
     * Document). On success, the sent Message is returned. Bots can currently send video files
     * of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $video Video to send. Pass a file_id as string to send a video that exists on the Telegram
     * servers (recommended), pass an HTTP URL as a string for Telegram to get a video from the Internet, or upload
     * a new video using multipart/form-data.
     * @param string|null $caption Video caption (may also be used when resending videos by file_id),
     * 0-1024 characters
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $width Video width
     * @param int|null $height Video height
     * @param string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for
     * the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB
     * in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded
     * using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you
     * can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>.
     * @param bool|null $supports_streaming Pass True, if the uploaded video is suitable for streaming
     * @return Requests\SendVideo
     */
    public function sendVideo($chat_id, string $video, string $caption = null, int $duration = null, int $width = null,
        int $height = null, string $thumb = null, bool $supports_streaming = null): Requests\SendVideo
    {
        return (new Requests\SendVideo($this->token, [
            'chat_id' => $chat_id,
            'video' => $video,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => $caption,
            'supports_streaming' => $supports_streaming,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success,
     * the sent Message is returned. Bots can currently send animation files of up to 50 MB in size,
     * this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $animation Animation to send. Pass a file_id as string to send an animation that exists
     * on the Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get an animation
     * from the Internet, or upload a new animation using multipart/form-data.
     * @param string|null $caption Animation caption (may also be used when resending animation by file_id),
     * 0-1024 characters
     * @param int|null $duration Duration of sent animation in seconds
     * @param int|null $width Animation width
     * @param int|null $height Animation height
     * @param string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for
     * the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB
     * in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded
     * using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you
     * can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>.
     * @return Requests\SendAnimation
     */
    public function sendAnimation($chat_id, string $animation, string $caption = null, int $duration = null,
        int $width = null, int $height = null, string $thumb = null): Requests\SendAnimation
    {
        return (new Requests\SendAnimation($this->token, [
            'chat_id' => $chat_id,
            'animation' => $animation,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => $caption,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable
     * voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats
     * may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send
     * voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $voice Audio file to send. Pass a file_id as string to send a file that exists on
     * the Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get a file from
     * the Internet, or upload a new one using multipart/form-data.
     * @param string|null $caption Voice message caption, 0-1024 characters
     * @param int|null $duration Duration of the voice message in seconds
     * @return Requests\SendVoice
     */
    public function sendVoice($chat_id, string $voice, string $caption = null,
        int $duration = null): Requests\SendVoice
    {
        return (new Requests\SendVoice($this->token, [
            'chat_id' => $chat_id,
            'voice' => $voice,
            'caption' => $caption,
            'duration' => $duration,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long.
     * Use this method to send video messages. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $video_note Video note to send. Pass a file_id as string to send a video note
     * that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data.
     * Sending video notes by a URL is currently unsupported
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $length Video width and height, i.e. diameter of the video message
     * @param string|null $thumb Thumbnail of the file sent; can be ignored if thumbnail generation for
     * the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB
     * in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded
     * using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you
     * can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data
     * under <file_attach_name>.
     * @return Requests\SendVideoNote
     */
    public function sendVideoNote($chat_id, string $video_note, int $duration = null, int $length = null,
        string $thumb = null): Requests\SendVideoNote
    {
        return new Requests\SendVideoNote($this->token, [
            'chat_id' => $chat_id,
            'video_note' => $video_note,
            'duration' => $duration,
            'length' => $length,
            'thumb' => $thumb,
        ]);
    }

    /**
     * Use this method to send a group of photos or videos as an album. On success, an array of the sent
     * Messages is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param Types\InputMedia\Photo[]|Types\InputMedia\Video[] $media A JSON-serialized array describing
     * photos and videos to be sent, must include 2–10 items
     * @return Requests\SendMediaGroup
     */
    public function sendMediaGroup($chat_id, array $media): Requests\SendMediaGroup
    {
        return new Requests\SendMediaGroup($this->token, [
            'chat_id' => $chat_id,
            'media' => $media,
        ]);
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param int|null $live_period Period in seconds for which the location will be updated
     * (see Live Locations), should be between 60 and 86400.
     * @return Requests\SendLocation
     */
    public function sendLocation($chat_id, float $latitude, float $longitude,
        int $live_period = null): Requests\SendLocation
    {
        return new Requests\SendLocation($this->token, [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'live_period' => $live_period,
        ]);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its live_period
     * expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success,
     * if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int|null $message_id Identifier of the message to edit
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @return Requests\EditMessageLiveLocation
     */
    public function editMessageLiveLocation($chat_id, int $message_id, float $latitude,
        float $longitude): Requests\EditMessageLiveLocation
    {
        return new Requests\EditMessageLiveLocation($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    /**
     * Inline version of method editMessageLiveLocation()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @return Requests\EditMessageLiveLocation
     */
    public function editMessageLiveLocationInline(string $inline_message_id, float $latitude, float $longitude): Requests\EditMessageLiveLocation
    {
        return new Requests\EditMessageLiveLocation($this->token, [
            'inline_message_id' => $inline_message_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires. On success,
     * if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the message with live location to stop
     * @return Requests\StopMessageLiveLocation
     */
    public function stopMessageLiveLocation($chat_id, int $message_id): Requests\StopMessageLiveLocation
    {
        return new Requests\StopMessageLiveLocation($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Inline version of method stopMessageLiveLocation()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @return Requests\StopMessageLiveLocation
     */
    public function stopMessageLiveLocationInline(string $inline_message_id): Requests\StopMessageLiveLocation
    {
        return new Requests\StopMessageLiveLocation($this->token, [
            'inline_message_id' => $inline_message_id,
        ]);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Foursquare identifier of the venue
     * @param string|null $foursquare_type Foursquare type of the venue, if known.
     * (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @return Requests\SendVenue
     */
    public function sendVenue($chat_id, float $latitude, float $longitude, string $title, string $address,
        string $foursquare_id = null, string $foursquare_type = null): Requests\SendVenue
    {
        return new Requests\SendVenue($this->token, [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            'foursquare_id' => $foursquare_id,
            'foursquare_type' => $foursquare_type,
        ]);
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @return Requests\SendContact
     */
    public function sendContact($chat_id, string $phone_number, string $first_name, string $last_name = null, string $vcard = null): Requests\SendContact
    {
        return new Requests\SendContact($this->token, [
            'chat_id' => $chat_id,
            'phone_number' => $phone_number,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'vcard' => $vcard,
        ]);
    }

    /**
     * Use this method to send a native poll. A native poll can't be sent to a private chat.
     * On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername). A native poll can't be sent to a private chat.
     * @param string $question Poll question, 1-255 characters
     * @param string[] $options List of answer options, 2-10 strings 1-100 characters each
     * @return Requests\SendPoll
     */
    public function sendPoll($chat_id, string $question, array $options): Requests\SendPoll
    {
        return new Requests\SendPoll($this->token, [
            'chat_id' => $chat_id,
            'question' => $question,
            'options' => $options,
        ]);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear
     * its typing status). Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $action Type of action to broadcast. Choose one, depending on what the user is about to
     * receive: typing for text messages, upload_photo for photos, record_video or upload_video for videos,
     * record_audio or upload_audio for audio files, upload_document for general files, find_location
     * for location data, record_video_note or upload_video_note for video notes.
     * @return Requests\SendChatAction
     */
    public function sendChatAction($chat_id, string $action): Requests\SendChatAction
    {
        return new Requests\SendChatAction($this->token, [
            'chat_id' => $chat_id,
            'action' => $action,
        ]);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     *
     * @param int $user_id Unique identifier of the target user
     * @param int|null $offset Sequential number of the first photo to be returned. By default, all photos
     * are returned.
     * @param int|null $limit Limits the number of photos to be retrieved. Values between 1—100
     * are accepted. Defaults to 100.
     * @return Requests\GetUserProfilePhotos
     */
    public function getUserProfilePhotos(int $user_id, int $offset = null,
        int $limit = null): Requests\GetUserProfilePhotos
    {
        return new Requests\GetUserProfilePhotos($this->token, [
            'user_id' => $user_id,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots
     * can download files of up to 20MB in size. On success, a File object is returned. The file can then
     * be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path>
     * is taken from the response. It is guaranteed that the link will be valid for at least 1 hour.
     * When the link expires, a new one can be requested by calling getFile again.
     *
     * @param string $file_id File identifier to get info about
     * @return Requests\GetFile
     */
    public function getFile(string $file_id): Requests\GetFile
    {
        return new Requests\GetFile($this->token, [
            'file_id' => $file_id,
        ]);
    }

    /**
     * Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups
     * and channels, the user will not be able to return to the group on their own using invite links, etc.,
     * unless unbanned first. The bot must be an administrator in the chat for this to work and must have
     * the appropriate admin rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target
     * supergroup or channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param int|null $until_date Date when the user will be unbanned, unix time. If user is banned for
     * more than 366 days or less than 30 seconds from the current time they are considered
     * to be banned forever
     * @return Requests\KickChatMember
     */
    public function kickChatMember($chat_id, int $user_id, int $until_date = null): Requests\KickChatMember
    {
        return new Requests\KickChatMember($this->token, [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'until_date' => $until_date,
        ]);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup or channel. The user will not
     * return to the group or channel automatically, but will be able to join via link, etc. The bot must
     * be an administrator for this to work. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target group or username of the target supergroup
     * or channel (in the format @username)
     * @param int $user_id Unique identifier of the target user
     * @return Requests\UnbanChatMember
     */
    public function unbanChatMember($chat_id, int $user_id): Requests\UnbanChatMember
    {
        return new Requests\UnbanChatMember($this->token, [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in
     * the supergroup for this to work and must have the appropriate admin rights. Pass True for all
     * permissions to lift restrictions from a user. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * (in the format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param Types\ChatPermissions $permissions New user permissions
     * @param int|null $until_date Date when restrictions will be lifted for the user, unix time. If user
     * is restricted for more than 366 days or less than 30 seconds from the current time, they are
     * considered to be restricted forever
     * @return Requests\RestrictChatMember
     */
    public function restrictChatMember($chat_id, int $user_id, Types\ChatPermissions $permissions,
        int $until_date = null): Requests\RestrictChatMember
    {
        return new Requests\RestrictChatMember($this->token, [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'permissions' => $permissions,
            'until_date' => $until_date,
        ]);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be
     * an administrator in the chat for this to work and must have the appropriate admin rights.
     * Pass False for all boolean parameters to demote a user. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @param Types\AdministratorPermissions $permissions Array with keys is self::CAN_* and values is bool
     * @return Requests\PromoteChatMember
     */
    public function promoteChatMember($chat_id, int $user_id,
        Types\AdministratorPermissions $permissions): Requests\PromoteChatMember
    {
        return new Requests\PromoteChatMember($this->token, array_merge([
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ], $permissions->getRequestArray()));
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * (in the format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @param string $custom_title New custom title for the administrator; 0-16 characters,
     * emoji are not allowed
     * @return Requests\SetChatAdministratorCustomTitle
     */
    public function setChatAdministratorCustomTitle($chat_id, int $user_id,
        string $custom_title): Requests\SetChatAdministratorCustomTitle
    {
        return new Requests\SetChatAdministratorCustomTitle($this->token, [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'custom_title' => $custom_title,
        ]);
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator
     * in the group or a supergroup for this to work and must have the can_restrict_members admin rights.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * (in the format @supergroupusername)
     * @param Types\ChatPermissions $permissions New default chat permissions
     * @return Requests\SetChatPermissions
     */
    public function setChatPermissions($chat_id, Types\ChatPermissions $permissions): Requests\SetChatPermissions
    {
        return new Requests\SetChatPermissions($this->token, [
            'chat_id' => $chat_id,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Use this method to generate a new invite link for a chat; any previously generated link is revoked.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin
     * rights. Returns the new invite link as string on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @return Requests\ExportChatInviteLink
     */
    public function exportChatInviteLink($chat_id): Requests\ExportChatInviteLink
    {
        return new Requests\ExportChatInviteLink($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats.
     * The bot must be an administrator in the chat for this to work and must have the appropriate admin
     * rights. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $photo New chat photo, uploaded using multipart/form-data
     * @return Requests\SetChatPhoto
     */
    public function setChatPhoto($chat_id, string $photo): Requests\SetChatPhoto
    {
        return new Requests\SetChatPhoto($this->token, [
            'chat_id' => $chat_id,
            'photo' => $photo,
        ]);
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be
     * an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @return Requests\DeleteChatPhoto
     */
    public function deleteChatPhoto($chat_id): Requests\DeleteChatPhoto
    {
        return new Requests\DeleteChatPhoto($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot
     * must be an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $title New chat title, 1-255 characters
     * @return Requests\SetChatTitle
     */
    public function setChatTitle($chat_id, string $title): Requests\SetChatTitle
    {
        return new Requests\SetChatTitle($this->token, [
            'chat_id' => $chat_id,
            'title' => $title,
        ]);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be
     * an administrator in the chat for this to work and must have the appropriate admin rights.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string|null $description New chat description, 0-255 characters
     * @return Requests\SetChatDescription
     */
    public function setChatDescription($chat_id, string $description = null): Requests\SetChatDescription
    {
        return new Requests\SetChatDescription($this->token, [
            'chat_id' => $chat_id,
            'description' => $description,
        ]);
    }

    /**
     * Use this method to pin a message in a group, a supergroup, or a channel. The bot must be
     * an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in
     * the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of a message to pin
     * @return Requests\PinChatMessage
     */
    public function pinChatMessage($chat_id, int $message_id): Requests\PinChatMessage
    {
        return new Requests\PinChatMessage($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to unpin a message in a group, a supergroup, or a channel. The bot must be
     * an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in
     * the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return Requests\UnpinChatMessage
     */
    public function unpinChatMessage($chat_id): Requests\UnpinChatMessage
    {
        return new Requests\UnpinChatMessage($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * or channel (in the format @channelusername)
     * @return Requests\LeaveChat
     */
    public function leaveChat($chat_id): Requests\LeaveChat
    {
        return new Requests\LeaveChat($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one
     * conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return Requests\GetChat
     */
    public function getChat($chat_id): Requests\GetChat
    {
        return new Requests\GetChat($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember
     * objects that contains information about all chat administrators except other bots. If the chat is
     * a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * or channel (in the format @channelusername)
     * @return Requests\GetChatAdministrators
     */
    public function getChatAdministrators($chat_id): Requests\GetChatAdministrators
    {
        return new Requests\GetChatAdministrators($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get the number of members in a chat. Returns Int on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * or channel (in the format @channelusername)
     * @return Requests\GetChatMembersCount
     */
    public function getChatMembersCount($chat_id): Requests\GetChatMembersCount
    {
        return new Requests\GetChatMembersCount($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * or channel (in the format @channelusername)
     * @param int $user_id Unique identifier of the target user
     * @return Requests\GetChatMember
     */
    public function getChatMember($chat_id, int $user_id): Requests\GetChatMember
    {
        return new Requests\GetChatMember($this->token, [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in
     * the chat for this to work and must have the appropriate admin rights. Use the field
     * can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * (in the format @supergroupusername)
     * @param string $sticker_set_name Name of the sticker set to be set as the group sticker set
     * @return Requests\SetChatStickerSet
     */
    public function setChatStickerSet($chat_id, string $sticker_set_name): Requests\SetChatStickerSet
    {
        return new Requests\SetChatStickerSet($this->token, [
            'chat_id' => $chat_id,
            'sticker_set_name' => $sticker_set_name,
        ]);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in
     * the chat for this to work and must have the appropriate admin rights. Use the field
     * can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method.
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * (in the format @supergroupusername)
     * @return Requests\DeleteChatStickerSet
     */
    public function deleteChatStickerSet($chat_id): Requests\DeleteChatStickerSet
    {
        return new Requests\DeleteChatStickerSet($this->token, [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will
     * be displayed to the user as a notification at the top of the chat screen or as an alert.
     * On success, True is returned.
     *
     * @param string $callback_query_id Unique identifier for the query to be answered
     * @param string|null $text Text of the notification. If not specified, nothing will be shown to
     * the user, 0-200 characters
     * @param bool|null $show_alert If true, an alert will be shown by the client instead of a notification
     * at the top of the chat screen. Defaults to false.
     * @param string|null $url URL that will be opened by the user's client. If you have created a Game and
     * accepted the conditions via @Botfather, specify the URL that opens your game – note that this will
     * only work if the query comes from a callback_game button.
     * Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
     * @return Requests\AnswerCallbackQuery
     */
    public function answerCallbackQuery(string $callback_query_id, string $text = null, bool $show_alert = null, string $url = null, int $cache_time = null): Requests\AnswerCallbackQuery
    {
        return new Requests\AnswerCallbackQuery($this->token, [
            'callback_query_id' => $callback_query_id,
            'text' => $text,
            'show_alert' => $show_alert,
            'url' => $url,
            'cache_time' => $cache_time,
        ]);
    }

    /**
     * Use this method to edit text and game messages. On success, if edited message is sent by the bot,
     * the edited Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param string $text New text of the message
     * @return Requests\EditMessageText
     */
    public function editMessageText($chat_id, int $message_id, string $text): Requests\EditMessageText
    {
        return (new Requests\EditMessageText($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => $text,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Inline version of method editMessageText()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param string $text New text of the message
     * @return Requests\EditMessageText
     */
    public function editMessageTextInline(string $inline_message_id, string $text): Requests\EditMessageText
    {
        return (new Requests\EditMessageText($this->token, [
            'inline_message_id' => $inline_message_id,
            'text' => $text,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to edit captions of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param string|null $caption New caption of the message
     * @return Requests\EditMessageCaption
     */
    public function editMessageCaption($chat_id, int $message_id, string $caption = null): Requests\EditMessageCaption
    {
        return (new Requests\EditMessageCaption($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'caption' => $caption,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Inline version of method editMessageCaption()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param string|null $caption New caption of the message
     * @return Requests\EditMessageCaption
     */
    public function editMessageCaptionInline(string $inline_message_id,
        string $caption = null): Requests\EditMessageCaption
    {
        return (new Requests\EditMessageCaption($this->token, [
            'inline_message_id' => $inline_message_id,
            'caption' => $caption,
        ]))->setParseMode($this->default_parse_mode);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is a part of a message album, then it can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the message to edit
     * @param Types\InputMedia $media A JSON-serialized object for a new media content of the message
     * @return Requests\EditMessageMedia
     */
    public function editMessageMedia($chat_id, int $message_id, Types\InputMedia $media): Requests\EditMessageMedia
    {
        return new Requests\EditMessageMedia($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'media' => $media,
        ]);
    }

    /**
     * Inline version of method editMessageMedia()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param Types\InputMedia $media A JSON-serialized object for a new media content of the message
     * @return Requests\EditMessageMedia
     */
    public function editMessageMediaInline(string $inline_message_id,
        Types\InputMedia $media): Requests\EditMessageMedia
    {
        return new Requests\EditMessageMedia($this->token, [
            'inline_message_id' => $inline_message_id,
            'media' => $media,
        ]);
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the message to edit
     * @return Requests\EditMessageReplyMarkup
     */
    public function editMessageReplyMarkup($chat_id, int $message_id): Requests\EditMessageReplyMarkup
    {
        return new Requests\EditMessageReplyMarkup($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Inline version of method editMessageReplyMarkup()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @return Requests\EditMessageReplyMarkup
     */
    public function editMessageReplyMarkupInline(string $inline_message_id): Requests\EditMessageReplyMarkup
    {
        return new Requests\EditMessageReplyMarkup($this->token, [
            'inline_message_id' => $inline_message_id,
        ]);
    }

    /**
     * Use this method to stop a poll which was sent by the bot.
     * On success, the stopped Poll with the final results is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param int $message_id Identifier of the original message with the poll
     * @return Requests\StopPoll
     */
    public function stopPoll($chat_id, int $message_id): Requests\StopPoll
    {
        return new Requests\StopPoll($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:<br>
     * - A message can only be deleted if it was sent less than 48 hours ago.<br>
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.<br>
     * - Bots can delete incoming messages in private chats.<br>
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.<br>
     * - If the bot is an administrator of a group, it can delete any message there.<br>
     * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.<br><br>
     * Returns True on success.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id Identifier of the message to delete
     * @return Requests\DeleteMessage
     */
    public function deleteMessage($chat_id, int $message_id): Requests\DeleteMessage
    {
        return new Requests\DeleteMessage($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Use this method to send static .WEBP or animated .TGS stickers.
     * On success, the sent Message is returned.
     *
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * (in the format @channelusername)
     * @param string $sticker Sticker to send. Pass a file_id as string to send a file that exists on
     * the Telegram servers (recommended), pass an HTTP URL as a string for Telegram to get a .webp file
     * from the Internet, or upload a new one using multipart/form-data.
     * @return Requests\SendSticker
     */
    public function sendSticker($chat_id, string $sticker): Requests\SendSticker
    {
        return new Requests\SendSticker($this->token, [
            'chat_id' => $chat_id,
            'sticker' => $sticker,
        ]);
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     *
     * @param string $name Name of the sticker set
     * @return Requests\GetStickerSet
     */
    public function getStickerSet(string $name): Requests\GetStickerSet
    {
        return new Requests\GetStickerSet($this->token, [
            'name' => $name,
        ]);
    }

    /**
     * Use this method to upload a .png file with a sticker for later use in createNewStickerSet and
     * addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
     *
     * @param int $user_id User identifier of sticker file owner
     * @param string $png_sticker Png image with the sticker, must be up to 512 kilobytes in size,
     * dimensions must not exceed 512px, and either width or height must be exactly 512px.
     * @return Requests\UploadStickerFile
     */
    public function uploadStickerFile(int $user_id, string $png_sticker): Requests\UploadStickerFile
    {
        return new Requests\UploadStickerFile($this->token, [
            'user_id' => $user_id,
            'png_sticker' => $png_sticker,
        ]);
    }

    /**
     * Use this method to create new sticker set owned by a user. The bot will be able to edit the created
     * sticker set. Returns True on success.
     *
     * @param int $user_id User identifier of created sticker set owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals).
     * Can contain only english letters, digits and underscores. Must begin with a letter, can't contain
     * consecutive underscores and must end in “_by_<bot username>”. <bot_username> is case insensitive.
     * 1-64 characters.
     * @param string $title Sticker set title, 1-64 characters
     * @param string $png_sticker Png image with the sticker, must be up to 512 kilobytes in size,
     * dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id
     * as a string to send a file that already exists on the Telegram servers, pass an HTTP URL as a string
     * for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param bool|null $contains_masks Pass True, if a set of mask stickers should be created
     * @param Types\MaskPosition|null $mask_position A JSON-serialized object for position where the mask should be placed on faces
     * @return Requests\CreateNewStickerSet
     */
    public function createNewStickerSet(int $user_id, string $name, string $title, string $png_sticker,
        string $emojis, bool $contains_masks = null, Types\MaskPosition $mask_position = null): Requests\CreateNewStickerSet
    {
        return new Requests\CreateNewStickerSet($this->token, [
            'user_id' => $user_id,
            'name' => $name,
            'title' => $title,
            'png_sticker' => $png_sticker,
            'emojis' => $emojis,
            'contains_masks' => $contains_masks,
            'mask_position' => $mask_position,
        ]);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. Returns True on success.
     *
     * @param int $user_id User identifier of sticker set owner
     * @param string $name Sticker set name
     * @param string $png_sticker Png image with the sticker, must be up to 512 kilobytes in size,
     * dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as
     * a string to send a file that already exists on the Telegram servers, pass an HTTP URL as a string for
     * Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param Types\MaskPosition|null $mask_position A JSON-serialized object for position where the mask should be placed on faces
     * @return Requests\AddStickerToSet
     */
    public function addStickerToSet(int $user_id, string $name, string $png_sticker, string $emojis,
        Types\MaskPosition $mask_position = null): Requests\AddStickerToSet
    {
        return new Requests\AddStickerToSet($this->token, [
            'user_id' => $user_id,
            'name' => $name,
            'png_sticker' => $png_sticker,
            'emojis' => $emojis,
            'mask_position' => $mask_position,
        ]);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     * Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     * @return Requests\SetStickerPositionInSet
     */
    public function setStickerPositionInSet(string $sticker, int $position): Requests\SetStickerPositionInSet
    {
        return new Requests\SetStickerPositionInSet($this->token, [
            'sticker' => $sticker,
            'position' => $position,
        ]);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     *
     * @param string $sticker File identifier of the sticker
     * @return Requests\DeleteStickerFromSet
     */
    public function deleteStickerFromSet(string $sticker): Requests\DeleteStickerFromSet
    {
        return new Requests\DeleteStickerFromSet($this->token, [
            'sticker' => $sticker,
        ]);
    }

    /**
     * Use this method to send answers to an inline query.
     * On success, True is returned.No more than 50 results per query are allowed.
     *
     * @param string $inline_query_id Unique identifier for the answered query
     * @param Types\InlineQueryResult[] $results A JSON-serialized array of results for the inline query
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the inline query
     * may be cached on the server. Defaults to 300.
     * @param bool|null $is_personal Pass True, if results may be cached on the server side only for
     * the user that sent the query. By default, results may be returned to any user who sends the same query
     * @param string|null $next_offset Pass the offset that a client should send in the next query with
     * the same text to receive more results. Pass an empty string if there are no more results or if you
     * don‘t support pagination. Offset length can’t exceed 64 bytes.
     * @param string|null $switch_pm_text If passed, clients will display a button with specified text
     * that switches the user to a private chat with the bot and sends the bot a start message with
     * the parameter switch_pm_parameter
     * @param string|null $switch_pm_parameter Deep-linking parameter for the /start message sent to the bot
     * when user presses the switch button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.<br>
     * Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube
     * account to adapt search results accordingly. To do this, it displays a ‘Connect your YouTube account’
     * button above the results, or even before showing any. The user presses the button, switches to
     * a private chat with the bot and, in doing so, passes a start parameter that instructs the bot
     * to return an oauth link. Once done, the bot can offer a switch_inline button so that the user can
     * easily return to the chat where they wanted to use the bot's inline capabilities.
     * @return Requests\AnswerInlineQuery
     */
    public function answerInlineQuery(string $inline_query_id, array $results, int $cache_time = null,
        bool $is_personal = null, string $next_offset = null, string $switch_pm_text = null,
        string $switch_pm_parameter = null): Requests\AnswerInlineQuery
    {
        return new Requests\AnswerInlineQuery($this->token, [
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
     * Use this method to send invoices. On success, the sent Message is returned.
     *
     * @param int $chat_id Unique identifier for the target private chat
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to
     * the user, use for your internal processes.
     * @param string $provider_token Payments provider token, obtained via Botfather
     * @param string $start_parameter Unique deep-linking parameter that can be used to generate this
     * invoice when used as a start parameter
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies
     * @param Types\LabeledPrice[] $prices Price breakdown, a list of components
     * (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param string|null $provider_data JSON-encoded data about the invoice, which will be shared with the
     * payment provider. A detailed description of required fields should be provided by the payment provider.
     * @param string|null $photo_url URL of the product photo for the invoice. Can be a photo of the goods or
     * a marketing image for a service. People like it better when they see what they are paying for.
     * @param int|null $photo_size Photo size
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass True, if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Pass True, if you require the user's phone number
     * to complete the order
     * @param bool|null $need_email Pass True, if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address Pass True, if you require the user's shipping address to
     * complete the order
     * @param bool|null $send_phone_number_to_provider Pass True, if user's phone number should be
     * sent to provider
     * @param bool|null $send_email_to_provider Pass True, if user's email address should be sent to provider
     * @param bool|null $is_flexible Pass True, if the final price depends on the shipping method
     * @return Requests\SendInvoice
     */
    public function sendInvoice(int $chat_id, string $title, string $description, string $payload,
        string $provider_token, string $start_parameter, string $currency, array $prices,
        string $provider_data = null, string $photo_url = null, int $photo_size = null,
        int $photo_width = null, int $photo_height = null, bool $need_name = null,
        bool $need_phone_number = null, bool $need_email = null, bool $need_shipping_address = null,
        bool $send_phone_number_to_provider = null, bool $send_email_to_provider = null,
        bool $is_flexible = null): Requests\SendInvoice
    {
        return new Requests\SendInvoice($this->token, [
            'chat_id' => $chat_id,
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $provider_token,
            'start_parameter' => $start_parameter,
            'currency' => $currency,
            'prices' => $prices,
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
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified,
     * the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply
     * to shipping queries. On success, True is returned.
     *
     * @param string $shipping_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify True if delivery to the specified address is possible and False if there are
     * any problems (for example, if delivery to the specified address is not possible)
     * @param Types\ShippingOption[]|null $shipping_options Required if ok is True. A JSON-serialized array
     * of available shipping options.
     * @param string|null $error_message Required if ok is False. Error message in human readable form that
     * explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address
     * is unavailable'). Telegram will display this message to the user.
     * @return Requests\AnswerShippingQuery
     */
    public function answerShippingQuery(string $shipping_query_id, bool $ok, array $shipping_options = null,
        string $error_message = null): Requests\AnswerShippingQuery
    {
        return new Requests\AnswerShippingQuery($this->token, [
            'shipping_query_id' => $shipping_query_id,
            'ok' => $ok,
            'shipping_options' => $shipping_options,
            'error_message' => $error_message,
        ]);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final
     * confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond
     * to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer
     * within 10 seconds after the pre-checkout query was sent.
     *
     * @param string $pre_checkout_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify True if everything is alright (goods are available, etc.) and the bot is
     * ready to proceed with the order. Use False if there are any problems.
     * @param string|null $error_message Required if ok is False. Error message in human readable form that
     * explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought
     * the last of our amazing black T-shirts while you were busy filling out your payment details. Please
     * choose a different color or garment!"). Telegram will display this message to the user.
     * @return Requests\AnswerPreCheckoutQuery
     */
    public function answerPreCheckoutQuery(string $pre_checkout_query_id, bool $ok,
        string $error_message = null): Requests\AnswerPreCheckoutQuery
    {
        return new Requests\AnswerPreCheckoutQuery($this->token, [
            'pre_checkout_query_id' => $pre_checkout_query_id,
            'ok' => $ok,
            'error_message' => $error_message,
        ]);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user
     * will not be able to re-submit their Passport to you until the errors are fixed (the contents of
     * the field for which you returned the error must change). Returns True on success.
     *
     * @param int $user_id User identifier
     * @param Types\PassportElementError[] $errors A JSON-serialized array describing the errors
     * @return Requests\SetPassportDataErrors
     */
    public function setPassportDataErrors(int $user_id, array $errors): Requests\SetPassportDataErrors
    {
        return new Requests\SetPassportDataErrors($this->token, [
            'user_id' => $user_id,
            'errors' => $errors,
        ]);
    }

    /**
     * Use this method to send a game. On success, the sent Message is returned.
     *
     * @param int $chat_id Unique identifier for the target chat
     * @param string $game_short_name Short name of the game, serves as the unique identifier for the game.
     * Set up your games via Botfather.
     * @return Requests\SendGame
     */
    public function sendGame(int $chat_id, string $game_short_name): Requests\SendGame
    {
        return new Requests\SendGame($this->token, [
            'chat_id' => $chat_id,
            'game_short_name' => $game_short_name,
        ]);
    }

    /**
     * Use this method to set the score of the specified user in a game. On success, if the message was sent
     * by the bot, returns the edited Message, otherwise returns True. Returns an error, if the new score
     * is not greater than the user's current score in the chat and force is False.
     *
     * @param int|null $chat_id Unique identifier for the target chat
     * @param int|null $message_id Identifier of the sent message
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass True, if the high score is allowed to decrease. This can be useful when
     * fixing mistakes or banning cheaters
     * @param bool|null $disable_edit_message Pass True, if the game message should not be automatically
     * edited to include the current scoreboard
     * @return Requests\SetGameScore
     */
    public function setGameScore(int $chat_id, int $message_id, int $user_id, int $score, bool $force = null, bool $disable_edit_message = null): Requests\SetGameScore
    {
        return new Requests\SetGameScore($this->token, [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'user_id' => $user_id,
            'score' => $score,
            'force' => $force,
            'disable_edit_message' => $disable_edit_message,
        ]);
    }

    /**
     * Inline version of method setGameScore()
     *
     * @param string $inline_message_id Identifier of the inline message
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass True, if the high score is allowed to decrease.
     * This can be useful when fixing mistakes or banning cheaters
     * @param bool|null $disable_edit_message Pass True, if the game message should not be automatically
     * edited to include the current scoreboard
     * @return Requests\SetGameScore
     */
    public function setGameScoreInline(string $inline_message_id, int $user_id, int $score, bool $force = null, bool $disable_edit_message = null): Requests\SetGameScore
    {
        return new Requests\SetGameScore($this->token, [
            'inline_message_id' => $inline_message_id,
            'user_id' => $user_id,
            'score' => $score,
            'force' => $force,
            'disable_edit_message' => $disable_edit_message,
        ]);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and
     * several of his neighbors in a game. On success, returns an Array of GameHighScore objects.
     *
     * @param int $user_id Target user id
     * @param int $chat_id Unique identifier for the target chat
     * @param int $message_id Identifier of the sent message
     * @return Requests\GetGameHighScores
     */
    public function getGameHighScores(int $user_id, int $chat_id, int $message_id): Requests\GetGameHighScores
    {
        return new Requests\GetGameHighScores($this->token, [
            'user_id' => $user_id,
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * Inline version of method getGameHighScores()
     *
     * @param int $user_id Target user id
     * @param string $inline_message_id Identifier of the inline message
     * @return Requests\GetGameHighScores
     */
    public function getGameHighScoresInline(int $user_id,
        string $inline_message_id): Requests\GetGameHighScores
    {
        return new Requests\GetGameHighScores($this->token, [
            'user_id' => $user_id,
            'inline_message_id' => $inline_message_id,
        ]);
    }
}