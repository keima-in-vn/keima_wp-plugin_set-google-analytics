<?php

add_action('admin_menu', function () {
  if ( current_user_can('administrator') ) {
    add_submenu_page('options-general.php', __('Set Google Analytics', 'keima-set-google-analytics'), __('Set Google Analytics', 'keima-set-google-analytics'), 'manage_options', 'keima_set_google_analytics', 'ksga_admin_page');

    add_action( 'admin_init', 'ksga_register_settings' );
  }
});

function ksga_register_settings() {
  register_setting( 'ksga_setting', 'ksga_ga_id' );
  register_setting( 'ksga_setting', 'ksga_ga_user_id_available' );
}

function ksga_admin_page () {
  ?>
  <div class="wrap">
    <h1><?php _e('Set Google Analytics', 'keima-set-google-analytics') ?></h1>

    <div class="fields">
      <form method="post" action="options.php">
        <?php settings_fields( 'ksga_setting' ); ?>
        <?php do_settings_sections( 'ksga_setting' ); ?>
        <table class="form-table">

          <tr valign="top">
            <th scope="row"><?php _e('Google Analytics ID', 'keima-set-google-analytics') ?></th>
            <td>
              <input type="text" name="ksga_ga_id" id="ksga_ga_id" size="30" value="<?php echo esc_attr( get_option('ksga_ga_id') ); ?>" />
              <p class="description" id="new-admin-email-description"><?php _e('Such as "G-XXXXXXXXXX"', 'keima-set-google-analytics') ?></strong></p>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row"><?php _e('Include user ID in log', 'keima-set-google-analytics') ?></th>
            <td>
              <?php $ga_user_id_available = get_option( 'ksga_ga_user_id_available' ); ?>
              <label>
                <input type="radio" name="ksga_ga_user_id_available" value="1" <?php checked(1, $ga_user_id_available, true); ?> /><?php _e('Yes', 'keima-set-google-analytics') ?>
              </label>
              <label>
                <input type="radio" name="ksga_ga_user_id_available" value="2" <?php checked(2, $ga_user_id_available, true); ?> /><?php _e('No', 'keima-set-google-analytics') ?>
              </label>
            </td>
          </tr>

        </table>

        <?php submit_button(); ?>

      </form>
    </div>
  </div>
  <?php
}