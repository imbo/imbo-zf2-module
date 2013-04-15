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

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Imbo module
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module
 */
class Module implements ConfigProviderInterface {
    /**
     * {@inheritdoc}
     */
    public function getConfig() {
        return require __DIR__ . '/../../config/module.config.php';
    }
}
