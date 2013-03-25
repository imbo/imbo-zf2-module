<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

return array(
    'service_manager' => array(
        'factories' => array(
            'ImboClient' => 'Imbo\ServiceFactory\ImboClientServiceFactory',
        ),
    ),

    'view_helpers' => array(
        'factories' => array(
            'imboUrl' => 'Imbo\ServiceFactory\ImboUrlViewHelperFactory',
        ),
    ),

    // Configuration for the client
    'imboClient' => array(
        // Single host name or an array of host names
        'host' => '',

        // Public key used with the Imbo server
        'publicKey' => '',

        // Private key used with the Imbo server
        'privateKey' => '',

        // Driver specific parameters
        'driver' => array(
            'timeout' => 2,
            'connectTimeout' => 2,
        ),
    ),
);
