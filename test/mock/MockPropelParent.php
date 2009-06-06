<?php

class MockPropelParent extends BaseObject
{

  const PEER = 'MockPropelParentPeer';

  public function getName()
  {
    return 'Name';
  }

  public function getMyCustomGetterParent()
  {
    return 'MyCustomGetterParent';
  }
}
