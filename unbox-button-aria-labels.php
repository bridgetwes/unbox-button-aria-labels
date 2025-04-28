<?php
/**
 * Plugin Name:         Unbox Button ARIA Labels
 * Description:         Extends the WordPress button block to add ARIA label support and screen reader visibility control.
 * Requires at least:   6.7
 * Requires PHP:        7.4
 * Version:             1.0.1
 * Author:              Bridget Wessel
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         unbox
 * GitHub Plugin URI:   bridgetwes/unbox-button-aria-labels
 * GitHub Branch:       main
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'plugin-update-checker.php';

/**
 * Enqueue the block editor assets
 */
function unbox_button_aria_labels_enqueue_editor_assets(): void {
    wp_enqueue_script(
        'unbox-button-aria-label-editor',
        plugins_url('build/index.js', __FILE__),
        ['wp-blocks', 'wp-dom', 'wp-dom-ready', 'wp-edit-post'],
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js'),
        true
    );
}
add_action('enqueue_block_editor_assets', 'unbox_button_aria_labels_enqueue_editor_assets'); 