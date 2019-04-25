<?php

namespace TelegramBotsApi;

use \TelegramBotsApi\Exceptions\Error;

/**
 * Class Request
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Request
{
    public const REQUEST_TIMEOUT = 30;
    public const CONNECT_TIMEOUT = 10;

    public const CAN_DISABLE_NOTIFICATION = 1;
    public const CAN_REPLY_TO_MESSAGE = 2;
    public const CAN_DISABLE_WEB_PAGE_PREVIEW = 4;
    public const CAN_SET_PARSE_MODE = 8;
    public const CAN_ADD_INLINE_KEYBOARD_MARKUP = 16;
    public const CAN_ADD_REPLY_KEYBOARD_MARKUP = 32;
    public const CAN_REMOVE_REPLY_KEYBOARD = 64;
    public const CAN_ADD_FORCE_REPLY = 128;
    public const CAN_ADD_REPLY_MARKUP = self::CAN_ADD_INLINE_KEYBOARD_MARKUP | self::CAN_ADD_REPLY_KEYBOARD_MARKUP | self::CAN_REMOVE_REPLY_KEYBOARD | self::CAN_ADD_FORCE_REPLY;

    /**
     * @var string $token Token of the Telegram-bot
     */
    private $token;

    /**
     * @var string $method Required Telegram Bots API method
     */
    private $method;

    /**
     * @var array|null $params Parameters of the request
     */
    public $params;

    /**
     * @var int
     */
    private $permissions;

    /**
     * Request constructor.
     * @param string $token
     * @param string $method
     * @param array $params
     * @param int $permissions
     */
    public function __construct(string $token, string $method, array $params = [], int $permissions = 0)
    {
        $this->token = $token;
        $this->method = $method;
        $this->params = $params;
        $this->permissions = $permissions;
    }

    /**
     * @param int $permission
     * @return bool
     */
    public function checkPermission(int $permission): bool
    {
        return ($this->permissions & $permission) !== 0;
    }

    /**
     * @param string $parse_mode
     * @return Request
     * @throws Error
     */
    public function setParseMode(string $parse_mode): self
    {
        if (!Bot::checkParseMode($parse_mode)) {
            throw new Error("Unknown parse mode: {$parse_mode}");
        }

        if (!$this->checkPermission(self::CAN_SET_PARSE_MODE)) {
            throw new Error('It is not allowed for this method');
        }

        $this->params['parse_mode'] = $parse_mode;
        return $this;
    }

    /**
     * @param bool $enable
     * @return Request
     * @throws Error
     */
    public function setNotificationSending(bool $enable): self
    {
        if (!$this->checkPermission(self::CAN_DISABLE_NOTIFICATION)) {
            throw new Error('It is not allowed for this method');
        }
        $this->params['disable_notification'] = !$enable;
        return $this;
    }

    /**
     * @param bool $enable
     * @return Request
     * @throws Error
     */
    public function setWebPagePreviewSending(bool $enable): self
    {
        if (!$this->checkPermission(self::CAN_DISABLE_WEB_PAGE_PREVIEW)) {
            throw new Error('It is not allowed for this method');
        }
        $this->params['disable_web_page_preview'] = !$enable;
        return $this;
    }

    /**
     * @param int $message_id
     * @return Request
     * @throws Error
     */
    public function replyToMessageWithId(int $message_id): self
    {
        if ($this->checkPermission(self::CAN_REPLY_TO_MESSAGE)) {
            throw new Error('It is not allowed for this method');
        }

        $this->params['reply_to_message_id'] = $message_id;
        return $this;
    }

    /**
     * @param bool|null $selective
     * @return Request
     * @throws Error
     */
    public function addForceReply(bool $selective = null): self
    {
        if (!$this->checkPermission(self::CAN_ADD_REPLY_MARKUP | self::CAN_ADD_FORCE_REPLY)) {
            throw new Error('It is not allowed for this method');
        }
        $force_reply = Types\ForceReply::make();
        $force_reply->selective = $selective;
        $this->params['reply_markup'] = $force_reply;
        return $this;
    }

    /**
     * @param Types\InlineKeyboardMarkup $inline_keyboard_markup
     * @return Request
     * @throws Error
     */
    public function addInlineKeyboardMarkup(Types\InlineKeyboardMarkup $inline_keyboard_markup): self
    {
        if (!$this->checkPermission(self::CAN_ADD_REPLY_MARKUP | self::CAN_ADD_INLINE_KEYBOARD_MARKUP)) {
            throw new Error('It is not allowed for this method');
        }

        $this->params['reply_markup'] = $inline_keyboard_markup;
        return $this;
    }

    /**
     * @param Types\ReplyKeyboardMarkup $reply_keyboard_markup
     * @return Request
     * @throws Error
     */
    public function addReplyKeyboardMarkup(Types\ReplyKeyboardMarkup $reply_keyboard_markup): self
    {
        if (!$this->checkPermission(self::CAN_ADD_REPLY_MARKUP | self::CAN_ADD_REPLY_KEYBOARD_MARKUP)) {
            throw new Error('It is not allowed for this method');
        }

        $this->params['reply_markup'] = $reply_keyboard_markup;
        return $this;
    }

    /**
     * @param bool|null $selective
     * @return Request
     * @throws Error
     */
    public function removeReplyKeyboard(bool $selective = null): self
    {
        if (!$this->checkPermission(self::CAN_ADD_REPLY_MARKUP | self::CAN_REMOVE_REPLY_KEYBOARD)) {
            throw new Error('It is not allowed for this method');
        }
        $reply_keyboard_remove = Types\ReplyKeyboardRemove::make();
        $reply_keyboard_remove->selective = $selective;
        $this->params['reply_markup'] = $reply_keyboard_remove;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        $params = self::processingParams($this->params);
        $params['method'] = $this->method;
        return $params;
    }

    /**
     * @param array $params
     * @return array
     */
    private static function processingParams(array $params): array
    {
        $result = [];
        foreach ($params as $param_key => $param_value) {
            if ($param_value === null) {
                continue;
            }
            if (is_object($param_value)) {
                $object_data = self::processingParams($param_value->getRequestArray());
                if (!empty($object_data)) {
                    $result[$param_key] = $object_data;
                }
            } elseif (is_array($param_value)) {
                $array_data = self::processingParams($param_value);
                if (!empty($array_data)) {
                    $result[$param_key] = $array_data;
                }
            } else {
                $result[$param_key] = $param_value;
            }
        }
        return $result;
    }

    /**
     * @param int $attempts
     * @return Response
     * @throws Error
     * @throws Exceptions\ApiException
     * @throws Exceptions\CurlException
     */
    public function sendRequest(int $attempts = 1): Response
    {
        $url = "https://api.telegram.org/bot{$this->token}/{$this->method}";

        if ($attempts < 1) {
            throw new Error('The number of attempts can not be less than one');
        }

        for ($i = 1; $i <= $attempts; $i++) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
                CURLOPT_TIMEOUT => self::REQUEST_TIMEOUT,
                CURLOPT_POSTFIELDS => json_encode($this->getRequest()),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ]);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                curl_close($ch);
            }

            break;
        }

        $result_decoded = json_decode($result, true);
        $info = curl_getinfo($ch);

        if (curl_errno($ch)) {
            $error_code = curl_error($ch);
            $error_description = curl_errno($ch);
            curl_close($ch);
            throw new Exceptions\CurlException($error_code, $error_description);
        }

        curl_close($ch);

        if (empty($result) || $result_decoded === null) {
            throw new Exceptions\ApiException("Empty or non-JSON result: \"{$result}\"", 520);
        }

        $result = $result_decoded;
        if (empty($result['ok']) || (bool)$result['ok'] === false) {
            throw new Exceptions\ApiException($result['description'], $result['error_code']);
        }

        if ($info['http_code'] !== 200) {
            throw new Exceptions\CurlException("HTTP error #{$info['http_code']}", $info['http_code']);
        }

        return new Response($this->method, $result, $info);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)json_encode($this->getRequest());
    }
}