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
interface ModelInterface
{
	public function getID();

	public function setID($name);

	public function load();

	protected function get($field, $default = NULL);

	protected function set($field, $what, $value = NULL);

	public function save();

	public function delete();

	public function isClean();

	public function __get($field);

	public function __set($field);
}
