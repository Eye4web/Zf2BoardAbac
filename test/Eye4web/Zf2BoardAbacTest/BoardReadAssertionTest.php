<?php

namespace Eye4web\Zf2BoardTest\Controller;

use Eye4web\Zf2BoardAbac\Assertion\BoardReadAssertion;
use PHPUnit_Framework_TestCase;

class BoardReadAssertionTest extends PHPUnit_Framework_TestCase
{
    /** @var \Eye4web\Zf2BoardAbac\Assertion\BoardReadAssertion */
    protected $assertion;

    /** @var \Eye4web\Zf2Abac\Provider\ProviderInterface */
    protected $provider;

    public function setUp()
    {
        $provider = $this->getMock('\Eye4web\Zf2Abac\Provider\ProviderInterface');
        $this->provider = $provider;

        $this->assertion = new BoardReadAssertion($provider);
    }
    
    public function testNoPermissionGroups()
    {
        $value = 'test';

        $attributes = [
            'a' => 'b'
        ];

        $this->provider->expects($this->once())
                       ->method('getPermissions')
                       ->with('board.read', $value)
                       ->willReturn([]);
        
        $result = $this->assertion->hasPermission($value, $attributes);

        $this->assertTrue($result);
    }

    public function testMissingAttributePermissionGroups()
    {
        $value = 'test';

        $attributes = [
            'a' => 'b'
        ];

        $collection = new \Eye4web\Zf2Abac\Collections\PermissionCollection();

        $permission = $this->getMock('Eye4web\Zf2Abac\Entity\PermissionInterface');
        $collection->add($permission);

        $collections = [$collection];

        $this->provider->expects($this->once())
                       ->method('getPermissions')
                       ->with('board.read', $value)
                       ->willReturn($collections);

        $permission->expects($this->once())
                   ->method('getValueId')
                   ->willReturn('missing attribute');

        $this->setExpectedException('Eye4web\Zf2Abac\Exception\RuntimeException');

        $this->assertion->hasPermission($value, $attributes);
    }

    public function testHasPermissionOneGroupNotValid()
    {
        $value = 'test';

        $attributes = [
            'a' => 'b'
        ];

        $collection = new \Eye4web\Zf2Abac\Collections\PermissionCollection();

        $permission = $this->getMock('Eye4web\Zf2Abac\Entity\PermissionInterface');
        $collection->add($permission);

        $collections = [$collection];

        $validatorMock = $this->getMock('Zend\Validator\ValidatorInterface');

        $this->provider->expects($this->once())
                       ->method('getPermissions')
                       ->with('board.read', $value)
                       ->willReturn($collections);

        $permission->expects($this->exactly(2))
                   ->method('getValueId')
                   ->willReturn('a');

        $this->provider->expects($this->once())
                       ->method('getValidator')
                       ->with($permission)
                       ->willReturn($validatorMock);

        $validatorMock->expects($this->once())
                      ->method('isValid')
                      ->with('b')
                      ->willReturn(false);

        $result = $this->assertion->hasPermission($value, $attributes);

        $this->assertFalse($result);
    }

    public function testHasPermissionOneGroupSuccess()
    {
        $value = 'test';

        $attributes = [
            'a' => 'b'
        ];

        $collection = new \Eye4web\Zf2Abac\Collections\PermissionCollection();

        $permission = $this->getMock('Eye4web\Zf2Abac\Entity\PermissionInterface');
        $collection->add($permission);

        $collections = [$collection];

        $validatorMock = $this->getMock('Zend\Validator\ValidatorInterface');

        $this->provider->expects($this->once())
                       ->method('getPermissions')
                       ->with('board.read', $value)
                       ->willReturn($collections);

        $permission->expects($this->exactly(2))
                   ->method('getValueId')
                   ->willReturn('a');

        $this->provider->expects($this->once())
                       ->method('getValidator')
                       ->with($permission)
                       ->willReturn($validatorMock);

        $validatorMock->expects($this->once())
                      ->method('isValid')
                      ->with('b')
                      ->willReturn(true);

        $result = $this->assertion->hasPermission($value, $attributes);

        $this->assertTrue($result);
    }
}
