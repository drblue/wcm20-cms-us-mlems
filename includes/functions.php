<?php

if (!function_exists('pre')) {
	/**
	 * Print human-readable information about a variable, wrapped in HTML `<pre>`-tags.
	 *
	 * @param mixed $obj
	 * @return string
	 */
	function pre($obj) {
		return sprintf("<pre>%s</pre>", print_r($obj, true));
	}
}

function wcmm_enqueue_styles() {
	wp_enqueue_style('wcm20-mlems-styles', WCMM_PLUGIN_URL . "assets/css/wcm20-mlems.css", [], "0.1", "screen");

	wp_enqueue_script('wcm20-mlems', WCMM_PLUGIN_URL . "assets/js/wcm20-mlems.js", [], "0.1", true);
	wp_localize_script('wcm20-mlems', 'wcmm_settings', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'messages' => [],
	]);
}
add_action('wp_enqueue_scripts', 'wcmm_enqueue_styles');

/**
 * Respond to incoming ajax-request with action "wcmm_get_random_mlem"
 *
 * @return void
 */
function wcmm_ajax_get_random_mlem() {
	// get random mlem
	$mlem_response = mlem_get_random_mlem();

	// did we fail to get a mlem?
	if (!$mlem_response['success']) {
		wp_send_json_error(__('Could not get a mlem/blep for you 😔', 'wcm20-mlems'));
	}

	// respond with mlem
	wp_send_json_success($mlem_response['data']);
}
add_action('wp_ajax_wcmm_get_random_mlem', 'wcmm_ajax_get_random_mlem');
add_action('wp_ajax_nopriv_wcmm_get_random_mlem', 'wcmm_ajax_get_random_mlem');

/**
 * Initialize plugin.
 *
 * @return void
 */
function wcmm_plugin_loaded() {
	// Load plugin translations
	load_plugin_textdomain('wcm20-mlems', false, WCMM_PLUGIN_DIR . 'languages/');
}
add_action('plugins_loaded', 'wcmm_plugin_loaded');


/**
 * Override loading of textdomain for this plugin.
 *
 * @param string $mofile
 * @param string $domain
 * @return string
 */
function wcmm_load_textdomain($mofile, $domain) {
	if ($domain === 'wcm20-mlems' && strpos($mofile, WP_LANG_DIR . '/plugins/') !== false) {
		$locale = apply_filters('plugin_locale', determine_locale(), $domain);
		$mofile = WCMM_PLUGIN_DIR . 'languages/' . $domain . '-' . $locale . '.mo';
	}
	return $mofile;
}
add_filter('load_textdomain_mofile', 'wcmm_load_textdomain', 10, 2);
