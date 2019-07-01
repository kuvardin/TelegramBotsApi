<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this object represents an incoming update. At most one of the optional parameters can be present in any given update.
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Update implements TypeInterface
{
    public const ACT_MESSAGE = 'message';
    public const ACT_EDITED_MESSAGE = 'edited_message';
    public const ACT_CHANNEL_POST = 'channel_post';
    public const ACT_EDITED_CHANNEL_POST = 'edited_channel_post';
    public const ACT_INLINE_QUERY = 'inline_query';
    public const ACT_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    public const ACT_CALLBACK_QUERY = 'callback_query';
    public const ACT_SHIPING_QUERY = 'shipping_query';
    public const ACT_PRE_CHECKOUT_QUERY = 'pre_checkout_query';
    public const ACT_POLL = 'poll';

    /**
     * @var int The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     */
    public $id;

    /**
     * @var Message|null New incoming message of any kind — text, photo, sticker, etc.
     */
    public $message;

    /**
     * @var Message|null New version of a message that is known to the bot and was edited
     */
    public $edited_message;

    /**
     * @var Message|null New incoming channel post of any kind — text, photo, sticker, etc.
     */
    public $channel_post;

    /**
     * @var Message|null New version of a channel post that is known to the bot and was edited
     */
    public $edited_channel_post;

    /**
     * @var InlineQuery|null New incoming inline query
     */
    public $inline_query;

    /**
     * @var ChosenInlineResult|null The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     */
    public $chosen_inline_result;

    /**
     * @var CallbackQuery|null New incoming callback query
     */
    public $callback_query;

    /**
     * @var ShippingQuery|null New incoming shipping query. Only for invoices with flexible price
     */
    public $shipping_query;

    /**
     * @var PreCheckoutQuery|null New incoming pre-checkout query. Contains full information about checkout
     */
    public $pre_checkout_query;

    /**
     * @var Poll|null New poll state. Bots receive only updates about polls, which are sent or stopped by the bot
     */
    public $poll;

    /**
     * Update constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['update_id'];

        if (isset($data['message'])) {
            $this->message = $data['message'] instanceof Message ? $data['message'] : new Message($data['message']);
        }

        if (isset($data['edited_message'])) {
            $this->edited_message = $data['edited_message'] instanceof Message ? $data['edited_message'] : new Message($data['edited_message']);
        }

        if (isset($data['channel_post'])) {
            $this->channel_post = $data['channel_post'] instanceof Message ? $data['channel_post'] : new Message($data['channel_post']);
        }

        if (isset($data['edited_channel_post'])) {
            $this->edited_channel_post = $data['edited_channel_post'] instanceof Message ? $data['edited_channel_post'] : new Message($data['edited_channel_post']);
        }

        if (isset($data['inline_query'])) {
            $this->inline_query = $data['inline_query'] instanceof InlineQuery ? $data['inline_query'] : new InlineQuery($data['inline_query']);
        }

        if (isset($data['chosen_inline_result'])) {
            $this->chosen_inline_result = $data['chosen_inline_result'] instanceof ChosenInlineResult ? $data['chosen_inline_result'] : new ChosenInlineResult($data['chosen_inline_result']);
        }

        if (isset($data['callback_query'])) {
            $this->callback_query = $data['callback_query'] instanceof CallbackQuery ? $data['callback_query'] : new CallbackQuery($data['callback_query']);
        }

        if (isset($data['shipping_query'])) {
            $this->shipping_query = $data['shipping_query'] instanceof ShippingQuery ? $data['shipping_query'] : new ShippingQuery($data['shipping_query']);
        }

        if (isset($data['pre_checkout_query'])) {
            $this->pre_checkout_query = $data['pre_checkout_query'] instanceof PreCheckoutQuery ? $data['pre_checkout_query'] : new PreCheckoutQuery($data['pre_checkout_query']);
        }

        if (isset($data['poll'])) {
            $this->poll = $data['poll'] instanceof Poll ? $data['poll'] : new Poll($data['poll']);
        }
    }

    /**
     * @return string|bool
     */
    public function getAction()
    {
        switch (true) {
            case $this->message instanceof Message:
                return self::ACT_MESSAGE;
            case $this->edited_message instanceof Message:
                return self::ACT_EDITED_MESSAGE;
            case $this->channel_post instanceof Message:
                return self::ACT_CHANNEL_POST;
            case $this->edited_channel_post instanceof Message:
                return self::ACT_EDITED_CHANNEL_POST;
            case $this->inline_query instanceof InlineQuery:
                return self::ACT_INLINE_QUERY;
            case $this->chosen_inline_result instanceof ChosenInlineResult:
                return self::ACT_CHOSEN_INLINE_RESULT;
            case $this->callback_query instanceof CallbackQuery:
                return self::ACT_CALLBACK_QUERY;
            case $this->shipping_query instanceof ShippingQuery:
                return self::ACT_SHIPING_QUERY;
            case $this->pre_checkout_query instanceof PreCheckoutQuery:
                return self::ACT_PRE_CHECKOUT_QUERY;
            case $this->poll instanceof Poll:
                return self::ACT_POLL;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isStart(): bool
    {
        return $this->message !== null && isset($this->message->entities[0]) && $this->message->entities[0]->type === MessageEntity::TYPE_BOT_COMMAND && mb_strpos($this->message->text, '/start') === 0;
    }

    /**
     * @return string|null
     */
    public function getStartCommand(): ?string
    {
        if ($this->isStart()) {
            $start_command = trim(mb_substr($this->message->text, $this->message->entities[0]->length));
            return empty($start_command) ? null : $start_command;
        }
        return null;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        switch ($this->getAction()) {
            case self::ACT_PRE_CHECKOUT_QUERY:
                return $this->pre_checkout_query->from;
            case self::ACT_SHIPING_QUERY:
                return $this->shipping_query->from;
            case self::ACT_CALLBACK_QUERY:
                return $this->callback_query->from;
            case self::ACT_CHOSEN_INLINE_RESULT:
                return $this->chosen_inline_result->from;
            case self::ACT_INLINE_QUERY:
                return $this->inline_query->from;
            case self::ACT_EDITED_CHANNEL_POST:
                return $this->edited_channel_post->from;
            case self::ACT_CHANNEL_POST:
                return $this->channel_post->from;
            case self::ACT_EDITED_MESSAGE:
                return $this->edited_message->from;
            case self::ACT_MESSAGE:
                return $this->message->from;
            case self::ACT_POLL:
                return null;
        }
    }

    /**
     * @return Chat|null
     */
    public function getChat(): ?Chat
    {
        switch ($this->getAction()) {
            case self::ACT_EDITED_CHANNEL_POST:
                return $this->edited_channel_post->chat;
            case self::ACT_CHANNEL_POST:
                return $this->channel_post->chat;
            case self::ACT_EDITED_MESSAGE:
                return $this->edited_message->chat;
            case self::ACT_MESSAGE:
                return $this->message->chat;
            case self::ACT_INLINE_QUERY:
            case self::ACT_POLL:
            case self::ACT_PRE_CHECKOUT_QUERY:
            case self::ACT_SHIPING_QUERY:
            case self::ACT_CALLBACK_QUERY:
            case self::ACT_CHOSEN_INLINE_RESULT:
                return null;
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'update_id' => $this->id,
            'message' => $this->message,
            'edited_message' => $this->edited_message,
            'channel_post' => $this->channel_post,
            'edited_channel_post' => $this->edited_channel_post,
            'inline_query' => $this->inline_query,
            'chosen_inline_result' => $this->chosen_inline_result,
            'callback_query' => $this->callback_query,
            'shipping_query' => $this->shipping_query,
            'pre_checkout_query' => $this->pre_checkout_query,
            'poll' => $this->poll,
        ];
    }

    /**
     * @param string $action
     * @return bool
     */
    public static function checkAction(string $action): bool
    {
        switch ($action) {
            case self::ACT_MESSAGE:
            case self::ACT_EDITED_MESSAGE:
            case self::ACT_CHANNEL_POST:
            case self::ACT_EDITED_CHANNEL_POST:
            case self::ACT_INLINE_QUERY:
            case self::ACT_CHOSEN_INLINE_RESULT:
            case self::ACT_CALLBACK_QUERY:
            case self::ACT_SHIPING_QUERY:
            case self::ACT_PRE_CHECKOUT_QUERY:
            case self::ACT_POLL:
                return true;
        }

        return false;
    }
}