<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use JetBrains\PhpStorm\Deprecated;

/**
 * This object represents a message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Message extends MaybeInaccessibleMessage
{
    /**
     * @param int $message_id Unique message identifier inside this chat
     * @param int $date Date the message was sent in Unix time. It is always a positive number, representing a valid
     *     date.
     * @param Chat $chat Chat the message belongs to
     * @param int|null $message_thread_id Unique identifier of a message thread to which the message belongs;
     *     for supergroups only
     * @param User|null $from Sender of the message; empty for messages sent to channels. For backward compatibility,
     *     the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @param Chat|null $sender_chat Sender of the message, sent on behalf of a chat. For example, the channel itself
     *     for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel
     *     for messages automatically forwarded to the discussion group. For backward compatibility, the field "from"
     *     contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @param int|null $sender_boost_count If the sender of the message boosted the chat, the number of boosts added
     *     by the user
     * @param User|null $sender_business_bot The bot that actually sent the message on behalf of the business account.
     *     Available only for outgoing messages sent on behalf of the connected business account.
     * @param string|null $business_connection_id Unique identifier of the business connection from which the message
     *     was received. If non-empty, the message belongs to a chat of the corresponding business account that is
     *     independent from any potential bot chat which might share the same identifier.
     * @param MessageOrigin|null $forward_origin Information about the original message for forwarded messages
     * @param bool|null $is_topic_message True, if the message is sent to a forum topic
     * @param bool|null $is_automatic_forward True, if the message is a channel post that was automatically
     *     forwarded to the connected discussion group
     * @param Message|null $reply_to_message For replies in the same chat and message thread, the original message.
     *     Note that the Message object in this field will not contain further "reply_to_message" fields even if it
     *     itself is a reply.
     * @param ExternalReplyInfo|null $external_reply Information about the message that is being replied to, which may
     *     come from another chat or forum topic
     * @param TextQuote|null $quote For replies that quote part of the original message, the quoted part of the message
     * @param Story|null $reply_to_story For replies to a story, the original story
     * @param User|null $via_bot Bot through which the message was sent
     * @param int|null $edit_date Date the message was last edited in Unix time
     * @param bool|null $has_protected_content True, if the message can't be forwarded
     * @param bool|null $is_from_offline True, if the message was sent by an implicit action, for example, as an away
     *     or a greeting business message, or as a scheduled message
     * @param string|null $media_group_id The unique identifier of a media message group this message belongs to
     * @param string|null $author_signature Signature of the post author for messages in channels, or the custom title
     *     of an anonymous group administrator
     * @param string|null $text For text messages, the actual UTF-8 text of the message
     * @param MessageEntity[]|null $entities For text messages, special entities like usernames, URLs, bot commands,
     *     etc. that appear in the text
     * @param LinkPreviewOptions|null $link_preview_options Options used for link preview generation for the message,
     *     if it is a text message and link preview options were changed
     * @param string|null $effect_id Unique identifier of the message effect added to the message
     * @param Animation|null $animation Message is an animation, information about the animation. For backward
     *     compatibility, when this field is set, the document field will also be set
     * @param Audio|null $audio Message is an audio file, information about the file
     * @param Document|null $document Message is a general file, information about the file
     * @param PhotoSize[]|null $photo Message is a photo, available sizes of the photo
     * @param Sticker|null $sticker Message is a sticker, information about the sticker
     * @param Story|null $story Message is a forwarded story
     * @param Video|null $video Message is a video, information about the video
     * @param VideoNote|null $video_note Message is a video note, information about the video message
     * @param Voice|null $voice Message is a voice message, information about the file
     * @param string|null $caption Caption for the animation, audio, document, photo, video or voice
     * @param MessageEntity[]|null $caption_entities For messages with a caption, special entities like usernames,
     *     URLs, bot commands, etc. that appear in the caption
     * @param bool|null $show_caption_above_media True, if the caption must be shown above the message media
     * @param bool|null $has_media_spoiler True, if the message media is covered by a spoiler animation
     * @param Contact|null $contact Message is a shared contact, information about the contact
     * @param Dice|null $dice Message is a dice with random value
     * @param Game|null $game Message is a game, information about the game.
     * @param Poll|null $poll Message is a native poll, information about the poll
     * @param Venue|null $venue Message is a venue, information about the venue. For backward compatibility,
     *     when this field is set, the "location" field will also be set
     * @param Location|null $location Message is a shared location, information about the location
     * @param User[]|null $new_chat_members New members that were added to the group or supergroup and information about
     *     them (the bot itself may be one of these members)
     * @param User|null $left_chat_member A member was removed from the group, information about them
     *     (this member may be the bot itself)
     * @param string|null $new_chat_title A chat title was changed to this value
     * @param PhotoSize[]|null $new_chat_photo A chat photo was change to this value
     * @param bool|null $delete_chat_photo Service message: the chat photo was deleted
     * @param bool|null $group_chat_created Service message: the group has been created
     * @param bool|null $supergroup_chat_created Service message: the supergroup has been created. This field can't be
     *     received in a message coming through updates, because bot can't be a member of a supergroup when it is
     *     created. It can only be found in reply_to_message if someone replies to a very first message in a directly
     *     created supergroup.
     * @param bool|null $channel_chat_created Service message: the channel has been created. This field can't be
     *     received in a message coming through updates, because bot can't be a member of a channel when it is created.
     *     It can only be found in reply_to_message if someone replies to a very first message in a channel.
     * @param MessageAutoDeleteTimerChanged|null $message_auto_delete_timer_changed Service message: auto-delete timer
     *     settings changed in the chat
     * @param int|null $migrate_to_chat_id The group has been migrated to a supergroup with the specified identifier.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or
     *     double-precision float type are safe for storing this identifier.
     * @param int|null $migrate_from_chat_id The supergroup has been migrated from a group with the specified
     *     identifier. This number may have more than 32 significant bits and some programming languages may have
     *     difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit
     *     integer or double-precision float type are safe for storing this identifier.
     * @param MaybeInaccessibleMessage|null $pinned_message Specified message was pinned. Note that the Message object
     *     in this field will not contain further reply_to_message fields even if it itself is a reply.
     * @param Invoice|null $invoice Message is an invoice for a payment, information about the invoice.
     * @param SuccessfulPayment|null $successful_payment Message is a service message about a successful payment,
     *     information about the payment.
     * @param UsersShared|null $users_shared Service message: users were shared with the bot
     * @param ChatShared|null $chat_shared Service message: a chat was shared with the bot
     * @param string|null $connected_website The domain name of the website on which the user has logged in.
     * @param PassportData|null $passport_data Telegram Passport data
     * @param ProximityAlertTriggered|null $proximity_alert_triggered Service message. A user in the chat triggered
     *     another user's proximity alert while sharing Live Location.
     * @param ChatBoostAdded|null $boost_added Service message: user boosted the chat
     * @param ChatBackground|null $chat_background_set Service message: chat background set
     * @param ForumTopicCreated|null $forum_topic_created Service message: forum topic created
     * @param ForumTopicEdited|null $forum_topic_edited Service message: forum topic edited
     * @param ForumTopicClosed|null $forum_topic_closed Service message: forum topic closed
     * @param ForumTopicReopened|null $forum_topic_reopened Service message: forum topic reopened
     * @param VideoChatScheduled|null $video_chat_scheduled Service message: video chat scheduled
     * @param VideoChatStarted|null $video_chat_started Service message: video chat started
     * @param VideoChatEnded|null $video_chat_ended Service message: video chat ended
     * @param VideoChatParticipantsInvited|null $video_chat_participants_invited Service message: new participants
     *     invited to a video chat
     * @param WebAppData|null $web_app_data Service message: data sent by a Web App
     * @param InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message. "login_url" buttons are
     *     represented as ordinary "url" buttons.
     * @param GeneralForumTopicHidden|null $general_forum_topic_hidden Service message: the 'General' forum topic hidden
     * @param GeneralForumTopicUnhidden|null $general_forum_topic_unhidden Service message: the 'General' forum topic
     *     unhidden
     * @param GiveawayCreated|null $giveaway_created Service message: a scheduled giveaway was created
     * @param Giveaway|null $giveaway The message is a scheduled giveaway message
     * @param GiveawayWinners|null $giveaway_winners A giveaway with public winners was completed
     * @param GiveawayCompleted|null $giveaway_completed Service message: a giveaway without public winners was
     *     completed
     * @param WriteAccessAllowed|null $write_access_allowed Service message: the user allowed the bot to write messages
     *      after adding it to the attachment or side menu, launching a Web App from a link, or accepting an explicit
     *      request from a Web App sent by the method requestWriteAccess()
     *
     * @param User|null $forward_from For forwarded messages, sender of the original message
     * @param Chat|null $forward_from_chat For messages forwarded from channels or from anonymous administrators,
     *     information about the original sender chat
     * @param int|null $forward_from_message_id For messages forwarded from channels, identifier of the original
     *     message in the channel
     * @param string|null $forward_signature For forwarded messages that were originally sent in channels or by an
     *     anonymous chat administrator, signature of the message sender if present
     * @param string|null $forward_sender_name Sender's name for messages forwarded from users who disallow adding a
     *     link to their account in forwarded messages
     * @param int|null $forward_date For forwarded messages, date the original message was sent in Unix time
     */
    public function __construct(
        public int $message_id,
        public int $date,
        public Chat $chat,
        public ?int $message_thread_id = null,
        public ?User $from = null,
        public ?Chat $sender_chat = null,
        public ?int $sender_boost_count = null,
        public ?User $sender_business_bot = null,
        public ?string $business_connection_id = null,
        public ?MessageOrigin $forward_origin = null,
        public ?bool $is_topic_message = null,
        public ?bool $is_automatic_forward = null,
        public ?Message $reply_to_message = null,
        public ?ExternalReplyInfo $external_reply = null,
        public ?TextQuote $quote = null,
        public ?Story $reply_to_story = null,
        public ?User $via_bot = null,
        public ?int $edit_date = null,
        public ?bool $has_protected_content = null,
        public ?bool $is_from_offline = null,
        public ?string $media_group_id = null,
        public ?string $author_signature = null,
        public ?string $text = null,
        public ?array $entities = null,
        public ?LinkPreviewOptions $link_preview_options = null,
        public ?string $effect_id = null,
        public ?Animation $animation = null,
        public ?Audio $audio = null,
        public ?Document $document = null,
        public ?array $photo = null,
        public ?Sticker $sticker = null,
        public ?Story $story = null,
        public ?Video $video = null,
        public ?VideoNote $video_note = null,
        public ?Voice $voice = null,
        public ?string $caption = null,
        public ?array $caption_entities = null,
        public ?bool $show_caption_above_media = null,
        public ?bool $has_media_spoiler = null,
        public ?Contact $contact = null,
        public ?Dice $dice = null,
        public ?Game $game = null,
        public ?Poll $poll = null,
        public ?Venue $venue = null,
        public ?Location $location = null,
        public ?array $new_chat_members = null,
        public ?User $left_chat_member = null,
        public ?string $new_chat_title = null,
        public ?array $new_chat_photo = null,
        public ?bool $delete_chat_photo = null,
        public ?bool $group_chat_created = null,
        public ?bool $supergroup_chat_created = null,
        public ?bool $channel_chat_created = null,
        public ?MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed = null,
        public ?int $migrate_to_chat_id = null,
        public ?int $migrate_from_chat_id = null,
        public ?MaybeInaccessibleMessage $pinned_message = null,
        public ?Invoice $invoice = null,
        public ?SuccessfulPayment $successful_payment = null,
        public ?UsersShared $users_shared = null,
        public ?ChatShared $chat_shared = null,
        public ?string $connected_website = null,
        public ?PassportData $passport_data = null,
        public ?ProximityAlertTriggered $proximity_alert_triggered = null,
        public ?ChatBoostAdded $boost_added = null,
        public ?ChatBackground $chat_background_set = null,
        public ?ForumTopicCreated $forum_topic_created = null,
        public ?ForumTopicEdited $forum_topic_edited = null,
        public ?ForumTopicClosed $forum_topic_closed = null,
        public ?ForumTopicReopened $forum_topic_reopened = null,
        public ?VideoChatScheduled $video_chat_scheduled = null,
        public ?VideoChatStarted $video_chat_started = null,
        public ?VideoChatEnded $video_chat_ended = null,
        public ?VideoChatParticipantsInvited $video_chat_participants_invited = null,
        public ?WebAppData $web_app_data = null,
        public ?InlineKeyboardMarkup $reply_markup = null,
        public ?GeneralForumTopicHidden $general_forum_topic_hidden = null,
        public ?GeneralForumTopicUnhidden $general_forum_topic_unhidden = null,
        public ?GiveawayCreated $giveaway_created = null,
        public ?Giveaway $giveaway = null,
        public ?GiveawayWinners $giveaway_winners = null,
        public ?GiveawayCompleted $giveaway_completed = null,
        public ?WriteAccessAllowed $write_access_allowed = null,

        #[Deprecated] public ?User $forward_from = null,
        #[Deprecated] public ?Chat $forward_from_chat = null,
        #[Deprecated] public ?int $forward_from_message_id = null,
        #[Deprecated] public ?string $forward_signature = null,
        #[Deprecated] public ?string $forward_sender_name = null,
        #[Deprecated] public ?int $forward_date = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            message_id: $data['message_id'],
            date: $data['date'],
            chat: Chat::makeByArray($data['chat']),
            message_thread_id: $data['message_thread_id'] ?? null,
            from: isset($data['from'])
                ? User::makeByArray($data['from'])
                : null,
            sender_chat: isset($data['sender_chat'])
                ? Chat::makeByArray($data['sender_chat'])
                : null,
            sender_boost_count: $data['sender_boost_count'] ?? null,
            sender_business_bot: isset($data['sender_business_bot'])
                ? User::makeByArray($data['sender_business_bot'])
                : null,
            business_connection_id: $data['business_connection_id'] ?? null,
            forward_origin: isset($data['forward_origin'])
                ? MessageOrigin::makeByArray($data['forward_origin'])
                : null,
            is_topic_message: $data['is_topic_message'] ?? null,
            is_automatic_forward: $data['is_automatic_forward'] ?? null,
            reply_to_message: isset($data['reply_to_message'])
                ? Message::makeByArray($data['reply_to_message'])
                : null,
            external_reply: isset($data['external_reply'])
                ? ExternalReplyInfo::makeByArray($data['external_reply'])
                : null,
            quote: isset($data['quote'])
                ? TextQuote::makeByArray($data['quote'])
                : null,
            reply_to_story: isset($data['reply_to_story'])
                ? Story::makeByArray($data['reply_to_story'])
                : null,
            via_bot: isset($data['via_bot'])
                ? User::makeByArray($data['via_bot'])
                : null,
            edit_date: $data['edit_date'] ?? null,
            has_protected_content: $data['has_protected_content'] ?? null,
            is_from_offline: $data['is_from_offline'] ?? null,
            media_group_id: $data['media_group_id'] ?? null,
            author_signature: $data['author_signature'] ?? null,
            text: $data['text'] ?? null,
            entities: isset($data['entities'])
                ? array_map(
                    static fn(array $entity_data) => MessageEntity::makeByArray($entity_data),
                    $data['entities'],
                )
                : null,
            link_preview_options: isset($data['link_preview_options'])
                ? LinkPreviewOptions::makeByArray($data['link_preview_options'])
                : null,
            effect_id: $data['effect_id'] ?? null,
            animation: isset($data['animation'])
                ? Animation::makeByArray($data['animation'])
                : null,
            audio: isset($data['audio'])
                ? Audio::makeByArray($data['audio'])
                : null,
            document: isset($data['document'])
                ? Document::makeByArray($data['document'])
                : null,
            photo: isset($data['photo'])
                ? array_map(
                    static fn(array $photo_size_data) => PhotoSize::makeByArray($photo_size_data),
                    $data['photo'],
                )
                : null,
            sticker: isset($data['sticker'])
                ? Sticker::makeByArray($data['sticker'])
                : null,
            story: isset($data['story'])
                ? Story::makeByArray($data['story'])
                : null,
            video: isset($data['video'])
                ? Video::makeByArray($data['video'])
                : null,
            video_note: isset($data['video_note'])
                ? VideoNote::makeByArray($data['video_note'])
                : null,
            voice: isset($data['voice'])
                ? Voice::makeByArray($data['voice'])
                : null,
            caption: $data['caption'] ?? null,
            caption_entities: isset($data['caption_entities'])
                ? array_map(
                    static fn(array $message_entity_data) => MessageEntity::makeByArray($message_entity_data),
                    $data['caption_entities'],
                )
                : null,
            show_caption_above_media: $data['show_caption_above_media'] ?? null,
            has_media_spoiler: $data['has_media_spoiler'] ?? null,
            contact: isset($data['contact'])
                ? Contact::makeByArray($data['contact'])
                : null,
            dice: isset($data['dice'])
                ? Dice::makeByArray($data['dice'])
                : null,
            game: isset($data['game'])
                ? Game::makeByArray($data['game'])
                : null,
            poll: isset($data['poll'])
                ? Poll::makeByArray($data['poll'])
                : null,
            venue: isset($data['venue'])
                ? Venue::makeByArray($data['venue'])
                : null,
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
            new_chat_members: isset($data['new_chat_members'])
                ? array_map(
                    static fn(array $user_data) => User::makeByArray($user_data),
                    $data['new_chat_members'],
                )
                : null,
            left_chat_member: isset($data['left_chat_member'])
                ? User::makeByArray($data['left_chat_member'])
                : null,
            new_chat_title: $data['new_chat_title'] ?? null,
            new_chat_photo: isset($data['new_chat_photo'])
                ? array_map(
                    static fn(array $photo_size_data) => PhotoSize::makeByArray($photo_size_data),
                    $data['new_chat_photo'],
                )
                : null,
            delete_chat_photo: $data['delete_chat_photo'] ?? null,
            group_chat_created: $data['group_chat_created'] ?? null,
            supergroup_chat_created: $data['supergroup_chat_created'] ?? null,
            channel_chat_created: $data['channel_chat_created'] ?? null,
            message_auto_delete_timer_changed: isset($data['message_auto_delete_timer_changed'])
                ? MessageAutoDeleteTimerChanged::makeByArray($data['message_auto_delete_timer_changed'])
                : null,
            migrate_to_chat_id: $data['migrate_to_chat_id'] ?? null,
            migrate_from_chat_id: $data['migrate_from_chat_id'] ?? null,
            pinned_message: isset($data['pinned_message'])
                ? MaybeInaccessibleMessage::makeByArray($data['pinned_message'])
                : null,
            invoice: isset($data['invoice'])
                ? Invoice::makeByArray($data['invoice'])
                : null,
            successful_payment: isset($data['successful_payment'])
                ? SuccessfulPayment::makeByArray($data['successful_payment'])
                : null,
            users_shared: isset($data['users_shared'])
                ? UsersShared::makeByArray($data['users_shared'])
                : null,
            chat_shared: isset($data['chat_shared'])
                ? ChatShared::makeByArray($data['chat_shared'])
                : null,
            connected_website: $data['connected_website'] ?? null,
            passport_data: isset($data['passport_data'])
                ? PassportData::makeByArray($data['passport_data'])
                : null,
            proximity_alert_triggered: isset($data['proximity_alert_triggered'])
                ? ProximityAlertTriggered::makeByArray($data['proximity_alert_triggered'])
                : null,
            boost_added: isset($data['boost_added'])
                ? ChatBoostAdded::makeByArray($data['boost_added'])
                : null,
            chat_background_set: isset($data['chat_background_set'])
                ? ChatBackground::makeByArray($data['chat_background_set'])
                : null,
            forum_topic_created: isset($data['forum_topic_created'])
                ? ForumTopicCreated::makeByArray($data['forum_topic_created'])
                : null,
            forum_topic_edited: isset($data['forum_topic_edited'])
                ? ForumTopicEdited::makeByArray($data['forum_topic_edited'])
                : null,
            forum_topic_closed: isset($data['forum_topic_closed'])
                ? ForumTopicClosed::makeByArray($data['forum_topic_closed'])
                : null,
            forum_topic_reopened: isset($data['forum_topic_reopened'])
                ? ForumTopicReopened::makeByArray($data['forum_topic_reopened'])
                : null,
            video_chat_scheduled: isset($data['video_chat_scheduled'])
                ? VideoChatScheduled::makeByArray($data['video_chat_scheduled'])
                : null,
            video_chat_started: isset($data['video_chat_started'])
                ? VideoChatStarted::makeByArray($data['video_chat_started'])
                : null,
            video_chat_ended: isset($data['video_chat_ended'])
                ? VideoChatEnded::makeByArray($data['video_chat_ended'])
                : null,
            video_chat_participants_invited: isset($data['video_chat_participants_invited'])
                ? VideoChatParticipantsInvited::makeByArray($data['video_chat_participants_invited'])
                : null,
            web_app_data: isset($data['web_app_data'])
                ? WebAppData::makeByArray($data['web_app_data'])
                : null,
            reply_markup: isset($data['reply_markup'])
                ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
                : null,
            general_forum_topic_hidden: isset($data['general_forum_topic_hidden'])
                ? GeneralForumTopicHidden::makeByArray($data['general_forum_topic_hidden'])
                : null,
            general_forum_topic_unhidden: isset($data['general_forum_topic_unhidden'])
                ? GeneralForumTopicUnhidden::makeByArray($data['general_forum_topic_unhidden'])
                : null,
            giveaway_created: isset($data['giveaway_created'])
                ? GiveawayCreated::makeByArray($data['giveaway_created'])
                : null,
            giveaway: isset($data['giveaway'])
                ? Giveaway::makeByArray($data['giveaway'])
                : null,
            giveaway_winners: isset($data['giveaway_winners'])
                ? GiveawayWinners::makeByArray($data['giveaway_winners'])
                : null,
            giveaway_completed: isset($data['giveaway_completed'])
                ? GiveawayCompleted::makeByArray($data['giveaway_completed'])
                : null,
            write_access_allowed: isset($data['write_access_allowed'])
                ? WriteAccessAllowed::makeByArray($data['write_access_allowed'])
                : null,

            forward_from: isset($data['forward_from'])
                ? User::makeByArray($data['forward_from'])
                : null,
            forward_from_chat: isset($data['forward_from_chat'])
                ? Chat::makeByArray($data['forward_from_chat'])
                : null,
            forward_from_message_id: $data['forward_from_message_id'] ?? null,
            forward_signature: $data['forward_signature'] ?? null,
            forward_sender_name: $data['forward_sender_name'] ?? null,
            forward_date: $data['forward_date'] ?? null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'message_id' => $this->message_id,
            'message_thread_id' => $this->message_thread_id,
            'from' => $this->from,
            'sender_chat' => $this->sender_chat,
            'sender_boost_count' => $this->sender_boost_count,
            'sender_business_bot' => $this->sender_business_bot,
            'date' => $this->date,
            'business_connection_id' => $this->business_connection_id,
            'chat' => $this->chat,
            'forward_origin' => $this->forward_origin,
            'is_topic_message' => $this->is_topic_message,
            'is_automatic_forward' => $this->is_automatic_forward,
            'reply_to_message' => $this->reply_to_message,
            'external_reply' => $this->external_reply,
            'quote' => $this->quote,
            'reply_to_story' => $this->reply_to_story,
            'via_bot' => $this->via_bot,
            'edit_date' => $this->edit_date,
            'has_protected_content' => $this->has_protected_content,
            'is_from_offline' => $this->is_from_offline,
            'media_group_id' => $this->media_group_id,
            'author_signature' => $this->author_signature,
            'text' => $this->text,
            'entities' => $this->entities,
            'link_preview_options' => $this->link_preview_options,
            'effect_id' => $this->effect_id,
            'animation' => $this->animation,
            'audio' => $this->audio,
            'document' => $this->document,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'story' => $this->story,
            'video' => $this->video,
            'video_note' => $this->video_note,
            'voice' => $this->voice,
            'caption' => $this->caption,
            'caption_entities' => $this->caption_entities,
            'show_caption_above_media' => $this->show_caption_above_media,
            'has_media_spoiler' => $this->has_media_spoiler,
            'contact' => $this->contact,
            'dice' => $this->dice,
            'game' => $this->game,
            'poll' => $this->poll,
            'venue' => $this->venue,
            'location' => $this->location,
            'new_chat_members' => $this->new_chat_members,
            'left_chat_member' => $this->left_chat_member,
            'new_chat_title' => $this->new_chat_title,
            'new_chat_photo' => $this->new_chat_photo,
            'delete_chat_photo' => $this->delete_chat_photo,
            'group_chat_created' => $this->group_chat_created,
            'supergroup_chat_created' => $this->supergroup_chat_created,
            'channel_chat_created' => $this->channel_chat_created,
            'message_auto_delete_timer_changed' => $this->message_auto_delete_timer_changed,
            'migrate_to_chat_id' => $this->migrate_to_chat_id,
            'migrate_from_chat_id' => $this->migrate_from_chat_id,
            'pinned_message' => $this->pinned_message,
            'invoice' => $this->invoice,
            'successful_payment' => $this->successful_payment,
            'users_shared' => $this->users_shared,
            'chat_shared' => $this->chat_shared,
            'connected_website' => $this->connected_website,
            'write_access_allowed' => $this->write_access_allowed,
            'passport_data' => $this->passport_data,
            'proximity_alert_triggered' => $this->proximity_alert_triggered,
            'boost_added' => $this->boost_added,
            'chat_background_set' => $this->chat_background_set,
            'forum_topic_created' => $this->forum_topic_created,
            'forum_topic_edited' => $this->forum_topic_edited,
            'forum_topic_closed' => $this->forum_topic_closed,
            'forum_topic_reopened' => $this->forum_topic_reopened,
            'general_forum_topic_hidden' => $this->general_forum_topic_hidden,
            'general_forum_topic_unhidden' => $this->general_forum_topic_unhidden,
            'giveaway_created' => $this->giveaway_created,
            'giveaway' => $this->giveaway,
            'giveaway_winners' => $this->giveaway_winners,
            'giveaway_completed' => $this->giveaway_completed,
            'video_chat_scheduled' => $this->video_chat_scheduled,
            'video_chat_started' => $this->video_chat_started,
            'video_chat_ended' => $this->video_chat_ended,
            'video_chat_participants_invited' => $this->video_chat_participants_invited,
            'web_app_data' => $this->web_app_data,
            'reply_markup' => $this->reply_markup,

            'forward_from' => $this->forward_from,
            'forward_from_chat' => $this->forward_from_chat,
            'forward_from_message_id' => $this->forward_from_message_id,
            'forward_signature' => $this->forward_signature,
            'forward_sender_name' => $this->forward_sender_name,
            'forward_date' => $this->forward_date,
        ];
    }
}
