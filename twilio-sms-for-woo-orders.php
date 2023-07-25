<?php
/**
 * Plugin Name: Twilio SMS for Orders
 * Plugin URI: https://shakeeb.dev
 * Description: This plugin sends an SMS when a new order is created using WooCommerce.
 * Version: 1.0
 * Author: Shakeeb Sadikeen
 * Author URI: https://shakeeb.dev
 **/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require __DIR__ . '/vendor/autoload.php';

use TwilioSMSForWooCommerce\TwilioSMSForOrders;
use TwilioSMSForWooCommerce\TwilioSettings;

$twilioSMSForOrders = new TwilioSMSForOrders();
$twilioSettings = new TwilioSettings();

// Hook to order completion
add_action('woocommerce_new_order', [$twilioSMSForOrders, 'send_order_sms']);

// Plugin activation hook
register_activation_hook(__FILE__, 'activate_twilio_sms_for_orders');

function activate_twilio_sms_for_orders()
{
    $default_message_template = 'You have a new order (#{order_id}) on Your Website Name. Customer Name: {customer_name}. Order Total: {order_total}.';

    if (!get_option('message_template')) {
        update_option('message_template', $default_message_template);
    }
}