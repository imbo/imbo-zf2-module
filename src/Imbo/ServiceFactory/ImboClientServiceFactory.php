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

use ImboClient\ImboClient,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory for creating the Imbo client
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Service factories
 */
class ImboClientServiceFactory implements FactoryInterface {
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('config')['imboModule']['imboClient'];

        // Return a new instance of the client with all available configuration options
        return ImboClient::factory(array(
            'serverUrls' => (array) $config['host'],
            'publicKey' => $config['publicKey'],
            'privateKey' => $config['privateKey'],
        ));
    }
}
