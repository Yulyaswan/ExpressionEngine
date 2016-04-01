<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2016, EllisLab, Inc.
 * @license		https://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.2.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine Update Class
 *
 * @package		ExpressionEngine
 * @subpackage	Core
 * @category	Core
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class Updater {

	var $version_suffix = '';

	/**
	 * Do Update
	 *
	 * @return TRUE
	 */
	public function do_update()
	{
		$steps = new ProgressIterator(
			array(
				'add_can_debug_column',
			)
		);

		foreach ($steps as $k => $v)
		{
			$this->$v();
		}

		return TRUE;
	}

	/**
	 * Adds the "can_debug" column to the sessions table
	 * @return void
	 */
	private function add_can_debug_column()
	{
		if ( ! ee()->db->field_exists('can_debug', 'sessions'))
		{
			ee()->smartforge->add_column(
				'sessions',
				array(
					'can_debug' => array(
						'type'       => 'char',
						'constraint' => 1,
						'default'    => 'n',
						'null'       => FALSE
					)
				)
			);
		}
	}
}

// EOF
