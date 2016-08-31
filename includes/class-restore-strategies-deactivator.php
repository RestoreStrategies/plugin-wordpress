<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.restorestrategies.org/
 * @since      1.0.0
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 * @author     Restore Strategies <info@restorestrategies.org>
 */
class Restore_Strategies_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

        $posts = query_posts(array(
            'post_type' => 'restore_strategies'
        ));

        for ($id = 0; $id < count($posts); $id++) {
            $posts[$id]->post_status = 'pending';
            wp_update_post($posts[$id]);
        }
	}

}
