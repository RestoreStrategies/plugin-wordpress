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
                $signup_url = $options['signup_url'];

                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
            ?>

            <tr>
                <th scope="row">
                    <label for="token">API Token</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[token]"
                        id="<?php echo $this->plugin_name; ?>-token"
                        value="<?php if(!empty($token)) { echo $token; } ?>"
                        type="text"
                        class="regular-text"
                    />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="secret">API Secret</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[secret]"
                        id="<?php echo $this->plugin_name; ?>-secret"
                        value="<?php if(!empty($secret)) { echo $secret; } ?>"
                        type="text"
                        class="regular-text"
                    />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="token">Signup page URL</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[signup_url]"
                        id="<?php echo $this->plugin_name; ?>-signup_url"
                        value="<?php if(!empty($signup_url)) { echo $signup_url; } ?>"
                        type="text"
                        class="regular-text"
                    />
                    <span>The relative URL of the page you want to use for the signup form.</span>
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
                    <span>If you'd like volunteers to indicate which church they're a part of.</span>
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
                    <span>If you'd like volunteers to indicate which church campus they're a part of.</span>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="secret">Custom confirmation message</label>
                </th>
                <td>
                    <p>If you would like to include a custom signup confirmation message, put it here. This message will appear above the opportunity's specific confirmation message.</p><br />
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
                    <label for="instructions">Hide specific confirmation message</label>
                </th>
                <td>
                    <input
                        name="<?php echo $this->plugin_name; ?>[hide_message]"
                        id="<?php echo $this->plugin_name; ?>-hide_message"
                        type="checkbox"
                        value="1"
                        <?php checked($hide_message, 1); ?>
                    />
                    <span>Check this if you do not want the opportunity's additional signup instructions to appear on the signup confirmation page.</span>
                </td>
            </tr>

        </table>
        <?php submit_button('Save Changes', 'primary', 'submit', true); ?>
    </form>
</div>
