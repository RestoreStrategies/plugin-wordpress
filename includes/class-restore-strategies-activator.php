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

        $opp_example_copy = 'Display a single opportunity using the <b>opportunity shortcode</b>. For this, you <em>need to have a valid opportunity id</em>.

<em>Here\'s an example using the id 511. (Note that this opportunity may not be available in your region).</em>

[restore-strategies-opportunity id="511"]';

        $search_example_copy = '<b>The fastest way to display several similar opportunities on a page</b> is to use the <b>search shortcode</b>. Based on a specific, hardcoded search it displays a list of opportunities. The search shortcode has <em>7 optional parameters</em>.
<ol>
 	<li><strong>q</strong>. A search query, some text you want to search for</li>
 	<li><strong>issues</strong>. Issues you want to filter by, possible issues include Children/Youth, Elderly, Family/Community, Foster Care/Adoption, Healthcare, Homelessness, Housing, Human Trafficking, International/Refugee, Job Training, Sanctity of Life, Sports, &amp; Incarceration</li>
 	<li><strong>regions</strong>. Geographical regions the opportunity is located in. Possible regions include North, Central, East, West, &amp; Other</li>
 	<li><strong>times</strong>. Times of day the opportunity occurs at. Possible times include Morning, Mid-Day, Afternoon, &amp; Evening</li>
 	<li><strong>days</strong>. Days of the week the opportunity occurs on. Possible days include Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, &amp; Sunday</li>
 	<li><strong>type</strong>. Type of opportunity. Possible types include Gift, Service, &amp; Training</li>
 	<li><strong>group_type</strong>. Volunteer group type. Possible types include Individual, Group, &amp; Family</li>
</ol>
<em>Here\'s an example using all of the parameters.</em>

[restore-strategies-search q="foster care" issues="Children/Youth,Sports" regions="North,Central" times="Morning,Evening" days="Monday,Thursday" type="Service,Training" group_type="Individual,Group"]
';

        $searchbox_example_copy = 'Display a search box for users can search opportunities using the <b>search box</b> shortcode. The search box shortcode has <em>2 optional parameters</em>.
<ol>
 	<li><strong>advanced</strong>. Display advanced search options</li>
 	<li><strong>prefix</strong>. Put text here that you would like to include in all of the searches done with this search box.</li>
</ol>
In this example advanced search options will be displayed &amp; every search will be prefixed with the words "foster care".

[restore-strategies-search-box advanced="yes" prefix="foster care"]

In this example advanced search options will not be displayed &amp; searches will not be prefixed with anything.

[restore-strategies-search-box]';

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

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Opportunity',
                'post_content' => $opp_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Search',
                'post_content' => $search_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Search Box',
                'post_content' => $searchbox_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );
	}

}
