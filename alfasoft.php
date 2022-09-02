<?php
/**
 * Plugin Name: Alfa Soft Test Plugin
 * Text Domain: alfasoft
 */
require 'vendor/autoload.php';

// Constant
define('PLUGIN_VERSION', rand());
define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN_TEXTDOMAIN', 'alfasoft');

use AlfaSoft\CreatePersonPostType as PostTypeClass;
use AlfaSoft\EnqueueScripts as EnqueueScripts;

if (!class_exists('AlfaSoft')) {
	class AlfaSoft
	{
		/**
		 * Constructor
		 */
		public function __construct()
		{
			$this->setup_actions();
		}

		/**
		 * Setting up Hooks
		 */
		public function setup_actions()
		{
			//Main plugin hooks
			//register_activation_hook(PLUGIN_DIR, [$this, 'activate']);
			//register_deactivation_hook(DIR_PATH, ['AlfaSoft', 'deactivate']);

			$this->createPerson();
			add_filter('enter_title_here', [$this, 'changeTitlePlaceHolder']);
			$this->adminEnqueue();
		}

		/**
		 * Activate callback
		 */
		public static function activate()
		{
		}

		/**
		 * Deactivate callback
		 */
		public static function deactivate()
		{
			//Deactivation code in here
		}

		public static function createPerson()
		{
			$CreateCPT = new PostTypeClass();
			//$CreateCPT->personPostType();
		}

		public static function changeTitlePlaceHolder()
		{
			if ('person' == get_post_type()) {
				$title = 'Enter Person Name';
			}

			return $title;
		}

		public static function adminEnqueue()
		{
			$enqueue_script = new EnqueueScripts();
		}
	}

	// instantiate the plugin class
	$wp_plugin_template = new AlfaSoft();
}
