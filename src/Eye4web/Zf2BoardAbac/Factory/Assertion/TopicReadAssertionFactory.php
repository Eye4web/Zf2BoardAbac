<?php

namespace Eye4web\Zf2BoardAbac\Factory\Assertion;

use Eye4web\Zf2BoardAbac\Assertion\TopicReadAssertion;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TopicReadAssertionFactory implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * Create Assertion
     *
     * @param ServiceLocatorInterface $assertionPluginManager
     * @return TopicReadAssertion|mixed
     */
    public function __invoke(\Psr\Container\ContainerInterface $assertionPluginManager, $requestedName, array $options = null)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $assertionPluginManager;

        /** @var \Eye4web\Zf2Abac\Provider\DoctrineORMProvider $provider */
        $provider = $serviceLocator->get('Eye4web\Zf2Abac\Provider\DoctrineORMProvider');

        return new TopicReadAssertion($provider);
    }
}
