<?php
/**
 * Plugin Name: Pronamic Pay Test Helper
 * Plugin URI: https://www.pronamic.eu/plugins/pronamic-pay-test-helper/
 * Description: This plugin makes testing Pronamic Pay easier.
 *
 * Version: 1.0.0
 * Requires at least: 4.7
 *
 * Author: Pronamic
 * Author URI: https://www.pronamic.eu/
 *
 * Text Domain: pronamic-pay-test-helper
 * Domain Path: /languages/
 *
 * License: GPL-3.0-or-later
 *
 * Depends: wp-pay/core
 *
 * GitHub URI: https://github.com/pronamic/wp-pronamic-pay-test-helper
 *
 * @author    Pronamic <info@pronamic.eu>
 * @copyright 2005-2022 Pronamic
 * @license   GPL-3.0-or-later
 */

add_action( 'init', function() {
    if ( defined( 'MOLLIE_API_KEY' ) ) {
        $mollie_config_id = get_option( 'pronamic_pay_mollie_config_id' );

        if ( 'publish' !== get_post_status( $mollie_config_id ) ) {
            $mollie_config_id = wp_insert_post(
                [
                    'post_type'   => 'pronamic_gateway',
                    'post_status' => 'publish',
                    'post_title'  => 'Mollie - Test',
                    'meta_input'  => [
                        '_pronamic_gateway_id'             => 'mollie',
                        '_pronamic_gateway_mollie_api_key' => MOLLIE_API_KEY,
                    ],
                ]
            );

            update_option( 'pronamic_pay_mollie_config_id', $mollie_config_id );
        }
    }

    if ( defined( 'BUCKAROO_WEBSITE_KEY' ) && defined( 'BUCKAROO_SECRET_KEY' ) ) {
        $buckaroo_config_id = get_option( 'pronamic_pay_buckaroo_config_id' );

        if ( 'publish' !== get_post_status( $buckaroo_config_id ) ) {
            $buckaroo_config_id = wp_insert_post(
                [
                    'post_type'   => 'pronamic_gateway',
                    'post_status' => 'publish',
                    'post_title'  => 'Buckaroo - Test',
                    'meta_input'  => [
                        '_pronamic_gateway_id'                   => 'buckaroo-test',
                        '_pronamic_gateway_buckaroo_website_key' => BUCKAROO_WEBSITE_KEY,
                        '_pronamic_gateway_buckaroo_secret_key'  => BUCKAROO_SECRET_KEY,
                    ],
                ]
            );

            update_option( 'pronamic_pay_buckaroo_config_id', $buckaroo_config_id );
        }
    }
} );
