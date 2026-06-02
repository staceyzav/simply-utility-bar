<?php
/**
 * Plugin Name: Simply Utility Bar
 * Plugin URI:  https://simplydesign.com/simply-utility-bar
 * Description: A configurable utility bar above the site header, fed from a WordPress menu. Scrolls away on scroll. Integrates with Simply Client Config for brand colors.
 * Version:     1.0.3
 * Author:      Simply Design
 * Author URI:  https://simplydesign.com
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simply-utility-bar
 * Requires at least: 5.4
 * Requires PHP: 7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SIMPLY_UTILITY_BAR_VERSION', '1.0.3' );
define( 'SIMPLY_UTILITY_BAR_PATH', plugin_dir_path( __FILE__ ) );
define( 'SIMPLY_UTILITY_BAR_URL', plugin_dir_url( __FILE__ ) );

require_once SIMPLY_UTILITY_BAR_PATH . 'admin/settings.php';
require_once SIMPLY_UTILITY_BAR_PATH . 'includes/output.php';
