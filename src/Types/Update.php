<?php

declare(strict_types=1);

namespace TelegramBotsApi\Types;

use TelegramBotsApi;
use TelegramBotsApi\Exceptions\Error;

/**
 * This object represents an incoming update.At most one of the optional parameters can be present in any given update.
 *
 * @package TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
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
    public const ACT_POLL_ANSWER = 'poll_answer';

    /**
     * @var int The update‘s unique identifier. Update identifiers start from a certain positive number and
     * increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to
     * ignore repeated updates or to restore the correct update sequence, should they get out of order. If there
     * are no new updates for at least a week, then identifier of the next update will be chosen randomly
     * instead of sequentially.
     */
    public int $update_id;

    /**
     * @var Message|null New incoming message of any kind — text, photo, sticker, etc.
     */
    public ?Message $message = null;

    /**
     * @var Message|null New version of a message that is known to the bot and was edited
     */
    public ?Message $edited_message = null;

    /**
     * @var Message|null New incoming channel post of any kind — text, photo, sticker, etc.
     */
    public ?Message $channel_post = null;

    /**
     * @var Message|null New version of a channel post that is known to the bot and was edited
     */
    public ?Message $edited_channel_post = null;

    /**
     * @var InlineQuery|null New incoming inline query
     */
    public ?InlineQuery $inline_query = null;

    /**
     * @var ChosenInlineResult|null The result of an inline query that was chosen by a user and sent to their
     * chat partner. Please see our documentation on the feedback collecting for details on how to enable these
     * updates for your bot.
     */
    public ?ChosenInlineResult $chosen_inline_result = null;

    /**
     * @var CallbackQuery|null New incoming callback query
     */
    public ?CallbackQuery $callback_query = null;

    /**
     * @var ShippingQuery|null New incoming shipping query. Only for invoices with flexible price
     */
    public ?ShippingQuery $shipping_query = null;

    /**
     * @var PreCheckoutQuery|null New incoming pre-checkout query. Contains full information about checkout
     */
    public ?PreCheckoutQuery $pre_checkout_query = null;

    /**
     * @var Poll|null New poll state. Bots receive only updates about stopped polls and polls, which are sent
     * by the bot
     */
    public ?Poll $poll = null;

    /**
     * @var PollAnswer|null A user changed their answer in a non-anonymous poll. Bots receive new votes only
     * in polls that were sent by the bot itself.
     */
    public ?PollAnswer $poll_answer = null;

    /**
     * Update constructor.
     *
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->update_id = $data['update_id'];
        if (isset($data['message'])) {
            $this->message = $data['message'] instanceof Message
                ? $data['message']
                : new Message($data['message']);
        }

        if (isset($data['edited_message'])) {
            $this->edited_message = $data['edited_message'] instanceof Message
                ? $data['edited_message']
                : new Message($data['edited_message']);
        }

        if (isset($data['channel_post'])) {
            $this->channel_post = $data['channel_post'] instanceof Message
                ? $data['channel_post']
                : new Message($data['channel_post']);
        }

        if (isset($data['edited_channel_post'])) {
            $this->edited_channel_post = $data['edited_channel_post'] instanceof Message
                ? $data['edited_channel_post']
                : new Message($data['edited_channel_post']);
        }

        if (isset($data['inline_query'])) {
            $this->inline_query = $data['inline_query'] instanceof InlineQuery
                ? $data['inline_query']
                : new InlineQuery($data['inline_query']);
        }

        if (isset($data['chosen_inline_result'])) {
            $this->chosen_inline_result = $data['chosen_inline_result'] instanceof ChosenInlineResult
                ? $data['chosen_inline_result']
                : new ChosenInlineResult($data['chosen_inline_result']);
        }

        if (isset($data['callback_query'])) {
            $this->callback_query = $data['callback_query'] instanceof CallbackQuery
                ? $data['callback_query']
                : new CallbackQuery($data['callback_query']);
        }

        if (isset($data['shipping_query'])) {
            $this->shipping_query = $data['shipping_query'] instanceof ShippingQuery
                ? $data['shipping_query']
                : new ShippingQuery($data['shipping_query']);
        }

        if (isset($data['pre_checkout_query'])) {
            $this->pre_checkout_query = $data['pre_checkout_query'] instanceof PreCheckoutQuery
                ? $data['pre_checkout_query']
                : new PreCheckoutQuery($data['pre_checkout_query']);
        }

        if (isset($data['poll'])) {
            $this->poll = $data['poll'] instanceof Poll
                ? $data['poll']
                : new Poll($data['poll']);
        }

        if (isset($data['poll_answer'])) {
            $this->poll_answer = $data['poll_answer'] instanceof PollAnswer
                ? $data['poll_answer']
                : new PollAnswer($data['poll_answer']);
        }
    }

    /**
     * @param int $update_id The update‘s unique identifier. Update identifiers start from a certain positive
     * number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it
     * allows you to ignore repeated updates or to restore the correct update sequence, should they get out of
     * order. If there are no new updates for at least a week, then identifier of the next update will be chosen
     * randomly instead of sequentially.
     * @return Update
     * @throws Error
     */
    public static function make(int $update_id): self
    {
        return new self([
            'update_id' => $update_id,
        ]);
    }

    /**
     * @param string $action
     * @return bool
     */
    public static function checkAction(string $action): bool
    {
        return $action === self::ACT_MESSAGE ||
            $action === self::ACT_EDITED_MESSAGE ||
            $action === self::ACT_CHANNEL_POST ||
            $action === self::ACT_EDITED_CHANNEL_POST ||
            $action === self::ACT_INLINE_QUERY ||
            $action === self::ACT_CHOSEN_INLINE_RESULT ||
            $action === self::ACT_CALLBACK_QUERY ||
            $action === self::ACT_SHIPING_QUERY ||
            $action === self::ACT_PRE_CHECKOUT_QUERY ||
            $action === self::ACT_POLL ||
            $action === self::ACT_POLL_ANSWER;
    }

    /**
     * @return User|null
     * @throws Error
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
            case self::ACT_POLL_ANSWER:
                return $this->poll_answer->user;
        }

        throw new Error("Unknown action: {$this->getAction()}");
    }

    /**
     * @return string
     * @throws Error
     */
    public function getAction(): string
    {
        switch (true) {
            case $this->message !== null:
                return self::ACT_MESSAGE;
            case $this->edited_message !== null:
                return self::ACT_EDITED_MESSAGE;
            case $this->channel_post !== null:
                return self::ACT_CHANNEL_POST;
            case $this->edited_channel_post !== null:
                return self::ACT_EDITED_CHANNEL_POST;
            case $this->inline_query !== null:
                return self::ACT_INLINE_QUERY;
            case $this->chosen_inline_result !== null:
                return self::ACT_CHOSEN_INLINE_RESULT;
            case $this->callback_query !== null:
                return self::ACT_CALLBACK_QUERY;
            case $this->shipping_query !== null:
                return self::ACT_SHIPING_QUERY;
            case $this->pre_checkout_query !== null:
                return self::ACT_PRE_CHECKOUT_QUERY;
            case $this->poll !== null:
                return self::ACT_POLL;
            case $this->poll_answer !== null:
                return self::ACT_POLL_ANSWER;
        }

        throw new Error('Unknown action');
    }

    /**
     * @return Chat|null
     * @throws Error
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
            case self::ACT_POLL_ANSWER:
            case self::ACT_PRE_CHECKOUT_QUERY:
            case self::ACT_SHIPING_QUERY:
            case self::ACT_CALLBACK_QUERY:
            case self::ACT_CHOSEN_INLINE_RESULT:
                return null;
        }

        throw new Error("Unknown action: {$this->getAction()}");
    }

    /**
     * @return string|null
     */
    public function getStartCommand(): ?string
    {
        if ($this->isStart()) {
            return trim(mb_substr($this->message->text, $this->message->entities[0]->length));
        }
        return null;
    }

    /**
     * @return bool
     */
    public function isStart(): bool
    {
        return $this->message !== null && isset($this->message->entities[0])
            && $this->message->entities[0]->getType() === MessageEntity::TYPE_BOT_COMMAND
            && mb_strpos($this->message->text, '/start') === 0;
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'update_id' => $this->update_id,
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
            'poll_answer' => $this->poll_answer,
        ];
    }
}
