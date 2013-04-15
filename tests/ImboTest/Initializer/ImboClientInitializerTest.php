<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboTest\Initializer;

use Imbo\Initializer\ImboClientInitializer;

/**
 * Test case for the ImboClientInitializer class
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ImboClientInitializerTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var ImboClientInitilizer
     */
    private $initializer;

    /**
     * Set up the class
     */
    public function setUp() {
        $this->initializer = new ImboClientInitializer();
    }

    /**
     * Tear down the class
     */
    public function tearDown() {
        $this->initializer = null;
    }

    /**
     * @covers Imbo\Initializer\ImboClientInitializer::initialize
     */
    public function testInjectsTheModuleToCorrectInstances() {
        $imboClient = $this->getMock('ImboClient\ClientInterface');

        $sm = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $sm->expects($this->once())->method('get')->with('ImboClient')->will($this->returnValue($imboClient));

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface', array('getServiceLocator', 'get', 'has'));
        $serviceLocator->expects($this->once())->method('getServiceLocator')->will($this->returnValue($sm));

        $instance = $this->getMock('Imbo\Service\ImboClientAwareInterface');
        $instance->expects($this->once())->method('setImboClient')->with($imboClient);

        $this->initializer->initialize($instance, $serviceLocator);
    }

    /**
     * @covers Imbo\Initializer\ImboClientInitializer::initialize
     */
    public function testDoesNotInjectClientToInstancesNotImplementingTheInterface() {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface', array('getServiceLocator', 'get', 'has'));

        $instance = $this->getMock('stdClass', array('setImboClient'));
        $instance->expects($this->never())->method('setImboClient');

        $this->initializer->initialize($instance, $serviceLocator);
    }
}
