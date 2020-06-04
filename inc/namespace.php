<?php
/**
 * Queues up the default editor settings script.
 */

namespace HM\Opt_In_Fullscreen_Mode_Dangit;

/**
 * Bootstrap the plugin.
 */
function setup() {
	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\enqueue_default_editor_settings' );
}

/**
 * Queue scripts for setting default block editor preferences in WP 5.4.
 *
 * Disables default fullscreen mode and welcome guide.
 */
function enqueue_default_editor_settings() {
	global $wp_scripts;

	wp_register_script(
		'default-editor-settings',
		plugin_dir_url( dirname( __FILE__, 2 ) ) . 'assets/editor-settings.js',
		[],
		'2020-06-04-1',
		false
	);
	wp_localize_script(
		'default-editor-settings',
		'defaultEditorSettings',
		[
			'uid' => get_current_user_id(),
		]
	);

	// Add default settings as a dependency of wp-data.
	$wp_scripts->registered['wp-data']->deps[] = 'default-editor-settings';
}
