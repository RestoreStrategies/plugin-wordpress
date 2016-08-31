<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.restorestrategies.org/
 * @since      1.0.0
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class='wrap'>
    <h1>Restore Strategies Settings</h1>


    <p>To setup the Restore Strategies plugin, provide your API credentials & create a signup page (a page with the <b>[restore-strategies-signup-form]</b> shortcode on it).</p>

    <p>Then, feel free to use Restore Strategies’ shortcodes throughout your site. Four shortcodes are available.</p>

    <h2>[restore-strategies-opportunity]</h2>

    <p>This shortcode displays a single opportunity based on it’s id. For example,<br />
    <kbd>[restore-strategies-opportunity id="511"]</kbd></p>
    
    <h2>[restore-strategies-signup-form]</h2>
    
    <p>This shortcode creates a signup form. It takes no parameters & must be used on at least one page for the plugin to work correctly.</p>
    
    <h2>[restore-strategies-search-box]</h2>
    
    <p>This shortcode creates a search box. The search box can be simple, with just a text input field, or advanced with several categories of check boxes. If you would like every search to be prefixed with a certain term, you can provide that. For example,<br />
    <kbd>[restore-strategies-search-box advanced="yes" prefix="foster care"]</kbd></p>
    
    <h2>[restore-strategies-search]</h2>
    
    <p>This shortcode does a search & returns the results. It's the fastest way to list several opportunities on a page if they can all be found from a single search. It's possible to do an advanced search with several different parameters. The possible parameters are listed below:</p>
    
    <kbd>[restore-strategies-search<br />
        &nbsp;&nbsp;q="&lt;search term&gt;"<br />
        &nbsp;&nbsp;issues="&lt;issue 1&gt;,&lt;issue 2&gt;,..."<br />
        &nbsp;&nbsp;regions="&lt;region 1&gt;,&lt;region 2&gt;,..."<br />
        &nbsp;&nbsp;times="&lt;time 1&gt;,&lt;time 2&gt;,..."<br />
        &nbsp;&nbsp;days="&lt;day 1&gt;,&lt;day 1&gt;,..."<br />
        &nbsp;&nbsp;type="&lt;opportunity type 1&gt;,&lt;opportunity type 2&gt;,..."<br />
        &nbsp;&nbsp;group_type="&lt;group type 1&gt;,&lt;group type 2&gt;,..."<br />
    ]</kbd>
    
    <p>For example:</p>
    
    <kbd>[restore-strategies-search q="foster care" issues="Children/Youth,Sports" regions="North,Central" times="Morning,Evening" days="Monday,Thursday" type="Service,Training" group_type="Individual,Group"]</kbd>
    <form method="post" action="options.php">
        <table class="form-table">
            <?php
                $options = get_option($this->plugin_name);

                $token = $options['token'];
                $secret = $options['secret'];
                $signup_url = $options['signup_url'];
                $confirmation_message = $options['confirmation_message'];
                $hide_message = $options['hide_message'];
                $include_church = $options['include_church'];
                $include_campus = $options['include_campus'];

                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
            ?>

            <tr>
                <th scope="row">
                    <label for="token">API Token*</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[token]"
                        id="<?php echo $this->plugin_name; ?>-token"
                        value="<?php if(!empty($token)) { echo $token; } ?>"
                        type="text"
                        class="regular-text"
                        required
                    />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="secret">API Secret*</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[secret]"
                        id="<?php echo $this->plugin_name; ?>-secret"
                        value="<?php if(!empty($secret)) { echo $secret; } ?>"
                        type="text"
                        class="regular-text"
                        required
                    />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="instructions">Include church</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[include_church]"
                        id="<?php echo $this->plugin_name; ?>-include_church"
                        type="checkbox"
                        value="1"
                        <?php checked($include_church, 1); ?>
                    />
                    <span>Include a field for church on the sign-up form. If not included, the church your API user is associated with will automatically be used.</span>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="instructions">Include church campus</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[include_campus]"
                        id="<?php echo $this->plugin_name; ?>-include_campus"
                        type="checkbox"
                        value="1"
                        <?php checked($include_campus, 1); ?>
                    />
                    <span>Include a field for church campus on the sign-up form.</span>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="secret">Custom confirmation message</label>
                </th>
                <td>
                    <p>Optionally, include a message that will appear on the sign-up confirmation page. The default message is "Thank you for signing up!"</p><br />
                    <textarea
                        name="<?php echo $this->plugin_name; ?>[confirmation_message]"
                        id="<?php echo $this->plugin_name; ?>-confirmation_message"
                        class="large-text"
                        rows="10"
                    ><?php if(!empty($confirmation_message)) { echo $confirmation_message; } ?></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="instructions">Hide post-signup instructions</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[hide_message]"
                        id="<?php echo $this->plugin_name; ?>-hide_message"
                        type="checkbox"
                        value="1"
                        <?php checked($hide_message, 1); ?>
                    />
                    <span>Do not display opportunity specific next step instructions on the sign-up confirmation page.</span>
                </td>
            </tr>

        </table>
        <?php submit_button('Save Changes', 'primary', 'submit', true); ?>
    </form>
</div>
