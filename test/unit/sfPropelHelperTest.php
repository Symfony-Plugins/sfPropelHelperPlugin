<?php

/*
 * This file is part of the symfony package.
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../bootstrap/unit.php');

//add propel to include-path
set_include_path($_SERVER['SYMFONY'].'/plugins/sfPropelPlugin/lib/vendor'.PATH_SEPARATOR.get_include_path());


$t = new lime_test(12, new lime_output_color());

//// initialize Propel
//$autoload = sfSimpleAutoload::getInstance(sfToolkit::getTmpDir().DIRECTORY_SEPARATOR.sprintf('sf_autoload_unit_propel_%s.data', md5(__FILE__)));
//$autoload->addDirectory(realpath($_SERVER['SYMFONY'].'/plugins/sfPropelPlugin/lib'));
//$autoload->addDirectory(realpath(dirname(__FILE__).'/model'));
//$autoload->register();

// helper methods
$t->diag('testing helper methods');

// include helper
require_once '../../lib/helper/sfPropelPropertyPathHelper.php';

// include Propel BaseClass
require_once $_SERVER['SYMFONY'].'/plugins/sfPropelPlugin/lib/vendor/propel/om/BaseObject.php';
// include model
require_once '../mock/MockPropelParent.php';
require_once '../mock/MockPropelParentPeer.php';
require_once '../mock/MockPropelChild.php';
require_once '../mock/MockPropelChildPeer.php';


$t->is(resolveBaseClass('MockPropelParent.MockPropelChild'), 'MockPropelParent', 'resolveBaseClass resolves first class from objectPath');

$t->is(resolveClassNameFromObjectPath('MockPropelChild'), 'MockPropelChild', 'resolveClassNameFromObjectPath resolves the latest class from objectPath');
$t->is(resolveClassNameFromObjectPath('MockPropelChild.MockPropelParent'), 'MockPropelParent', 'resolveClassNameFromObjectPath resolves the latest class from objectPath');
$t->is(resolveClassNameFromObjectPath('MockPropelChild.MockPropelParent.MockPropelParentRelatedByMockPropelParentId'), 'MockPropelParent', 'resolveClassNameFromObjectPath resolves the latest class from objectPath recursively');

$relation = getRelationForRelationPath('MockPropelChild.MockPropelParent');
$t->is($relation['associateMethod'], 'addMockPropelChild', 'resolveFirstAddMethodForObjectPath resolves add Method for first relation objectPath');

try
{
  checkObjectPath('MockPropelChild.MockPropelParent');
  $t->pass('checkObjectPath OK with valid Path');
}
catch (Exception $e)
{
  echo $e;
  $t->fail('checkObjectPath OK with valid Path');
}

try
{
  checkObjectPath('Invalid.Child.ChildChild');
  $t->fail('checkObjectPath throws an InvalidArgumentException with invalid Path');
}
catch (InvalidArgumentException $e)
{
  $t->pass('checkObjectPath throws an InvalidArgumentException: with invalid Path');
}

try
{
  checkObjectPath('Invalid');
  $t->fail('checkObjectPath throws an InvalidArgumentException with invalid Class ');
}
catch (InvalidArgumentException $e)
{
  $t->pass('checkObjectPath throws an InvalidArgumentException with invalid Class');
}


$classes = array();
$classes = flattenAllClasses('MockPropelChild');
$t->is(count($classes), 1, 'resolveAllClasses returns one class for "MockPropelChild"');
$classAliasses = array_keys($classes);
$t->is($classAliasses[0], 'MockPropelChild', 'resolveAllClasses returns alias "MockPropelChild"');

$classes = flattenAllClasses('MockPropelChild.MockPropelParent', $classes);
$t->is(count($classes), 2, 'resolveAllClasses correctly adds two classes');
$base = $classes['MockPropelChild'];
$t->is(count($base['relatedTo']), 1, '"MockPropelChild" correctly gets related to one child class');
