<?php
/**
 *
 *===================================================================
 *
 *  Shot Library
 *-------------------------------------------------------------------
 * @package     shot
 * @author      emberlabs.org
 * @copyright   (c) 2012 emberlabs.org
 * @license     MIT License
 * @link        https://github.com/emberlabs/shot
 *
 *===================================================================
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 *
 */

namespace emberlabs\shot\Model;

/**
 * Shot - Model interface
 * 	     Provides model prototype for models to fulfill.
 *
 * @package     shot
 * @author      emberlabs.org
 * @license     http://opensource.org/licenses/mit-license.php The MIT License
 * @link        https://github.com/emberlabs/shot/
 */
abstract class ModelBase
{
	protected $data, $pending;

	public function getID()
	{
		// asdf
	}

	public function setID($name)
	{
		// asdf
	}

	abstract public function load();

	protected function get($field, $default = NULL)
	{
		// asdf
	}

	protected function set($field, $what, $value = NULL)
	{
		// asdf
	}

	public function isClean()
	{
		return (!empty($this->pending)) ? true : false;
	}

	abstract public function save();

	abstract public function delete();

	public function __get($field)
	{
		// asdf
	}

	public function __set($field)
	{
		// asdf
	}
}
