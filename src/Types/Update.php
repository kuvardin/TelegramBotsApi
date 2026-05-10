<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Enums\UpdateType;
use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents an incoming update.<br>At most <strong>one</strong> of the optional parameters can be present
 * in any given update.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Update extends Type
{
    /**
     * @param int $update_id The update's unique identifier. Update identifiers start from a certain positive number
     *     and increase sequentially. This identifier becomes especially handy if you're using webhooks, since it
     *     allows you to ignore repeated updates or to restore the correct update sequence, should they get out of
     *     order. If there are no new updates for at least a week, then identifier of the next update will be chosen
     *     randomly instead of sequentially.
     * @param Message|null $message New incoming message of any kind - text, photo, sticker, etc.
     * @param Message|null $edited_message New version of a message that is known to the bot and was edited. This
     *     update may at times be triggered by changes to message fields that are either unavailable or not actively
     *     used by your bot.
     * @param Message|null $channel_post New incoming channel post of any kind - text, photo, sticker, etc.
     * @param Message|null $edited_channel_post New version of a channel post that is known to the bot and was edited.
     *     This update may at times be triggered by changes to message fields that are either unavailable or not
     *     actively used by your bot.
     * @param BusinessConnection|null $business_connection The bot was connected to or disconnected from a business
     *     account, or a user edited an existing connection with the bot
     * @param Message|null $business_message New message from a connected business account
     * @param Message|null $edited_business_message New version of a message from a connected business account
     * @param BusinessMessagesDeleted|null $deleted_business_messages Messages were deleted from a connected business
     *     account
     * @param MessageReactionUpdated|null $message_reaction A reaction to a message was changed by a user. The bot must
     *     be an administrator in the chat and must explicitly specify ""message_reaction"" in the list of
     *     "allowed_updates" to receive these updates. The update isn't received for reactions set by bots.
     * @param MessageReactionCountUpdated|null $message_reaction_count Reactions to a message with anonymous reactions
     *     were changed. The bot must be an administrator in the chat and must explicitly specify
     *     ""message_reaction_count"" in the list of "allowed_updates" to receive these updates. The updates are
     *     grouped and can be sent with delay up to a few minutes.
     * @param InlineQuery|null $inline_query New incoming inline query
     * @param ChosenInlineResult|null $chosen_inline_result The result of an inline query that was chosen by a user and
     *     sent to their chat partner. Please see our documentation on the feedback collecting for details on how to
     *     enable these updates for your bot.
     * @param CallbackQuery|null $callback_query New incoming callback query
     * @param ShippingQuery|null $shipping_query New incoming shipping query. Only for invoices with flexible price
     * @param PreCheckoutQuery|null $pre_checkout_query New incoming pre-checkout query. Contains full information
     *     about checkout
     * @param Poll|null $poll New poll state. Bots receive only updates about manually stopped polls and polls, which
     *     are sent by the bot
     * @param PollAnswer|null $poll_answer A user changed their answer in a non-anonymous poll. Bots receive new votes
     *     only in polls that were sent by the bot itself.
     * @param ChatMemberUpdated|null $my_chat_member The bot's chat member status was updated in a chat. For private
     *     chats, this update is received only when the bot is blocked or unblocked by the user.
     * @param ChatMemberUpdated|null $chat_member A chat member's status was updated in a chat. The bot must be an
     *     administrator in the chat and must explicitly specify ""chat_member"" in the list of "allowed_updates" to
     *     receive these updates.
     * @param ChatJoinRequest|null $chat_join_request A request to join the chat has been sent. The bot must have the
     *     "can_invite_users" administrator right in the chat to receive these updates.
     * @param ChatBoostUpdated|null $chat_boost A chat boost was added or changed. The bot must be an administrator in
     *     the chat to receive these updates.
     * @param ChatBoostRemoved|null $removed_chat_boost A boost was removed from a chat. The bot must be an
     *     administrator in the chat to receive these updates.
     * @param PaidMediaPurchased|null $purchased_paid_media A user purchased paid media with a non-empty payload sent
     *     by the bot in a non-channel chat
     * @param ManagedBotUpdated|null $managed_bot A new bot was created to be managed by the bot, or token or owner of
     *     a managed bot was changed
     * @param Message|null $guest_message New guest message. The bot can use the field "Message.guest_query_id" and the
     *     method answerGuestQuery() to send a message in response.
     */
    public function __construct(
        public int $update_id,
        public ?Message $message = null,
        public ?Message $edited_message = null,
        public ?Message $channel_post = null,
        public ?Message $edited_channel_post = null,
        public ?BusinessConnection $business_connection = null,
        public ?Message $business_message = null,
        public ?Message $edited_business_message = null,
        public ?BusinessMessagesDeleted $deleted_business_messages = null,
        public ?MessageReactionUpdated $message_reaction = null,
        public ?MessageReactionCountUpdated $message_reaction_count = null,
        public ?InlineQuery $inline_query = null,
        public ?ChosenInlineResult $chosen_inline_result = null,
        public ?CallbackQuery $callback_query = null,
        public ?ShippingQuery $shipping_query = null,
        public ?PreCheckoutQuery $pre_checkout_query = null,
        public ?Poll $poll = null,
        public ?PollAnswer $poll_answer = null,
        public ?ChatMemberUpdated $my_chat_member = null,
        public ?ChatMemberUpdated $chat_member = null,
        public ?ChatJoinRequest $chat_join_request = null,
        public ?ChatBoostUpdated $chat_boost = null,
        public ?ChatBoostRemoved $removed_chat_boost = null,
        public ?PaidMediaPurchased $purchased_paid_media = null,
        public ?ManagedBotUpdated $managed_bot = null,
        public ?Message $guest_message = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            update_id: $data['update_id'],
            message: isset($data['message'])
                ? Message::makeByArray($data['message'])
                : null,
            edited_message: isset($data['edited_message'])
                ? Message::makeByArray($data['edited_message'])
                : null,
            channel_post: isset($data['channel_post'])
                ? Message::makeByArray($data['channel_post'])
                : null,
            edited_channel_post: isset($data['edited_channel_post'])
                ? Message::makeByArray($data['edited_channel_post'])
                : null,
            business_connection: isset($data['business_connection'])
                ? BusinessConnection::makeByArray($data['business_connection'])
                : null,
            business_message: isset($data['business_message'])
                ? Message::makeByArray($data['business_message'])
                : null,
            edited_business_message: isset($data['edited_business_message'])
                ? Message::makeByArray($data['edited_business_message'])
                : null,
            deleted_business_messages: isset($data['deleted_business_messages'])
                ? BusinessMessagesDeleted::makeByArray($data['deleted_business_messages'])
                : null,
            message_reaction: isset($data['message_reaction'])
                ? MessageReactionUpdated::makeByArray($data['message_reaction'])
                : null,
            message_reaction_count: isset($data['message_reaction_count'])
                ? MessageReactionCountUpdated::makeByArray($data['message_reaction_count'])
                : null,
            inline_query: isset($data['inline_query'])
                ? InlineQuery::makeByArray($data['inline_query'])
                : null,
            chosen_inline_result: isset($data['chosen_inline_result'])
                ? ChosenInlineResult::makeByArray($data['chosen_inline_result'])
                : null,
            callback_query: isset($data['callback_query'])
                ? CallbackQuery::makeByArray($data['callback_query'])
                : null,
            shipping_query: isset($data['shipping_query'])
                ? ShippingQuery::makeByArray($data['shipping_query'])
                : null,
            pre_checkout_query: isset($data['pre_checkout_query'])
                ? PreCheckoutQuery::makeByArray($data['pre_checkout_query'])
                : null,
            poll: isset($data['poll'])
                ? Poll::makeByArray($data['poll'])
                : null,
            poll_answer: isset($data['poll_answer'])
                ? PollAnswer::makeByArray($data['poll_answer'])
                : null,
            my_chat_member: isset($data['my_chat_member'])
                ? ChatMemberUpdated::makeByArray($data['my_chat_member'])
                : null,
            chat_member: isset($data['chat_member'])
                ? ChatMemberUpdated::makeByArray($data['chat_member'])
                : null,
            chat_join_request: isset($data['chat_join_request'])
                ? ChatJoinRequest::makeByArray($data['chat_join_request'])
                : null,
            chat_boost: isset($data['chat_boost'])
                ? ChatBoostUpdated::makeByArray($data['chat_boost'])
                : null,
            removed_chat_boost: isset($data['removed_chat_boost'])
                ? ChatBoostRemoved::makeByArray($data['removed_chat_boost'])
                : null,
            purchased_paid_media: isset($data['purchased_paid_media'])
                ? PaidMediaPurchased::makeByArray($data['purchased_paid_media'])
                : null,
            managed_bot: isset($data['managed_bot'])
                ? ManagedBotUpdated::makeByArray($data['managed_bot'])
                : null,
            guest_message: isset($data['guest_message'])
                ? Message::makeByArray($data['guest_message'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'update_id' => $this->update_id,
            'message' => $this->message,
            'edited_message' => $this->edited_message,
            'channel_post' => $this->channel_post,
            'edited_channel_post' => $this->edited_channel_post,
            'business_connection' => $this->business_connection,
            'business_message' => $this->business_message,
            'edited_business_message' => $this->edited_business_message,
            'deleted_business_messages' => $this->deleted_business_messages,
            'message_reaction' => $this->message_reaction,
            'message_reaction_count' => $this->message_reaction_count,
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
            'chat_boost' => $this->chat_boost,
            'removed_chat_boost' => $this->removed_chat_boost,
            'purchased_paid_media' => $this->purchased_paid_media,
            'managed_bot' => $this->managed_bot,
            'guest_message' => $this->guest_message,
        ];
    }

    public function getChat(): ?Chat
    {
        return $this->getMessage()?->chat
            ?? $this->deleted_business_messages?->chat
            ?? $this->message_reaction?->chat
            ?? $this->message_reaction_count?->chat
            ?? $this->callback_query?->message?->chat
            ?? $this->my_chat_member?->chat
            ?? $this->chat_member?->chat
            ?? $this->chat_join_request?->chat
            ?? $this->chat_boost?->chat
            ?? $this->removed_chat_boost?->chat;
    }

    public function getUser(): ?User
    {
        return $this->getMessage()?->from
            ?? $this->business_connection?->user
            ?? $this->message_reaction?->user
            ?? $this->inline_query?->from
            ?? $this->chosen_inline_result?->from
            ?? $this->callback_query?->from
            ?? $this->shipping_query?->from
            ?? $this->pre_checkout_query?->from
            ?? $this->poll_answer?->user
            ?? $this->my_chat_member?->from
            ?? $this->chat_member?->from
            ?? $this->chat_join_request?->from
            ?? $this->managed_bot?->user
            ?? $this->purchased_paid_media?->from;
    }

    public function getDate(): ?int
    {
        return $this->getMessage()?->date
            ?? $this->message_reaction?->date
            ?? $this->message_reaction_count?->date
            ?? $this->my_chat_member?->date
            ?? $this->chat_member?->date
            ?? $this->chat_join_request?->date;
    }

    /**
     * Returns Null if the update type is unknown.
     *
     * @return UpdateType|null
     */
    public function getType(): ?UpdateType
    {
        return match (true) {
            $this->message !== null => UpdateType::Message,
            $this->edited_message !== null => UpdateType::EditedMessage,
            $this->channel_post !== null => UpdateType::ChannelPost,
            $this->edited_channel_post !== null => UpdateType::EditedChannelPost,
            $this->business_connection !== null => UpdateType::BusinessConnection,
            $this->business_message !== null => UpdateType::BusinessMessage,
            $this->edited_business_message !== null => UpdateType::EditedBusinessMessage,
            $this->deleted_business_messages !== null => UpdateType::DeletedBusinessMessages,
            $this->message_reaction !== null => UpdateType::MessageReaction,
            $this->message_reaction_count !== null => UpdateType::MessageReactionCount,
            $this->inline_query !== null => UpdateType::InlineQuery,
            $this->chosen_inline_result !== null => UpdateType::ChosenInlineResult,
            $this->callback_query !== null => UpdateType::CallbackQuery,
            $this->shipping_query !== null => UpdateType::ShippingQuery,
            $this->pre_checkout_query !== null => UpdateType::PreCheckoutQuery,
            $this->poll !== null => UpdateType::Poll,
            $this->poll_answer !== null => UpdateType::PollAnswer,
            $this->my_chat_member !== null => UpdateType::MyChatMember,
            $this->chat_member !== null => UpdateType::ChatMember,
            $this->chat_join_request !== null => UpdateType::ChatJoinRequest,
            $this->chat_boost !== null => UpdateType::ChatBoost,
            $this->removed_chat_boost !== null => UpdateType::RemovedChatBoost,
            $this->purchased_paid_media !== null => UpdateType::PurchasedPaidMedia,
            $this->managed_bot !== null => UpdateType::ManagedBot,
            $this->guest_message !== null => UpdateType::GuestMessage,
            default => null,
        };
    }

    public function getBusinessConnectionId(): ?string
    {
        return $this->deleted_business_messages?->business_connection_id
            ?? $this->message?->business_connection_id
            ?? $this->edited_message?->business_connection_id
            ?? $this->channel_post?->business_connection_id
            ?? $this->edited_channel_post?->business_connection_id
            ?? $this->business_message?->business_connection_id
            ?? $this->edited_business_message?->business_connection_id
            ?? $this->guest_message?->business_connection_id;
    }

    public function getMessage(): ?Message
    {
        return $this->message
            ?? $this->edited_message
            ?? $this->channel_post
            ?? $this->edited_channel_post
            ?? $this->business_message
            ?? $this->edited_business_message
            ?? $this->guest_message;
    }
}
