<?php

namespace Eye4web\Zf2BoardAbac\Assertion;

use Eye4web\Zf2Abac\Assertion\AssertionInterface;
use Eye4web\Zf2Abac\Provider\ProviderInterface;
use Eye4web\Zf2Abac\Exception;
use Zend\Validator\ValidatorPluginManager;

class BaseAssertion implements AssertionInterface
{
    /** @var ProviderInterface */
    protected $provider;

    protected $permissionName = false;

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
        if (!$this->permissionName || empty($this->permissionName)) {
            throw new \Exception('Please provide a permission name');
        }

        $permissionGroups = $this->provider->getPermissions($this->permissionName, $value);

        if (!count($permissionGroups)) {
            return true;
        }

        foreach ($permissionGroups as $group) {
            foreach ($group as $permission) {
                if (!isset($attributes[$permission->getValueId()])) {
                    return false;
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
