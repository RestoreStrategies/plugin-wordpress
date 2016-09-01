<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.restorestrategies.org/
 * @since      1.0.0
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 * @author     Restore Strategies <info@restorestrategies.org>
 */
class Restore_Strategies_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        $posts = query_posts(array(
            'post_type' => 'restore_strategies'
        ));

        if (count($posts) > 1) {
            for ($id = 0; $id < count($posts); $id++) {
                $posts[$id]->post_status = 'publish';
                wp_update_post($posts[$id]);
            }
        }
        else {
            wp_insert_post(
                array(
                    'post_title' => 'Signup',
                    'post_content' => '[restore-strategies-signup-form]',
                    'comment_status' => 'closed',
                    'post_type' => 'restore_strategies',
                    'post_status' => 'publish',
                    'post_name' => 'form'
                ),
                true
            );

            wp_insert_post(
                array(
                    'post_title' => 'Volunteer Opportunity',
                    'post_content' => '[restore-strategies-opportunity]',
                    'comment_status' => 'closed',
                    'post_type' => 'restore_strategies',
                    'post_status' => 'publish',
                    'post_name' => 'show'
                ),
                true
            );

        }
	}

}
