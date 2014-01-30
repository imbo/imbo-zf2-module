<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboTest\Service;

use Imbo\Service\ImboClientAware;

/**
 * ImboClientAware trait test
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ImboClientAwareTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var ImboClientAware
     */
    private $traitObject;

    /**
     * Set up the class
     */
    public function setUp() {
        $this->traitObject = $this->getObjectForTrait('Imbo\Service\ImboClientAware');
    }

    /**
     * Tear down the class
     */
    public function tearDown() {
        $this->traitObject = null;
    }

    /**
     * @covers Imbo\Service\ImboClientAware::getImboClient
     */
    public function testReturnsNoClientPerDefault() {
        $this->assertNull($this->traitObject->getImboClient());
    }

    /**
     * @covers Imbo\Service\ImboClientAware::getImboClient
     * @covers Imbo\Service\ImboClientAware::setImboClient
     */
    public function testCanSetAnInstanceOfAClient() {
        $client = $this->getMockBuilder('ImboClient\ImboClient')->disableOriginalConstructor()->getMock();
        $this->traitObject->setImboClient($client);
        $this->assertSame($client, $this->traitObject->getImboClient());
    }
}
