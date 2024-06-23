<?php

declare(strict_types=1);

namespace Kuvardin\TelegramBotsApi\Types\ReactionType;

use Kuvardin\TelegramBotsApi\Types\ReactionType;
use RuntimeException;

/**
 * The reaction is based on an emoji.
 *
 * @package Kuvardin\TelegramBotsApi
 * @author Maxim Kuvardin <maxim@kuvard.in>
 */
class Emoji extends ReactionType
{
    /**
     * @param string $emoji Reaction emoji. Currently, it can be one of "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F918D.png" width="20" height="20" alt="👍" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F918E.png" width="20" height="20" alt="👎" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/E29DA4.png" width="20" height="20" alt="❤" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F94A5.png" width="20" height="20" alt="🔥" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09FA5B0.png" width="20" height="20" alt="🥰" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F918F.png" width="20" height="20" alt="👏" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F9881.png" width="20" height="20" alt="😁" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09FA494.png" width="20" height="20" alt="🤔" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09FA4AF.png" width="20" height="20" alt="🤯" />", "<img class="emoji"
     *     src="//telegram.org/img/emoji/40/F09F98B1.png" width="20" height="20" alt="😱" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4AC.png" width="20" height="20" alt="🤬" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F98A2.png" width="20" height="20" alt="😢" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8E89.png" width="20" height="20" alt="🎉" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4A9.png" width="20" height="20" alt="🤩" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4AE.png" width="20" height="20" alt="🤮" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F92A9.png" width="20" height="20" alt="💩" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F998F.png" width="20" height="20" alt="🙏" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F918C.png" width="20" height="20" alt="👌" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F958A.png" width="20" height="20" alt="🕊" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4A1.png" width="20" height="20" alt="🤡" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA5B1.png" width="20" height="20" alt="🥱" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA5B4.png" width="20" height="20" alt="🥴" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F988D.png" width="20" height="20" alt="😍" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F90B3.png" width="20" height="20" alt="🐳" />", "<img class="emoji" src="//telegram.org/img/emoji/40/E29DA4E2808DF09F94A5.png" width="20" height="20" alt="❤‍🔥" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8C9A.png" width="20" height="20" alt="🌚" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8CAD.png" width="20" height="20" alt="🌭" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F92AF.png" width="20" height="20" alt="💯" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4A3.png" width="20" height="20" alt="🤣" />", "<img class="emoji" src="//telegram.org/img/emoji/40/E29AA1.png" width="20" height="20" alt="⚡" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8D8C.png" width="20" height="20" alt="🍌" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8F86.png" width="20" height="20" alt="🏆" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9294.png" width="20" height="20" alt="💔" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4A8.png" width="20" height="20" alt="🤨" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9890.png" width="20" height="20" alt="😐" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8D93.png" width="20" height="20" alt="🍓" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8DBE.png" width="20" height="20" alt="🍾" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F928B.png" width="20" height="20" alt="💋" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9695.png" width="20" height="20" alt="🖕" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9888.png" width="20" height="20" alt="😈" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F98B4.png" width="20" height="20" alt="😴" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F98AD.png" width="20" height="20" alt="😭" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA493.png" width="20" height="20" alt="🤓" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F91BB.png" width="20" height="20" alt="👻" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F91A8E2808DF09F92BB.png" width="20" height="20" alt="👨‍💻" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9180.png" width="20" height="20" alt="👀" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8E83.png" width="20" height="20" alt="🎃" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9988.png" width="20" height="20" alt="🙈" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9887.png" width="20" height="20" alt="😇" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F98A8.png" width="20" height="20" alt="😨" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA49D.png" width="20" height="20" alt="🤝" />", "<img class="emoji" src="//telegram.org/img/emoji/40/E29C8D.png" width="20" height="20" alt="✍" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA497.png" width="20" height="20" alt="🤗" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FABA1.png" width="20" height="20" alt="🫡" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8E85.png" width="20" height="20" alt="🎅" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8E84.png" width="20" height="20" alt="🎄" />", "<img class="emoji" src="//telegram.org/img/emoji/40/E29883.png" width="20" height="20" alt="☃" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9285.png" width="20" height="20" alt="💅" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4AA.png" width="20" height="20" alt="🤪" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F97BF.png" width="20" height="20" alt="🗿" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F8692.png" width="20" height="20" alt="🆒" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9298.png" width="20" height="20" alt="💘" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9989.png" width="20" height="20" alt="🙉" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA684.png" width="20" height="20" alt="🦄" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F9898.png" width="20" height="20" alt="😘" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F928A.png" width="20" height="20" alt="💊" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F998A.png" width="20" height="20" alt="🙊" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F988E.png" width="20" height="20" alt="😎" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F91BE.png" width="20" height="20" alt="👾" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4B7E2808DE29982.png" width="20" height="20" alt="🤷‍♂" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4B7.png" width="20" height="20" alt="🤷" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09FA4B7E2808DE29980.png" width="20" height="20" alt="🤷‍♀" />", "<img class="emoji" src="//telegram.org/img/emoji/40/F09F98A1.png" width="20" height="20" alt="😡" />"
     */
    public function __construct(
        public string $emoji,
    )
    {

    }

    public static function getType(): string
    {
        return 'emoji';
    }


    public static function makeByArray(array $data): static
    {
        if ($data['type'] !== self::getType()) {
            throw new RuntimeException("Wrong reaction type: {$data['type']}");
        }

        return new self(
            emoji: $data['emoji'],
        );
    }

    public function getRequestData(): array
    {
        return [
            'type' => self::getType(),
            'emoji' => $this->emoji,
        ];
    }
}