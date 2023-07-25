<?php

namespace TwilioSMSForWooCommerce;

use Twilio\Rest\Client;
use Exception;

class TwilioSMSForOrders
{
    private $twilio_account_sid;
    private $twilio_auth_token;
    private $twilio_phone_number;
    private $recipient_phone_number;
    private $is_enabled;
    private $message_template;

    public function __construct()
    {
        $this->twilio_account_sid = get_option('twilio_account_sid');
        $this->twilio_auth_token = get_option('twilio_auth_token');
        $this->twilio_phone_number = get_option('twilio_phone_number');
        $this->recipient_phone_number = get_option('recipient_phone_number');
        $this->is_enabled = get_option('twilio_sms_enabled');
        $this->message_template = get_option('twilio_sms_template');
    }

    public function send_order_sms($order_id)
    {
        if ('yes' !== $this->is_enabled || empty($this->twilio_account_sid) || empty($this->twilio_auth_token) || empty($this->twilio_phone_number) || empty($this->recipient_phone_number) || empty($this->message_template)) {
            return;
        }

        $order = wc_get_order($order_id);

        if (!$order) {
            return;
        }

        $customer_name = $order->get_billing_first_name();
        $order_total = $order->get_total();

        // Replace placeholders with actual data
        $message = str_replace(
            ['{order_id}', '{customer_name}', '{order_total}'],
            [$order_id, $customer_name, $order_total],
            $this->message_template
        );

        // Add line break and website URL
        $message .= "\n\nvia - " . get_site_url();

        try {
            $client = new Client($this->twilio_account_sid, $this->twilio_auth_token);
            $client->messages->create(
                $this->recipient_phone_number,
                [
                    'from' => $this->twilio_phone_number,
                    'body' => $message,
                ]
            );
        } catch (Exception $e) {
            error_log('Failed to send SMS via Twilio: ' . $e->getMessage());
        }

    }

}
