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
     * Configuration used for transformation presets
     *
     * @var array
     */
    private $config;

    /**
     * Class constructor
     *
     * @param ClientInterface $client The imbo client
     */
    public function __construct(ClientInterface $client, array $config = array()) {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Get the image url
     *
     * @param string $imageIdentifier The image identifier
     * @param string $preset Transformation preset from the configuration
     * @return ImageUrl
     */
    public function imboUrl($imageIdentifier, $preset = null) {
        $url = $this->client->getImageUrl($imageIdentifier);

        if (isset($this->config[$preset])) {
            return $this->config[$preset]($url);
        }

        return $url;
    }

    /**
     * Invoke the view helper directly (proxies to imboUrl())
     *
     * @param string $imageIdentifier The image identifier
     * @param string $preset Transformation preset from the configuration
     * @return ImageUrl
     */
    public function __invoke($imageIdentifier, $preset = null) {
        return $this->imboUrl($imageIdentifier, $preset);
    }
}
