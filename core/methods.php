<?php

namespace EasyTel\core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Nette\Utils\Arrays;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use ReflectionFunction;
use stdClass;

class methods
{
    private string $method;
    public int $output;
    private string $bot_token;
    private Client $guzzle;
    public const OUTPUT_JSON = 111;
    public const OUTPUT_OBJECT = 112;
    public const OUTPUT_ARRAY = 113;

    public function __construct(string $bot_token, string $botapi_url = 'https://api.telegram.org', string $method = 'POST', int $timeout = 5, $output = self::OUTPUT_OBJECT)
    {
        $this->guzzle = new Client([
            'base_uri' => $botapi_url,
            'timeout' => $timeout
        ]);
        $this->bot_token = $bot_token;
        $this->method = $method;
        $this->output = $output;
    }
    // https://core.telegram.org/bots/api#getting-updates

    /**
     * Use this method to receive incoming updates using long polling (wiki). Returns an Array of Update objects.
     *
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param Json|string|null $allowed_updates
     * @return mixed
     * @link https://core.telegram.org/bots/api#getupdates
     */
    public function getUpdates(
        int $offset = null, int $limit = null, int $timeout = null, Json|string $allowed_updates = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     *
     * @param string $url
     * @param mixed $certificate
     * @param string $ip_address
     * @param int $max_connections
     * @param Json|string $allowed_updates
     * @param bool $drop_pending_updates
     * @param string $secret_token
     * @return mixed
     * @link https://core.telegram.org/bots/api#setwebhook
     */
    public function setWebhook(
        string      $url, mixed $certificate = null, string $ip_address = null, int $max_connections = null,
        Json|string $allowed_updates = null, bool $drop_pending_updates = null, string $secret_token = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
     *
     * @param bool $drop_pending_updates
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletewebhook
     */
    public function deleteWebhook(bool $drop_pending_updates = null): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object.
     * If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @return mixed
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     */
    public function getWebhookInfo(): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#available-methods

    /**
     * A simple method for testing your bot's authentication token. Requires no parameters.
     * Returns basic information about the bot in form of a User object.
     *
     * @return mixed
     * @link https://core.telegram.org/bots/api#getme
     */
    public function getMe(): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally.
     * You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates.
     * After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes.
     * Returns True on success. Requires no parameters.
     *
     * @return mixed
     * @link https://core.telegram.org/bots/api#logout
     */
    public function logOut(): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another.
     * You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart.
     * The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success.
     * Requires no parameters.
     *
     * @return mixed
     * @link https://core.telegram.org/bots/api#close
     */
    public function close(): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param string $chat_id
     * @param int|null $message_thread_id
     * @param string $text
     * @param string|null $parse_mode
     * @param Json|string|null $entities
     * @param bool|null $disable_web_page_preview
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendmessage
     */
    public function sendMessage(
        string $chat_id, int $message_thread_id = null, string $text, string $parse_mode = null, Json|string $entities = null,
        bool   $disable_web_page_preview = null, bool $disable_notification = null, bool $protect_content = null,
        int    $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to forward messages of any kind. Service messages can't be forwarded.
     * On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param int|string $from_chat_id
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#forwardmessage
     */
    public function forwardMessage(
        int|string $chat_id, int $message_thread_id = null, int|string $from_chat_id, bool $disable_notification = null,
        bool       $protect_content = null, int $message_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied.
     * A quiz poll can be copied only if the value of the field correct_option_id is known to the bot.
     * The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message.
     * Returns the MessageId of the sent message on success.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param int|string $from_chat_id
     * @param int $message_id
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param bool|null $disable_notification
     * @param bool $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendaudio
     */
    public function copyMessage(
        int|string $chat_id, int $message_thread_id = null, int|string $from_chat_id, int $message_id, string $caption = null,
        string     $parse_mode = null, Json|string $caption_entities = null, bool $disable_notification = null, bool $protect_content = null,
        int        $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string $photo
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param bool|null $has_spoiler
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendphoto
     */
    public function sendPhoto(
        int|string  $chat_id, int $message_thread_id = null, mixed $photo, string $caption = null, string $parse_mode = null,
        Json|string $caption_entities = null, bool $has_spoiler = null, bool $disable_notification = null, bool $protect_content = null,
        int         $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * For sending voice messages, use the sendVoice method instead.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $audio
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param int|null $duration
     * @param string|null $performer
     * @param string|null $title
     * @param mixed|null $thumbnail
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendaudio
     */
    public function sendAudio(
        int|string  $chat_id, int $message_thread_id = null, mixed $audio, string $caption = null, string $parse_mode = null,
        Json|string $caption_entities = null, int $duration = null, string $performer = null, string $title = null,
        mixed       $thumbnail = null, bool $disable_notification = null, bool $protect_content = null,
        int         $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $document
     * @param mixed|null $thumbnail
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param bool|null $disable_content_type_detection
     * @param Json|string|null $caption_entities
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#senddocument
     */
    public function sendDocument(
        int|string $chat_id, int $message_thread_id = null, mixed $document, mixed $thumbnail = null, string $caption = null,
        string     $parse_mode = null, Json|string $caption_entities = null, bool $disable_content_type_detection = null,
        bool       $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null,
        bool       $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $video
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param mixed|null $thumbnail
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param bool|null $has_spoiler
     * @param bool|null $supports_streaming
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvideo
     */
    public function sendVideo(
        int|string  $chat_id, int $message_thread_id = null, mixed $video, int $duration = null, int $width = null,
        int         $height = null, mixed $thumbnail = null, string $caption = null, string $parse_mode = null,
        Json|string $caption_entities = null, bool $has_spoiler = null, bool $supports_streaming = null,
        bool        $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null,
        bool        $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * On success, the sent Message is returned.
     * Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $animation
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param mixed|null $thumbnail
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param bool|null $has_spoiler
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendanimation
     */
    public function sendAnimation(
        int|string  $chat_id, int $message_thread_id = null, mixed $animation, int $duration = null, int $width = null,
        int         $height = null, mixed $thumbnail = null, string $caption = null, string $parse_mode = null,
        Json|string $caption_entities = null, bool $has_spoiler = null, bool $disable_notification = null,
        bool        $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null,
        Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document).
     * On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $voice
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param int|null $duration
     * @param bool|null $disable_content_type_detection
     * @param bool|null $has_spoiler
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvoice
     */
    public function sendVoice(
        int|string  $chat_id, int $message_thread_id = null, mixed $voice, string $caption = null, string $parse_mode = null,
        Json|string $caption_entities = null, int $duration = null, bool $disable_content_type_detection = null,
        bool        $has_spoiler = null, bool $disable_notification = null, bool $protect_content = null,
        int         $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * As of v.4.0, Telegram clients support rounded square MPEG4 videos of up to 1 minute long.
     * Use this method to send video messages.
     * On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $voice
     * @param int|null $duration
     * @param int|null $length
     * @param mixed|null $thumbnail
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendvideonote
     */
    public function sendVideoNote(
        int|string $chat_id, int $message_thread_id = null, mixed $voice, int $duration = null, int $length = null,
        mixed      $thumbnail = null, bool $disable_notification = null, bool $protect_content = null,
        int        $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album.
     * Documents and audio files can be only grouped in an album with messages of the same type.
     * On success, an array of Messages that were sent is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param Json|string $media
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendmediagroup
     */
    public function sendMediaGroup(
        int|string  $chat_id, int $message_thread_id = null, Json|string $media, bool $disable_notification = null,
        bool        $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null,
        Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param float $latitude
     * @param float $longitude
     * @param float|null $horizontal_accuracy
     * @param int|null $live_period
     * @param int|null $heading
     * @param int|null $proximity_alert_radius
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendLocation
     */
    public function sendLocation(
        int|string $chat_id, int $message_thread_id = null, float $latitude, float $longitude, float $horizontal_accuracy = null, int $live_period = null, int $heading = null, int $proximity_alert_radius = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param string|null $foursquare_id
     * @param string|null $foursquare_type
     * @param string|null $google_place_id
     * @param string|null $google_place_type
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendVenue
     */
    public function sendVenue(
        int|string $chat_id, int $message_thread_id = null, float $latitude, float $longitude, string $title, string $address, string $foursquare_id = null, string $foursquare_type = null, string $google_place_id = null, string $google_place_type = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string $phone_number
     * @param string $first_name
     * @param string|null $last_name
     * @param string|null $vcard
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendContact
     */
    public function sendContact(
        int|string $chat_id, int $message_thread_id = null, string $phone_number, string $first_name, string $last_name = null, string $vcard = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send a native poll. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string $question
     * @param Json|string $options
     * @param bool|null $is_anonymous
     * @param string|null $type
     * @param bool|null $allows_multiple_answers
     * @param int|null $correct_option_id
     * @param string|null $explanation
     * @param string|null $explanation_parse_mode
     * @param Json|string|null $explanation_entities
     * @param int|null $open_period
     * @param int|null $close_date
     * @param bool|null $is_closed
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendPoll
     */
    public function sendPoll(
        int|string $chat_id, int $message_thread_id = null, string $question, Json|string $options, bool $is_anonymous = null, string $type = null, bool $allows_multiple_answers = null, int $correct_option_id = null, string $explanation = null, string $explanation_parse_mode = null, Json|string $explanation_entities = null, int $open_period = null, int $close_date = null, bool $is_closed = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string|null $emoji
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendDice
     */
    public function sendDice(
        int|string $chat_id, int $message_thread_id = null, string $emoji = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string $action
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendChatAction
     */
    public function sendChatAction(
        int|string $chat_id, int $message_thread_id = null, string $action
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     *
     * @param int $user_id
     * @param int|null $offset
     * @param int|null $limit
     * @return mixed
     * @link https://core.telegram.org/bots/api#getUserProfilePhotos
     */
    public function getUserProfilePhotos(
        int $user_id, int $offset = null, int $limit = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get basic information about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link <code>https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;</code>, where <code>&lt;file_path&gt;</code> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     *
     * @param string $file_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getFile
     */
    public function getFile(
        string $file_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param int|null $until_date
     * @param bool|null $revoke_messages
     * @return mixed
     * @link https://core.telegram.org/bots/api#banChatMember
     */
    public function banChatMember(
        int|string $chat_id, int $user_id, int $until_date = null, bool $revoke_messages = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will <strong>not</strong> return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be <strong>removed</strong> from the chat. If you don't want this, use the parameter only_if_banned. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param bool|null $only_if_banned
     * @return mixed
     * @link https://core.telegram.org/bots/api#unbanChatMember
     */
    public function unbanChatMember(
        int|string $chat_id, int $user_id, bool $only_if_banned = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param Json|string $permissions
     * @param bool|null $use_independent_chat_permissions
     * @param int|null $until_date
     * @return mixed
     * @link https://core.telegram.org/bots/api#restrictChatMember
     */
    public function restrictChatMember(
        int|string $chat_id, int $user_id, Json|string $permissions, bool $use_independent_chat_permissions = null, int $until_date = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param bool|null $is_anonymous
     * @param bool|null $can_manage_chat
     * @param bool|null $can_delete_messages
     * @param bool|null $can_manage_video_chats
     * @param bool|null $can_restrict_members
     * @param bool|null $can_promote_members
     * @param bool|null $can_change_info
     * @param bool|null $can_invite_users
     * @param bool|null $can_post_messages
     * @param bool|null $can_edit_messages
     * @param bool|null $can_pin_messages
     * @param bool|null $can_post_stories
     * @param bool|null $can_edit_stories
     * @param bool|null $can_delete_stories
     * @param bool|null $can_manage_topics
     * @return mixed
     * @link https://core.telegram.org/bots/api#promoteChatMember
     */
    public function promoteChatMember(
        int|string $chat_id, int $user_id, bool $is_anonymous = null, bool $can_manage_chat = null, bool $can_delete_messages = null, bool $can_manage_video_chats = null, bool $can_restrict_members = null, bool $can_promote_members = null, bool $can_change_info = null, bool $can_invite_users = null, bool $can_post_messages = null, bool $can_edit_messages = null, bool $can_pin_messages = null, bool $can_post_stories = null, bool $can_edit_stories = null, bool $can_delete_stories = null, bool $can_manage_topics = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @param string $custom_title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatAdministratorCustomTitle
     */
    public function setChatAdministratorCustomTitle(
        int|string $chat_id, int $user_id, string $custom_title
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of <strong>any of their channels</strong>. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#banChatSenderChat
     */
    public function banChatSenderChat(
        int|string $chat_id, int $sender_chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unbanChatSenderChat
     */
    public function unbanChatSenderChat(
        int|string $chat_id, int $sender_chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param Json|string $permissions
     * @param bool|null $use_independent_chat_permissions
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatPermissions
     */
    public function setChatPermissions(
        int|string $chat_id, Json|string $permissions, bool $use_independent_chat_permissions = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the new invite link as String on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#exportChatInviteLink
     */
    public function exportChatInviteLink(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink object.
     *
     * @param int|string $chat_id
     * @param string|null $name
     * @param int|null $expire_date
     * @param int|null $member_limit
     * @param bool|null $creates_join_request
     * @return mixed
     * @link https://core.telegram.org/bots/api#createChatInviteLink
     */
    public function createChatInviteLink(
        int|string $chat_id, string $name = null, int $expire_date = null, int $member_limit = null, bool $creates_join_request = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a ChatInviteLink object.
     *
     * @param int|string $chat_id
     * @param string $invite_link
     * @param string|null $name
     * @param int|null $expire_date
     * @param int|null $member_limit
     * @param bool|null $creates_join_request
     * @return mixed
     * @link https://core.telegram.org/bots/api#editChatInviteLink
     */
    public function editChatInviteLink(
        int|string $chat_id, string $invite_link, string $name = null, int $expire_date = null, int $member_limit = null, bool $creates_join_request = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as ChatInviteLink object.
     *
     * @param int|string $chat_id
     * @param string $invite_link
     * @return mixed
     * @link https://core.telegram.org/bots/api#revokeChatInviteLink
     */
    public function revokeChatInviteLink(
        int|string $chat_id, string $invite_link
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#approveChatJoinRequest
     */
    public function approveChatJoinRequest(
        int|string $chat_id, int $user_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#declineChatJoinRequest
     */
    public function declineChatJoinRequest(
        int|string $chat_id, int $user_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param mixed $photo
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatPhoto
     */
    public function setChatPhoto(
        int|string $chat_id, mixed $photo
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteChatPhoto
     */
    public function deleteChatPhoto(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param string $title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatTitle
     */
    public function setChatTitle(
        int|string $chat_id, string $title
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param string|null $description
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatDescription
     */
    public function setChatDescription(
        int|string $chat_id, string $description = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @param bool|null $disable_notification
     * @return mixed
     * @link https://core.telegram.org/bots/api#pinChatMessage
     */
    public function pinChatMessage(
        int|string $chat_id, int $message_id, bool $disable_notification = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int|null $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinChatMessage
     */
    public function unpinChatMessage(
        int|string $chat_id, int $message_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinAllChatMessages
     */
    public function unpinAllChatMessages(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#leaveChat
     */
    public function leaveChat(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getChat
     */
    public function getChat(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get a list of administrators in a chat, which aren't bots. Returns an Array of ChatMember objects.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getChatAdministrators
     */
    public function getChatAdministrators(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the number of members in a chat. Returns Int on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getChatMemberCount
     */
    public function getChatMemberCount(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get information about a member of a chat. The method is only guaranteed to work for other users if the bot is an administrator in the chat. Returns a ChatMember object on success.
     *
     * @param int|string $chat_id
     * @param int $user_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getChatMember
     */
    public function getChatMember(
        int|string $chat_id, int $user_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @param int|string $chat_id
     * @param string $sticker_set_name
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatStickerSet
     */
    public function setChatStickerSet(
        int|string $chat_id, string $sticker_set_name
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteChatStickerSet
     */
    public function deleteChatStickerSet(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to create a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns information about the created topic as a ForumTopic object.
     *
     * @param int|string $chat_id
     * @param string $name
     * @param int|null $icon_color
     * @param string|null $icon_custom_emoji_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#createForumTopic
     */
    public function createForumTopic(
        int|string $chat_id, string $name, int $icon_color = null, string $icon_custom_emoji_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @param string|null $name
     * @param string|null $icon_custom_emoji_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#editForumTopic
     */
    public function editForumTopic(
        int|string $chat_id, int $message_thread_id, string $name = null, string $icon_custom_emoji_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#closeForumTopic
     */
    public function closeForumTopic(
        int|string $chat_id, int $message_thread_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#reopenForumTopic
     */
    public function reopenForumTopic(
        int|string $chat_id, int $message_thread_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_delete_messages administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteForumTopic
     */
    public function deleteForumTopic(
        int|string $chat_id, int $message_thread_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to clear the list of pinned messages in a forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup. Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_thread_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinAllForumTopicMessages
     */
    public function unpinAllForumTopicMessages(
        int|string $chat_id, int $message_thread_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit the name of the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have can_manage_topics administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#editGeneralForumTopic
     */
    public function editGeneralForumTopic(
        int|string $chat_id, string $name
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to close an open 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#closeGeneralForumTopic
     */
    public function closeGeneralForumTopic(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to reopen a closed 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically unhidden if it was hidden. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#reopenGeneralForumTopic
     */
    public function reopenGeneralForumTopic(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to hide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. The topic will be automatically closed if it was open. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#hideGeneralForumTopic
     */
    public function hideGeneralForumTopic(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to unhide the 'General' topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unhideGeneralForumTopic
     */
    public function unhideGeneralForumTopic(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to clear the list of pinned messages in a General forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup. Returns True on success.
     *
     * @param int|string $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#unpinAllGeneralForumTopicMessages
     */
    public function unpinAllGeneralForumTopicMessages(
        int|string $chat_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     *
     * @param string $callback_query_id
     * @param string|null $text
     * @param bool|null $show_alert
     * @param string|null $url
     * @param int|null $cache_time
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerCallbackQuery
     */
    public function answerCallbackQuery(
        string $callback_query_id, string $text = null, bool $show_alert = null, string $url = null, int $cache_time = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the list of the bot's commands. See this manual for more details about bot commands. Returns True on success.
     *
     * @param Json|string $commands
     * @param Json|string|null $scope
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#setMyCommands
     */
    public function setMyCommands(
        Json|string $commands, Json|string $scope = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
     *
     * @param Json|string|null $scope
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteMyCommands
     */
    public function deleteMyCommands(
        Json|string $scope = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language. Returns an Array of BotCommand objects. If commands aren't set, an empty list is returned.
     *
     * @param Json|string|null $scope
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#getMyCommands
     */
    public function getMyCommands(
        Json|string $scope = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the bot's name. Returns True on success.
     *
     * @param string|null $name
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#setMyName
     */
    public function setMyName(
        string $name = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current bot name for the given user language. Returns BotName on success.
     *
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#getMyName
     */
    public function getMyName(
        string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the bot's description, which is shown in the chat with the bot if the chat is empty. Returns True on success.
     *
     * @param string|null $description
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#setMyDescription
     */
    public function setMyDescription(
        string $description = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current bot description for the given user language. Returns BotDescription on success.
     *
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#getMyDescription
     */
    public function getMyDescription(
        string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the bot's short description, which is shown on the bot's profile page and is sent together with the link when users share the bot. Returns True on success.
     *
     * @param string|null $short_description
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#setMyShortDescription
     */
    public function setMyShortDescription(
        string $short_description = null, string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current bot short description for the given user language. Returns BotShortDescription on success.
     *
     * @param string|null $language_code
     * @return mixed
     * @link https://core.telegram.org/bots/api#getMyShortDescription
     */
    public function getMyShortDescription(
        string $language_code = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the bot&##39;s menu button in a private chat, or the default menu button. Returns True on success.
     *
     * @param int|null $chat_id
     * @param Json|string|null $menu_button
     * @return mixed
     * @link https://core.telegram.org/bots/api#setChatMenuButton
     */
    public function setChatMenuButton(
        int $chat_id = null, Json|string $menu_button = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button. Returns MenuButton on success.
     *
     * @param int|null $chat_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getChatMenuButton
     */
    public function getChatMenuButton(
        int $chat_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are free to modify the list before adding the bot. Returns True on success.
     *
     * @param Json|string|null $rights
     * @param bool|null $for_channels
     * @return mixed
     * @link https://core.telegram.org/bots/api#setMyDefaultAdministratorRights
     */
    public function setMyDefaultAdministratorRights(
        Json|string $rights = null, bool $for_channels = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get the current default administrator rights of the bot. Returns ChatAdministratorRights on success.
     *
     * @param bool|null $for_channels
     * @return mixed
     * @link https://core.telegram.org/bots/api#getMyDefaultAdministratorRights
     */
    public function getMyDefaultAdministratorRights(
        bool $for_channels = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#updating-messages

    /**
     * Use this method to edit text and <a href="#games">game</a> messages. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param string $text
     * @param string|null $parse_mode
     * @param Json|string|null $entities
     * @param bool|null $disable_web_page_preview
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#editMessageText
     */
    public function editMessageText(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, string $text, string $parse_mode = null, Json|string $entities = null, bool $disable_web_page_preview = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param Json|string|null $caption_entities
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#editMessageCaption
     */
    public function editMessageCaption(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, string $caption = null, string $parse_mode = null, Json|string $caption_entities = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously uploaded file via its file_id or specify a URL. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param Json|string $media
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#editMessageMedia
     */
    public function editMessageMedia(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, Json|string $media, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to <a href="#stopmessagelivelocation">stopMessageLiveLocation</a>. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param float $latitude
     * @param float $longitude
     * @param float|null $horizontal_accuracy
     * @param int|null $heading
     * @param int|null $proximity_alert_radius
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#editMessageLiveLocation
     */
    public function editMessageLiveLocation(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, float $latitude, float $longitude, float $horizontal_accuracy = null, int $heading = null, int $proximity_alert_radius = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to stop updating a live location message before live_period expires. On success, if the message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#stopMessageLiveLocation
     */
    public function stopMessageLiveLocation(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise True is returned.
     *
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#editMessageReplyMarkup
     */
    public function editMessageReplyMarkup(
        int|string $chat_id = null, int $message_id = null, string $inline_message_id = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped <a href="#poll">Poll</a> is returned.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#stopPoll
     */
    public function stopPoll(
        int|string $chat_id, int $message_id, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:
     * - A message can only be deleted if it was sent less than 48 hours ago.
     * - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
     * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
     * - Bots can delete outgoing messages in private chats, groups, and supergroups.
     * - Bots can delete incoming messages in private chats.
     * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * - If the bot is an administrator of a group, it can delete any message there.
     * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     * Returns True on success.
     *
     * @param int|string $chat_id
     * @param int $message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteMessage
     */
    public function deleteMessage(
        int|string $chat_id, int $message_id
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#stickers

    /**
     * Use this method to send static .WEBP, <a href="https://telegram.org/blog/animated-stickers">animated</a> .TGS, or <a href="https://telegram.org/blog/video-stickers-better-reactions">video</a> .WEBM stickers. On success, the sent <a href="#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param mixed $sticker
     * @param string|null $emoji
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendSticker
     */
    public function sendSticker(
        int|string $chat_id, int $message_thread_id = null, mixed $sticker, string $emoji = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     *
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#getStickerSet
     */
    public function getStickerSet(
        string $name
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get information about custom emoji stickers by their identifiers. Returns an Array of <a href="#sticker">Sticker</a> objects.
     *
     * @param Json|string $custom_emoji_ids
     * @return mixed
     * @link https://core.telegram.org/bots/api#getCustomEmojiStickers
     */
    public function getCustomEmojiStickers(
        Json|string $custom_emoji_ids
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to upload a file with a sticker for later use in the <a href="#createnewstickerset">createNewStickerSet</a> and <a href="#addstickertoset">addStickerToSet</a> methods (the file can be used multiple times). Returns the uploaded <a href="#file">File</a> on success.
     *
     * @param int $user_id
     * @param mixed $sticker
     * @param string $sticker_format
     * @return mixed
     * @link https://core.telegram.org/bots/api#uploadStickerFile
     */
    public function uploadStickerFile(
        int $user_id, mixed $sticker, string $sticker_format
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $name
     * @param string $title
     * @param Json|string $stickers
     * @param string $sticker_format
     * @param string|null $sticker_type
     * @param bool|null $needs_repainting
     * @return mixed
     * @link https://core.telegram.org/bots/api#createNewStickerSet
     */
    public function createNewStickerSet(
        int $user_id, string $name, string $title, Json|string $stickers, string $sticker_format, string $sticker_type = null, bool $needs_repainting = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. The format of the added sticker must match the format of the other stickers in the set. Emoji sticker sets can have up to 200 stickers. Animated and video sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns <em>True</em> on success.
     *
     * @param int $user_id
     * @param string $name
     * @param Json|string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#addStickerToSet
     */
    public function addStickerToSet(
        int $user_id, string $name, Json|string $sticker
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param int $position
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerPositionInSet
     */
    public function setStickerPositionInSet(
        string $sticker, int $position
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @return mixed
     * @link https://core.telegram.org/bots/api#deleteStickerFromSet
     */
    public function deleteStickerFromSet(
        string $sticker
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param Json|string $emoji_list
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerEmojiList
     */
    public function setStickerEmojiList(
        string $sticker, Json|string $emoji_list
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param Json|string|null $keywords
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerKeywords
     */
    public function setStickerKeywords(
        string $sticker, Json|string $keywords = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to change the <a href="#maskposition">mask position</a> of a mask sticker. The sticker must belong to a sticker set that was created by the bot. Returns <em>True</em> on success.
     *
     * @param string $sticker
     * @param Json|string|null $mask_position
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerMaskPosition
     */
    public function setStickerMaskPosition(
        string $sticker, Json|string $mask_position = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set the title of a created sticker set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @param string $title
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerSetTitle
     */
    public function setStickerSetTitle(
        string $name, string $title
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set the thumbnail of a regular or mask sticker set. The format of the thumbnail file must match the format of the stickers in the set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @param int $user_id
     * @param mixed|null $thumbnail
     * @return mixed
     * @link https://core.telegram.org/bots/api#setStickerSetThumbnail
     */
    public function setStickerSetThumbnail(
        string $name, int $user_id, mixed $thumbnail = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set the thumbnail of a custom emoji sticker set. Returns <em>True</em> on success.
     *
     * @param string $name
     * @param string|null $custom_emoji_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#setCustomEmojiStickerSetThumbnail
     */
    public function setCustomEmojiStickerSetThumbnail(
        string $name, string $custom_emoji_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to delete a sticker set that was created by the bot. Returns <em>True</em> on success.
     *
     * @param string $name
     * @return mixed
     * @link https://core.telegram.org/bots/api#deletestickerset
     */
    public function deleteStickerSet(
        string $name
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#inline-mode

    /**
     * Use this method to send answers to an inline query. On success, True is returned.
     * No more than 50 results per query are allowed.
     *
     * @param int $inline_query_id
     * @param Json|string $results
     * @param int|null $cache_time
     * @param bool|null $is_personal
     * @param string|null $next_offset
     * @param Json|string $button
     * @return mixed
     */
    public function answerInlineQuery(
        int $inline_query_id, Json|string $results, int $cache_time = null, bool $is_personal = null, string $next_offset = null, Json|string $button
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a SentWebAppMessage object is returned.
     *
     * @param string $web_app_query_id
     * @param Json|string $result
     * @return mixed
     */
    public function answerWebAppQuery(
        string $web_app_query_id, Json|string $result
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#payments

    /**
     * Use this method to send invoices. On success, the sent <a href="#message">Message</a> is returned.
     *
     * @param int|string $chat_id
     * @param int|null $message_thread_id
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $provider_token
     * @param string $currency
     * @param Json|string $prices
     * @param int|null $max_tip_amount
     * @param Json|string|null $suggested_tip_amounts
     * @param string|null $start_parameter
     * @param string|null $provider_data
     * @param string|null $photo_url
     * @param int|null $photo_size
     * @param int|null $photo_width
     * @param int|null $photo_height
     * @param bool|null $need_name
     * @param bool|null $need_phone_number
     * @param bool|null $need_email
     * @param bool|null $need_shipping_address
     * @param bool|null $send_phone_number_to_provider
     * @param bool|null $send_email_to_provider
     * @param bool|null $is_flexible
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendInvoicelink
     */
    public function sendInvoice(
        int|string $chat_id, int $message_thread_id = null, string $title, string $description, string $payload, string $provider_token, string $currency, Json|string $prices, int $max_tip_amount = null, Json|string $suggested_tip_amounts = null, string $start_parameter = null, string $provider_data = null, string $photo_url = null, int $photo_size = null, int $photo_width = null, int $photo_height = null, bool $need_name = null, bool $need_phone_number = null, bool $need_email = null, bool $need_shipping_address = null, bool $send_phone_number_to_provider = null, bool $send_email_to_provider = null, bool $is_flexible = null, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to create a link for an invoice. Returns the created invoice link as <em>String</em> on success.
     *
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $provider_token
     * @param string $currency
     * @param Json|string $prices
     * @param int|null $max_tip_amount
     * @param Json|string|null $suggested_tip_amounts
     * @param string|null $provider_data
     * @param string|null $photo_url
     * @param int|null $photo_size
     * @param int|null $photo_width
     * @param int|null $photo_height
     * @param bool|null $need_name
     * @param bool|null $need_phone_number
     * @param bool|null $need_email
     * @param bool|null $need_shipping_address
     * @param bool|null $send_phone_number_to_provider
     * @param bool|null $send_email_to_provider
     * @param bool|null $is_flexible
     * @return mixed
     * @link https://core.telegram.org/bots/api#createInvoiceLinklink
     */
    public function createInvoiceLink(
        string $title, string $description, string $payload, string $provider_token, string $currency, Json|string $prices, int $max_tip_amount = null, Json|string $suggested_tip_amounts = null, string $provider_data = null, string $photo_url = null, int $photo_size = null, int $photo_width = null, int $photo_height = null, bool $need_name = null, bool $need_phone_number = null, bool $need_email = null, bool $need_shipping_address = null, bool $send_phone_number_to_provider = null, bool $send_email_to_provider = null, bool $is_flexible = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter <em>is_flexible</em> was specified, the Bot API will send an <a href="#update">Update</a> with a <em>shipping_query</em> field to the bot. Use this method to reply to shipping queries. On success, <em>True</em> is returned.
     *
     * @param string $shipping_query_id
     * @param bool $ok
     * @param Json|string|null $shipping_options
     * @param string|null $error_message
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerShippingQuerylink
     */
    public function answerShippingQuery(
        string $shipping_query_id, bool $ok, Json|string $shipping_options = null, string $error_message = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an <a href="#update">Update</a> with the field <em>pre_checkout_query</em>. Use this method to respond to such pre-checkout queries. On success, <em>True</em> is returned. <strong>Note:</strong> The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @param string $pre_checkout_query_id
     * @param bool $ok
     * @param string|null $error_message
     * @return mixed
     * @link https://core.telegram.org/bots/api#answerPreCheckoutQuerylink
     */
    public function answerPreCheckoutQuery(
        string $pre_checkout_query_id, bool $ok, string $error_message = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#telegram-passport

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors.
     * The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change).
     * Returns True on success.
     *
     * Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason.
     * For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc.
     * Supply some details in the error message to make sure the user knows how to correct the issues.
     *
     * @param int $user_id
     * @param Json|string $errors
     * @return mixed
     */
    public function setPassportDataErrors(
        int $user_id, Json|string $errors
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    // https://core.telegram.org/bots/api#games

    /**
     * Use this method to send a game. On success, the sent <a href="#message">Message</a> is returned.
     *
     * @param int $chat_id
     * @param int|null $message_thread_id
     * @param string $game_short_name
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param Json|string|null $reply_markup
     * @return mixed
     * @link https://core.telegram.org/bots/api#sendGamelink
     */
    public function sendGame(
        int $chat_id, int $message_thread_id = null, string $game_short_name, bool $disable_notification = null, bool $protect_content = null, int $reply_to_message_id = null, bool $allow_sending_without_reply = null, Json|string $reply_markup = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to set the score of the specified user in a game message. On success, if the message is not an inline message, the <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned. Returns an error, if the new score is not greater than the user&#39;s current score in the chat and <em>force</em> is <em>False</em>.
     *
     * @param int $user_id
     * @param int $score
     * @param bool|null $force
     * @param bool|null $disable_edit_message
     * @param int|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#setGameScorelink
     */
    public function setGameScore(
        int $user_id, int $score, bool $force = null, bool $disable_edit_message = null, int $chat_id = null, int $message_id = null, string $inline_message_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. Returns an Array of <a href="#gamehighscore">GameHighScore</a> objects.
     *
     * @param int $user_id
     * @param int|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @return mixed
     * @link https://core.telegram.org/bots/api#getGameHighScoreslink
     */
    public function getGameHighScores(
        int $user_id, int $chat_id = null, int $message_id = null, string $inline_message_id = null
    ): mixed
    {
        return $this->getResponse(__FUNCTION__, get_defined_vars());
    }

    /**
     * @param $function
     * @return mixed
     */
    private function getResponse($function, $params): mixed
    {
        $promise = $this->guzzle->requestAsync($this->method, '/bot' . $this->bot_token . '/' . $function, [
            'form_params' => $params
        ]);
        return $promise->then(
            function (ResponseInterface $res) {
                $body = $res->getBody();
                return [
                    'success' => true,
                    'code' => $res->getStatusCode(),
                    'header' => $res->getHeaders(),
                    'response' => $body->getContents(),
                    'size' => $body->getSize(),
                ];
            },
            function (RequestException $err) {
                $response = [
                    'success' => false,
                    'code' => $err->getCode(),
                    'error' => $err->getMessage(),
                ];
                if ($err->hasResponse())
                    $response['response'] = $err->getResponse()->getBody()->getContents();
                else
                    $response['response'] = null;
                return $response;
            }
        )->wait();
    }

    private function output($data)
    {
        switch ($this->output):
            case self::OUTPUT_JSON:
                $return = Json::encode($data, true);
            break;
            case self::OUTPUT_OBJECT:
                $return = new stdClass();
                Arrays::toObject($data, $return);
            break;
            default:
                $return = $data;
            break;
        endswitch;
        return $return;
    }

    private static function get_func_argNames($funcName): array
    {
        $f = new ReflectionFunction($funcName);
        $result = [];
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;
        }
        return $result;
    }
}