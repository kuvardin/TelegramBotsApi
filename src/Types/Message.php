<?php

namespace TelegramBotsApi\Types;

use \TelegramBotsApi;
use \TelegramBotsApi\Exceptions\Error;

/**
 * Instance of this class represents a message.
 * @package TelegramBotsApi\Types
 * @author Maxim Kuvardin <kuvard.in@mail.ru>
 */
class Message implements TypeInterface
{

    /**
     * @var int Unique message identifier inside this chat
     */
    public $id;

    /**
     * @var User|null Sender, empty for messages sent to channels
     */
    public $from;

    /**
     * @var int Date the message was sent in Unix time
     */
    public $date;

    /**
     * @var Chat Conversation the message belongs to
     */
    public $chat;

    /**
     * @var User|null For forwarded messages, sender of the original message
     */
    public $forward_from;

    /**
     * @var Chat|null For messages forwarded from channels, information about the original channel
     */
    public $forward_from_chat;

    /**
     * @var int|null For messages forwarded from channels, identifier of the original message in the channel
     */
    public $forward_from_message_id;

    /**
     * @var string|null For messages forwarded from channels, signature of the post author if present
     */
    public $forward_signature;

    /**
     * @var string|null Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     */
    public $forward_sender_name;

    /**
     * @var int|null For forwarded messages, date the original message was sent in Unix time
     */
    public $forward_date;

    /**
     * @var Message|null For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     */
    public $reply_to_message;

    /**
     * @var int|null Date the message was last edited in Unix time
     */
    public $edit_date;

    /**
     * @var string|null The unique identifier of a media message group this message belongs to
     */
    public $media_group_id;

    /**
     * @var string|null Signature of the post author for messages in channels
     */
    public $author_signature;

    /**
     * @var string|null For text messages, the actual UTF-8 text of the message, 0-4096 characters.
     */
    public $text;

    /**
     * @var MessageEntity[]|null For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     */
    public $entities;

    /**
     * @var MessageEntity[]|null For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     */
    public $caption_entities;

    /**
     * @var Audio|null Message is an audio file, information about the file
     */
    public $audio;

    /**
     * @var Document|null Message is a general file, information about the file
     */
    public $document;

    /**
     * @var Animation|null Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
     */
    public $animation;

    /**
     * @var Game|null Optional. Message is a game, information about the game
     */
    public $game;

    /**
     * @var PhotoSize[]|null Message is a photo, available sizes of the photo
     */
    public $photo;

    /**
     * @var Sticker|null Message is a sticker, information about the sticker
     */
    public $sticker;

    /**
     * @var Video|null Message is a video, information about the video
     */
    public $video;

    /**
     * @var Voice|null Message is a voice message, information about the file
     */
    public $voice;

    /**
     * @var VideoNote|null Message is a video note, information about the video message
     */
    public $video_note;

    /**
     * @var string|null Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
     */
    public $caption;

    /**
     * @var Contact|null Message is a shared contact, information about the contact
     */
    public $contact;

    /**
     * @var Location|null Message is a shared location, information about the location
     */
    public $location;

    /**
     * @var Venue|null Message is a venue, information about the venue
     */
    public $venue;

    /**
     * @var Poll|null Message is a native poll, information about the poll
     */
    public $poll;

    /**
     * @var User[]|null New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
     */
    public $new_chat_members;

    /**
     * @var User|null A member was removed from the group, information about them (this member may be the bot itself)
     */
    public $left_chat_member;

    /**
     * @var string|null A chat title was changed to this value
     */
    public $new_chat_title;

    /**
     * @var PhotoSize[]|null A chat photo was change to this value
     */
    public $new_chat_photo;

    /**
     * @var bool|null Service message: the chat photo was deleted
     */
    public $delete_chat_photo;

    /**
     * @var bool|null Service message: the group has been created
     */
    public $group_chat_created;

    /**
     * @var bool|null Service message: the supergroup has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
     */
    public $supergroup_chat_created;

    /**
     * @var bool|null Service message: the channel has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
     */
    public $channel_chat_created;

    /**
     * @var int|null The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public $migrate_to_chat_id;

    /**
     * @var int|null The supergroup has been migrated from a group with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
     */
    public $migrate_from_chat_id;

    /**
     * @var Message|null Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     */
    public $pinned_message;

    /**
     * @var Invoice|null Message is an invoice for a payment, information about the invoice
     */
    public $invoice;

    /**
     * @var SuccessfulPayment|null
     */
    public $successful_payment;

    /**
     * @var string|null The domain name of the website on which the user has logged in
     */
    public $connected_website;

    /**
     * @var PassportData|null Telegram Passport data
     */
    public $passport_data;

    /**
     * @var InlineKeyboardMarkup|null Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons
     */
    public $reply_markup;

    /**
     * Message constructor.
     * @param array $data
     * @throws Error
     */
    public function __construct(array $data)
    {
        $this->id = $data['message_id'];

        if (isset($data['from'])) {
            $this->from = $data['from'] instanceof User ? $data['from'] : new User($data['from']);
        }

        $this->date = $data['date'];
        $this->chat = $data['chat'] instanceof Chat ? $data['chat'] : new Chat($data['chat']);

        if (isset($data['forward_from'])) {
            $this->forward_from = $data['forward_from'] instanceof User ? $data['forward_from'] : new User($data['forward_from']);
        }

        if (isset($data['forward_from_chat'])) {
            $this->forward_from_chat = $data['forward_from_chat'] instanceof Chat ? $data['forward_from_chat'] : new Chat($data['forward_from_chat']);
        }

        $this->forward_from_message_id = $data['forward_from_message_id'] ?? null;
        $this->forward_signature = $data['forward_signature'] ?? null;
        $this->forward_sender_name = $data['forward_sender_name'] ?? null;
        $this->forward_date = $data['forward_date'] ?? null;

        if (isset($data['reply_to_message'])) {
            $this->reply_to_message = $data['reply_to_message'] instanceof self ? $data['reply_to_message'] : new self($data['reply_to_message']);
        }

        $this->edit_date = $data['edit_date'] ?? null;
        $this->media_group_id = $data['media_group_id'] ?? null;
        $this->author_signature = $data['author_signature'] ?? null;
        $this->text = $data['text'] ?? null;

        if (isset($data['entities'])) {
            $this->entities = [];
            foreach ($data['entities'] as $entity) {
                $this->entities[] = $entity instanceof MessageEntity ? $entity : new MessageEntity($entity);
            }
        }

        if (isset($data['caption_entities'])) {
            $this->caption_entities = [];
            foreach ($data['caption_entities'] as $caption_entity) {
                $this->caption_entities[] = $caption_entity instanceof MessageEntity ? $caption_entity : new MessageEntity($caption_entity);
            }
        }

        if (isset($data['audio'])) {
            $this->audio = $data['audio'] instanceof Audio ? $data['audio'] : new Audio($data['audio']);
        }

        if (isset($data['document'])) {
            $this->document = $data['document'] instanceof Document ? $data['document'] : new Document($data['document']);
        }

        if (isset($data['animation'])) {
            $this->animation = $data['animation'] instanceof Animation ? $data['animation'] : new Animation($data['animation']);
        }

        if (isset($data['game'])) {
            $this->game = $data['game'] instanceof Game ? $data['game'] : new Game($data['game']);
        }

        if (isset($data['photo'])) {
            $this->photo = [];
            foreach ($data['photo'] as $photo_size) {
                $this->photo[] = $photo_size instanceof PhotoSize ? $photo_size : new PhotoSize($photo_size);
            }
        }

        if (isset($data['sticker'])) {
            $this->sticker = $data['sticker'] instanceof Sticker ? $data['sticker'] : new Sticker($data['sticker']);
        }

        if (isset($data['video'])) {
            $this->video = $data['video'] instanceof Video ? $data['video'] : new Video($data['video']);
        }

        if (isset($data['voice'])) {
            $this->voice = $data['voice'] instanceof Voice ? $data['voice'] : new Voice($data['voice']);
        }

        if (isset($data['video_note'])) {
            $this->video_note = $data['video_note'] instanceof VideoNote ? $data['video_note'] : new VideoNote($data['video_note']);
        }

        $this->caption = $data['caption'] ?? null;

        if (isset($data['location'])) {
            $this->location = $data['location'] instanceof Location ? $data['location'] : new Location($data['location']);
        }

        if (isset($data['venue'])) {
            $this->venue = $data['venue'] instanceof Venue ? $data['venue'] : new Venue($data['venue']);
        }

        if (isset($data['poll'])) {
            $this->poll = $data['poll'] instanceof Poll ? $data['poll'] : new Poll($data['poll']);
        }

        if (isset($data['new_chat_members'])) {
            $this->new_chat_members = [];
            foreach ($data['new_chat_members'] as $new_chat_member) {
                $this->new_chat_members[] = $new_chat_member instanceof User ? $new_chat_member : new User($new_chat_member);
            }
        }

        if (isset($data['left_chat_member'])) {
            $this->left_chat_member = $data['left_chat_member'] instanceof User ? $data['left_chat_member'] : new User($data['left_chat_member']);
        }

        $this->new_chat_title = $data['new_chat_title'] ?? null;

        if (isset($data['new_chat_photo'])) {
            $this->new_chat_photo = [];
            foreach ($data['new_chat_photo'] as $new_chat_photo_size) {
                $this->new_chat_photo[] = $new_chat_photo_size instanceof PhotoSize ? $new_chat_photo_size : new PhotoSize($new_chat_photo_size);
            }
        }

        $this->delete_chat_photo = $data['delete_chat_photo'] ?? null;
        $this->group_chat_created = $data['group_chat_created'] ?? null;
        $this->supergroup_chat_created = $data['supergroup_chat_created'] ?? null;
        $this->channel_chat_created = $data['channel_chat_created'] ?? null;
        $this->migrate_to_chat_id = $data['migrate_to_chat_id'] ?? null;
        $this->migrate_from_chat_id = $data['migrate_from_chat_id'] ?? null;

        if (isset($data['pinned_message'])) {
            $this->pinned_message = $data['pinned_message'] instanceof self ? $data['pinned_message'] : new self($data['pinned_message']);
        }

        if (isset($data['invoice'])) {
            $this->invoice = $data['invoice'] instanceof Invoice ? $data['invoice'] : new Invoice($data['invoice']);
        }

        if (isset($data['successful_payment'])) {
            $this->successful_payment = $data['successful_payment'] instanceof SuccessfulPayment ? $data['successful_payment'] : new SuccessfulPayment($data['successful_payment']);
        }

        $this->connected_website = $data['connected_website'] ?? null;

        if (isset($data['passport_data'])) {
            $this->passport_data = $data['passport_data'] instanceof PassportData ? $data['passport_data'] : new PassportData($data['passport_data']);
        }

        if (isset($data['reply_markup'])) {
            $this->reply_markup = $data['reply_markup'] instanceof InlineKeyboardMarkup ? $data['reply_markup'] : new InlineKeyboardMarkup($data['reply_markup']);
        }
    }

    /**
     * @return array
     */
    public function getRequestArray(): array
    {
        return [
            'message_id' => $this->id,
            'from' => $this->from,
            'date' => $this->date,
            'chat' => $this->chat,
            'forward_from' => $this->forward_from,
            'forward_from_chat' => $this->forward_from_chat,
            'forward_from_message_id' => $this->forward_from_message_id,
            'forward_signature' => $this->forward_signature,
            'forward_sender_name' => $this->forward_sender_name,
            'forward_date' => $this->forward_date,
            'reply_to_message' => $this->reply_to_message,
            'edit_date' => $this->edit_date,
            'media_group_id' => $this->media_group_id,
            'author_signature' => $this->author_signature,
            'text' => $this->text,
            'entities' => $this->entities,
            'caption_entities' => $this->caption_entities,
            'audio' => $this->audio,
            'document' => $this->document,
            'animation' => $this->animation,
            'game' => $this->game,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'video' => $this->video,
            'voice' => $this->voice,
            'video_note' => $this->video_note,
            'contact' => $this->contact,
            'caption' => $this->caption,
            'location' => $this->location,
            'venue' => $this->venue,
            'poll' => $this->poll,
            'new_chat_members' => $this->new_chat_members,
            'left_chat_member' => $this->left_chat_member,
            'new_chat_title' => $this->new_chat_title,
            'new_chat_photo' => $this->new_chat_photo,
            'delete_chat_photo' => $this->delete_chat_photo,
            'group_chat_created' => $this->group_chat_created,
            'supergroup_chat_created' => $this->supergroup_chat_created,
            'channel_chat_created' => $this->channel_chat_created,
            'migrate_to_chat_id' => $this->migrate_to_chat_id,
            'migrate_from_chat_id' => $this->migrate_from_chat_id,
            'pinned_message' => $this->pinned_message,
            'invoice' => $this->invoice,
            'successful_payment' => $this->successful_payment,
            'connected_website' => $this->connected_website,
            'passport_data' => $this->passport_data,
            'reply_markup' => $this->reply_markup,
        ];
    }

    /**
     * @param int $id
     * @param Chat $chat
     * @param int $date
     * @return Message
     * @throws Error
     */
    public static function make(int $id, Chat $chat, int $date): self
    {
        return new self([
            'message_id' => $id,
            'chat' => $chat,
            'date' => $date,
        ]);
    }
}