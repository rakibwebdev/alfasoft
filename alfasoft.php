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
use AlfaSoft\EnqueueScripts as EnqueueScriptsClass;
use AlfaSoft\CustomField as CustomFieldClass;

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
			$this->createCustomField();
			add_filter('archive_template', [$this, 'get_custom_post_type_template']) ;
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

		//Create Person Post Type
		public static function createPerson()
		{
			$CreateCPT = new PostTypeClass();
		}

		// Remove Default Title and Add New Placeholder
		public static function changeTitlePlaceHolder()
		{
			if ('person' == get_post_type()) {
				$title = 'Enter Person Name';
			}

			return $title;
		}

		// Enqueue admin scripts
		public static function adminEnqueue()
		{
			$enqueue_script = new EnqueueScriptsClass();
		}

		//Create Custom Fields for the post type
		public static function createCustomField()
		{
			$customField = new CustomFieldClass();
		}

		//Archive Template
		public static function get_custom_post_type_template($archive_template)
		{
			global $post;

			if (is_post_type_archive('person')) {
				$archive_template = PLUGIN_DIR . '/archive-person.php';
			}
			return $archive_template;
		}
	}

	// instantiate the plugin class
	$wp_plugin_template = new AlfaSoft();
}
