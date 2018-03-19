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

        $delete_posts = array_merge(
            query_posts(['s' => '[Restore Strategies Example] Opportunity']),
            query_posts(['s' => '[Restore Strategies Example] Search']),
            query_posts(['s' => '[Restore Strategies Example] Search Box']),
            query_posts(['s' => '[Restore Strategies Example] Featured Opportunities']),
            $posts
        );

        foreach ($delete_posts as $dpost) {
            wp_delete_post($dpost->ID, true);
        }
	}
}
