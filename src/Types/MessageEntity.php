<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class MessageEntity implements TypeInterface
{

    public const TYPE_MENTION = 'mention'; // @username
    public const TYPE_HASHTAG = 'hashtag';
    public const TYPE_CASHTAG = 'cashtag';
    public const TYPE_BOT_COMMAND = 'bot_command';
    public const TYPE_URL = 'url';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PHONE_NUMBER = 'phone_number';
    public const TYPE_BOLD = 'bold'; // bold text
    public const TYPE_ITALIC = 'italic'; // italic text
    public const TYPE_CODE = 'code'; // monowidth string
    public const TYPE_PRE = 'pre'; // monowidth block 
    public const TYPE_TEXT_LINK = 'text_link'; // for clickable text URLs
    public const TYPE_TEXT_MENTION = 'text_mention'; // for users without usernames

    /**
     * @var string Type of the entity. One of self::TYPE_* constants
     */
    public $type;

    /**
     * @var int Offset in UTF-16 code units to the start of the entity
     */
    public $offset;

    /**
     * @var int Length of the entity in UTF-16 code units
     */
    public $length;

    /**
     * @var string|null For “text_link” only, url that will be opened after user taps on the text
     */
    public $url;

    /**
     * @var User|null For “text_mention” only, the mentioned user
     */
    public $user;

    /**
     * MessageEntity constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->setType($data['type']);
        $this->offset = $data['offset'];
        $this->length = $data['length'];
        $this->url = $data['url'] ?? null;
        $this->user = isset($data['user']) ? new User($data['user']) : null;
    }

    /**
     * @param string $type
     * @return MessageEntity
     * @throws Error
     */
    private function setType(string $type): self
    {
        switch ($type) {
            case self::TYPE_MENTION:
            case self::TYPE_HASHTAG:
            case self::TYPE_CASHTAG:
            case self::TYPE_BOT_COMMAND:
            case self::TYPE_URL:
            case self::TYPE_EMAIL:
            case self::TYPE_PHONE_NUMBER:
            case self::TYPE_BOLD:
            case self::TYPE_ITALIC:
            case self::TYPE_CODE:
            case self::TYPE_PRE:
            case self::TYPE_TEXT_LINK:
            case self::TYPE_TEXT_MENTION:
                $this->type = $type;
                break;
            default:
                throw new Error("Unknown message entity type: {$type}");
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
            'offset' => $this->offset,
            'length' => $this->length,
            'url' => $this->url,
            'user' => $this->user,
        ];
    }

    /**
     * @param string $type
     * @param int $offset
     * @param int $length
     * @return MessageEntity
     * @throws Error
     */
    public static function make(string $type, int $offset, int $length): self
    {
        return new self([
            'type' => $type,
            'offset' => $offset,
            'length' => $length,
        ]);
    }
}