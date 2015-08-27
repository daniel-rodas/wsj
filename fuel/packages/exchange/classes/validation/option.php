<?php

namespace Exchange\Validation;

/**
 * Validation product class.
 */
class Option
{
	/**
	 * Creates a new validation instance for product create.
	 *
	 * @return Validation
	 */
	public static function create()
	{
		$validator = Validation::forge('option');
		
		$validator->add('name', 'Name')->add_rule('trim')->add_rule('required');
		
		return $validator;
	}
	
	/**
	 * Creates a new validation instance for product update.
	 *
	 * @return Validation
	 */
	public static function update()
	{
		$validator = Validation::forge('option');
		
		$input = Input::param();
		
		if (array_key_exists('name', $input)) {
			$validator->add('name', 'Name')->add_rule('trim')->add_rule('required');
		}
		
		return $validator;
	}
}
