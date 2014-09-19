<?php

namespace Eye4web\Zf2BoardAbac\Assertion;

use Eye4web\Zf2Abac\Assertion\AssertionInterface;
use Eye4web\Zf2Abac\Provider\ProviderInterface;
use Eye4web\Zf2Abac\Exception;
use Zend\Validator\ValidatorPluginManager;

class PageViewAssertion implements AssertionInterface
{
    /** @var ProviderInterface */
    protected $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $value
     * @param array $attributes
     * @return bool
     * @throws \Eye4web\Zf2Abac\Exception\RuntimeException
     */
    public function hasPermission($value, array $attributes)
    {
        $permissionGroups = $this->provider->getPermissions('page', $value);

        if (!count($permissionGroups)) {
            return true;
        }

        foreach ($permissionGroups as $group) {
            foreach ($group as $permission) {
                if (!isset($attributes[$permission->getValueId()])) {
                    throw new Exception\RuntimeException(sprintf(
                        'No value set for permission with id %s',
                        $permission->getId()
                    ));
                }

                $validator = $this->provider->getValidator($permission);

                if (!$validator->isValid($attributes[$permission->getValueId()])) {
                    break;
                }

                return true;
            }
        }

        return false;
    }
}