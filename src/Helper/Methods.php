<?php

namespace EasyTel\Helper;

use EasyTel\Handler\Request;
use EasyTel\Telegram;
use GuzzleHttp\Client;
use JSON\json;
use EasyTel\Methods\GetUpdates;
use EasyTel\Methods\SetWebhook;
use EasyTel\Methods\DeleteWebhook;
use EasyTel\Methods\GetWebhookInfo;
use EasyTel\Methods\GetMe;
use EasyTel\Methods\LogOut;
use EasyTel\Methods\Close;
use EasyTel\Methods\SendMessage;
use EasyTel\Methods\ForwardMessage;
use EasyTel\Methods\ForwardMessages;
use EasyTel\Methods\CopyMessage;
use EasyTel\Methods\CopyMessages;
use EasyTel\Methods\SendPhoto;
use EasyTel\Methods\SendAudio;
use EasyTel\Methods\SendDocument;
use EasyTel\Methods\SendVideo;
use EasyTel\Methods\SendAnimation;
use EasyTel\Methods\SendVoice;
use EasyTel\Methods\SendVideoNote;
use EasyTel\Methods\SendMediaGroup;
use EasyTel\Methods\SendLocation;
use EasyTel\Methods\SendVenue;
use EasyTel\Methods\SendContact;
use EasyTel\Methods\SendPoll;
use EasyTel\Methods\SendDice;
use EasyTel\Methods\SendChatAction;
use EasyTel\Methods\SetMessageReaction;
use EasyTel\Methods\GetUserProfilePhotos;
use EasyTel\Methods\GetFile;
use EasyTel\Methods\BanChatMember;
use EasyTel\Methods\UnbanChatMember;
use EasyTel\Methods\RestrictChatMember;
use EasyTel\Methods\PromoteChatMember;
use EasyTel\Methods\SetChatAdministratorCustomTitle;
use EasyTel\Methods\BanChatSenderChat;
use EasyTel\Methods\UnbanChatSenderChat;
use EasyTel\Methods\SetChatPermissions;
use EasyTel\Methods\ExportChatInviteLink;
use EasyTel\Methods\CreateChatInviteLink;
use EasyTel\Methods\EditChatInviteLink;
use EasyTel\Methods\RevokeChatInviteLink;
use EasyTel\Methods\ApproveChatJoinRequest;
use EasyTel\Methods\DeclineChatJoinRequest;
use EasyTel\Methods\SetChatPhoto;
use EasyTel\Methods\DeleteChatPhoto;
use EasyTel\Methods\SetChatTitle;
use EasyTel\Methods\SetChatDescription;
use EasyTel\Methods\PinChatMessage;
use EasyTel\Methods\UnpinChatMessage;
use EasyTel\Methods\UnpinAllChatMessages;
use EasyTel\Methods\LeaveChat;
use EasyTel\Methods\GetChat;
use EasyTel\Methods\GetChatAdministrators;
use EasyTel\Methods\GetChatMemberCount;
use EasyTel\Methods\GetChatMember;
use EasyTel\Methods\SetChatStickerSet;
use EasyTel\Methods\DeleteChatStickerSet;
use EasyTel\Methods\GetForumTopicIconStickers;
use EasyTel\Methods\CreateForumTopic;
use EasyTel\Methods\EditForumTopic;
use EasyTel\Methods\CloseForumTopic;
use EasyTel\Methods\ReopenForumTopic;
use EasyTel\Methods\DeleteForumTopic;
use EasyTel\Methods\UnpinAllForumTopicMessages;
use EasyTel\Methods\EditGeneralForumTopic;
use EasyTel\Methods\CloseGeneralForumTopic;
use EasyTel\Methods\ReopenGeneralForumTopic;
use EasyTel\Methods\HideGeneralForumTopic;
use EasyTel\Methods\UnhideGeneralForumTopic;
use EasyTel\Methods\UnpinAllGeneralForumTopicMessages;
use EasyTel\Methods\AnswerCallbackQuery;
use EasyTel\Methods\GetUserChatBoosts;
use EasyTel\Methods\GetBusinessConnection;
use EasyTel\Methods\SetMyCommands;
use EasyTel\Methods\DeleteMyCommands;
use EasyTel\Methods\GetMyCommands;
use EasyTel\Methods\SetMyName;
use EasyTel\Methods\GetMyName;
use EasyTel\Methods\SetMyDescription;
use EasyTel\Methods\GetMyDescription;
use EasyTel\Methods\SetMyShortDescription;
use EasyTel\Methods\GetMyShortDescription;
use EasyTel\Methods\SetChatMenuButton;
use EasyTel\Methods\GetChatMenuButton;
use EasyTel\Methods\SetMyDefaultAdministratorRights;
use EasyTel\Methods\GetMyDefaultAdministratorRights;
use EasyTel\Methods\EditMessageText;
use EasyTel\Methods\EditMessageCaption;
use EasyTel\Methods\EditMessageMedia;
use EasyTel\Methods\EditMessageLiveLocation;
use EasyTel\Methods\StopMessageLiveLocation;
use EasyTel\Methods\EditMessageReplyMarkup;
use EasyTel\Methods\StopPoll;
use EasyTel\Methods\DeleteMessage;
use EasyTel\Methods\DeleteMessages;
use EasyTel\Methods\SendSticker;
use EasyTel\Methods\GetStickerSet;
use EasyTel\Methods\GetCustomEmojiStickers;
use EasyTel\Methods\UploadStickerFile;
use EasyTel\Methods\CreateNewStickerSet;
use EasyTel\Methods\AddStickerToSet;
use EasyTel\Methods\SetStickerPositionInSet;
use EasyTel\Methods\DeleteStickerFromSet;
use EasyTel\Methods\ReplaceStickerInSet;
use EasyTel\Methods\SetStickerEmojiList;
use EasyTel\Methods\SetStickerKeywords;
use EasyTel\Methods\SetStickerMaskPosition;
use EasyTel\Methods\SetStickerSetTitle;
use EasyTel\Methods\SetStickerSetThumbnail;
use EasyTel\Methods\SetCustomEmojiStickerSetThumbnail;
use EasyTel\Methods\DeleteStickerSet;
use EasyTel\Methods\AnswerInlineQuery;
use EasyTel\Methods\AnswerWebAppQuery;
use EasyTel\Methods\SendInvoice;
use EasyTel\Methods\CreateInvoiceLink;
use EasyTel\Methods\AnswerShippingQuery;
use EasyTel\Methods\AnswerPreCheckoutQuery;
use EasyTel\Methods\RefundStarPayment;
use EasyTel\Methods\SetPassportDataErrors;
use EasyTel\Methods\SendGame;
use EasyTel\Methods\SetGameScore;
use EasyTel\Methods\GetGameHighScores;

class Methods
{
    private Request $request;
    public function __construct(
        Client $guzzle, string $method = 'POST', $output = Telegram::OUTPUT_OBJECT
    )
    {
        $this->request = new Request($guzzle,$method,$output);
    }

    
    /**
     * Use this method to receive incoming updates using long polling (<a href="https://en.wikipedia.org/wiki/Push_technology#Long_polling">wiki</a>). Returns an Array of <a href="https://core.telegram.org/bots/api#update">Update</a> objects.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getupdates
     */
    public function getUpdates(): GetUpdates
    {
        return new GetUpdates($this->request);
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized <a href="https://core.telegram.org/bots/api#update">Update</a>. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns <em>True</em> on success.
     *
     * @param string $url
     * @return mixed
     * @link https://core.telegram.org/bots/api#setwebhook
     */
    public function setWebhook(string $url): SetWebhook
    {
        return new SetWebhook($this->request, $url);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to <a href="https://core.telegram.org/bots/api#getupdates">getUpdates</a>. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#deletewebhook
     */
    public function deleteWebhook(): DeleteWebhook
    {
        return new DeleteWebhook($this->request);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a <a href="https://core.telegram.org/bots/api#webhookinfo">WebhookInfo</a> object. If the bot is using <a href="https://core.telegram.org/bots/api#getupdates">getUpdates</a>, will return an object with the <em>url</em> field empty.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     */
    public function getWebhookInfo(): GetWebhookInfo
    {
        return new GetWebhookInfo($this->request);
    }

    /**
     * A simple method for testing your bot&#39;s authentication token. Requires no parameters. Returns basic information about the bot in form of a <a href="https://core.telegram.org/bots/api#user">User</a> object.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getme
     */
    public function getMe(): GetMe
    {
        return new GetMe($this->request);
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You <strong>must</strong> log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns <em>True</em> on success. Requires no parameters.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#logout
     */
    public function logOut(): LogOut
    {
        return new LogOut($this->request);
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn&#39;t launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns <em>True</em> on success. Requires no parameters.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#close
     */
    public function close(): Close
    {
        return new Close($this->request);
    }

    /**
     * Use this method to send text messages. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param string $text
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendmessage
     */
    public function sendMessage(int|string $chat_id, string $text): SendMessage
    {
        return new SendMessage($this->request, $chat_id, $text);
    }

    /**
     * Use this method to forward messages of any kind. Service messages and messages with protected content can&#39;t be forwarded. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#forwardmessage
     */
    public function forwardMessage(int|string $chat_id, int|string $from_chat_id, int $message_id): ForwardMessage
    {
        return new ForwardMessage($this->request, $chat_id, $from_chat_id, $message_id);
    }

    /**
     * Use this method to forward multiple messages of any kind. If some of the specified messages can&#39;t be found or forwarded, they are skipped. Service messages and messages with protected content can&#39;t be forwarded. Album grouping is kept for forwarded messages. On success, an array of <a href="https://core.telegram.org/bots/api#messageid">MessageId</a> of the sent messages is returned.
     *
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param string  $message_ids
     * @return mixed
     * @link https://core.telegram.org/bots/api#forwardmessages
     */
    public function forwardMessages(int|string $chat_id, int|string $from_chat_id, string  $message_ids): ForwardMessages
    {
        return new ForwardMessages($this->request, $chat_id, $from_chat_id, $message_ids);
    }

    /**
     * Use this method to copy messages of any kind. Service messages, giveaway messages, giveaway winners messages, and invoice messages can&#39;t be copied. A quiz <a href="https://core.telegram.org/bots/api#poll">poll</a> can be copied only if the value of the field <em>correct_option_id</em> is known to the bot. The method is analogous to the method <a href="https://core.telegram.org/bots/api#forwardmessage">forwardMessage</a>, but the copied message doesn&#39;t have a link to the original message. Returns the <a href="https://core.telegram.org/bots/api#messageid">MessageId</a> of the sent message on success.
     *
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#copymessage
     */
    public function copyMessage(int|string $chat_id, int|string $from_chat_id, int $message_id): CopyMessage
    {
        return new CopyMessage($this->request, $chat_id, $from_chat_id, $message_id);
    }

    /**
     * Use this method to copy messages of any kind. If some of the specified messages can&#39;t be found or copied, they are skipped. Service messages, giveaway messages, giveaway winners messages, and invoice messages can&#39;t be copied. A quiz <a href="https://core.telegram.org/bots/api#poll">poll</a> can be copied only if the value of the field <em>correct_option_id</em> is known to the bot. The method is analogous to the method <a href="https://core.telegram.org/bots/api#forwardmessages">forwardMessages</a>, but the copied messages don&#39;t have a link to the original message. Album grouping is kept for copied messages. On success, an array of <a href="https://core.telegram.org/bots/api#messageid">MessageId</a> of the sent messages is returned.
     *
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param string  $message_ids
     * @return mixed
     * @link https://core.telegram.org/bots/api#copymessages
     */
    public function copyMessages(int|string $chat_id, int|string $from_chat_id, string  $message_ids): CopyMessages
    {
        return new CopyMessages($this->request, $chat_id, $from_chat_id, $message_ids);
    }

    /**
     * Use this method to send photos. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param mixed $photo
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendphoto
     */
    public function sendPhoto(int|string $chat_id, mixed $photo): SendPhoto
    {
        return new SendPhoto($this->request, $chat_id, $photo);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param mixed $audio
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendaudio
     */
    public function sendAudio(int|string $chat_id, mixed $audio): SendAudio
    {
        return new SendAudio($this->request, $chat_id, $audio);
    }

    /**
     * Use this method to send general files. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param mixed $document
     * @return mixed
     * @link https://core.telegram.org/bots/api#senddocument
     */
    public function sendDocument(int|string $chat_id, mixed $document): SendDocument
    {
        return new SendDocument($this->request, $chat_id, $document);
    }

    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as <a href="https://core.telegram.org/bots/api#document">Document</a>). On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param mixed $video
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvideo
     */
    public function sendVideo(int|string $chat_id, mixed $video): SendVideo
    {
        return new SendVideo($this->request, $chat_id, $video);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param mixed $animation
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendanimation
     */
    public function sendAnimation(int|string $chat_id, mixed $animation): SendAnimation
    {
        return new SendAnimation($this->request, $chat_id, $animation);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS, or in .MP3 format, or in .M4A format (other formats may be sent as <a href="https://core.telegram.org/bots/api#audio">Audio</a> or <a href="https://core.telegram.org/bots/api#document">Document</a>). On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param mixed $voice
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvoice
     */
    public function sendVoice(int|string $chat_id, mixed $voice): SendVoice
    {
        return new SendVoice($this->request, $chat_id, $voice);
    }

    /**
     * As of <a href="https://telegram.org/blog/video-messages-and-telescope">v.4.0</a>, Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param mixed $video_note
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvideonote
     */
    public function sendVideoNote(int|string $chat_id, mixed $video_note): SendVideoNote
    {
        return new SendVideoNote($this->request, $chat_id, $video_note);
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type. On success, an array of <a href="https://core.telegram.org/bots/api#message">Messages</a> that were sent is returned.
     *
     * @param int|string $chat_id
     * @param string  $media
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendmediagroup
     */
    public function sendMediaGroup(int|string $chat_id, string  $media): SendMediaGroup
    {
        return new SendMediaGroup($this->request, $chat_id, $media);
    }

    /**
     * Use this method to send point on the map. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param Float $latitude
     * @param Float $longitude
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendlocation
     */
    public function sendLocation(int|string $chat_id, Float $latitude, Float $longitude): SendLocation
    {
        return new SendLocation($this->request, $chat_id, $latitude, $longitude);
    }

    /**
     * Use this method to send information about a venue. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param Float $latitude
     * @param Float $longitude
     * @param string $title
     * @param string $address
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvenue
     */
    public function sendVenue(int|string $chat_id, Float $latitude, Float $longitude, string $title, string $address): SendVenue
    {
        return new SendVenue($this->request, $chat_id, $latitude, $longitude, $title, $address);
    }

    /**
     * Use this method to send phone contacts. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param string $phone_number
     * @param string $first_name
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendcontact
     */
    public function sendContact(int|string $chat_id, string $phone_number, string $first_name): SendContact
    {
        return new SendContact($this->request, $chat_id, $phone_number, $first_name);
    }

    /**
     * Use this method to send a native poll. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param string $question
     * @param string  $options
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendpoll
     */
    public function sendPoll(int|string $chat_id, string $question, string  $options): SendPoll
    {
        return new SendPoll($this->request, $chat_id, $question, $options);
    }

    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#senddice
     */
    public function sendDice(int|string $chat_id): SendDice
    {
        return new SendDice($this->request, $chat_id);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot&#39;s side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string $action
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendchataction
     */
    public function sendChatAction(int|string $chat_id, string $action): SendChatAction
    {
        return new SendChatAction($this->request, $chat_id, $action);
    }

    /**
     * Use this method to change the chosen reactions on a message. Service messages can&#39;t be reacted to. Automatically forwarded messages from a channel to its discussion group have the same available reactions as messages in the channel. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#setmessagereaction
     */
    public function setMessageReaction(int|string $chat_id, int $message_id): SetMessageReaction
    {
        return new SetMessageReaction($this->request, $chat_id, $message_id);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a <a href="https://core.telegram.org/bots/api#userprofilephotos">UserProfilePhotos</a> object.
     *
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     */
    public function getUserProfilePhotos(int $user_id): GetUserProfilePhotos
    {
        return new GetUserProfilePhotos($this->request, $user_id);
    }

    /**
     * Use this method to get basic information about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a <a href="https://core.telegram.org/bots/api#file">File</a> object is returned. The file can then be downloaded via the link <code>https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;</code>, where <code>&lt;file_path&gt;</code> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling <a href="https://core.telegram.org/bots/api#getfile">getFile</a> again.
     *
     * @param string $file_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getfile
     */
    public function getFile(string $file_id): GetFile
    {
        return new GetFile($this->request, $file_id);
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless <a href="https://core.telegram.org/bots/api#unbanchatmember">unbanned</a> first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#banchatmember
     */
    public function banChatMember(int|string $chat_id, int $user_id): BanChatMember
    {
        return new BanChatMember($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will <strong>not</strong> return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be <strong>removed</strong> from the chat. If you don&#39;t want this, use the parameter <em>only_if_banned</em>. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unbanchatmember
     */
    public function unbanChatMember(int|string $chat_id, int $user_id): UnbanChatMember
    {
        return new UnbanChatMember($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass <em>True</em> for all permissions to lift restrictions from a user. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param string $permissions
     * @return mixed
     * @link https://core.telegram.org/bots/api#restrictchatmember
     */
    public function restrictChatMember(int|string $chat_id, int $user_id, string $permissions): RestrictChatMember
    {
        return new RestrictChatMember($this->request, $chat_id, $user_id, $permissions);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass <em>False</em> for all boolean parameters to demote a user. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#promotechatmember
     */
    public function promoteChatMember(int|string $chat_id, int $user_id): PromoteChatMember
    {
        return new PromoteChatMember($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param string $custom_title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     */
    public function setChatAdministratorCustomTitle(int|string $chat_id, int $user_id, string $custom_title): SetChatAdministratorCustomTitle
    {
        return new SetChatAdministratorCustomTitle($this->request, $chat_id, $user_id, $custom_title);
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is <a href="https://core.telegram.org/bots/api#unbanchatsenderchat">unbanned</a>, the owner of the banned chat won&#39;t be able to send messages on behalf of <strong>any of their channels</strong>. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#banchatsenderchat
     */
    public function banChatSenderChat(int|string $chat_id, int $sender_chat_id): BanChatSenderChat
    {
        return new BanChatSenderChat($this->request, $chat_id, $sender_chat_id);
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unbanchatsenderchat
     */
    public function unbanChatSenderChat(int|string $chat_id, int $sender_chat_id): UnbanChatSenderChat
    {
        return new UnbanChatSenderChat($this->request, $chat_id, $sender_chat_id);
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the <em>can_restrict_members</em> administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string $permissions
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatpermissions
     */
    public function setChatPermissions(int|string $chat_id, string $permissions): SetChatPermissions
    {
        return new SetChatPermissions($this->request, $chat_id, $permissions);
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the new invite link as <em>String</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     */
    public function exportChatInviteLink(int|string $chat_id): ExportChatInviteLink
    {
        return new ExportChatInviteLink($this->request, $chat_id);
    }

    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method <a href="https://core.telegram.org/bots/api#revokechatinvitelink">revokeChatInviteLink</a>. Returns the new invite link as <a href="https://core.telegram.org/bots/api#chatinvitelink">ChatInviteLink</a> object.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#createchatinvitelink
     */
    public function createChatInviteLink(int|string $chat_id): CreateChatInviteLink
    {
        return new CreateChatInviteLink($this->request, $chat_id);
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a <a href="https://core.telegram.org/bots/api#chatinvitelink">ChatInviteLink</a> object.
     *
     * @param int|string $chat_id
     * @param string $invite_link
     * @return mixed
     * @link https://core.telegram.org/bots/api#editchatinvitelink
     */
    public function editChatInviteLink(int|string $chat_id, string $invite_link): EditChatInviteLink
    {
        return new EditChatInviteLink($this->request, $chat_id, $invite_link);
    }

    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as <a href="https://core.telegram.org/bots/api#chatinvitelink">ChatInviteLink</a> object.
     *
     * @param int|string $chat_id
     * @param string $invite_link
     * @return mixed
     * @link https://core.telegram.org/bots/api#revokechatinvitelink
     */
    public function revokeChatInviteLink(int|string $chat_id, string $invite_link): RevokeChatInviteLink
    {
        return new RevokeChatInviteLink($this->request, $chat_id, $invite_link);
    }

    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the <em>can_invite_users</em> administrator right. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#approvechatjoinrequest
     */
    public function approveChatJoinRequest(int|string $chat_id, int $user_id): ApproveChatJoinRequest
    {
        return new ApproveChatJoinRequest($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the <em>can_invite_users</em> administrator right. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#declinechatjoinrequest
     */
    public function declineChatJoinRequest(int|string $chat_id, int $user_id): DeclineChatJoinRequest
    {
        return new DeclineChatJoinRequest($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param mixed $photo
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatphoto
     */
    public function setChatPhoto(int|string $chat_id, mixed $photo): SetChatPhoto
    {
        return new SetChatPhoto($this->request, $chat_id, $photo);
    }

    /**
     * Use this method to delete a chat photo. Photos can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletechatphoto
     */
    public function deleteChatPhoto(int|string $chat_id): DeleteChatPhoto
    {
        return new DeleteChatPhoto($this->request, $chat_id);
    }

    /**
     * Use this method to change the title of a chat. Titles can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string $title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchattitle
     */
    public function setChatTitle(int|string $chat_id, string $title): SetChatTitle
    {
        return new SetChatTitle($this->request, $chat_id, $title);
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatdescription
     */
    public function setChatDescription(int|string $chat_id): SetChatDescription
    {
        return new SetChatDescription($this->request, $chat_id);
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#pinchatmessage
     */
    public function pinChatMessage(int|string $chat_id, int $message_id): PinChatMessage
    {
        return new PinChatMessage($this->request, $chat_id, $message_id);
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     */
    public function unpinChatMessage(int|string $chat_id): UnpinChatMessage
    {
        return new UnpinChatMessage($this->request, $chat_id);
    }

    /**
     * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinallchatmessages
     */
    public function unpinAllChatMessages(int|string $chat_id): UnpinAllChatMessages
    {
        return new UnpinAllChatMessages($this->request, $chat_id);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#leavechat
     */
    public function leaveChat(int|string $chat_id): LeaveChat
    {
        return new LeaveChat($this->request, $chat_id);
    }

    /**
     * Use this method to get up-to-date information about the chat. Returns a <a href="https://core.telegram.org/bots/api#chatfullinfo">ChatFullInfo</a> object on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getchat
     */
    public function getChat(int|string $chat_id): GetChat
    {
        return new GetChat($this->request, $chat_id);
    }

    /**
     * Use this method to get a list of administrators in a chat, which aren&#39;t bots. Returns an Array of <a href="https://core.telegram.org/bots/api#chatmember">ChatMember</a> objects.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getchatadministrators
     */
    public function getChatAdministrators(int|string $chat_id): GetChatAdministrators
    {
        return new GetChatAdministrators($this->request, $chat_id);
    }

    /**
     * Use this method to get the number of members in a chat. Returns <em>Int</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getchatmembercount
     */
    public function getChatMemberCount(int|string $chat_id): GetChatMemberCount
    {
        return new GetChatMemberCount($this->request, $chat_id);
    }

    /**
     * Use this method to get information about a member of a chat. The method is only guaranteed to work for other users if the bot is an administrator in the chat. Returns a <a href="https://core.telegram.org/bots/api#chatmember">ChatMember</a> object on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getchatmember
     */
    public function getChatMember(int|string $chat_id, int $user_id): GetChatMember
    {
        return new GetChatMember($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em> optionally returned in <a href="https://core.telegram.org/bots/api#getchat">getChat</a> requests to check if the bot can use this method. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string $sticker_set_name
     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatstickerset
     */
    public function setChatStickerSet(int|string $chat_id, string $sticker_set_name): SetChatStickerSet
    {
        return new SetChatStickerSet($this->request, $chat_id, $sticker_set_name);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em> optionally returned in <a href="https://core.telegram.org/bots/api#getchat">getChat</a> requests to check if the bot can use this method. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     */
    public function deleteChatStickerSet(int|string $chat_id): DeleteChatStickerSet
    {
        return new DeleteChatStickerSet($this->request, $chat_id);
    }

    /**
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user. Requires no parameters. Returns an Array of <a href="https://core.telegram.org/bots/api#sticker">Sticker</a> objects.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getforumtopiciconstickers
     */
    public function getForumTopicIconStickers(): GetForumTopicIconStickers
    {
        return new GetForumTopicIconStickers($this->request);
    }

    /**
     * Use this method to create a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns information about the created topic as a <a href="https://core.telegram.org/bots/api#forumtopic">ForumTopic</a> object.
     *
     * @param int|string $chat_id
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#createforumtopic
     */
    public function createForumTopic(int|string $chat_id, string $name): CreateForumTopic
    {
        return new CreateForumTopic($this->request, $chat_id, $name);
    }

    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#editforumtopic
     */
    public function editForumTopic(int|string $chat_id, int $message_thread_id): EditForumTopic
    {
        return new EditForumTopic($this->request, $chat_id, $message_thread_id);
    }

    /**
     * Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#closeforumtopic
     */
    public function closeForumTopic(int|string $chat_id, int $message_thread_id): CloseForumTopic
    {
        return new CloseForumTopic($this->request, $chat_id, $message_thread_id);
    }

    /**
     * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#reopenforumtopic
     */
    public function reopenForumTopic(int|string $chat_id, int $message_thread_id): ReopenForumTopic
    {
        return new ReopenForumTopic($this->request, $chat_id, $message_thread_id);
    }

    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_delete_messages</em> administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteforumtopic
     */
    public function deleteForumTopic(int|string $chat_id, int $message_thread_id): DeleteForumTopic
    {
        return new DeleteForumTopic($this->request, $chat_id, $message_thread_id);
    }

    /**
     * Use this method to clear the list of pinned messages in a forum topic. The bot must be an administrator in the chat for this to work and must have the <em>can_pin_messages</em> administrator right in the supergroup. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
     */
    public function unpinAllForumTopicMessages(int|string $chat_id, int $message_thread_id): UnpinAllForumTopicMessages
    {
        return new UnpinAllForumTopicMessages($this->request, $chat_id, $message_thread_id);
    }

    /**
     * Use this method to edit the name of the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#editgeneralforumtopic
     */
    public function editGeneralForumTopic(int|string $chat_id, string $name): EditGeneralForumTopic
    {
        return new EditGeneralForumTopic($this->request, $chat_id, $name);
    }

    /**
     * Use this method to close an open &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#closegeneralforumtopic
     */
    public function closeGeneralForumTopic(int|string $chat_id): CloseGeneralForumTopic
    {
        return new CloseGeneralForumTopic($this->request, $chat_id);
    }

    /**
     * Use this method to reopen a closed &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. The topic will be automatically unhidden if it was hidden. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#reopengeneralforumtopic
     */
    public function reopenGeneralForumTopic(int|string $chat_id): ReopenGeneralForumTopic
    {
        return new ReopenGeneralForumTopic($this->request, $chat_id);
    }

    /**
     * Use this method to hide the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. The topic will be automatically closed if it was open. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#hidegeneralforumtopic
     */
    public function hideGeneralForumTopic(int|string $chat_id): HideGeneralForumTopic
    {
        return new HideGeneralForumTopic($this->request, $chat_id);
    }

    /**
     * Use this method to unhide the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unhidegeneralforumtopic
     */
    public function unhideGeneralForumTopic(int|string $chat_id): UnhideGeneralForumTopic
    {
        return new UnhideGeneralForumTopic($this->request, $chat_id);
    }

    /**
     * Use this method to clear the list of pinned messages in a General forum topic. The bot must be an administrator in the chat for this to work and must have the <em>can_pin_messages</em> administrator right in the supergroup. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinallgeneralforumtopicmessages
     */
    public function unpinAllGeneralForumTopicMessages(int|string $chat_id): UnpinAllGeneralForumTopicMessages
    {
        return new UnpinAllGeneralForumTopicMessages($this->request, $chat_id);
    }

    /**
     * Use this method to send answers to callback queries sent from <a href="/bots/features#inline-keyboards">inline keyboards</a>. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, <em>True</em> is returned.
     *
     * @param string $callback_query_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#answercallbackquery
     */
    public function answerCallbackQuery(string $callback_query_id): AnswerCallbackQuery
    {
        return new AnswerCallbackQuery($this->request, $callback_query_id);
    }

    /**
     * Use this method to get the list of boosts added to a chat by a user. Requires administrator rights in the chat. Returns a <a href="https://core.telegram.org/bots/api#userchatboosts">UserChatBoosts</a> object.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getuserchatboosts
     */
    public function getUserChatBoosts(int|string $chat_id, int $user_id): GetUserChatBoosts
    {
        return new GetUserChatBoosts($this->request, $chat_id, $user_id);
    }

    /**
     * Use this method to get information about the connection of the bot with a business account. Returns a <a href="https://core.telegram.org/bots/api#businessconnection">BusinessConnection</a> object on success.
     *
     * @param string $business_connection_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getbusinessconnection
     */
    public function getBusinessConnection(string $business_connection_id): GetBusinessConnection
    {
        return new GetBusinessConnection($this->request, $business_connection_id);
    }

    /**
     * Use this method to change the list of the bot&#39;s commands. See <a href="/bots/features#commands">this manual</a> for more details about bot commands. Returns <em>True</em> on success.
     *
     * @param string  $commands
     * @return mixed
     * @link https://core.telegram.org/bots/api#setmycommands
     */
    public function setMyCommands(string  $commands): SetMyCommands
    {
        return new SetMyCommands($this->request, $commands);
    }

    /**
     * Use this method to delete the list of the bot&#39;s commands for the given scope and user language. After deletion, <a href="https://core.telegram.org/bots/api#determining-list-of-commands">higher level commands</a> will be shown to affected users. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#deletemycommands
     */
    public function deleteMyCommands(): DeleteMyCommands
    {
        return new DeleteMyCommands($this->request);
    }

    /**
     * Use this method to get the current list of the bot&#39;s commands for the given scope and user language. Returns an Array of <a href="https://core.telegram.org/bots/api#botcommand">BotCommand</a> objects. If commands aren&#39;t set, an empty list is returned.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getmycommands
     */
    public function getMyCommands(): GetMyCommands
    {
        return new GetMyCommands($this->request);
    }

    /**
     * Use this method to change the bot&#39;s name. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#setmyname
     */
    public function setMyName(): SetMyName
    {
        return new SetMyName($this->request);
    }

    /**
     * Use this method to get the current bot name for the given user language. Returns <a href="https://core.telegram.org/bots/api#botname">BotName</a> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getmyname
     */
    public function getMyName(): GetMyName
    {
        return new GetMyName($this->request);
    }

    /**
     * Use this method to change the bot&#39;s description, which is shown in the chat with the bot if the chat is empty. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#setmydescription
     */
    public function setMyDescription(): SetMyDescription
    {
        return new SetMyDescription($this->request);
    }

    /**
     * Use this method to get the current bot description for the given user language. Returns <a href="https://core.telegram.org/bots/api#botdescription">BotDescription</a> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getmydescription
     */
    public function getMyDescription(): GetMyDescription
    {
        return new GetMyDescription($this->request);
    }

    /**
     * Use this method to change the bot&#39;s short description, which is shown on the bot&#39;s profile page and is sent together with the link when users share the bot. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#setmyshortdescription
     */
    public function setMyShortDescription(): SetMyShortDescription
    {
        return new SetMyShortDescription($this->request);
    }

    /**
     * Use this method to get the current bot short description for the given user language. Returns <a href="https://core.telegram.org/bots/api#botshortdescription">BotShortDescription</a> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getmyshortdescription
     */
    public function getMyShortDescription(): GetMyShortDescription
    {
        return new GetMyShortDescription($this->request);
    }

    /**
     * Use this method to change the bot&#39;s menu button in a private chat, or the default menu button. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#setchatmenubutton
     */
    public function setChatMenuButton(): SetChatMenuButton
    {
        return new SetChatMenuButton($this->request);
    }

    /**
     * Use this method to get the current value of the bot&#39;s menu button in a private chat, or the default menu button. Returns <a href="https://core.telegram.org/bots/api#menubutton">MenuButton</a> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getchatmenubutton
     */
    public function getChatMenuButton(): GetChatMenuButton
    {
        return new GetChatMenuButton($this->request);
    }

    /**
     * Use this method to change the default administrator rights requested by the bot when it&#39;s added as an administrator to groups or channels. These rights will be suggested to users, but they are free to modify the list before adding the bot. Returns <em>True</em> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#setmydefaultadministratorrights
     */
    public function setMyDefaultAdministratorRights(): SetMyDefaultAdministratorRights
    {
        return new SetMyDefaultAdministratorRights($this->request);
    }

    /**
     * Use this method to get the current default administrator rights of the bot. Returns <a href="https://core.telegram.org/bots/api#chatadministratorrights">ChatAdministratorRights</a> on success.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#getmydefaultadministratorrights
     */
    public function getMyDefaultAdministratorRights(): GetMyDefaultAdministratorRights
    {
        return new GetMyDefaultAdministratorRights($this->request);
    }

    /**
     * Use this method to edit text and <a href="https://core.telegram.org/bots/api#games">game</a> messages. On success, if the edited message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     * @param string $text
     * @return mixed
     * @link https://core.telegram.org/bots/api#editmessagetext
     */
    public function editMessageText(string $text): EditMessageText
    {
        return new EditMessageText($this->request, $text);
    }

    /**
     * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#editmessagecaption
     */
    public function editMessageCaption(): EditMessageCaption
    {
        return new EditMessageCaption($this->request);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can&#39;t be uploaded; use a previously uploaded file via its file_id or specify a URL. On success, if the edited message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     * @param string $media
     * @return mixed
     * @link https://core.telegram.org/bots/api#editmessagemedia
     */
    public function editMessageMedia(string $media): EditMessageMedia
    {
        return new EditMessageMedia($this->request, $media);
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its <em>live_period</em> expires or editing is explicitly disabled by a call to <a href="https://core.telegram.org/bots/api#stopmessagelivelocation">stopMessageLiveLocation</a>. On success, if the edited message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     * @param Float $latitude
     * @param Float $longitude
     * @return mixed
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     */
    public function editMessageLiveLocation(Float $latitude, Float $longitude): EditMessageLiveLocation
    {
        return new EditMessageLiveLocation($this->request, $latitude, $longitude);
    }

    /**
     * Use this method to stop updating a live location message before <em>live_period</em> expires. On success, if the message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     */
    public function stopMessageLiveLocation(): StopMessageLiveLocation
    {
        return new StopMessageLiveLocation($this->request);
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if the edited message is not an inline message, the edited <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned.
     *
     *

     * @return mixed
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     */
    public function editMessageReplyMarkup(): EditMessageReplyMarkup
    {
        return new EditMessageReplyMarkup($this->request);
    }

    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped <a href="https://core.telegram.org/bots/api#poll">Poll</a> is returned.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#stoppoll
     */
    public function stopPoll(int|string $chat_id, int $message_id): StopPoll
    {
        return new StopPoll($this->request, $chat_id, $message_id);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:<br>- A message can only be deleted if it was sent less than 48 hours ago.<br>- Service messages about a supergroup, channel, or forum topic creation can&#39;t be deleted.<br>- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.<br>- Bots can delete outgoing messages in private chats, groups, and supergroups.<br>- Bots can delete incoming messages in private chats.<br>- Bots granted <em>can_post_messages</em> permissions can delete outgoing messages in channels.<br>- If the bot is an administrator of a group, it can delete any message there.<br>- If the bot has <em>can_delete_messages</em> permission in a supergroup or a channel, it can delete any message there.<br>Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletemessage
     */
    public function deleteMessage(int|string $chat_id, int $message_id): DeleteMessage
    {
        return new DeleteMessage($this->request, $chat_id, $message_id);
    }

    /**
     * Use this method to delete multiple messages simultaneously. If some of the specified messages can&#39;t be found, they are skipped. Returns <em>True</em> on success.
     *
     * @param int|string $chat_id
     * @param string  $message_ids
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletemessages
     */
    public function deleteMessages(int|string $chat_id, string  $message_ids): DeleteMessages
    {
        return new DeleteMessages($this->request, $chat_id, $message_ids);
    }

    /**
     * Use this method to send static .WEBP, <a href="https://telegram.org/blog/animated-stickers">animated</a> .TGS, or <a href="https://telegram.org/blog/video-stickers-better-reactions">video</a> .WEBM stickers. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param mixed $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendsticker
     */
    public function sendSticker(int|string $chat_id, mixed $sticker): SendSticker
    {
        return new SendSticker($this->request, $chat_id, $sticker);
    }

    /**
     * Use this method to get a sticker set. On success, a <a href="https://core.telegram.org/bots/api#stickerset">StickerSet</a> object is returned.
     *
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#getstickerset
     */
    public function getStickerSet(string $name): GetStickerSet
    {
        return new GetStickerSet($this->request, $name);
    }

    /**
     * Use this method to get information about custom emoji stickers by their identifiers. Returns an Array of <a href="https://core.telegram.org/bots/api#sticker">Sticker</a> objects.
     *
     * @param string  $custom_emoji_ids
     * @return mixed
     * @link https://core.telegram.org/bots/api#getcustomemojistickers
     */
    public function getCustomEmojiStickers(string  $custom_emoji_ids): GetCustomEmojiStickers
    {
        return new GetCustomEmojiStickers($this->request, $custom_emoji_ids);
    }

    /**
     * Use this method to upload a file with a sticker for later use in the <a href="https://core.telegram.org/bots/api#createnewstickerset">createNewStickerSet</a>, <a href="https://core.telegram.org/bots/api#addstickertoset">addStickerToSet</a>, or <a href="https://core.telegram.org/bots/api#replacestickerinset">replaceStickerInSet</a> methods (the file can be used multiple times). Returns the uploaded <a href="https://core.telegram.org/bots/api#file">File</a> on success.
     *
     * @param int $user_id
     * @param mixed $sticker
     * @param string $sticker_format
     * @return mixed
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     */
    public function uploadStickerFile(int $user_id, mixed $sticker, string $sticker_format): UploadStickerFile
    {
        return new UploadStickerFile($this->request, $user_id, $sticker, $sticker_format);
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $name
     * @param string $title
     * @param string  $stickers
     * @return mixed
     * @link https://core.telegram.org/bots/api#createnewstickerset
     */
    public function createNewStickerSet(int $user_id, string $name, string $title, string  $stickers): CreateNewStickerSet
    {
        return new CreateNewStickerSet($this->request, $user_id, $name, $title, $stickers);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. Emoji sticker sets can have up to 200 stickers. Other sticker sets can have up to 120 stickers. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $name
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#addstickertoset
     */
    public function addStickerToSet(int $user_id, string $name, string $sticker): AddStickerToSet
    {
        return new AddStickerToSet($this->request, $user_id, $name, $sticker);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param int $position
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     */
    public function setStickerPositionInSet(string $sticker, int $position): SetStickerPositionInSet
    {
        return new SetStickerPositionInSet($this->request, $sticker, $position);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     */
    public function deleteStickerFromSet(string $sticker): DeleteStickerFromSet
    {
        return new DeleteStickerFromSet($this->request, $sticker);
    }

    /**
     * Use this method to replace an existing sticker in a sticker set with a new one. The method is equivalent to calling <a href="https://core.telegram.org/bots/api#deletestickerfromset">deleteStickerFromSet</a>, then <a href="https://core.telegram.org/bots/api#addstickertoset">addStickerToSet</a>, then <a href="https://core.telegram.org/bots/api#setstickerpositioninset">setStickerPositionInSet</a>. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $name
     * @param string $old_sticker
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#replacestickerinset
     */
    public function replaceStickerInSet(int $user_id, string $name, string $old_sticker, string $sticker): ReplaceStickerInSet
    {
        return new ReplaceStickerInSet($this->request, $user_id, $name, $old_sticker, $sticker);
    }

    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param string  $emoji_list
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickeremojilist
     */
    public function setStickerEmojiList(string $sticker, string  $emoji_list): SetStickerEmojiList
    {
        return new SetStickerEmojiList($this->request, $sticker, $emoji_list);
    }

    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickerkeywords
     */
    public function setStickerKeywords(string $sticker): SetStickerKeywords
    {
        return new SetStickerKeywords($this->request, $sticker);
    }

    /**
     * Use this method to change the <a href="https://core.telegram.org/bots/api#maskposition">mask position</a> of a mask sticker. The sticker must belong to a sticker set that was created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickermaskposition
     */
    public function setStickerMaskPosition(string $sticker): SetStickerMaskPosition
    {
        return new SetStickerMaskPosition($this->request, $sticker);
    }

    /**
     * Use this method to set the title of a created sticker set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @param string $title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickersettitle
     */
    public function setStickerSetTitle(string $name, string $title): SetStickerSetTitle
    {
        return new SetStickerSetTitle($this->request, $name, $title);
    }

    /**
     * Use this method to set the thumbnail of a regular or mask sticker set. The format of the thumbnail file must match the format of the stickers in the set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @param int $user_id
     * @param string $format
     * @return mixed
     * @link https://core.telegram.org/bots/api#setstickersetthumbnail
     */
    public function setStickerSetThumbnail(string $name, int $user_id, string $format): SetStickerSetThumbnail
    {
        return new SetStickerSetThumbnail($this->request, $name, $user_id, $format);
    }

    /**
     * Use this method to set the thumbnail of a custom emoji sticker set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#setcustomemojistickersetthumbnail
     */
    public function setCustomEmojiStickerSetThumbnail(string $name): SetCustomEmojiStickerSetThumbnail
    {
        return new SetCustomEmojiStickerSetThumbnail($this->request, $name);
    }

    /**
     * Use this method to delete a sticker set that was created by the bot. Returns <em>True</em> on success.
     *
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletestickerset
     */
    public function deleteStickerSet(string $name): DeleteStickerSet
    {
        return new DeleteStickerSet($this->request, $name);
    }

    /**
     * Use this method to send answers to an inline query. On success, <em>True</em> is returned.<br>No more than <strong>50</strong> results per query are allowed.
     *
     * @param string $inline_query_id
     * @param string  $results
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerinlinequery
     */
    public function answerInlineQuery(string $inline_query_id, string  $results): AnswerInlineQuery
    {
        return new AnswerInlineQuery($this->request, $inline_query_id, $results);
    }

    /**
     * Use this method to set the result of an interaction with a <a href="/bots/webapps">Web App</a> and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a <a href="https://core.telegram.org/bots/api#sentwebappmessage">SentWebAppMessage</a> object is returned.
     *
     * @param string $web_app_query_id
     * @param string $result
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerwebappquery
     */
    public function answerWebAppQuery(string $web_app_query_id, string $result): AnswerWebAppQuery
    {
        return new AnswerWebAppQuery($this->request, $web_app_query_id, $result);
    }

    /**
     * Use this method to send invoices. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $currency
     * @param string  $prices
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendinvoice
     */
    public function sendInvoice(int|string $chat_id, string $title, string $description, string $payload, string $currency, string  $prices): SendInvoice
    {
        return new SendInvoice($this->request, $chat_id, $title, $description, $payload, $currency, $prices);
    }

    /**
     * Use this method to create a link for an invoice. Returns the created invoice link as <em>String</em> on success.
     *
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $currency
     * @param string  $prices
     * @return mixed
     * @link https://core.telegram.org/bots/api#createinvoicelink
     */
    public function createInvoiceLink(string $title, string $description, string $payload, string $currency, string  $prices): CreateInvoiceLink
    {
        return new CreateInvoiceLink($this->request, $title, $description, $payload, $currency, $prices);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter <em>is_flexible</em> was specified, the Bot API will send an <a href="https://core.telegram.org/bots/api#update">Update</a> with a <em>shipping_query</em> field to the bot. Use this method to reply to shipping queries. On success, <em>True</em> is returned.
     *
     * @param string $shipping_query_id
     * @param bool $ok
     * @return mixed
     * @link https://core.telegram.org/bots/api#answershippingquery
     */
    public function answerShippingQuery(string $shipping_query_id, bool $ok): AnswerShippingQuery
    {
        return new AnswerShippingQuery($this->request, $shipping_query_id, $ok);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an <a href="https://core.telegram.org/bots/api#update">Update</a> with the field <em>pre_checkout_query</em>. Use this method to respond to such pre-checkout queries. On success, <em>True</em> is returned. <strong>Note:</strong> The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @param string $pre_checkout_query_id
     * @param bool $ok
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     */
    public function answerPreCheckoutQuery(string $pre_checkout_query_id, bool $ok): AnswerPreCheckoutQuery
    {
        return new AnswerPreCheckoutQuery($this->request, $pre_checkout_query_id, $ok);
    }

    /**
     * Refunds a successful payment in <a href="https://t.me/BotNews/90">Telegram Stars</a>. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $telegram_payment_charge_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#refundstarpayment
     */
    public function refundStarPayment(int $user_id, string $telegram_payment_charge_id): RefundStarPayment
    {
        return new RefundStarPayment($this->request, $user_id, $telegram_payment_charge_id);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string  $errors
     * @return mixed
     * @link https://core.telegram.org/bots/api#setpassportdataerrors
     */
    public function setPassportDataErrors(int $user_id, string  $errors): SetPassportDataErrors
    {
        return new SetPassportDataErrors($this->request, $user_id, $errors);
    }

    /**
     * Use this method to send a game. On success, the sent <a href="https://core.telegram.org/bots/api#message">Message</a> is returned.
     *
     * @param int $chat_id
     * @param string $game_short_name
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendgame
     */
    public function sendGame(int $chat_id, string $game_short_name): SendGame
    {
        return new SendGame($this->request, $chat_id, $game_short_name);
    }

    /**
     * Use this method to set the score of the specified user in a game message. On success, if the message is not an inline message, the <a href="https://core.telegram.org/bots/api#message">Message</a> is returned, otherwise <em>True</em> is returned. Returns an error, if the new score is not greater than the user&#39;s current score in the chat and <em>force</em> is <em>False</em>.
     *
     * @param int $user_id
     * @param int $score
     * @return mixed
     * @link https://core.telegram.org/bots/api#setgamescore
     */
    public function setGameScore(int $user_id, int $score): SetGameScore
    {
        return new SetGameScore($this->request, $user_id, $score);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. Returns an Array of <a href="https://core.telegram.org/bots/api#gamehighscore">GameHighScore</a> objects.
     *
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getgamehighscores
     */
    public function getGameHighScores(int $user_id): GetGameHighScores
    {
        return new GetGameHighScores($this->request, $user_id);
    }
}