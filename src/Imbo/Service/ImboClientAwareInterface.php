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

use ImboClient\ImboClient;

/**
 * Interface that controllers who want an instance of ImboClient injected can implement
 *
 * This interface is accompanied with a trait that fullfills the contract.
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module
 */
interface ImboClientAwareInterface {
    /**
     * Set an instance of an Imbo client
     *
     * @param ImboClient $client
     */
    function setImboClient(ImboClient $client);

    /**
     * Fetch the Imbo client
     *
     * @return ImboClient
     */
    function getImboClient();
}
