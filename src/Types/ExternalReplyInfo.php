<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types;

use Kuvardin\TelegramBotsApi\Type;

/**
 * This object contains information about a message that is being replied to, which may come from another chat or forum
 * topic.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class ExternalReplyInfo extends Type
{
    /**
     * @param MessageOrigin $origin Origin of the message replied to by the given message
     * @param Chat|null $chat Chat the original message belongs to. Available only if the chat is a supergroup
     *     or a channel.
     * @param int|null $message_id Unique message identifier inside the original chat. Available only if the original
     *     chat is a supergroup or a channel.
     * @param LinkPreviewOptions|null $link_preview_options Options used for link preview generation for the original
     *     message, if it is a text message
     * @param Animation|null $animation Message is an animation, information about the animation
     * @param Audio|null $audio Message is an audio file, information about the file
     * @param Document|null $document Message is a general file, information about the file
     * @param PaidMediaInfo|null $paid_media Message contains paid media; information about the paid media
     * @param PhotoSize[]|null $photo Message is a photo, available sizes of the photo
     * @param Sticker|null $sticker Message is a sticker, information about the sticker
     * @param Story|null $story Message is a forwarded story
     * @param Video|null $video Message is a video, information about the video
     * @param VideoNote|null $video_note Message is a video note, information about the video message
     * @param Voice|null $voice Message is a voice message, information about the file
     * @param bool|null $has_media_spoiler True, if the message media is covered by a spoiler animation
     * @param Contact|null $contact Message is a shared contact, information about the contact
     * @param Dice|null $dice Message is a dice with random value
     * @param Game|null $game Message is a game, information about the game.
     * @param Giveaway|null $giveaway Message is a scheduled giveaway, information about the giveaway
     * @param GiveawayWinners|null $giveaway_winners A giveaway with public winners was completed
     * @param Invoice|null $invoice Message is an invoice for a payment, information about the invoice.
     * @param Location|null $location Message is a shared location, information about the location
     * @param Poll|null $poll Message is a native poll, information about the poll
     * @param Venue|null $venue Message is a venue, information about the venue
     */
    public function __construct(
        public MessageOrigin $origin,
        public ?Chat $chat = null,
        public ?int $message_id = null,
        public ?LinkPreviewOptions $link_preview_options = null,
        public ?Animation $animation = null,
        public ?Audio $audio = null,
        public ?Document $document = null,
        public ?PaidMediaInfo $paid_media = null,
        public ?array $photo = null,
        public ?Sticker $sticker = null,
        public ?Story $story = null,
        public ?Video $video = null,
        public ?VideoNote $video_note = null,
        public ?Voice $voice = null,
        public ?bool $has_media_spoiler = null,
        public ?Contact $contact = null,
        public ?Dice $dice = null,
        public ?Game $game = null,
        public ?Giveaway $giveaway = null,
        public ?GiveawayWinners $giveaway_winners = null,
        public ?Invoice $invoice = null,
        public ?Location $location = null,
        public ?Poll $poll = null,
        public ?Venue $venue = null,
    )
    {

    }

    public static function makeByArray(array $data): self
    {
        return new self(
            origin: MessageOrigin::makeByArray($data['origin']),
            chat: isset($data['chat'])
                ? Chat::makeByArray($data['chat'])
                : null,
            message_id: $data['message_id'] ?? null,
            link_preview_options: isset($data['link_preview_options'])
                ? LinkPreviewOptions::makeByArray($data['link_preview_options'])
                : null,
            animation: isset($data['animation'])
                ? Animation::makeByArray($data['animation'])
                : null,
            audio: isset($data['audio'])
                ? Audio::makeByArray($data['audio'])
                : null,
            document: isset($data['document'])
                ? Document::makeByArray($data['document'])
                : null,
            paid_media: isset($data['paid_media'])
                ? PaidMediaInfo::makeByArray($data['paid_media'])
                : null,
            photo: isset($data['photo'])
                ? array_map(
                    static fn(array $item_data) => PhotoSize::makeByArray($item_data),
                    $data['photo']
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
            giveaway: isset($data['giveaway'])
                ? Giveaway::makeByArray($data['giveaway'])
                : null,
            giveaway_winners: isset($data['giveaway_winners'])
                ? GiveawayWinners::makeByArray($data['giveaway_winners'])
                : null,
            invoice: isset($data['invoice'])
                ? Invoice::makeByArray($data['invoice'])
                : null,
            location: isset($data['location'])
                ? Location::makeByArray($data['location'])
                : null,
            poll: isset($data['poll'])
                ? Poll::makeByArray($data['poll'])
                : null,
            venue: isset($data['venue'])
                ? Venue::makeByArray($data['venue'])
                : null,
        );
    }

    public function getRequestData(): array
    {
        return [
            'origin' => $this->origin,
            'chat' => $this->chat,
            'message_id' => $this->message_id,
            'link_preview_options' => $this->link_preview_options,
            'animation' => $this->animation,
            'audio' => $this->audio,
            'document' => $this->document,
            'paid_media' => $this->paid_media,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'story' => $this->story,
            'video' => $this->video,
            'video_note' => $this->video_note,
            'voice' => $this->voice,
            'has_media_spoiler' => $this->has_media_spoiler,
            'contact' => $this->contact,
            'dice' => $this->dice,
            'game' => $this->game,
            'giveaway' => $this->giveaway,
            'giveaway_winners' => $this->giveaway_winners,
            'invoice' => $this->invoice,
            'location' => $this->location,
            'poll' => $this->poll,
            'venue' => $this->venue,
        ];
    }
}
