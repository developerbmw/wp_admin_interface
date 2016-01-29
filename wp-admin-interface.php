<?php

if (!defined('ABSPATH')) {
	exit;
}

abstract class WP_Admin_Interface
{
	protected $id;

	abstract public function register_admin_menu();

	public function __construct($id)
	{
		$this->id = $id;

		add_action('admin_menu', array($this, 'register_admin_menu'));
		add_action('wp_loaded', array($this, 'process_action'));
	}

	public function process_action()
	{
		$key = $this->id . '_action';

		if (isset($_GET[$key])) {
			$action = 'action_' . $_GET[$key];

			if (is_callable(array($this, $action))) {
				$this->{$action}();
			}
		}
	}

	public function process_display()
	{
		if (isset($_GET['display'])) {
			$display = 'display_' . $_GET['display'];
		} else {
			$display = 'display_index';
		}

		if (is_callable(array($this, $display))) {
			$this->{$display}();
		}
	}
}
