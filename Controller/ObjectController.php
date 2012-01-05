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

namespace emberlabs\shot\Controller;
use \emberlabs\shot\Kernel;
use \OpenFlame\Framework\Route\RouteInstance;
use \OpenFlame\Framework\Core\Internal\FileException;

/**
 * Shot - Controller interface
 * 	     Provides controller prototype for controllers to fulfill.
 *
 * @package     shot
 * @author      emberlabs.org
 * @license     http://opensource.org/licenses/mit-license.php The MIT License
 * @link        https://github.com/emberlabs/shot/
 */
class ObjectController implements ControllerInterface
{
	protected $name, $template, $route, $include_file, $objects;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = (string) $name;

		return $this;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function setTemplate($template)
	{
		$this->template = (string) $template;

		return $this;
	}

	public function getRoute()
	{
		return $this->route;
	}

	public function setRoute(RouteInstance $route)
	{
		$this->route = $route;

		return $this;
	}

	public function getIncludeFile()
	{
		return $this->include_file;
	}

	public function setIncludeFile($include_file)
	{
		if(!file_exists($include_file))
		{
			throw new FileException(sprintf('Controller include file "%s" does not exist', $include_file));
		}

		$this->include_file = $include_file;

		return $this;
	}

	public function getInjectedObjects()
	{
		return $this->objects;
	}

	public function setInjectedObjects(array $objects)
	{
		$this->objects = $objects;

		return $this;
	}

	public function runController()
	{
		// Assign scope variables for the controller
		$route = $this->getRoute();
		$template_name = $this->getTemplate();
		if($this->getInjectedObjects())
		{
			extract(Kernel::mget($this->getInjectedObjects()), EXTR_OVERWRITE);
		}

		// Set $return to NULL - the include file can overwrite the value itself if it wants.
		$return = NULL;

		include $this->getIncludeFile();

		return $return;
	}
}
