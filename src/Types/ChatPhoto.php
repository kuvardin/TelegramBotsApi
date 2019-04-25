<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents a chat photo.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class ChatPhoto implements TypeInterface
{
    /**
     * @var string Unique file identifier of small (160x160) chat photo. This file_id can be used only for photo download.
     */
    public $small_file_id;

    /**
     * @var string Unique file identifier of big (640x640) chat photo. This file_id can be used only for photo download.
     */
    public $big_file_id;

    /**
     * ChatPhoto constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->small_file_id = $data['small_file_id'];
        $this->big_file_id = $data['big_file_id'];
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'small_file_id' => $this->small_file_id,
            'big_file_id' => $this->big_file_id,
        ];
    }

    /**
     * @param string $small_file_id
     * @param string $big_file_id
     * @return ChatPhoto
     */
    public static function make(string $small_file_id, string $big_file_id): self
    {
        return new self([
            'small_file_id' => $small_file_id,
            'big_file_id' => $big_file_id,
        ]);
    }
}