<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\Service;

use ImboClient\ClientInterface;

/**
 * Trait for controllers to use when implementing the ImboClientAwareInterface interface
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module
 */
trait ImboClientAware {
    /**
     * @var ClientInterface
     */
    private $imboClient;

    /**
     * @see ImboClientAwareInterface::setImboClient()
     */
    public function setImboClient(ClientInterface $client) {
        $this->imboClient = $client;
    }

    /**
     * @see ImboClientAwareInterface::getImboClient()
     */
    public function getImboClient() {
        return $this->imboClient;
    }
}
