<?php
namespace AlfaSoft;

if (!defined('ABSPATH')) {
	exit;
}

class EnqueueScripts
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', [
			$this, 'adminEnqueue'
		]);
	}

	public function adminEnqueue()
	{
		if (is_admin()) {
			wp_enqueue_script('alfa-admin', PLUGIN_URL . 'assets/admin/js/main.js', ['jquery'], PLUGIN_VERSION, false);
		}
	}
}
