<?php

namespace Eye4web\Zf2BoardAbac\Factory\Assertion;

use Eye4web\Zf2BoardAbac\Assertion\TopicWriteAssertion;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TopicReadAssertionFactory implements FactoryInterface
{
    /**
     * Create Assertion
     *
     * @param ServiceLocatorInterface $assertionPluginManager
     * @return TopicWriteAssertion|mixed
     */
    public function createService (ServiceLocatorInterface $assertionPluginManager)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $assertionPluginManager->getServiceLocator();

        /** @var \Eye4web\Zf2Abac\Provider\DoctrineORMProvider $provider */
        $provider = $serviceLocator->get('Eye4web\Zf2Abac\Provider\DoctrineORMProvider');

        return new TopicWriteAssertion($provider);
    }
}
