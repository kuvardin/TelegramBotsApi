<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This <a href="https://core.telegram.org/bots/api#available-types">object</a> represents an incoming update.<br>At
 * most <strong>one</strong> of the optional parameters can be present in any given update.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Update extends Type
{
    /**
     * @var int $update_id The update's unique identifier. Update identifiers start from a certain positive number and
     *     increase sequentially. This ID becomes especially handy if you're using <a
     *     href="https://core.telegram.org/bots/api#setwebhook">Webhooks</a>, since it allows you to ignore repeated
     *     updates or to restore the correct update sequence, should they get out of order. If there are no new updates
     *     for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     */
    public int $update_id;

    public Enums\UpdateType $type;

    /**
     * @var Message|null $message New incoming message of any kind — text, photo, sticker, etc.
     */
    public ?Message $message = null;

    /**
     * @var Message|null $edited_message New version of a message that is known to the bot and was edited
     */
    public ?Message $edited_message = null;

    /**
     * @var Message|null $channel_post New incoming channel post of any kind — text, photo, sticker, etc.
     */
    public ?Message $channel_post = null;

    /**
     * @var Message|null $edited_channel_post New version of a channel post that is known to the bot and was edited
     */
    public ?Message $edited_channel_post = null;

    /**
     * @var InlineQuery|null $inline_query New incoming <a
     *     href="https://core.telegram.org/bots/api#inline-mode">inline</a> query
     */
    public ?InlineQuery $inline_query = null;

    /**
     * @var ChosenInlineResult|null $chosen_inline_result The result of an <a
     *     href="https://core.telegram.org/bots/api#inline-mode">inline</a> query that was chosen by a user and sent to
     *     their chat partner. Please see our documentation on the <a
     *     href="https://core.telegram.org/bots/inline#collecting-feedback">feedback collecting</a> for details on how
     *     to enable these updates for your bot.
     */
    public ?ChosenInlineResult $chosen_inline_result = null;

    /**
     * @var CallbackQuery|null $callback_query New incoming callback query
     */
    public ?CallbackQuery $callback_query = null;

    /**
     * @var ShippingQuery|null $shipping_query New incoming shipping query. Only for invoices with flexible price
     */
    public ?ShippingQuery $shipping_query = null;

    /**
     * @var PreCheckoutQuery|null $pre_checkout_query New incoming pre-checkout query. Contains full information about
     *     checkout
     */
    public ?PreCheckoutQuery $pre_checkout_query = null;

    /**
     * @var Poll|null $poll New poll state. Bots receive only updates about stopped polls and polls, which are sent by
     *     the bot
     */
    public ?Poll $poll = null;

    /**
     * @var PollAnswer|null $poll_answer A user changed their answer in a non-anonymous poll. Bots receive new votes
     *     only in polls that were sent by the bot itself.
     */
    public ?PollAnswer $poll_answer = null;

    /**
     * @var ChatMemberUpdated|null $my_chat_member The bot's chat member status was updated in a chat. For private
     *     chats, this update is received only when the bot is blocked or unblocked by the user.
     */
    public ?ChatMemberUpdated $my_chat_member = null;

    /**
     * @var ChatMemberUpdated|null $chat_member A chat member's status was updated in a chat. The bot must be an
     *     administrator in the chat and must explicitly specify “chat_member” in the list of <em>allowed_updates</em>
     *     to receive these updates.
     */
    public ?ChatMemberUpdated $chat_member = null;

    /**
     * @var ChatJoinRequest|null $chat_join_request A request to join the chat has been sent. The bot must have the
     *     <em>can_invite_users</em> administrator right in the chat to receive these updates.
     */
    public ?ChatJoinRequest $chat_join_request = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->update_id = $data['update_id'];

        $data_keys = array_keys($data);
        $result->type = Enums\UpdateType::from($data_keys[0] === 'update_id' ? $data_keys[1] : $data_keys[0]);

        $result->message = isset($data['message'])
            ? Message::makeByArray($data['message'])
            : null;
        $result->edited_message = isset($data['edited_message'])
            ? Message::makeByArray($data['edited_message'])
            : null;
        $result->channel_post = isset($data['channel_post'])
            ? Message::makeByArray($data['channel_post'])
            : null;
        $result->edited_channel_post = isset($data['edited_channel_post'])
            ? Message::makeByArray($data['edited_channel_post'])
            : null;
        $result->inline_query = isset($data['inline_query'])
            ? InlineQuery::makeByArray($data['inline_query'])
            : null;
        $result->chosen_inline_result = isset($data['chosen_inline_result'])
            ? ChosenInlineResult::makeByArray($data['chosen_inline_result'])
            : null;
        $result->callback_query = isset($data['callback_query'])
            ? CallbackQuery::makeByArray($data['callback_query'])
            : null;
        $result->shipping_query = isset($data['shipping_query'])
            ? ShippingQuery::makeByArray($data['shipping_query'])
            : null;
        $result->pre_checkout_query = isset($data['pre_checkout_query'])
            ? PreCheckoutQuery::makeByArray($data['pre_checkout_query'])
            : null;
        $result->poll = isset($data['poll'])
            ? Poll::makeByArray($data['poll'])
            : null;
        $result->poll_answer = isset($data['poll_answer'])
            ? PollAnswer::makeByArray($data['poll_answer'])
            : null;
        $result->my_chat_member = isset($data['my_chat_member'])
            ? ChatMemberUpdated::makeByArray($data['my_chat_member'])
            : null;
        $result->chat_member = isset($data['chat_member'])
            ? ChatMemberUpdated::makeByArray($data['chat_member'])
            : null;
        $result->chat_join_request = isset($data['chat_join_request'])
            ? ChatJoinRequest::makeByArray($data['chat_join_request'])
            : null;

        return $result;
    }

    public function getRequestData(): array
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
            'my_chat_member' => $this->my_chat_member,
            'chat_member' => $this->chat_member,
            'chat_join_request' => $this->chat_join_request,
        ];
    }

    public function getChat(): ?Chat
    {
        return $this->message?->chat
            ?? $this->edited_message?->chat
            ?? $this->channel_post?->chat
            ?? $this->edited_channel_post?->chat
            ?? $this->my_chat_member?->chat
            ?? $this->chat_member?->chat
            ?? $this->chat_join_request?->chat;
    }

    public function getUser(): ?User
    {
        return $this->message?->from
            ?? $this->edited_message?->from
            ?? $this->channel_post?->from
            ?? $this->edited_channel_post?->from
            ?? $this->inline_query?->from
            ?? $this->chosen_inline_result?->from
            ?? $this->callback_query?->from
            ?? $this->shipping_query?->from
            ?? $this->pre_checkout_query?->from
            ?? $this->poll_answer?->user
            ?? $this->my_chat_member->from
            ?? $this->chat_member->from
            ?? $this->chat_join_request->from;
    }
}
