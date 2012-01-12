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

namespace emberlabs\shot\Live;
use \emberlabs\shot\Kernel;
use \OpenFlame\Framework\Core\DependencyInjector;
use \OpenFlame\Framework\Exception\EncryptedHandler as ExceptionHandler;
use \OpenFlame\Framework\Utility\JSON;
use \OpenFlame\Dbal\Connection as DbalConnection;
use \OpenFlame\Dbal\Query;
use \OpenFlame\Dbal\QueryBuilder;

$injector = DependencyInjector::getInstance();
// bit of a trick to trigger lazy dbal connection creation
$injector->setInjector('dbal', function() {
	// @todo connect to db here

	return true;
});

$injector->setInjector('query', function() use($injector) {
	$injector->get('dbal');
	return Query::newInstance();
});

$injector->setInjector('squery', function() use($injector) {
	$injector->get('dbal');
	return QueryBuilder::newInstance();
});
