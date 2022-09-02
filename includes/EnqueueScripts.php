<?php
namespace AlfaSoft;

if (!defined('ABSPATH')) {
	exit;
}

class EnqueueScripts
{
	public function __construct()
	{
		add_action('admin_enqueue_scripts', [
			$this, 'adminEnqueue'
		]);
		add_action('wp_enqueue_scripts', [
			$this, 'publicEnqueue'
		]);
	}

	public function adminEnqueue()
	{
		if (is_admin()) {
			if ('person' == get_post_type()) {
				wp_enqueue_script('alfa-admin', PLUGIN_URL . 'assets/admin/js/main.js', ['jquery'], PLUGIN_VERSION, false);
			}
		}
	}

	public function publicEnqueue()
	{
		wp_enqueue_style('alfa-public', PLUGIN_URL . '/assets/public/css/style.css', '', PLUGIN_VERSION, '');
	}
}
