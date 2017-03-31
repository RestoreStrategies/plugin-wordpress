<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.restorestrategies.org/
 * @since      1.0.0
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/public
 * @author     Restore Strategies <info@restorestrategies.org>
 */
class Restore_Strategies_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    private $client;

    private $include_church;
    private $include_campus;
    private $hide_message;
    private $confirmation_message;
    private $signup_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


        $options = get_option($this->plugin_name);

        $this->confirmation_message = $options['confirmation_message'];
        $this->hide_message = $options['hide_message'];
        $this->include_church = $options['include_church'];
        $this->include_campus = $options['include_campus'];
        $this->signup_url = $options['signup_url'];


        $this->client = new RestoreStrategiesClient(
            $options['token'],
            $options['secret']
        );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Restore_Strategies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Restore_Strategies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/restore-strategies-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'restore-strategies-customize', plugin_dir_url( __FILE__ ) . '../customize.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Restore_Strategies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Restore_Strategies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/restore-strategies-public.js', array( 'jquery' ), $this->version, false );

	}

    public function restore_strategies_template($single_template) {
        $post = get_post();

        if($post->post_type == 'restore_strategies') {
            $single_template = dirname(__FILE__) . '/partials/restore-strategies-template.php';
        }

        return $single_template;
    }

    public function issues() {
        return [
            'Children/Youth',
            'Elderly',
            'Family/Community',
            'Foster Care/Adoption',
            'Healthcare',
            'Homelessness',
            'Housing',
            'Human Trafficking',
            'International/Refugee',
            'Job Training',
            'Sanctity of Life',
            'Sports',
            'Incarceration'
        ];
    }

    public function regions() {
        return [
            'North',
            'Central',
            'East',
            'West',
            'Other'
        ];
    }

    public function days() {
        return [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
    }

    public function times() {
        return [
            'Morning',
            'Mid-Day',
            'Afternoon',
            'Evening'
        ];
    }

    public function types() {
        return [
            'Gift',
            'Service',
            'Training'
        ];
    }

    public function group_types() {
        return [
            'Individual',
            'Group',
            'Family'
        ];
    }

    public function confirmation_message() {
        if (strlen($this->confirmation_message) > 0) {
            return $this->confirmation_message;
        }

        return "<p>Thank you for signing up!</p>";
    }

    public function signup_url() {
        return $this->signup_url;
    }

    public function hide_message() {
        if ($this->hide_message == "1") {
            return true;
        }

        return false;
    }

    public function include_church() {
        if ($this->include_church == "1") {
            return true;
        }

        return false;
    }

    public function include_campus() {
        if ($this->include_campus == "1") {
            return true;
        }

        return false;
    }

    private function opportunity($id) {
        $response = $this->client->getOpportunity($id);
        return $response->items()[0];
    }

    private function search($atts, $prefix) {
        $keys = array_keys($atts);

        for ($i = 0; $i < count($keys); $i++) {
            if (!is_array($atts[$keys[$i]])) {
                $atts[$keys[$i]] = explode(',', $atts[$keys[$i]]);
            }
        }

        if (!empty($atts['q'])) {
            $atts['q'] = $atts['q'][0];
        }

        if (!empty($prefix)) {
            $atts['q'] = $prefix . ' ' . $atts['q'];
        }

        if (!empty($atts['custom_category'])) {
            $atts['q'] .= implode(' ', $atts['custom_category']);
            unset($atts['custom_category']);
        }

        $response = $this->client->search($atts);

        $items = $response->items();

        $html = '';

        if (count($items) == 0) {
            return '<p>no results found</p>';
        }

        for ($i = 0; $i < count($items); $i++) {
            $html .= self::opportunity_html($items[$i]);
        }

        return $html;
    }

    private function opportunity_html($opp, $class = 'restore-strategies-opp-group') {

        ob_start();
        include('partials/restore-strategies-opportunity.php');
        return ob_get_clean();
    }

    private function search_results_html($prefix) {
        unset($_GET['page_id']);
        unset($_GET['id']);
        unset($_GET['preview']);
        unset($_GET['preview_id']);
        unset($_GET['preview_nonce']);

        if(empty($_GET)) {
            return '';
        }

        return self::search($_GET, $prefix);
    }

    public function validate_signup($data) {
        $valid = !empty($data['givenName']) &&
                strlen($data['givenName']) > 0 &&
                is_string($data['givenName']) &&
                !empty($data['familyName']) &&
                strlen($data['familyName']) > 0 &&
                is_string($data['familyName']) &&
                !empty($data['email']) &&
                strlen($data['email']) > 5 &&
                is_string($data['email']) &&
                !empty($data['telephone']) &&
                strlen($data['telephone']) > 3 &&
                is_string($data['telephone']);

        return $valid;
    }

    public function opportunity_shortcode($atts) {
        if (!empty($atts['id'])) {
            $opp = self::opportunity($atts['id']);
            $class = 'restore-strategies-opp-group';
            return self::opportunity_html($opp, $class);
        }
        else if (!empty($_GET['opportunity_id'])) {
            $opp = self::opportunity($_GET['opportunity_id']);
            $class='restore-strategies-opp-single';
            return self::opportunity_html($opp, $class);
        }

        return '<p class="error">valid id not given</p>';
    }

    public function search_shortcode($atts) {
        return self::search($atts, null);
    }

    /*
     * [search-box category="Stages,Fast,Slow,First,Last"]
     */ 
    public function search_box_shortcode($atts) {
        $prefix = null;
        $advanced = false;
        $collapse = true;
        $exclude = [];

        $category_title = null;
        $category = [];

        if (!empty($atts['category'])) {
            $category = explode(',', $atts['category']);
            $category_title = array_shift($category);
        }

        if (!empty($atts['hide'])) {
            $exclude = explode(',', $atts['hide']);
        }

        if (!empty($atts['prefix'])) {
            $prefix = $atts['prefix'];
        }

        if (!empty($atts['advanced']) && strtolower($atts['advanced']) == 'yes') {
            $advanced = true;
        }

        if (!empty($atts['collapse']) && strtolower($atts['collapse']) == 'no') {
            $collapse = false;
        }

        ob_start();
        include('partials/restore-strategies-search-box.php');
        return ob_get_clean();
    }

    public function signup_form_shortcode() {
        $id = $_GET['opportunity_id'];

        if (!empty($id)) {
            include('partials/restore-strategies-signup.php');
        }
        else {
            return '';
        }
    }
}
