<?php

namespace Eye4web\Zf2BoardAbac\Factory\Assertion;

use Eye4web\Zf2BoardAbac\Assertion\PostWriteAssertion;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostWriteAssertionFactory implements FactoryInterface
{
    /**
     * Create Assertion
     *
     * @param ServiceLocatorInterface $assertionPluginManager
     * @return PostWriteAssertion|mixed
     */
    public function createService (ServiceLocatorInterface $assertionPluginManager)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $assertionPluginManager->getServiceLocator();

        /** @var \Eye4web\Zf2Abac\Provider\DoctrineORMProvider $provider */
        $provider = $serviceLocator->get('Eye4web\Zf2Abac\Provider\DoctrineORMProvider');

        return new PostWriteAssertion($provider);
    }
}
