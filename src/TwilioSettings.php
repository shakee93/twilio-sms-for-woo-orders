<?php

namespace TwilioSMSForWooCommerce;

class TwilioSettings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'create_settings_menu'));
        add_action('admin_init', array($this, 'setup_settings'));
    }

    public function create_settings_menu()
    {
        add_options_page(
            'Twilio SMS for Orders',
            'Twilio SMS for Orders',
            'manage_options',
            'twilio-sms-for-orders',
            array($this, 'settings_page_content')
        );
    }

    public function setup_settings()
    {
        register_setting('twilio_sms_for_orders', 'twilio_account_sid');
        register_setting('twilio_sms_for_orders', 'twilio_auth_token');
        register_setting('twilio_sms_for_orders', 'twilio_phone_number');
        register_setting('twilio_sms_for_orders', 'recipient_phone_number');
        register_setting('twilio_sms_for_orders', 'twilio_sms_enabled');
        register_setting('twilio_sms_for_orders', 'twilio_sms_template');
    }

    public function settings_page_content()
    {
        ?>
        <h1>Twilio SMS for Orders Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('twilio_sms_for_orders'); ?>
            <?php do_settings_sections('twilio_sms_for_orders'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Twilio Account SID</th>
                    <td><input type="text" name="twilio_account_sid" value="<?php echo esc_attr(get_option('twilio_account_sid')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Twilio Auth Token</th>
                    <td><input type="text" name="twilio_auth_token" value="<?php echo esc_attr(get_option('twilio_auth_token')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Twilio Phone Number</th>
                    <td><input type="text" name="twilio_phone_number" value="<?php echo esc_attr(get_option('twilio_phone_number')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Recipient Phone Number</th>
                    <td><input type="text" name="recipient_phone_number" value="<?php echo esc_attr(get_option('recipient_phone_number')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enable Twilio SMS</th>
                    <td><input type="checkbox" name="twilio_sms_enabled" value="yes" <?php checked('yes', get_option('twilio_sms_enabled')); ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Message Template</th>
                    <td>
                        <textarea name="twilio_sms_template" rows="5" cols="50"><?php echo esc_textarea(get_option('twilio_sms_template')); ?></textarea>
                        <p class="description">
                            You can use placeholders in your message: {order_id}, {customer_name}, {order_total}.
                        </p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <?php
    }
}
