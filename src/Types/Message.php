<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object represents a message.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Message extends Type
{
    /**
     * @var int $message_id Unique message identifier inside this chat
     */
    public int $message_id;

    /**
     * @var User|null $from Sender of the message; empty for messages sent to channels. For backward compatibility, the
     *     field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     */
    public ?User $from = null;

    /**
     * @var Chat|null $sender_chat Sender of the message, sent on behalf of a chat. For example, the channel itself for
     *     channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel
     *     for messages automatically forwarded to the discussion group. For backward compatibility, the field
     *     <em>from</em> contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     */
    public ?Chat $sender_chat = null;

    /**
     * @var int $date Date the message was sent in Unix time
     */
    public int $date;

    /**
     * @var Chat $chat Conversation the message belongs to
     */
    public Chat $chat;

    /**
     * @var User|null $forward_from For forwarded messages, sender of the original message
     */
    public ?User $forward_from = null;

    /**
     * @var Chat|null $forward_from_chat For messages forwarded from channels or from anonymous administrators,
     *     information about the original sender chat
     */
    public ?Chat $forward_from_chat = null;

    /**
     * @var int|null $forward_from_message_id For messages forwarded from channels, identifier of the original message
     *     in the channel
     */
    public ?int $forward_from_message_id = null;

    /**
     * @var string|null $forward_signature For forwarded messages that were originally sent in channels or by an
     *     anonymous chat administrator, signature of the message sender if present
     */
    public ?string $forward_signature = null;

    /**
     * @var string|null $forward_sender_name Sender's name for messages forwarded from users who disallow adding a link
     *     to their account in forwarded messages
     */
    public ?string $forward_sender_name = null;

    /**
     * @var int|null $forward_date For forwarded messages, date the original message was sent in Unix time
     */
    public ?int $forward_date = null;

    /**
     * @var bool|null $is_automatic_forward True, if the message is a channel post that was automatically forwarded to
     *     the connected discussion group
     */
    public ?bool $is_automatic_forward = null;

    /**
     * @var Message|null $reply_to_message For replies, the original message. Note that the Message object in this
     *     field will not contain further <em>reply_to_message</em> fields even if it itself is a reply.
     */
    public ?Message $reply_to_message = null;

    /**
     * @var User|null $via_bot Bot through which the message was sent
     */
    public ?User $via_bot = null;

    /**
     * @var int|null $edit_date Date the message was last edited in Unix time
     */
    public ?int $edit_date = null;

    /**
     * @var bool|null $has_protected_content True, if the message can't be forwarded
     */
    public ?bool $has_protected_content = null;

    /**
     * @var string|null $media_group_id The unique identifier of a media message group this message belongs to
     */
    public ?string $media_group_id = null;

    /**
     * @var string|null $author_signature Signature of the post author for messages in channels, or the custom title of
     *     an anonymous group administrator
     */
    public ?string $author_signature = null;

    /**
     * @var string|null $text For text messages, the actual UTF-8 text of the message, 0-4096 characters
     */
    public ?string $text = null;

    /**
     * @var MessageEntity[]|null $entities For text messages, special entities like usernames, URLs, bot commands, etc.
     *     that appear in the text
     */
    public ?array $entities = null;

    /**
     * @var Animation|null $animation Message is an animation, information about the animation. For backward
     *     compatibility, when this field is set, the <em>document</em> field will also be set
     */
    public ?Animation $animation = null;

    /**
     * @var Audio|null $audio Message is an audio file, information about the file
     */
    public ?Audio $audio = null;

    /**
     * @var Document|null $document Message is a general file, information about the file
     */
    public ?Document $document = null;

    /**
     * @var PhotoSize[]|null $photo Message is a photo, available sizes of the photo
     */
    public ?array $photo = null;

    /**
     * @var Sticker|null $sticker Message is a sticker, information about the sticker
     */
    public ?Sticker $sticker = null;

    /**
     * @var Video|null $video Message is a video, information about the video
     */
    public ?Video $video = null;

    /**
     * @var VideoNote|null $video_note Message is a <a
     *     href="https://telegram.org/blog/video-messages-and-telescope">video note</a>, information about the video
     *     message
     */
    public ?VideoNote $video_note = null;

    /**
     * @var Voice|null $voice Message is a voice message, information about the file
     */
    public ?Voice $voice = null;

    /**
     * @var string|null $caption Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
     */
    public ?string $caption = null;

    /**
     * @var MessageEntity[]|null $caption_entities For messages with a caption, special entities like usernames, URLs,
     *     bot commands, etc. that appear in the caption
     */
    public ?array $caption_entities = null;

    /**
     * @var Contact|null $contact Message is a shared contact, information about the contact
     */
    public ?Contact $contact = null;

    /**
     * @var Dice|null $dice Message is a dice with random value
     */
    public ?Dice $dice = null;

    /**
     * @var Game|null $game Message is a game, information about the game. <a
     *     href="https://core.telegram.org/bots/api#games">More about games »</a>
     */
    public ?Game $game = null;

    /**
     * @var Poll|null $poll Message is a native poll, information about the poll
     */
    public ?Poll $poll = null;

    /**
     * @var Venue|null $venue Message is a venue, information about the venue. For backward compatibility, when this
     *     field is set, the <em>location</em> field will also be set
     */
    public ?Venue $venue = null;

    /**
     * @var Location|null $location Message is a shared location, information about the location
     */
    public ?Location $location = null;

    /**
     * @var User[]|null $new_chat_members New members that were added to the group or supergroup and information about
     *     them (the bot itself may be one of these members)
     */
    public ?array $new_chat_members = null;

    /**
     * @var User|null $left_chat_member A member was removed from the group, information about them (this member may be
     *     the bot itself)
     */
    public ?User $left_chat_member = null;

    /**
     * @var string|null $new_chat_title A chat title was changed to this value
     */
    public ?string $new_chat_title = null;

    /**
     * @var PhotoSize[]|null $new_chat_photo A chat photo was change to this value
     */
    public ?array $new_chat_photo = null;

    /**
     * @var bool|null $delete_chat_photo Service message: the chat photo was deleted
     */
    public ?bool $delete_chat_photo = null;

    /**
     * @var bool|null $group_chat_created Service message: the group has been created
     */
    public ?bool $group_chat_created = null;

    /**
     * @var bool|null $supergroup_chat_created Service message: the supergroup has been created. This field can't be
     *     received in a message coming through updates, because bot can't be a member of a supergroup when it is
     *     created. It can only be found in reply_to_message if someone replies to a very first message in a directly
     *     created supergroup.
     */
    public ?bool $supergroup_chat_created = null;

    /**
     * @var bool|null $channel_chat_created Service message: the channel has been created. This field can't be received
     *     in a message coming through updates, because bot can't be a member of a channel when it is created. It can
     *     only be found in reply_to_message if someone replies to a very first message in a channel.
     */
    public ?bool $channel_chat_created = null;

    /**
     * @var MessageAutoDeleteTimerChanged|null $message_auto_delete_timer_changed Service message: auto-delete timer
     *     settings changed in the chat
     */
    public ?MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed = null;

    /**
     * @var int|null $migrate_to_chat_id The group has been migrated to a supergroup with the specified identifier.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or
     *     double-precision float type are safe for storing this identifier.
     */
    public ?int $migrate_to_chat_id = null;

    /**
     * @var int|null $migrate_from_chat_id The supergroup has been migrated from a group with the specified identifier.
     *     This number may have more than 32 significant bits and some programming languages may have difficulty/silent
     *     defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or
     *     double-precision float type are safe for storing this identifier.
     */
    public ?int $migrate_from_chat_id = null;

    /**
     * @var Message|null $pinned_message Specified message was pinned. Note that the Message object in this field will
     *     not contain further <em>reply_to_message</em> fields even if it is itself a reply.
     */
    public ?Message $pinned_message = null;

    /**
     * @var Invoice|null $invoice Message is an invoice for a <a
     *     href="https://core.telegram.org/bots/api#payments">payment</a>, information about the invoice. <a
     *     href="https://core.telegram.org/bots/api#payments">More about payments »</a>
     */
    public ?Invoice $invoice = null;

    /**
     * @var SuccessfulPayment|null $successful_payment Message is a service message about a successful payment,
     *     information about the payment. <a href="https://core.telegram.org/bots/api#payments">More about payments
     *     »</a>
     */
    public ?SuccessfulPayment $successful_payment = null;

    /**
     * @var string|null $connected_website The domain name of the website on which the user has logged in. <a
     *     href="https://core.telegram.org/widgets/login">More about Telegram Login »</a>
     */
    public ?string $connected_website = null;

    /**
     * @var PassportData|null $passport_data Telegram Passport data
     */
    public ?PassportData $passport_data = null;

    /**
     * @var ProximityAlertTriggered|null $proximity_alert_triggered Service message. A user in the chat triggered
     *     another user's proximity alert while sharing Live Location.
     */
    public ?ProximityAlertTriggered $proximity_alert_triggered = null;

    /**
     * @var VideoChatScheduled|null $video_chat_scheduled Service message: video chat scheduled
     */
    public ?VideoChatScheduled $video_chat_scheduled = null;

    /**
     * @var VideoChatStarted|null $video_chat_started Service message: video chat started
     */
    public ?VideoChatStarted $video_chat_started = null;

    /**
     * @var VideoChatEnded|null $video_chat_ended Service message: video chat ended
     */
    public ?VideoChatEnded $video_chat_ended = null;

    /**
     * @var VideoChatParticipantsInvited|null $video_chat_participants_invited Service message: new participants
     *     invited to a video chat
     */
    public ?VideoChatParticipantsInvited $video_chat_participants_invited = null;

    /**
     * @var WebAppData|null $web_app_data Service message: data sent by a Web App
     */
    public ?WebAppData $web_app_data = null;

    /**
     * @var InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message. <code>login_url</code>
     *     buttons are represented as ordinary <code>url</code> buttons.
     */
    public ?InlineKeyboardMarkup $reply_markup = null;

    public static function makeByArray(array $data): self
    {
        $result = new self;
        $result->message_id = $data['message_id'];
        $result->from = isset($data['from'])
            ? User::makeByArray($data['from'])
            : null;
        $result->sender_chat = isset($data['sender_chat'])
            ? Chat::makeByArray($data['sender_chat'])
            : null;
        $result->date = $data['date'];
        $result->chat = Chat::makeByArray($data['chat']);
        $result->forward_from = isset($data['forward_from'])
            ? User::makeByArray($data['forward_from'])
            : null;
        $result->forward_from_chat = isset($data['forward_from_chat'])
            ? Chat::makeByArray($data['forward_from_chat'])
            : null;
        $result->forward_from_message_id = $data['forward_from_message_id'] ?? null;
        $result->forward_signature = $data['forward_signature'] ?? null;
        $result->forward_sender_name = $data['forward_sender_name'] ?? null;
        $result->forward_date = $data['forward_date'] ?? null;
        $result->is_automatic_forward = $data['is_automatic_forward'] ?? null;
        $result->reply_to_message = isset($data['reply_to_message'])
            ? Message::makeByArray($data['reply_to_message'])
            : null;
        $result->via_bot = isset($data['via_bot'])
            ? User::makeByArray($data['via_bot'])
            : null;
        $result->edit_date = $data['edit_date'] ?? null;
        $result->has_protected_content = $data['has_protected_content'] ?? null;
        $result->media_group_id = $data['media_group_id'] ?? null;
        $result->author_signature = $data['author_signature'] ?? null;
        $result->text = $data['text'] ?? null;
        if (isset($data['entities'])) {
            $result->entities = [];
            foreach ($data['entities'] as $item_data) {
                $result->entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->animation = isset($data['animation'])
            ? Animation::makeByArray($data['animation'])
            : null;
        $result->audio = isset($data['audio'])
            ? Audio::makeByArray($data['audio'])
            : null;
        $result->document = isset($data['document'])
            ? Document::makeByArray($data['document'])
            : null;
        if (isset($data['photo'])) {
            $result->photo = [];
            foreach ($data['photo'] as $item_data) {
                $result->photo[] = PhotoSize::makeByArray($item_data);
            }
        }
        $result->sticker = isset($data['sticker'])
            ? Sticker::makeByArray($data['sticker'])
            : null;
        $result->video = isset($data['video'])
            ? Video::makeByArray($data['video'])
            : null;
        $result->video_note = isset($data['video_note'])
            ? VideoNote::makeByArray($data['video_note'])
            : null;
        $result->voice = isset($data['voice'])
            ? Voice::makeByArray($data['voice'])
            : null;
        $result->caption = $data['caption'] ?? null;
        if (isset($data['caption_entities'])) {
            $result->caption_entities = [];
            foreach ($data['caption_entities'] as $item_data) {
                $result->caption_entities[] = MessageEntity::makeByArray($item_data);
            }
        }
        $result->contact = isset($data['contact'])
            ? Contact::makeByArray($data['contact'])
            : null;
        $result->dice = isset($data['dice'])
            ? Dice::makeByArray($data['dice'])
            : null;
        $result->game = isset($data['game'])
            ? Game::makeByArray($data['game'])
            : null;
        $result->poll = isset($data['poll'])
            ? Poll::makeByArray($data['poll'])
            : null;
        $result->venue = isset($data['venue'])
            ? Venue::makeByArray($data['venue'])
            : null;
        $result->location = isset($data['location'])
            ? Location::makeByArray($data['location'])
            : null;
        if (isset($data['new_chat_members'])) {
            $result->new_chat_members = [];
            foreach ($data['new_chat_members'] as $item_data) {
                $result->new_chat_members[] = User::makeByArray($item_data);
            }
        }
        $result->left_chat_member = isset($data['left_chat_member'])
            ? User::makeByArray($data['left_chat_member'])
            : null;
        $result->new_chat_title = $data['new_chat_title'] ?? null;
        if (isset($data['new_chat_photo'])) {
            $result->new_chat_photo = [];
            foreach ($data['new_chat_photo'] as $item_data) {
                $result->new_chat_photo[] = PhotoSize::makeByArray($item_data);
            }
        }
        $result->delete_chat_photo = $data['delete_chat_photo'] ?? null;
        $result->group_chat_created = $data['group_chat_created'] ?? null;
        $result->supergroup_chat_created = $data['supergroup_chat_created'] ?? null;
        $result->channel_chat_created = $data['channel_chat_created'] ?? null;
        $result->message_auto_delete_timer_changed = isset($data['message_auto_delete_timer_changed'])
            ? MessageAutoDeleteTimerChanged::makeByArray($data['message_auto_delete_timer_changed'])
            : null;
        $result->migrate_to_chat_id = $data['migrate_to_chat_id'] ?? null;
        $result->migrate_from_chat_id = $data['migrate_from_chat_id'] ?? null;
        $result->pinned_message = isset($data['pinned_message'])
            ? Message::makeByArray($data['pinned_message'])
            : null;
        $result->invoice = isset($data['invoice'])
            ? Invoice::makeByArray($data['invoice'])
            : null;
        $result->successful_payment = isset($data['successful_payment'])
            ? SuccessfulPayment::makeByArray($data['successful_payment'])
            : null;
        $result->connected_website = $data['connected_website'] ?? null;
        $result->passport_data = isset($data['passport_data'])
            ? PassportData::makeByArray($data['passport_data'])
            : null;
        $result->proximity_alert_triggered = isset($data['proximity_alert_triggered'])
            ? ProximityAlertTriggered::makeByArray($data['proximity_alert_triggered'])
            : null;
        $result->video_chat_scheduled = isset($data['video_chat_scheduled'])
            ? VideoChatScheduled::makeByArray($data['video_chat_scheduled'])
            : null;
        $result->video_chat_started = isset($data['video_chat_started'])
            ? VideoChatStarted::makeByArray($data['video_chat_started'])
            : null;
        $result->video_chat_ended = isset($data['video_chat_ended'])
            ? VideoChatEnded::makeByArray($data['video_chat_ended'])
            : null;
        $result->video_chat_participants_invited = isset($data['video_chat_participants_invited'])
            ? VideoChatParticipantsInvited::makeByArray($data['video_chat_participants_invited'])
            : null;
        $result->web_app_data = isset($data['web_app_data'])
            ? WebAppData::makeByArray($data['web_app_data'])
            : null;
        $result->reply_markup = isset($data['reply_markup'])
            ? InlineKeyboardMarkup::makeByArray($data['reply_markup'])
            : null;
        return $result;
    }

    public function getRequestData(): array
    {
        return [
            'message_id' => $this->message_id,
            'from' => $this->from,
            'sender_chat' => $this->sender_chat,
            'date' => $this->date,
            'chat' => $this->chat,
            'forward_from' => $this->forward_from,
            'forward_from_chat' => $this->forward_from_chat,
            'forward_from_message_id' => $this->forward_from_message_id,
            'forward_signature' => $this->forward_signature,
            'forward_sender_name' => $this->forward_sender_name,
            'forward_date' => $this->forward_date,
            'is_automatic_forward' => $this->is_automatic_forward,
            'reply_to_message' => $this->reply_to_message,
            'via_bot' => $this->via_bot,
            'edit_date' => $this->edit_date,
            'has_protected_content' => $this->has_protected_content,
            'media_group_id' => $this->media_group_id,
            'author_signature' => $this->author_signature,
            'text' => $this->text,
            'entities' => $this->entities,
            'animation' => $this->animation,
            'audio' => $this->audio,
            'document' => $this->document,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'video' => $this->video,
            'video_note' => $this->video_note,
            'voice' => $this->voice,
            'caption' => $this->caption,
            'caption_entities' => $this->caption_entities,
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
            'connected_website' => $this->connected_website,
            'passport_data' => $this->passport_data,
            'proximity_alert_triggered' => $this->proximity_alert_triggered,
            'video_chat_scheduled' => $this->video_chat_scheduled,
            'video_chat_started' => $this->video_chat_started,
            'video_chat_ended' => $this->video_chat_ended,
            'video_chat_participants_invited' => $this->video_chat_participants_invited,
            'web_app_data' => $this->web_app_data,
            'reply_markup' => $this->reply_markup,
        ];
    }
}
