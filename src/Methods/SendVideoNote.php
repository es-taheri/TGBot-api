<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method SendVideoNote business_connection_id(string $value) Unique identifier of the business connection on behalf of which the message will be sent
 * @method SendVideoNote message_thread_id(int $value) Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
 * @method SendVideoNote duration(int $value) Duration of sent video in seconds
 * @method SendVideoNote length(int $value) Video width and height, i.e. diameter of the video message
 * @method SendVideoNote thumbnail(mixed $value) Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail&#39;s width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can&#39;t be reused and can be only uploaded as a new file, so you can pass “attach://&lt;file_attach_name&gt;” if the thumbnail was uploaded using multipart/form-data under &lt;file_attach_name&gt;. <a href="https://core.telegram.org/bots/api#sending-files">More information on Sending Files »</a>
 * @method SendVideoNote disable_notification(bool $value) Sends the message <a href="https://telegram.org/blog/channels-2-0#silent-messages">silently</a>. Users will receive a notification with no sound.
 * @method SendVideoNote protect_content(bool $value) Protects the contents of the sent message from forwarding and saving
 * @method SendVideoNote message_effect_id(string $value) Unique identifier of the message effect to be added to the message; for private chats only
 * @method SendVideoNote reply_parameters(string $value) Description of the message to reply to
 * @method SendVideoNote reply_markup(string $value) Additional interface options. A JSON-serialized object for an <a href="/bots/features#inline-keyboards">inline keyboard</a>, <a href="/bots/features#keyboards">custom reply keyboard</a>, instructions to remove a reply keyboard or to force a reply from the user
 */
class SendVideoNote
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private int|string $chat_id;
    private mixed $video_note;
    private string $business_connection_id;
    private int $message_thread_id;
    private int $duration;
    private int $length;
    private mixed $thumbnail;
    private bool $disable_notification;
    private bool $protect_content;
    private string $message_effect_id;
    private string $reply_parameters;
    private string $reply_markup;
    
    public function __construct(Request $request, int|string $chat_id, mixed $video_note)
    {
        $this->_request = $request;
        $this->chat_id = $chat_id;
        $this->video_note = $video_note;
    }

    public function __call(string $name, array $arguments)
    {
        return $this->return($name, array_shift($arguments));
    }

    public function _send(): mixed
    {
        $parameters = [];
        foreach ($this as $key => $value):
            if (isset($this->{$key}) && !in_array($key, ['_request', '_sent', '_returned'])) $parameters[$key] = $value;
        endforeach;
        $r = new \ReflectionClass($this);
        $this->_sent = true;
        return $this->_request->send(lcfirst($r->getShortName()), $parameters);
    }

    private function return($function, $value)
    {
        $class = new (static::class)($this->_request, $this->chat_id, $this->video_note);
            $this->{$function} = $value;
        foreach ($this as $key => $value):
            if (!in_array($key, ['_sent', '_returned'])) $class->{$key} = $value;
        endforeach;
        $this->_returned = true;
        return $class;
    }

    public function __destruct()
    {
        if (!$this->_returned && !$this->_sent) $this->_send();
    }
}
