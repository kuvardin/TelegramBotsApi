<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class MessageEntity implements TypeInterface
{
    public const TYPE_MENTION = 'mention'; // @username
    public const TYPE_HASHTAG = 'hashtag'; // #hashtag
    public const TYPE_CASHTAG = 'cashtag'; // $USD
    public const TYPE_BOT_COMMAND = 'bot_command'; // /start@jobs_bot
    public const TYPE_URL = 'url'; // https://telegram.org
    public const TYPE_EMAIL = 'email'; // do-not-reply@telegram.org
    public const TYPE_PHONE_NUMBER = 'phone_number'; // +1-212-555-0123
    public const TYPE_BOLD = 'bold'; // bold text
    public const TYPE_ITALIC = 'italic'; // italic text
    public const TYPE_UNDERLINE = 'underline'; // underlined text
    public const TYPE_STRIKETHROUGH = 'strikethrough'; // strikethrough text
    public const TYPE_CODE = 'code'; // monowidth string
    public const TYPE_PRE = 'pre'; // monowidth block
    public const TYPE_TEXT_LINK = 'text_link'; // for clickable text URLs
    public const TYPE_TEXT_MENTION = 'text_mention'; // for users without usernames
    /**
     * @var int Offset in UTF-16 code units to the start of the entity
     */
    public int $offset;

    /**
     * @var int Length of the entity in UTF-16 code units
     */
    public int $length;

    /**
     * @var string|null For “text_link” only, url that will be opened after user taps on the text
     */
    public ?string $url = null;

    /**
     * @var User|null For “text_mention” only, the mentioned user
     */
    public ?User $user = null;

    /**
     * @var string Type of the entity. Can be self::TYPE_*
     */
    protected string $type;

    /**
     * MessageEntity constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->setType($data['type']);
        $this->offset = $data['offset'];
        $this->length = $data['length'];

        if (isset($data['url'])) {
            $this->url = $data['url'];
        }

        if (isset($data['user'])) {
            $this->user = $data['user'] instanceof User
                ? $data['user']
                : new User($data['user']);
        }
    }

    /**
     * @param string $type Type of the entity. Can be self::TYPE_*
     * @param int $offset Offset in UTF-16 code units to the start of the entity
     * @param int $length Length of the entity in UTF-16 code units
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

    /**
     * @param string $type
     * @return bool
     */
    public static function checkType(string $type): bool
    {
        return $type === self::TYPE_MENTION ||
            $type === self::TYPE_HASHTAG ||
            $type === self::TYPE_CASHTAG ||
            $type === self::TYPE_BOT_COMMAND ||
            $type === self::TYPE_URL ||
            $type === self::TYPE_EMAIL ||
            $type === self::TYPE_PHONE_NUMBER ||
            $type === self::TYPE_BOLD ||
            $type === self::TYPE_ITALIC ||
            $type === self::TYPE_UNDERLINE ||
            $type === self::TYPE_STRIKETHROUGH ||
            $type === self::TYPE_CODE ||
            $type === self::TYPE_PRE ||
            $type === self::TYPE_TEXT_LINK ||
            $type === self::TYPE_TEXT_MENTION;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @throws Error
     */
    public function setType(string $type): void
    {
        if (!self::checkType($type)) {
            throw new Error("Unknown type: $type");
        }
        $this->type = $type;
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
}