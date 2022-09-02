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
	}

	public function adminEnqueue()
	{
		if (is_admin()) {
			if ('person' == get_post_type()) {
				wp_enqueue_script('alfa-admin', PLUGIN_URL . 'assets/admin/js/main.js', ['jquery'], PLUGIN_VERSION, false);
			}
		}
	}
}
