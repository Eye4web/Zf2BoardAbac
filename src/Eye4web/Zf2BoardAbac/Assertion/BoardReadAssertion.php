<?php

namespace Eye4web\Zf2BoardAbac\Assertion;

use Eye4web\Zf2Abac\Assertion\AssertionInterface;
use Eye4web\Zf2Abac\Provider\ProviderInterface;
use Eye4web\Zf2Abac\Exception;
use Zend\Validator\ValidatorPluginManager;

class BoardReadAssertion extends  BaseAssertion
{
    protected $permissionName = 'board.read';
}
