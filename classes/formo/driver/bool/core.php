<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Formo_Driver_Bool_Core class.
 * 
 * @package  Formo
 */
class Formo_Driver_Bool_Core extends Formo_Driver_Core {

	protected $view = 'bool';
	public $empty_input = TRUE;
		
	public function checked()
	{
		// Check if field was sent. If so, the new value shoulda been posted
		if ($this->field->sent() AND Formo::notset($this->field->get('new_value')))
			return FALSE;
						
		return $this->val() == TRUE;
	}
	
	public function getval()
	{
		// If the form was sent but the field wasn't set, return empty array as value
		if ($this->field->sent() AND Formo::notset($this->field->get('new_value')))
			return FALSE;
			
		// Otherwise return the value that's set
		return ( ! Formo::notset($this->field->get('new_value')))
			? (bool) $this->field->get('new_value')
			: (bool) $this->field->get('value');
	}
	
	public function not_empty()
	{
		// If it's checked, it is not empty
		return $this->checked() === TRUE;
	}
	
	// Make the field checked
	public function check()
	{
		// Set this value to 1
		$this->field->set('value', TRUE);
	}
	
	public function uncheck()
	{
		$this->field->set('value', 0);
	}
	
	protected function html()
	{
		$this->render_field
			->set('tag', 'input')
			->attr('type', 'checkbox')
			->attr('name', $this->field->alias())
			->attr('value', 1);
		
		$parent_value = $this->render_field->parent()->val();
		
		if ($this->field->checked())
		{
			$this->render_field->attr('checked', 'checked');
		}
	}

}