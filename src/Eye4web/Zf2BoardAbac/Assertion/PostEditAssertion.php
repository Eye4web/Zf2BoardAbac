<?php

namespace Eye4web\Zf2BoardAbac\Assertion;

use Eye4web\Zf2Abac\Exception;
use Eye4web\Zf2BoardAbac\Assertion\BaseAssertion;
use Zend\Validator\ValidatorPluginManager;

class PostEditAssertion extends BaseAssertion
{
    protected $permissionName = 'post.edit';
}
