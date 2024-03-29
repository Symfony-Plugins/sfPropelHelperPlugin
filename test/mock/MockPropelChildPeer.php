<?php

class MockPropelChildPeer
{
  /** the default database name for this class */
  const DATABASE_NAME = 'propel_mock';

  /** the table name for this class */
  const TABLE_NAME = 'mock_propel_child';

  /** A class that can be returned by this peer. */
  const CLASS_DEFAULT = 'lib.model.MockPropelChild';

  /** The total number of columns. */
  const NUM_COLUMNS = 3;

  /** The number of lazy-loaded columns. */
  const NUM_LAZY_LOAD_COLUMNS = 0;

  /** the column name for the ID field */
  const ID = 'mock_propel_child.ID';

  /** the column name for the MOCK_PROPEL_PARENT_ID field */
  const MOCK_PROPEL_PARENT_ID = 'mock_propel_child.MOCK_PROPEL_PARENT_ID';

  /** the column name for the NAME field */
  const NAME = 'mock_propel_child.NAME';

  static public function getRelations()
  {
    return array (
      'MockPropelParent' =>
        array (
          'relatedClass' => 'MockPropelParent',
          'oneToMany' => false,
          'associateMethod' => 'addMockPropelChild',
          'leftKeys' =>
          array (
            0 => MockPropelChildPeer::MOCK_PROPEL_PARENT_ID,
          ),
          'rightKeys' =>
          array (
            0 => MockPropelParentPeer::ID,
          ),
          'joinType' => 'LEFT JOIN',
        ),
    );
  }

  public static function getCustomColumns()
  {
    return array();
  }

  public static function addCustomSelectColumns(Criteria $criteria)
  {
    foreach (MockPropelChildPeer::getCustomColumns() as $name => $clause )
    {
      $criteria->addAsColumn($name, $clause);
    }
  }

  public static function addSelectColumnsAliased(Criteria $criteria, $alias)
  {

    $criteria->addSelectColumn(MockPropelChildPeer::alias($alias, MockPropelChildPeer::ID));

    $criteria->addSelectColumn(MockPropelChildPeer::alias($alias, MockPropelChildPeer::MOCK_PROPEL_PARENT_ID));

    $criteria->addSelectColumn(MockPropelChildPeer::alias($alias, MockPropelChildPeer::NAME));

  }

  public static function alias($alias, $column)
  {
    return str_replace(MockPropelChildPeer::TABLE_NAME.'.', $alias.'.', $column);
  }

  static public function translateFieldName($name, $fromType, $toType)
  {
    return $name;
  }
}
