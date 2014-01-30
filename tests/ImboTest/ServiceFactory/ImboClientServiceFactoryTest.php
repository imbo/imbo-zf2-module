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

use Imbo\ServiceFactory\ImboClientServiceFactory,
    ReflectionProperty;

/**
 * ImboClient service factory test
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ImboClientServiceFactoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @covers Imbo\ServiceFactory\ImboClientServiceFactory::createService
     */
    public function testCorrectlyConfiguresTheClient() {
        $config = array(
            'imboModule' => array(
                'imboClient' => array(
                    'host' => 'http://imbo',
                    'publicKey' => 'public',
                    'privateKey' => 'private',
                    'driver' => array(
                        'timeout' => 13,
                        'connectTimeout' => 49,
                    ),
                ),
            ),
        );

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with('config')->will($this->returnValue($config));

        $factory = new ImboClientServiceFactory();
        $client = $factory->createService($serviceLocator);

        $this->assertInstanceOf('ImboClient\ImboClient', $client);

        // Assert correct configuration has been injected
        $this->assertSame(array('http://imbo'), $client->getServerUrls());
        $this->assertStringStartsWith(
            'http://imbo/users/public.json',
            (string) $client->getUserUrl()
        );

        $this->assertSame('public', $client->getPublicKey());
        $this->assertSame('private', $client->getConfig('privateKey'));
    }
}
