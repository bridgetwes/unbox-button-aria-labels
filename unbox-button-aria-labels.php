<?php
/**
 * Plugin Name:         Unbox Button ARIA Labels
 * Description:         Extends the WordPress button block to add ARIA label support and screen reader visibility control.
 * Requires at least:   6.7
 * Requires PHP:        7.4
 * Version:             1.0.5
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

/**
 * Check if unbox-github-updater plugin is active and modify plugin description
 */
function unbox_button_aria_labels_check_dependencies() {
    // Check if unbox-github-updater plugin is active
    if (!is_plugin_active('unbox-github-updater/unbox-github-updater.php')) {
        // Add filter to modify plugin description
        add_filter('plugin_row_meta', 'unbox_button_aria_labels_add_dependency_warning', 10, 2);
    }
}
add_action('load-plugins.php', 'unbox_button_aria_labels_check_dependencies');

/**
 * Add warning about missing unbox-github-updater plugin
 */
function unbox_button_aria_labels_add_dependency_warning($links, $file) {
    if ($file === plugin_basename(__FILE__)) {
        $warning = '<div style="margin-top: 8px; padding: 8px; background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px; color: #856404;"><strong>⚠️ Warning:</strong> The Unbox GitHub Updater plugin is not installed or active. This plugin is required for automatic updates. You can download the latest release of the Unbox GitHub Updater <a href="https://github.com/bridgetwes/unbox-github-updater">here</a>.</div>';
        $links[] = $warning;
    }
    return $links;
}

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