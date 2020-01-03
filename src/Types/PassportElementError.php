<?php declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an error in the Telegram Passport element which was submitted that should be
 * resolved by the user
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class PassportElementError
{
    public const SOURCE_DATA = 'data';
    public const SOURCE_FRONT_SIDE = 'front_side';
    public const SOURCE_REVERSE_SIDE = 'reverse_side';
    public const SOURCE_SELFIE = 'selfie';
    public const SOURCE_FILE = 'file';
    public const SOURCE_FILES = 'files';
    public const SOURCE_TRANSLATION_FILE = 'translation_file';
    public const SOURCE_TRANSLATION_FILES = 'translation_files';
    public const SOURCE_UNSPECIFIED = 'unspecified';

    /**
     * PassportElementError constructor.
     *
     * @param array $data
     */
    protected function __construct(array $data)
    {
    }

    /**
     * @param array $data
     * @return PassportElementError
     * @throws Error
     */
    public static function constructChild(array $data): PassportElementError
    {
        switch ($data['source']) {
            case self::SOURCE_DATA:
                return new PassportElementError\DataField($data);

            case self::SOURCE_FRONT_SIDE:
                return new PassportElementError\FrontSide($data);

            case self::SOURCE_REVERSE_SIDE:
                return new PassportElementError\ReverseSide($data);

            case self::SOURCE_SELFIE:
                return new PassportElementError\Selfie($data);

            case self::SOURCE_FILE:
                return new PassportElementError\File($data);

            case self::SOURCE_FILES:
                return new PassportElementError\Files($data);

            case self::SOURCE_TRANSLATION_FILE:
                return new PassportElementError\TranslationFile($data);

            case self::SOURCE_TRANSLATION_FILES:
                return new PassportElementError\TranslationFiles($data);

            case self::SOURCE_UNSPECIFIED:
                return new PassportElementError\Unspecified($data);

            default:
                throw new Error("Unknown source: {$data['source']}");
        }
    }
}