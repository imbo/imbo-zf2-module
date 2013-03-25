<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboTest\View\Helper;

use Imbo\View\Helper\ImboUrl,
    ImboClient\Url\Image as ImageUrl;

/**
 * ImboUrl view helper test
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ImboUrlTest extends \PHPUnit_Framework_TestCase {
    /**
     * @covers Imbo\View\Helper\ImboUrl::__construct
     * @covers Imbo\View\Helper\ImboUrl::__invoke
     * @covers Imbo\View\Helper\ImboUrl::imboUrl
     */
    public function testCanReturnAnImageUrl() {
        $identifier = 'd1f4a3e84c79e58fdc654981b0e3a374';
        $imageUrl = $this->getMockBuilder('ImboClient\Url\Image')->disableOriginalConstructor()->getMock();
        $client = $this->getMock('ImboClient\ClientInterface');
        $client->expects($this->once())->method('getImageUrl')->with($identifier)->will($this->returnValue($imageUrl));

        $helper = new ImboUrl($client);
        $this->assertSame($imageUrl, $helper($identifier));
    }

    /**
     * @covers Imbo\View\Helper\ImboUrl::__construct
     * @covers Imbo\View\Helper\ImboUrl::__invoke
     * @covers Imbo\View\Helper\ImboUrl::imboUrl
     */
    public function testSupportsConfiurablePresets() {
        $config = array(
            'graythumb' => function(ImageUrl $url) {
                return $url->thumbnail()
                           ->desaturate();
            },
        );
        $identifier = 'd1f4a3e84c79e58fdc654981b0e3a374';
        $imageUrl = $this->getMockBuilder('ImboClient\Url\Image')->disableOriginalConstructor()->getMock();
        $imageUrl->expects($this->once())->method('thumbnail')->will($this->returnSelf());
        $imageUrl->expects($this->once())->method('desaturate')->will($this->returnSelf());

        $client = $this->getMock('ImboClient\ClientInterface');
        $client->expects($this->once())->method('getImageUrl')->with($identifier)->will($this->returnValue($imageUrl));
        $helper = new ImboUrl($client, $config);
        $url = $helper($identifier, 'graythumb');

        $this->assertSame($imageUrl, $url);
    }
}
