<?php
/**
 * Plugin Name:	WCM20 Mlems
 * Description:	This plugin adds a widget for with cute mlems/bleps
 * Version:		0.1
 * Author:		Johan Nordström
 * Author URI:	https://www.thehiveresistance.com
 * Text Domain:	wcm20-mlems
 * Domain Path:	/languages
 */

define('WCMM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WCMM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WCMM_RAPIDAPI_KEY', '5874fb1e2amshb25c49daea68c0dp150bf5jsn211ce2715bb9');
define('WCMM_RAPIDAPI_HOST', 'mlemapi.p.rapidapi.com');

/**
 * Include dependencies.
 */
require_once(WCMM_PLUGIN_DIR . 'includes/functions.php');
require_once(WCMM_PLUGIN_DIR . 'includes/mlemapi.php');
require_once(WCMM_PLUGIN_DIR . 'includes/widgets.php');
