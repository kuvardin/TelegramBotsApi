<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;
use RuntimeException;

/**
 * This object represents a rich formatted text. Currently, it can be either a String for plain text, an Array of RichText, or any of the following types:
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class RichText extends Type
{
    /**
     * @param string|null $plain_text
     * @param RichTextModel[]|null $rich_text_models
     */
    private function __construct(
        protected ?string $plain_text = null,
        protected ?array $rich_text_models = null,
    )
    {

    }

    public static function makeByPlainText(string $plain_text): self
    {
        return new self($plain_text);
    }

    public static function makeByRichTextModels(RichTextModel|array $rich_text_models): self
    {
        $models = [];

        if (is_array($rich_text_models)) {
            foreach ($rich_text_models as $rich_text_model) {
                if (is_array($rich_text_model)) {
                    $models[] = RichTextModel::makeByArray($rich_text_model);
                } elseif ($rich_text_model instanceof RichTextModel) {
                    $models[] = $rich_text_model;
                } else {
                    throw new RuntimeException('RichTextModel must be array or RichTextModel object');
                }
            }
        } elseif ($rich_text_models instanceof RichTextModel) {
            $models[] = $rich_text_models;
        }

        return new self(rich_text_models: $models);
    }

    public static function makeByInput(string|array $input): self
    {
        if (is_string($input)) {
            return self::makeByPlainText($input);
        }

        return self::makeByRichTextModels($input);
    }

    public function isEmpty(): bool
    {
        return ($this->plain_text === null || $this->plain_text === '') &&
            ($this->rich_text_models === null || $this->rich_text_models === []);
    }

    /**
     * @return string|RichTextModel[]
     */
    public function getRequestData(): string|array
    {
        if ($this->plain_text !== null) {
            return $this->plain_text;
        }

        return $this->rich_text_models;
    }
}

