<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a button to be shown above inline query results. You <strong>must</strong> use exactly one
 * of the optional fields.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class InlineQueryResultsButton extends Type
{
    /**
     * @param string $text Label text on the button
     * @param WebAppInfo|null $web_app Description of the <a href="https://core.telegram.org/bots/webapps">Web App</a>
     *     that will be launched when the user presses the button. The Web App will be able to switch back to the inline
     *     mode using the method switchInlineQuery() inside the Web App.
     * @param string|null $start_parameter <a href="https://core.telegram.org/bots/features#deep-linking">Deep</a>
     *     linking parameter for the /start message sent to the bot when a user presses the button.
     *     1-64 characters, only A-Z, a-z, 0-9, "_" and "-" are allowed.<br><br>
     *     <em>Example:</em> An inline bot that sends YouTube videos can ask the user to connect the bot to their
     *     YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account'
     *     button above the results, or even before showing any. The user presses the button, switches to a private chat
     *     with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once
     *     done, the bot can offer a <a href="https://core.telegram.org/bots/api#inlinekeyboardmarkup">switch_inline</a>
     *     button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
     */
    public function __construct(
        public string $text,
        public ?WebAppInfo $web_app = null,
        public ?string $start_parameter = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            text: $data['text'],
            web_app: isset($data['web_app'])
                ? WebAppInfo::makeByArray($data['web_app'])
                : null,
            start_parameter: $data['start_parameter'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'text' => $this->text,
            'web_app' => $this->web_app,
            'start_parameter' => $this->start_parameter,
        ];
    }
}
