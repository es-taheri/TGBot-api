<?php

namespace EasyTel\Methods;

use EasyTel\Handler\Request;

/**
 * @method CreateInvoiceLink provider_token(string $value) Payment provider token, obtained via <a href="https://t.me/botfather">@BotFather</a>. Pass an empty string for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink max_tip_amount(int $value) The maximum accepted amount for tips in the <em>smallest units</em> of the currency (integer, <strong>not</strong> float/double). For example, for a maximum tip of <code>US$ 1.45</code> pass <code>max_tip_amount = 145</code>. See the <em>exp</em> parameter in <a href="/bots/payments/currencies.json">currencies.json</a>, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0. Not supported for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink suggested_tip_amounts(string  $value) A JSON-serialized array of suggested amounts of tips in the <em>smallest units</em> of the currency (integer, <strong>not</strong> float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed <em>max_tip_amount</em>.
 * @method CreateInvoiceLink provider_data(string $value) JSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
 * @method CreateInvoiceLink photo_url(string $value) URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
 * @method CreateInvoiceLink photo_size(int $value) Photo size in bytes
 * @method CreateInvoiceLink photo_width(int $value) Photo width
 * @method CreateInvoiceLink photo_height(int $value) Photo height
 * @method CreateInvoiceLink need_name(bool $value) Pass <em>True</em> if you require the user&#39;s full name to complete the order. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink need_phone_number(bool $value) Pass <em>True</em> if you require the user&#39;s phone number to complete the order. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink need_email(bool $value) Pass <em>True</em> if you require the user&#39;s email address to complete the order. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink need_shipping_address(bool $value) Pass <em>True</em> if you require the user&#39;s shipping address to complete the order. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink send_phone_number_to_provider(bool $value) Pass <em>True</em> if the user&#39;s phone number should be sent to the provider. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink send_email_to_provider(bool $value) Pass <em>True</em> if the user&#39;s email address should be sent to the provider. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 * @method CreateInvoiceLink is_flexible(bool $value) Pass <em>True</em> if the final price depends on the shipping method. Ignored for payments in <a href="https://t.me/BotNews/90">Telegram Stars</a>.
 */
class CreateInvoiceLink
{
    private Request $_request;
    private bool $_returned = false;
    private bool $_sent = false;
    private string $title;
    private string $description;
    private string $payload;
    private string $currency;
    private string  $prices;
    private string $provider_token;
    private int $max_tip_amount;
    private string  $suggested_tip_amounts;
    private string $provider_data;
    private string $photo_url;
    private int $photo_size;
    private int $photo_width;
    private int $photo_height;
    private bool $need_name;
    private bool $need_phone_number;
    private bool $need_email;
    private bool $need_shipping_address;
    private bool $send_phone_number_to_provider;
    private bool $send_email_to_provider;
    private bool $is_flexible;
    
    public function __construct(Request $request, string $title, string $description, string $payload, string $currency, string  $prices)
    {
        $this->_request = $request;
        $this->title = $title;
        $this->description = $description;
        $this->payload = $payload;
        $this->currency = $currency;
        $this->prices = $prices;
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
        $class = new (static::class)($this->_request, $this->title, $this->description, $this->payload, $this->currency, $this->prices);
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
