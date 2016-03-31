<?php

if (!defined('ABSPATH')) {
	exit;
}

abstract class WP_Admin_Appearance_Interface extends WP_Admin_Interface
{
	protected $title;
	protected $capability;

	public function __construct($id, $title, $capability)
	{
		parent::__construct($id);

		$this->title = $title;
		$this->capability = $capability;
	}

	public function register_admin_menu()
	{
		add_theme_page($this->title, $this->title, $this->capability, $this->id, array($this, 'process_display'));
	}

	protected function get_url($args = array())
	{
		$url = admin_url('themes.php?page=' . $this->id);

		if (isset($args['display'])) {
			$url .= '&display=' . $args['display'];
		}

		if (isset($args['action'])) {
			$url .= '&' . $this->id . '_action=' . $args['action'];
		}

		return $url;
	}
}
