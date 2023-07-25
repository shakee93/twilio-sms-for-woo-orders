# Twilio SMS for Woocommerce Orders

Twilio SMS for Orders is a free WordPress plugin that sends an SMS notification whenever a new order is placed in WooCommerce. The plugin uses the Twilio API to send SMS notifications.

## Features
- Configurable options in the WordPress backend.
- SMS notifications on new WooCommerce orders.
- Customizable SMS message template with placeholders for order data.

## Requirements
- WordPress 4.7 or later
- WooCommerce 3.0 or later
- PHP 7.4 or later
- Composer

## Installation
1. Download the plugin files.
2. Upload the plugin files to your `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen.
3. Activate the plugin through the 'Plugins' screen in WordPress.
4. Go to the plugin settings (located in the main WordPress options menu) to configure Twilio API settings and the SMS message template.

## Configuration
You can configure the plugin options in the WordPress backend. The following options are available:

`Wordpress menu -> settings -> Twilio SMS for Orders`
- Twilio Account SID
- Twilio Auth Token
- Twilio Phone Number (the number SMS notifications will be sent from)
- Recipient Phone Number (the number SMS notifications will be sent to)
- Enable/Disable SMS notifications
- SMS message template (with placeholders for order id, customer name, and order total)

## Usage
Once you have configured the plugin options, an SMS notification will be sent for every new order placed in WooCommerce. The SMS will be sent to the recipient number specified in the plugin settings, and it will include the order id, customer name, and order total according to the SMS message template.

## Support
If you encounter any problems or have suggestions for the plugin, please open an issue on GitHub.

## License
This project is licensed under the GNU General Public License v3.0 - see the LICENSE file for details.
