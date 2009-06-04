<?php

class MockPropelParentPeer
{
  /** the default database name for this class */
  const DATABASE_NAME = 'propel';

  /** the table name for this class */
  const TABLE_NAME = 'mock_propel_parent';

  /** A class that can be returned by this peer. */
  const CLASS_DEFAULT = 'lib.model.MockPropelParent';

  /** The total number of columns. */
  const NUM_COLUMNS = 3;

  /** The number of lazy-loaded columns. */
  const NUM_LAZY_LOAD_COLUMNS = 0;

  /** the column name for the ID field */
  const ID = 'mock_propel_parent.ID';

  /** the column name for the MOCK_PROPEL_PARENT_ID field */
  const MOCK_PROPEL_PARENT_ID = 'mock_propel_parent.MOCK_PROPEL_PARENT_ID';

  /** the column name for the NAME field */
  const NAME = 'mock_propel_parent.NAME';


  static public function getRelations()
  {
    return array (
      'MockPropelParentRelatedByMockPropelParentId' =>
        array (
          'relatedClass' => 'MockPropelParent',
          'oneToMany' => false,
          'associateMethod' => 'addMockPropelParentRelatedByMockPropelParentId',
          'leftKeys' =>
          array (
            0 => MockPropelParentPeer::MOCK_PROPEL_PARENT_ID,
          ),
          'rightKeys' =>
          array (
            0 => MockPropelParentPeer::ID,
          ),
          'joinType' => 'LEFT JOIN',
        ),
      'MockPropelParentsRelatedByMockPropelParentId' =>
        array (
          'relatedClass' => 'MockPropelParent',
          'oneToMany' => true,
          'associateMethod' => 'setMockPropelParentRelatedByMockPropelParentId',
          'leftKeys' =>
          array (
            0 => MockPropelParentPeer::ID,
          ),
          'rightKeys' =>
          array (
            0 => MockPropelParentPeer::MOCK_PROPEL_PARENT_ID,
          ),
          'joinType' => 'LEFT JOIN',
        ),
      'MockPropelChilds' =>
        array (
          'relatedClass' => 'MockPropelChild',
          'oneToMany' => true,
          'associateMethod' => 'setMockPropelParent',
          'leftKeys' =>
          array (
            0 => MockPropelParentPeer::ID,
          ),
          'rightKeys' =>
          array (
            0 => MockPropelChildPeer::MOCK_PROPEL_PARENT_ID,
          ),
          'joinType' => 'LEFT JOIN',
        ),
    );
  }
}
