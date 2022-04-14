<?php
/**
 * Plugin Name: keima | Set Google Analytics
 * Description:  This will add Google Analytics setting.
 * Version: 1.0.1
 * Plugin URI: 
 * Author: keima.co
 * Author URI: https://www.keima.co/
 * Text Domain: keima-set-google-analytics
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

define( 'KEIMA_SET_GOOGLE_ANALYTICS_FILE', __FILE__ );
define( 'KEIMA_SET_GOOGLE_ANALYTICS_DIR', plugin_dir_path( __FILE__ ) );
define( 'KEIMA_SET_GOOGLE_ANALYTICS_VER', '1.0.0' );

if ( ! class_exists( 'KEIMA_SET_GOOGLE_ANALYTICS' ) ) :

  class KEIMA_SET_GOOGLE_ANALYTICS {

    function __construct() {
      // Do nothing.
    }

    function initialize() {

      add_action( 'plugins_loaded', function () {
        load_plugin_textdomain( 'keima-set-google-analytics', false, 'keima-set-google-analytics/languages/' );
      });

      require_once KEIMA_SET_GOOGLE_ANALYTICS_DIR . 'includes/ksga-create-admin-page.php';
      require_once KEIMA_SET_GOOGLE_ANALYTICS_DIR . 'includes/ksga-add-scripts.php';

    }
  }

  function keima_set_google_analytics() {
    global $keima_set_google_analytics;

    // Instantiate only once.
    if ( ! isset( $keima_set_google_analytics ) ) {
      $keima_set_google_analytics = new KEIMA_SET_GOOGLE_ANALYTICS();
      $keima_set_google_analytics->initialize();
    }
    return $keima_set_google_analytics;
  }

  // Instantiate.
  keima_set_google_analytics();

endif; // class_exists check

