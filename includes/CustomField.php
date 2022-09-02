<?php
namespace AlfaSoft;

if (!defined('ABSPATH')) {
	exit;
}

class CustomField
{
	private $config = '{"title":"Custom Fields","prefix":"alfasoft","domain":"alfasoft","class_name":"CustomField","context":"advanced","priority":"default","cpt":"person","fields":[{"type":"email","label":"Person Email","id":"alfasoftperson-email"},{"type":"number","label":"Person ID","id":"alfasoftperson-number"}]}';

	public function __construct()
	{
		$this->config = json_decode($this->config, true);
		$this->process_cpts();
		add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
		add_action('save_post', [$this, 'save_post']);
	}

	public function process_cpts()
	{
		if (!empty($this->config['cpt'])) {
			if (empty($this->config['post-type'])) {
				$this->config['post-type'] = [];
			}
			$parts                     = explode(',', $this->config['cpt']);
			$parts                     = array_map('trim', $parts);
			$this->config['post-type'] = array_merge($this->config['post-type'], $parts);
		}
	}

	public function add_meta_boxes()
	{
		foreach ($this->config['post-type'] as $screen) {
			add_meta_box(
				sanitize_title($this->config['title']),
				$this->config['title'],
				[$this, 'add_meta_box_callback'],
				$screen,
				$this->config['context'],
				$this->config['priority']
			);
		}
	}

	public function save_post($post_id)
	{
		foreach ($this->config['fields'] as $field) {
			switch ($field['type']) {
				case 'email':
					if (isset($_POST[$field['id']])) {
						$sanitized = sanitize_email($_POST[$field['id']]);
						update_post_meta($post_id, $field['id'], $sanitized);
					}
					break;
				default:
					if (isset($_POST[$field['id']])) {
						$sanitized = sanitize_text_field($_POST[$field['id']]);
						update_post_meta($post_id, $field['id'], $sanitized);
					}
			}
		}
	}

	public function add_meta_box_callback()
	{
		$this->fields_table();
	}

	private function fields_table()
	{
		?><table class="form-table" role="presentation">
			<tbody><?php
				foreach ($this->config['fields'] as $field) {
					?><tr>
						<th scope="row"><?php $this->label($field); ?></th>
						<td><?php $this->field($field); ?></td>
					</tr><?php
				} ?></tbody>
		</table><?php
	}

	private function label($field)
	{
		switch ($field['type']) {
			default:
				printf(
					'<label class="" for="%s">%s</label>',
					$field['id'],
					$field['label']
				);
		}
	}

	private function field($field)
	{
		switch ($field['type']) {
			case 'number':
				$this->input_minmax($field);
				break;
			default:
				$this->input($field);
		}
	}

	private function input($field)
	{
		printf(
			'<input class="regular-text %s" id="%s" name="%s" %s type="%s" value="%s">',
			isset($field['class']) ? $field['class'] : '',
			$field['id'],
			$field['id'],
			isset($field['pattern']) ? "pattern='{$field['pattern']}'" : '',
			$field['type'],
			$this->value($field)
		);
	}

	private function input_minmax($field)
	{
		printf(
			'<input class="regular-text" id="%s" %s %s name="%s" %s type="%s" value="%s">',
			$field['id'],
			isset($field['max']) ? "max='{$field['max']}'" : '',
			isset($field['min']) ? "min='{$field['min']}'" : '',
			$field['id'],
			isset($field['step']) ? "step='{$field['step']}'" : '',
			$field['type'],
			$this->value($field)
		);
	}

	private function value($field)
	{
		global $post;
		if (metadata_exists('post', $post->ID, $field['id'])) {
			$value = get_post_meta($post->ID, $field['id'], true);
		} elseif (isset($field['default'])) {
			$value = $field['default'];
		} else {
			return '';
		}
		return str_replace('\u0027', "'", $value);
	}
}
