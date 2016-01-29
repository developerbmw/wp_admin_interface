<?php

if (!defined('ABSPATH')) {
	exit;
}

class WP_Example_Interface extends WP_Admin_Appearance_Interface
{
	private $errors = array();

	public function __construct()
	{
		parent::__construct('example', 'Example', 'edit_theme_options');
	}

	protected function display_index()
	{
		echo '<a href="' . $this->get_url(array('display' => 'add')) . '">Add Example Item</a>';
	}

	protected function display_add()
	{
		if (count($this->errors) > 0) {
			echo '<h4>Please correct the following errors before continuing:</h4>';

			echo '<ul>';

			foreach ($this->errors as $error) {
				echo '<li>' . $error . '</li>';
			}

			echo '</ul>';
		}

		echo '<form action="' . $this->get_url(array('display' => 'add', 'action' => 'add')) . '">';
		echo '<input type="text" name="example" />';
		echo '<input type="submit" value="Save" />';
		echo '</form>';
	}

	protected function action_add()
	{
		if (!isset($_POST['example']) || !$_POST['example']) {
			$this->errors[] = 'The example field is required';
		}

		if (count($this->errors) === 0) {
			// persist the item here

			wp_redirect($this->get_url());
			exit;
		}
	}

	protected function get_url($args = array())
	{
		// override this function to add custom parameters to URLs

		$url = parent::get_url($args);
		
		if (isset($args['item'])) {
			$url .= '&item=' . $args['item'];
		}

		return $url;
	}
}
