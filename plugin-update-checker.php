<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

$plugin_update_checker_path = plugin_dir_path( __FILE__ ) . 'vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';

if (file_exists($plugin_update_checker_path)) {
    require_once $plugin_update_checker_path;
} 
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

function unbox_button_aria_labels_plugin_updater() {
    if ( class_exists( 'YahnisElsts\PluginUpdateChecker\v5\PucFactory' ) ) {
        $myUpdateChecker = PucFactory::buildUpdateChecker(
            'https://github.com/bridgetwes/unbox-button-aria-labels/',
            plugin_dir_path( __FILE__ ) . 'unbox-button-aria-labels.php', // Change to point to main plugin file
            'unbox-button-aria-labels'
        );
        
        // Set the branch that contains the stable release.
        $myUpdateChecker->setBranch('main');        
    }
}
add_action('init', 'unbox_button_aria_labels_plugin_updater'); 