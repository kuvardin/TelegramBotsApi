<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the
 * user. It should be one of: PassportElementError\*
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
abstract class PassportElementError extends Type
{
    abstract public static function getSource(): string;

    public static function makeByArray(array $data): static
    {
        return match ($data['source']) {
            PassportElementError\DataField::getSource() => PassportElementError\DataField::makeByArray($data),
            PassportElementError\File::getSource() => PassportElementError\File::makeByArray($data),
            PassportElementError\Files::getSource() => PassportElementError\Files::makeByArray($data),
            PassportElementError\FrontSide::getSource() => PassportElementError\FrontSide::makeByArray($data),
            PassportElementError\ReverseSide::getSource() => PassportElementError\ReverseSide::makeByArray($data),
            PassportElementError\Selfie::getSource() => PassportElementError\Selfie::makeByArray($data),
            PassportElementError\TranslationFile::getSource() => PassportElementError\TranslationFile::makeByArray($data),
            PassportElementError\TranslationFiles::getSource() => PassportElementError\TranslationFiles::makeByArray($data),
            PassportElementError\Unspecified::getSource() => PassportElementError\Unspecified::makeByArray($data),
            default => throw new RuntimeException("Unknown passport element error source: {$data['source']}"),
        };
    }

    abstract public function getRequestData(): array;
}
