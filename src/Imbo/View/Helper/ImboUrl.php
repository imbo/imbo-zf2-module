<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace Imbo\View\Helper;

use ImboClient\ClientInterface,
    ImboClient\Url\Image as ImageUrl,
    Zend\View\Helper\AbstractHelper;

/**
 * ImboUrl view helper
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\View helper
 */
class ImboUrl extends AbstractHelper {
    /**
     * The Imbo client
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * Class constructor
     *
     * @param ClientInterface $client The imbo client
     */
    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    /**
     * Get the image url
     *
     * @param string $imageIdentifier The image identifier
     * @return ImageUrl
     */
    public function imboUrl($imageIdentifier) {
        return $this->client->getImageUrl($imageIdentifier);
    }

    /**
     * Invoke the view helper directly
     *
     * @param string $imageIdentifier The image identifier
     * @return ImageUrl
     */
    public function __invoke($imageIdentifier) {
        return $this->imboUrl($imageIdentifier);
    }
}
