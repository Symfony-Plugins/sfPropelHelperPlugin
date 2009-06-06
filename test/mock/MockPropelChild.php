<?php

class MockPropelChild extends BaseObject
{

  const PEER = 'MockPropelChildPeer';

  public function getName()
  {
    return 'Name';
  }

  public function getMyCustomGetterChild()
  {
    return 'MyCustomGetterChild';
  }
}
