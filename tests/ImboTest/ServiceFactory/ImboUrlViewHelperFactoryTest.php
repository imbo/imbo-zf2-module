<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboTest\ServiceFactory;

use Imbo\ServiceFactory\ImboUrlViewHelperFactory;

/**
 * ImboUrl view helper factory test
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ImboUrlViewHelperFactoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @covers Imbo\ServiceFactory\ImboUrlViewHelperFactory::createService
     */
    public function testCorrectlyConfiguresTheViewHelper() {
        $config = array(
            'imboModule' => array(
                'viewHelperPresets' => array(),
            ),
        );

        $imboClient = $this->getMock('ImboClient\ClientInterface');

        $serviceManager = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceManager->expects($this->at(0))
                       ->method('get')
                       ->with('ImboClient')
                       ->will($this->returnValue($imboClient));

        $serviceManager->expects($this->at(1))
                       ->method('get')
                       ->with('config')
                       ->will($this->returnValue($config));

        $helperPluginManager = $this->getMockBuilder('Zend\View\HelperPluginManager')
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $helperPluginManager->expects($this->once())
                            ->method('getServiceLocator')
                            ->will($this->returnValue($serviceManager));

        $factory = new ImboUrlViewHelperFactory();
        $helper = $factory->createService($helperPluginManager);

        $this->assertInstanceOf('Imbo\View\Helper\ImboUrl', $helper);
    }
}
