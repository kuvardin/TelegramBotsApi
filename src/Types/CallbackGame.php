<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

/**
 * A placeholder, currently holds no information. Use BotFather to set up your game.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class CallbackGame implements TypeInterface
{
    /**
     * CallbackGame constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
    }

    /**
     * @return CallbackGame
     */
    public static function make(): self
    {
        return new self([
        ]);
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
        ];
    }
}
