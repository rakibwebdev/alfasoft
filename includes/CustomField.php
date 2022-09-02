<?php
namespace AlfaSoft;

if (!defined('ABSPATH')) {
	exit;
}

class CustomField
{
	public function __construct()
	{
		if (is_admin()) {
			add_action('load-post.php', [$this, 'init_metabox']);
			add_action('load-post-new.php', [$this, 'init_metabox']);
		}
	}

	public function init_metabox()
	{
		add_action('add_meta_boxes', [$this, 'meta_box']);
		add_action('save_post', [$this, 'save_metabox'], 10, 2);

		add_action('add_meta_boxes', [$this, 'email_metabox']);
		add_action('save_post', [$this, 'save_email_metabox'], 10, 2);
	}

	public function meta_box()
	{
		add_meta_box(
			'person-id',
			__('Person ID', PLUGIN_TEXTDOMAIN),
			[$this, 'render_id_metabox'],
			'person',
			'advanced',
			'default'
		);
	}

	public function render_id_metabox($post)
	{
		$person_id    = get_post_meta($post->ID, 'person-id', true); ?>

		<input type="text" name="person-number" value=<?php echo esc_attr($person_id); ?>>
		
 
        <?php
	}

	public function email_metabox()
	{
		add_meta_box(
			'person-email',
			__('Person Email', PLUGIN_TEXTDOMAIN),
			[$this, 'render_email_metabox'],
			'person',
			'advanced',
			'default'
		);
	}

	public function render_email_metabox($post)
	{
		$person_email    = get_post_meta($post->ID, 'person-email', true); ?>
		<input type="email" name="person-email" value=<?php echo esc_attr($person_email); ?>>
		
 
        <?php
	}

	public function save_metabox($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// Check the user's permissions.
		if ('person' == get_post_type()) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}

		$id    = sanitize_text_field(isset($_POST['person-number']));

		if ($id) {
			update_post_meta($post_id, 'person-number', $id);
		}
	}

	public function save_email_metabox($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		// Check the user's permissions.
		if ('person' == get_post_type()) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} else {
			if (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}

		$email = isset($_POST['person-email']);

		if ($email) {
			update_post_meta($post_id, 'person-email', $email);
		}
	}
}
