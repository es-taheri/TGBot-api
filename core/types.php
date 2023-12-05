<?php

namespace EasyTel\core;

use EasyTel\types\Animation;
use EasyTel\types\Audio;
use EasyTel\types\BotCommand;
use EasyTel\types\BotCommandScope;
use EasyTel\types\BotCommandScopeAllChatAdministrators;
use EasyTel\types\BotCommandScopeAllGroupChats;
use EasyTel\types\BotCommandScopeAllPrivateChats;
use EasyTel\types\BotCommandScopeChat;
use EasyTel\types\BotCommandScopeChatAdministrators;
use EasyTel\types\BotCommandScopeChatMember;
use EasyTel\types\BotCommandScopeDefault;
use EasyTel\types\BotDescription;
use EasyTel\types\BotName;
use EasyTel\types\BotShortDescription;
use EasyTel\types\CallbackQuery;
use EasyTel\types\Chat;
use EasyTel\types\ChatAdministratorRights;
use EasyTel\types\ChatInviteLink;
use EasyTel\types\ChatJoinRequest;
use EasyTel\types\ChatLocation;
use EasyTel\types\ChatMember;
use EasyTel\types\ChatMemberAdministrator;
use EasyTel\types\ChatMemberBanned;
use EasyTel\types\ChatMemberLeft;
use EasyTel\types\ChatMemberMember;
use EasyTel\types\ChatMemberOwner;
use EasyTel\types\ChatMemberRestricted;
use EasyTel\types\ChatMemberUpdated;
use EasyTel\types\ChatPermissions;
use EasyTel\types\ChatPhoto;
use EasyTel\types\ChatShared;
use EasyTel\types\ChosenInlineResult;
use EasyTel\types\Contact;
use EasyTel\types\Dice;
use EasyTel\types\Document;
use EasyTel\types\EncryptedCredentials;
use EasyTel\types\EncryptedPassportElement;
use EasyTel\types\File;
use EasyTel\types\ForceReply;
use EasyTel\types\ForumTopic;
use EasyTel\types\ForumTopicClosed;
use EasyTel\types\ForumTopicCreated;
use EasyTel\types\ForumTopicEdited;
use EasyTel\types\ForumTopicReopened;
use EasyTel\types\Game;
use EasyTel\types\GameHighScore;
use EasyTel\types\GeneralForumTopicHidden;
use EasyTel\types\GeneralForumTopicUnhidden;
use EasyTel\types\InlineKeyboardButton;
use EasyTel\types\InlineKeyboardMarkup;
use EasyTel\types\InlineQuery;
use EasyTel\types\InlineQueryResult;
use EasyTel\types\InlineQueryResultArticle;
use EasyTel\types\InlineQueryResultAudio;
use EasyTel\types\InlineQueryResultCachedAudio;
use EasyTel\types\InlineQueryResultCachedDocument;
use EasyTel\types\InlineQueryResultCachedGif;
use EasyTel\types\InlineQueryResultCachedMpeg4Gif;
use EasyTel\types\InlineQueryResultCachedPhoto;
use EasyTel\types\InlineQueryResultCachedSticker;
use EasyTel\types\InlineQueryResultCachedVideo;
use EasyTel\types\InlineQueryResultCachedVoice;
use EasyTel\types\InlineQueryResultContact;
use EasyTel\types\InlineQueryResultDocument;
use EasyTel\types\InlineQueryResultGame;
use EasyTel\types\InlineQueryResultGif;
use EasyTel\types\InlineQueryResultLocation;
use EasyTel\types\InlineQueryResultMpeg4Gif;
use EasyTel\types\InlineQueryResultPhoto;
use EasyTel\types\InlineQueryResultsButton;
use EasyTel\types\InlineQueryResultVenue;
use EasyTel\types\InlineQueryResultVideo;
use EasyTel\types\InlineQueryResultVoice;
use EasyTel\types\InputContactMessageContent;
use EasyTel\types\InputInvoiceMessageContent;
use EasyTel\types\InputLocationMessageContent;
use EasyTel\types\InputMedia;
use EasyTel\types\InputMediaAnimation;
use EasyTel\types\InputMediaAudio;
use EasyTel\types\InputMediaDocument;
use EasyTel\types\InputMediaPhoto;
use EasyTel\types\InputMediaVideo;
use EasyTel\types\InputMessageContent;
use EasyTel\types\InputSticker;
use EasyTel\types\InputTextMessageContent;
use EasyTel\types\InputVenueMessageContent;
use EasyTel\types\Invoice;
use EasyTel\types\KeyboardButton;
use EasyTel\types\KeyboardButtonPollType;
use EasyTel\types\KeyboardButtonRequestChat;
use EasyTel\types\KeyboardButtonRequestUser;
use EasyTel\types\LabeledPrice;
use EasyTel\types\Location;
use EasyTel\types\LoginUrl;
use EasyTel\types\MaskPosition;
use EasyTel\types\MenuButton;
use EasyTel\types\MenuButtonCommands;
use EasyTel\types\MenuButtonDefault;
use EasyTel\types\MenuButtonWebApp;
use EasyTel\types\Message;
use EasyTel\types\MessageAutoDeleteTimerChanged;
use EasyTel\types\MessageEntity;
use EasyTel\types\MessageId;
use EasyTel\types\OrderInfo;
use EasyTel\types\PassportData;
use EasyTel\types\PassportElementErrorDataField;
use EasyTel\types\PassportElementErrorFile;
use EasyTel\types\PassportElementErrorFiles;
use EasyTel\types\PassportElementErrorFrontSide;
use EasyTel\types\PassportElementErrorReverseSide;
use EasyTel\types\PassportElementErrorSelfie;
use EasyTel\types\PassportElementErrorTranslationFile;
use EasyTel\types\PassportElementErrorTranslationFiles;
use EasyTel\types\PassportElementErrorUnspecified;
use EasyTel\types\PassportFile;
use EasyTel\types\PhotoSize;
use EasyTel\types\Poll;
use EasyTel\types\PollAnswer;
use EasyTel\types\PollOption;
use EasyTel\types\PreCheckoutQuery;
use EasyTel\types\ProximityAlertTriggered;
use EasyTel\types\ReplyKeyboardMarkup;
use EasyTel\types\ReplyKeyboardRemove;
use EasyTel\types\ResponseParameters;
use EasyTel\types\ShippingAddress;
use EasyTel\types\ShippingOption;
use EasyTel\types\ShippingQuery;
use EasyTel\types\Sticker;
use EasyTel\types\StickerSet;
use EasyTel\types\Story;
use EasyTel\types\SuccessfulPayment;
use EasyTel\types\SwitchInlineQueryChosenChat;
use EasyTel\types\User;
use EasyTel\types\UserProfilePhotos;
use EasyTel\types\UserShared;
use EasyTel\types\Venue;
use EasyTel\types\Video;
use EasyTel\types\VideoChatEnded;
use EasyTel\types\VideoChatParticipantsInvited;
use EasyTel\types\VideoChatScheduled;
use EasyTel\types\VideoChatStarted;
use EasyTel\types\VideoNote;
use EasyTel\types\Voice;
use EasyTel\types\WebAppData;
use EasyTel\types\WebAppInfo;
use EasyTel\types\WebhookInfo;
use EasyTel\types\WriteAccessAllowed;

class types
{
    public int $output;
    private object|string|array $update;

    public function __construct(object|string|array $update)
    {
        switch (true):
            case (is_object($update)):
                $update = json_decode(json_encode($update), true);
            break;
            case (is_string($update)):
                $update = json_decode($update, true);
            break;
        endswitch;
        $this->update = $update;
    }

    public function Animation(): Animation
    {
        return new Animation($this->update);
    }

    public function Audio(): Audio
    {
        return new Audio($this->update);
    }

    public function BotCommand(): BotCommand
    {
        return new BotCommand($this->update);
    }

    public function BotCommandScope(): BotCommandScope
    {
        return new BotCommandScope($this->update);
    }

    public function BotCommandScopeAllChatAdministrators(): BotCommandScopeAllChatAdministrators
    {
        return new BotCommandScopeAllChatAdministrators($this->update);
    }

    public function BotCommandScopeAllGroupChats(): BotCommandScopeAllGroupChats
    {
        return new BotCommandScopeAllGroupChats($this->update);
    }

    public function BotCommandScopeAllPrivateChats(): BotCommandScopeAllPrivateChats
    {
        return new BotCommandScopeAllPrivateChats($this->update);
    }

    public function BotCommandScopeChat(): BotCommandScopeChat
    {
        return new BotCommandScopeChat($this->update);
    }

    public function BotCommandScopeChatAdministrators(): BotCommandScopeChatAdministrators
    {
        return new BotCommandScopeChatAdministrators($this->update);
    }

    public function BotCommandScopeChatMember(): BotCommandScopeChatMember
    {
        return new BotCommandScopeChatMember($this->update);
    }

    public function BotCommandScopeDefault(): BotCommandScopeDefault
    {
        return new BotCommandScopeDefault($this->update);
    }

    public function BotDescription(): BotDescription
    {
        return new BotDescription($this->update);
    }

    public function BotName(): BotName
    {
        return new BotName($this->update);
    }

    public function BotShortDescription(): BotShortDescription
    {
        return new BotShortDescription($this->update);
    }

    public function CallbackQuery(): CallbackQuery
    {
        return new CallbackQuery($this->update);
    }

    public function Chat(): Chat
    {
        return new Chat($this->update);
    }

    public function ChatAdministratorRights(): ChatAdministratorRights
    {
        return new ChatAdministratorRights($this->update);
    }

    public function ChatInviteLink(): ChatInviteLink
    {
        return new ChatInviteLink($this->update);
    }

    public function ChatJoinRequest(): ChatJoinRequest
    {
        return new ChatJoinRequest($this->update);
    }

    public function ChatLocation(): ChatLocation
    {
        return new ChatLocation($this->update);
    }

    public function ChatMember(): ChatMember
    {
        return new ChatMember($this->update);
    }

    public function ChatMemberAdministrator(): ChatMemberAdministrator
    {
        return new ChatMemberAdministrator($this->update);
    }

    public function ChatMemberBanned(): ChatMemberBanned
    {
        return new ChatMemberBanned($this->update);
    }

    public function ChatMemberLeft(): ChatMemberLeft
    {
        return new ChatMemberLeft($this->update);
    }

    public function ChatMemberMember(): ChatMemberMember
    {
        return new ChatMemberMember($this->update);
    }

    public function ChatMemberOwner(): ChatMemberOwner
    {
        return new ChatMemberOwner($this->update);
    }

    public function ChatMemberRestricted(): ChatMemberRestricted
    {
        return new ChatMemberRestricted($this->update);
    }

    public function ChatMemberUpdated(): ChatMemberUpdated
    {
        return new ChatMemberUpdated($this->update);
    }

    public function ChatPermissions(): ChatPermissions
    {
        return new ChatPermissions($this->update);
    }

    public function ChatPhoto(): ChatPhoto
    {
        return new ChatPhoto($this->update);
    }

    public function ChatShared(): ChatShared
    {
        return new ChatShared($this->update);
    }

    public function ChosenInlineResult(): ChosenInlineResult
    {
        return new ChosenInlineResult($this->update);
    }

    public function Contact(): Contact
    {
        return new Contact($this->update);
    }

    public function Dice(): Dice
    {
        return new Dice($this->update);
    }

    public function Document(): Document
    {
        return new Document($this->update);
    }

    public function EncryptedCredentials(): EncryptedCredentials
    {
        return new EncryptedCredentials($this->update);
    }

    public function EncryptedPassportElement(): EncryptedPassportElement
    {
        return new EncryptedPassportElement($this->update);
    }

    public function File(): File
    {
        return new File($this->update);
    }

    public function ForceReply(): ForceReply
    {
        return new ForceReply($this->update);
    }

    public function ForumTopic(): ForumTopic
    {
        return new ForumTopic($this->update);
    }

    public function ForumTopicClosed(): ForumTopicClosed
    {
        return new ForumTopicClosed($this->update);
    }

    public function ForumTopicCreated(): ForumTopicCreated
    {
        return new ForumTopicCreated($this->update);
    }

    public function ForumTopicEdited(): ForumTopicEdited
    {
        return new ForumTopicEdited($this->update);
    }

    public function ForumTopicReopened(): ForumTopicReopened
    {
        return new ForumTopicReopened($this->update);
    }

    public function Game(): Game
    {
        return new Game($this->update);
    }

    public function GameHighScore(): GameHighScore
    {
        return new GameHighScore($this->update);
    }

    public function GeneralForumTopicHidden(): GeneralForumTopicHidden
    {
        return new GeneralForumTopicHidden($this->update);
    }

    public function GeneralForumTopicUnhidden(): GeneralForumTopicUnhidden
    {
        return new GeneralForumTopicUnhidden($this->update);
    }

    public function InlineKeyboardButton(): InlineKeyboardButton
    {
        return new InlineKeyboardButton($this->update);
    }

    public function InlineKeyboardMarkup(): InlineKeyboardMarkup
    {
        return new InlineKeyboardMarkup($this->update);
    }

    public function InlineQuery(): InlineQuery
    {
        return new InlineQuery($this->update);
    }

    public function InlineQueryResult(): InlineQueryResult
    {
        return new InlineQueryResult($this->update);
    }

    public function InlineQueryResultArticle(): InlineQueryResultArticle
    {
        return new InlineQueryResultArticle($this->update);
    }

    public function InlineQueryResultAudio(): InlineQueryResultAudio
    {
        return new InlineQueryResultAudio($this->update);
    }

    public function InlineQueryResultCachedAudio(): InlineQueryResultCachedAudio
    {
        return new InlineQueryResultCachedAudio($this->update);
    }

    public function InlineQueryResultCachedDocument(): InlineQueryResultCachedDocument
    {
        return new InlineQueryResultCachedDocument($this->update);
    }

    public function InlineQueryResultCachedGif(): InlineQueryResultCachedGif
    {
        return new InlineQueryResultCachedGif($this->update);
    }

    public function InlineQueryResultCachedMpeg4Gif(): InlineQueryResultCachedMpeg4Gif
    {
        return new InlineQueryResultCachedMpeg4Gif($this->update);
    }

    public function InlineQueryResultCachedPhoto(): InlineQueryResultCachedPhoto
    {
        return new InlineQueryResultCachedPhoto($this->update);
    }

    public function InlineQueryResultCachedSticker(): InlineQueryResultCachedSticker
    {
        return new InlineQueryResultCachedSticker($this->update);
    }

    public function InlineQueryResultCachedVideo(): InlineQueryResultCachedVideo
    {
        return new InlineQueryResultCachedVideo($this->update);
    }

    public function InlineQueryResultCachedVoice(): InlineQueryResultCachedVoice
    {
        return new InlineQueryResultCachedVoice($this->update);
    }

    public function InlineQueryResultContact(): InlineQueryResultContact
    {
        return new InlineQueryResultContact($this->update);
    }

    public function InlineQueryResultDocument(): InlineQueryResultDocument
    {
        return new InlineQueryResultDocument($this->update);
    }

    public function InlineQueryResultGame(): InlineQueryResultGame
    {
        return new InlineQueryResultGame($this->update);
    }

    public function InlineQueryResultGif(): InlineQueryResultGif
    {
        return new InlineQueryResultGif($this->update);
    }

    public function InlineQueryResultLocation(): InlineQueryResultLocation
    {
        return new InlineQueryResultLocation($this->update);
    }

    public function InlineQueryResultMpeg4Gif(): InlineQueryResultMpeg4Gif
    {
        return new InlineQueryResultMpeg4Gif($this->update);
    }

    public function InlineQueryResultPhoto(): InlineQueryResultPhoto
    {
        return new InlineQueryResultPhoto($this->update);
    }

    public function InlineQueryResultVenue(): InlineQueryResultVenue
    {
        return new InlineQueryResultVenue($this->update);
    }

    public function InlineQueryResultVideo(): InlineQueryResultVideo
    {
        return new InlineQueryResultVideo($this->update);
    }

    public function InlineQueryResultVoice(): InlineQueryResultVoice
    {
        return new InlineQueryResultVoice($this->update);
    }

    public function InlineQueryResultsButton(): InlineQueryResultsButton
    {
        return new InlineQueryResultsButton($this->update);
    }

    public function InputContactMessageContent(): InputContactMessageContent
    {
        return new InputContactMessageContent($this->update);
    }

    public function InputInvoiceMessageContent(): InputInvoiceMessageContent
    {
        return new InputInvoiceMessageContent($this->update);
    }

    public function InputLocationMessageContent(): InputLocationMessageContent
    {
        return new InputLocationMessageContent($this->update);
    }

    public function InputMedia(): InputMedia
    {
        return new InputMedia($this->update);
    }

    public function InputMediaAnimation(): InputMediaAnimation
    {
        return new InputMediaAnimation($this->update);
    }

    public function InputMediaAudio(): InputMediaAudio
    {
        return new InputMediaAudio($this->update);
    }

    public function InputMediaDocument(): InputMediaDocument
    {
        return new InputMediaDocument($this->update);
    }

    public function InputMediaPhoto(): InputMediaPhoto
    {
        return new InputMediaPhoto($this->update);
    }

    public function InputMediaVideo(): InputMediaVideo
    {
        return new InputMediaVideo($this->update);
    }

    public function InputMessageContent(): InputMessageContent
    {
        return new InputMessageContent($this->update);
    }

    public function InputSticker(): InputSticker
    {
        return new InputSticker($this->update);
    }

    public function InputTextMessageContent(): InputTextMessageContent
    {
        return new InputTextMessageContent($this->update);
    }

    public function InputVenueMessageContent(): InputVenueMessageContent
    {
        return new InputVenueMessageContent($this->update);
    }

    public function Invoice(): Invoice
    {
        return new Invoice($this->update);
    }

    public function KeyboardButton(): KeyboardButton
    {
        return new KeyboardButton($this->update);
    }

    public function KeyboardButtonPollType(): KeyboardButtonPollType
    {
        return new KeyboardButtonPollType($this->update);
    }

    public function KeyboardButtonRequestChat(): KeyboardButtonRequestChat
    {
        return new KeyboardButtonRequestChat($this->update);
    }

    public function KeyboardButtonRequestUser(): KeyboardButtonRequestUser
    {
        return new KeyboardButtonRequestUser($this->update);
    }

    public function LabeledPrice(): LabeledPrice
    {
        return new LabeledPrice($this->update);
    }

    public function Location(): Location
    {
        return new Location($this->update);
    }

    public function LoginUrl(): LoginUrl
    {
        return new LoginUrl($this->update);
    }

    public function MaskPosition(): MaskPosition
    {
        return new MaskPosition($this->update);
    }

    public function MenuButton(): MenuButton
    {
        return new MenuButton($this->update);
    }

    public function MenuButtonCommands(): MenuButtonCommands
    {
        return new MenuButtonCommands($this->update);
    }

    public function MenuButtonDefault(): MenuButtonDefault
    {
        return new MenuButtonDefault($this->update);
    }

    public function MenuButtonWebApp(): MenuButtonWebApp
    {
        return new MenuButtonWebApp($this->update);
    }

    public function Message(): Message
    {
        return new Message($this->update);
    }

    public function MessageAutoDeleteTimerChanged(): MessageAutoDeleteTimerChanged
    {
        return new MessageAutoDeleteTimerChanged($this->update);
    }

    public function MessageEntity(): MessageEntity
    {
        return new MessageEntity($this->update);
    }

    public function MessageId(): MessageId
    {
        return new MessageId($this->update);
    }

    public function OrderInfo(): OrderInfo
    {
        return new OrderInfo($this->update);
    }

    public function PassportData(): PassportData
    {
        return new PassportData($this->update);
    }

    public function PassportElementErrorDataField(): PassportElementErrorDataField
    {
        return new PassportElementErrorDataField($this->update);
    }

    public function PassportElementErrorFile(): PassportElementErrorFile
    {
        return new PassportElementErrorFile($this->update);
    }

    public function PassportElementErrorFiles(): PassportElementErrorFiles
    {
        return new PassportElementErrorFiles($this->update);
    }

    public function PassportElementErrorFrontSide(): PassportElementErrorFrontSide
    {
        return new PassportElementErrorFrontSide($this->update);
    }

    public function PassportElementErrorReverseSide(): PassportElementErrorReverseSide
    {
        return new PassportElementErrorReverseSide($this->update);
    }

    public function PassportElementErrorSelfie(): PassportElementErrorSelfie
    {
        return new PassportElementErrorSelfie($this->update);
    }

    public function PassportElementErrorTranslationFile(): PassportElementErrorTranslationFile
    {
        return new PassportElementErrorTranslationFile($this->update);
    }

    public function PassportElementErrorTranslationFiles(): PassportElementErrorTranslationFiles
    {
        return new PassportElementErrorTranslationFiles($this->update);
    }

    public function PassportElementErrorUnspecified(): PassportElementErrorUnspecified
    {
        return new PassportElementErrorUnspecified($this->update);
    }

    public function PassportFile(): PassportFile
    {
        return new PassportFile($this->update);
    }

    public function PhotoSize(): PhotoSize
    {
        return new PhotoSize($this->update);
    }

    public function Poll(): Poll
    {
        return new Poll($this->update);
    }

    public function PollAnswer(): PollAnswer
    {
        return new PollAnswer($this->update);
    }

    public function PollOption(): PollOption
    {
        return new PollOption($this->update);
    }

    public function PreCheckoutQuery(): PreCheckoutQuery
    {
        return new PreCheckoutQuery($this->update);
    }

    public function ProximityAlertTriggered(): ProximityAlertTriggered
    {
        return new ProximityAlertTriggered($this->update);
    }

    public function ReplyKeyboardMarkup(): ReplyKeyboardMarkup
    {
        return new ReplyKeyboardMarkup($this->update);
    }

    public function ReplyKeyboardRemove(): ReplyKeyboardRemove
    {
        return new ReplyKeyboardRemove($this->update);
    }

    public function ResponseParameters(): ResponseParameters
    {
        return new ResponseParameters($this->update);
    }

    public function ShippingAddress(): ShippingAddress
    {
        return new ShippingAddress($this->update);
    }

    public function ShippingOption(): ShippingOption
    {
        return new ShippingOption($this->update);
    }

    public function ShippingQuery(): ShippingQuery
    {
        return new ShippingQuery($this->update);
    }

    public function Sticker(): Sticker
    {
        return new Sticker($this->update);
    }

    public function StickerSet(): StickerSet
    {
        return new StickerSet($this->update);
    }

    public function Story(): Story
    {
        return new Story($this->update);
    }

    public function SuccessfulPayment(): SuccessfulPayment
    {
        return new SuccessfulPayment($this->update);
    }

    public function SwitchInlineQueryChosenChat(): SwitchInlineQueryChosenChat
    {
        return new SwitchInlineQueryChosenChat($this->update);
    }

    public function User(): User
    {
        return new User($this->update);
    }

    public function UserProfilePhotos(): UserProfilePhotos
    {
        return new UserProfilePhotos($this->update);
    }

    public function UserShared(): UserShared
    {
        return new UserShared($this->update);
    }

    public function Venue(): Venue
    {
        return new Venue($this->update);
    }

    public function Video(): Video
    {
        return new Video($this->update);
    }

    public function VideoChatEnded(): VideoChatEnded
    {
        return new VideoChatEnded($this->update);
    }

    public function VideoChatParticipantsInvited(): VideoChatParticipantsInvited
    {
        return new VideoChatParticipantsInvited($this->update);
    }

    public function VideoChatScheduled(): VideoChatScheduled
    {
        return new VideoChatScheduled($this->update);
    }

    public function VideoChatStarted(): VideoChatStarted
    {
        return new VideoChatStarted($this->update);
    }

    public function VideoNote(): VideoNote
    {
        return new VideoNote($this->update);
    }

    public function Voice(): Voice
    {
        return new Voice($this->update);
    }

    public function WebAppData(): WebAppData
    {
        return new WebAppData($this->update);
    }

    public function WebAppInfo(): WebAppInfo
    {
        return new WebAppInfo($this->update);
    }

    public function WebhookInfo(): WebhookInfo
    {
        return new WebhookInfo($this->update);
    }

    public function WriteAccessAllowed(): WriteAccessAllowed
    {
        return new WriteAccessAllowed($this->update);
    }

}