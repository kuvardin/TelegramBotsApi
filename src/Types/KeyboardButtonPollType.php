<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button
 * is pressed.
 *
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class KeyboardButtonPollType implements TypeInterface
{
    /**
     * @var string If quiz is passed, the user will be allowed to create only polls in the quiz mode.
     * If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create
     * a poll of any type.
     */
    public string $type;

    /**
     * KeyboardButtonPollType constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        if (!Poll::checkType($data['type'])) {
            throw new Error("Unknown poll type: {$data['type']} (must be Poll::TYPE_*)");
        }
        $this->type = $data['type'];
    }

    /**
     * @param string $type If quiz is passed, the user will be allowed to create only polls in the quiz mode.
     * If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create
     * a poll of any type.
     * @return KeyboardButtonPollType
     * @throws Error
     */
    public static function make(string $type): self
    {
        if (!Poll::checkType($type)) {
            throw new Error("Unknown poll type: {$type} (must be Poll::TYPE_*)");
        }

        return new self([
            'type' => $type,
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
