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

<div class='wrap rsa'>
    <h1>Restore Strategies Settings</h1>

    <p>To setup the Restore Strategies plugin, provide your API credentials. Then, feel free to use Restore Strategies’ shortcodes throughout your site.</p>

    <p>Several shortcodes are available. For details, look at them <b><a id="rsa-reveal" href="#">here</a></b> or <b><a href="<?php echo get_site_url(); ?>/wp-admin/edit.php?s=%5BRestore+Strategies+Example%5D&post_status=all&post_type=page">check out your pages for some examples</a></b>.</p>

    <p><strong>Note: This plugin may not work correctly if your site's permalinks are set to <em>Plain</em>. Additionally the [restore-strategies-search-box] shortcode may not work as expected in post preview. You can check your permalinks settings <a href="<?php echo get_site_url(); ?>/wp-admin/options-permalink.php">here</a>.</strong></p>

    <div class="rsa-hide">
        <h2>[restore-strategies-opportunity]</h2>

        <p>This shortcode displays a single opportunity based on it’s id. For example,<br /><br />
        <kbd>[restore-strategies-opportunity id="511"]</kbd></p>
       
        <h2>[restore-strategies-featured-opportunities]</h2>

        <p>This shortcode displays opportunities that you've featured. You may feature any number of opportunities via your <a href="https://www.citysync.church/admin/featured-opps" target="_blank">City Sync admin</a>. This shortcode takes no parameters.</p>
        <kbd>[restore-strategies-featured-opportunities]</kbd>

        <h2>[restore-strategies-search]</h2>
        
        <p>This shortcode does a search & returns the results. It's the fastest way to list several opportunities on a page if they can all be found from a single search. It's possible to do an advanced search with several different parameters. The possible parameters are listed below:</p>
        
        <kbd>[restore-strategies-search q="&lt;search term&gt;" issues="&lt;issue 1&gt;,&lt;issue 2&gt;,..." regions="&lt;region 1&gt;,&lt;region 2&gt;,..." times="&lt;time 1&gt;,&lt;time 2&gt;,..." days="&lt;day 1&gt;,&lt;day 1&gt;,..."  type="&lt;opportunity type 1&gt;,&lt;opportunity type 2&gt;,..." group_type="&lt;group type 1&gt;,&lt;group type 2&gt;,..."]</kbd>
        
        <p>For example:</p>
        
        <kbd>[restore-strategies-search q="foster care" issues="Children/Youth,Sports" regions="North,Central" times="Morning,Evening" days="Monday,Thursday,Sunday" type="Service,Training" group_type="Individual,Group"]</kbd>

        <h2>[restore-strategies-slider]</h2>

        <p>This shortcode creates a slider of opportunities, it wraps any list of opportunities created by the <kbd>[restore-strategies-opportunity]</kbd>, <kbd>[restore-strategies-featured-opportunities]</kbd>, & <kbd>[restore-strategies-search]</kbd> shortcodes.</p>

        <p>For example:</p>

        <kbd>
        [restore-strategies-slider]<br >
        &nbsp;&nbsp;[restore-strategies-search q="foster care"]<br >
        &nbsp;[/restore-strategies-slider]
        </kbd>

        <p>It's possible to adjust the width & speed (in milliseconds) of the slider and whether or not to auto play it.</p>

        <p>For example:</p>

        <kbd>
        [restore-strategies-slider width="100%" auto="yes" speed="3000"]<br >
        &nbsp;&nbsp;[restore-strategies-featured-opportunities]<br >
        &nbsp;[/restore-strategies-slider]
        </kbd>

        <h2>[restore-strategies-search-box]</h2>
        
        <p>This shortcode creates a search box. The search box can be simple, with just a text input field, or advanced with several categories of check boxes. You can choose to collapse or reveal the advanced search layout by default. If you would like every search to be prefixed with a certain term, you can provide that. In advanced search, you can hide checkbox categories if you'd like. You can also create your own category. For example,<br /><br />
        <kbd>[restore-strategies-search-box advanced="yes" collapse="yes" prefix="foster care" hide="Issues,Groups" category="Engagements,Prevent,Support,Foster,Sustain,Remain"]</kbd></p>
    </div>

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
                    <p>The default message is <em>"Thank you for signing up!"</em> <b>Optionally, you can customize this to say whatever you want</b>. This will appear on the sign-up confirmation page.</p>
                </th>
                <td>
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
                    <p>Some volunteer opportunities have specific next step instructions after signup. Check this box if you <b>do not want those instructions displayed</b> on the sign-up confirmation page.</p>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[hide_message]"
                        id="<?php echo $this->plugin_name; ?>-hide_message"
                        type="checkbox"
                        value="1"
                        <?php checked($hide_message, 1); ?>
                    /> 
                </td>
            </tr>

        </table>
        <?php submit_button('Save Changes', 'primary', 'submit', true); ?>
    </form>
</div>
