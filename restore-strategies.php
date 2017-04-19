<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.restorestrategies.org/
 * @since             1.0.0
 * @package           Restore_Strategies
 *
 * @wordpress-plugin
 * Plugin Name:       Restore Strategies
 * Plugin URI:        https://github.com/RestoreStrategies/plugin-wordpress
 * Description:       The WordPress plugin for the Restore Strategies API.
 * Version:           1.0.4
 * Author:            Restore Strategies
 * Author URI:        http://www.restorestrategies.org/
 * License:           MIT
 * Text Domain:       restore-strategies
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-restore-strategies-activator.php
 */
function activate_restore_strategies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restore-strategies-activator.php';
	Restore_Strategies_Activator::activate();
}


add_action( 'init', 'restore_strategies_create_post_type' );
function restore_strategies_create_post_type() {
    register_post_type( 'restore_strategies',
        array(
            'rewrite' => array('slug' => 'rs', 'with_front' => false),
            'public' => false,
            'publicly_queryable' => true
        )
    );
    flush_rewrite_rules(false);
}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-restore-strategies-deactivator.php
 */
function deactivate_restore_strategies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restore-strategies-deactivator.php';
	Restore_Strategies_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_restore_strategies' );
register_deactivation_hook( __FILE__, 'deactivate_restore_strategies' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-restore-strategies.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_restore_strategies() {

	$plugin = new Restore_Strategies();
	$plugin->run();

}
run_restore_strategies();
