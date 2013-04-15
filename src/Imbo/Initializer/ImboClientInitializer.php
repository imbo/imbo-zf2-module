<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\Initializer;

use Imbo\Service\ImboClientAwareInterface,
    Zend\ServiceManager\InitializerInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Service initializer for ImboClient
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module
 */
class ImboClientInitializer implements InitializerInterface {
    /**
     * Injects an ImboClient instance into controllers that implement a specific interface
     *
     * @param mixed $instance The object we want initialized
     * @param ServiceLocatorInterface $sm A service locator
     * @see InitializerInterface::initialize()
     */
    public function initialize($instance, ServiceLocatorInterface $sm) {
        if ($instance instanceof ImboClientAwareInterface) {
            $instance->setImboClient($sm->getServiceLocator()->get('ImboClient'));
        }
    }
}
