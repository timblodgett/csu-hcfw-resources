<?php
/**
 * Plugin Name: HCFW Resources
 * Plugin URI:  https://web.colostate.edu/
 * Description: Custom resources for CSU Homecoming & Family Weekend.
 * Author:      CSU Web Communications
 * Author URI:  https://web.colostate.edu/
 *
 * Version:     1.0.0
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: csu-hcfw-resources
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Enqueue scripts and styles.
function csu_hcfw_resources_load_scripts() {
	wp_enqueue_style( 'csu-hcfw-resources-styles', plugin_dir_url( __FILE__ ) . 'includes/css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'csu_hcfw_resources_load_scripts' );


// Call in necessary files.
require plugin_dir_path( __FILE__ ) . 'includes/custom-post-types/hcfw-event.php';
require plugin_dir_path( __FILE__ ) . 'includes/custom-post-types/timeline.php';

require plugin_dir_path( __FILE__ ) . 'includes/taxonomies/location.php';
require plugin_dir_path( __FILE__ ) . 'includes/taxonomies/organization.php';
require plugin_dir_path( __FILE__ ) . 'includes/taxonomies/audience.php';
require plugin_dir_path( __FILE__ ) . 'includes/taxonomies/event_year.php';

require plugin_dir_path( __FILE__ ) . 'includes/g_forms/dynamic-form-values.php';
require plugin_dir_path( __FILE__ ) . 'includes/g_forms/submit-an-event.php';
