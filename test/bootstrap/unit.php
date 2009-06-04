<?php

/*
 * This file is part of the symfony package.
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


$_test_dir = realpath(dirname(__FILE__).'/..');

if (!isset($_SERVER['SYMFONY']))
{
  //throw new RuntimeException('Could not find symfony core libraries.');

  $_SERVER['SYMFONY'] = $_test_dir.'/../../../lib/vendor/symfony/lib';
}

// register symfony files
require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

// register plugin libraries
require_once $_SERVER['SYMFONY'].'/autoload/sfSimpleAutoload.class.php';
sfSimpleAutoload::getInstance()->addDirectory(dirname(__FILE__).'/../../lib');
sfSimpleAutoload::register();

// load lime
require_once $_SERVER['SYMFONY'].'/vendor/lime/lime.php';

