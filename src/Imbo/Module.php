<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo;

use ImboClient\Client,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface;


/**
 * Imbo ZF2 module
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module
 */
class Module implements ConfigProviderInterface {
    /**
     * Load default module config
     */
    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
