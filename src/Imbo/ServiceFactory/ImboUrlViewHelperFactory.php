<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\ServiceFactory;

use Imbo\View\Helper\ImboUrl,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for creating the imboUrl view helper
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Service factories
 */
class ImboUrlViewHelperFactory implements FactoryInterface {
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        // Fetch the main service manager
        $serviceManager = $serviceLocator->getServiceLocator();

        return new ImboUrl(
            $serviceManager->get('ImboClient'),
            $serviceManager->get('config')['imboModule']['viewHelperPresets']
        );
    }
}
