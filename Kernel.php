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

namespace emberlabs\shot;
use \OpenFlame\Framework\Core\Core;
use \OpenFlame\Framework\Core\DependencyInjector;
use \OpenFlame\Framework\Event\Dispatcher;
use \OpenFlame\Framework\Event\Instance as Event;

/**
 * Shot - Web Kernel
 * 	     Provides shortcuts to commonly used web functionality.
 *
 * @package     shot
 * @author      emberlabs.org
 * @license     http://opensource.org/licenses/mit-license.php The MIT License
 * @link        https://github.com/emberlabs/shot/
 */
class Kernel extends Core
{
	const VERSION = '1.0.0-dev';

	const TRIGGER_NOBREAK = 1;
	const TRIGGER_MANUALBREAK = 2;
	const TRIGGER_RETURNBREAK = 3;
	const TRIGGER_MIXEDBREAK = 4;

	protected static $init = false;

	protected static $dispatcher;

	protected static $injector;

	protected static function _init()
	{
		self::$injector = DependencyInjector::getInstance();
		self::$dispatcher = self::$injector->get('dispatcher');

		self::$init = true;
	}

	public static function get($object)
	{
		if(!self::$init)
		{
			self::_init();
		}

		return self::$injector->get($object);
	}

	public static function register($event, $priority, $listener, $limit = -1)
	{
		if(!self::$init)
		{
			self::_init();
		}

		return self::$dispatcher->register($event, $priority, $listener, $limit);
	}

	public static function trigger($event_name, $dispatch_type = self::TRIGGER_NOBREAK)
	{
		return self::$dispatcher->trigger(Event::newEvent($event_name), $dispatch_type);
	}

	public static function _trigger(Event $event, $dispatch_type = self::TRIGGER_NOBREAK)
	{
		return self::$dispatcher->trigger($event), $dispatch_type);
	}

	public static function burstTrigger(array $events)
	{
		foreach($events as $event)
		{
			if($event instanceof Event)
			{
				self::_trigger($event);
			}
			else
			{
				self::trigger($event);
			}
		}
	}
}
