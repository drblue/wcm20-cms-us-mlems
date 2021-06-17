<?php

/**
 * Include widget class(es)
 */
require(WCMM_PLUGIN_DIR . 'includes/class.RandomMlemWidget.php');

/**
 * Register widget(s)
 */
function wcmm_widgets_init() {
	register_widget('RandomMlemWidget');
}
add_action('widgets_init', 'wcmm_widgets_init');
