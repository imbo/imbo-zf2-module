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
            'imboClient' => array(
                'host' => 'http://imbo',
                'publicKey' => 'public',
                'privateKey' => 'private',
                'driver' => array(
                    'timeout' => 13,
                    'connectTimeout' => 49,
                ),
            ),
        );

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator->expects($this->once())
                       ->method('get')
                       ->with('config')->will($this->returnValue($config));

        $factory = new ImboClientServiceFactory();
        $client = $factory->createService($serviceLocator);

        $this->assertInstanceOf('ImboClient\Client', $client);

        // Assert correct configuration has been injected
        $this->assertSame(array('http://imbo'), $client->getServerUrls());
        $this->assertStringStartsWith(
            'http://imbo/users/public.json',
            (string) $client->getUserUrl()
        );

        // Enable super ghetto mode

        $privateKey = new ReflectionProperty('ImboClient\Client', 'privateKey');
        $privateKey->setAccessible(true);

        $this->assertSame('private', $privateKey->getValue($client));

        $driver = new ReflectionProperty('ImboClient\Client', 'driver');
        $driver->setAccessible(true);

        $curl = $driver->getValue($client);

        $curlParams = new ReflectionProperty('ImboClient\Driver\cURL', 'params');
        $curlParams->setAccessible(true);

        $this->assertSame(13, $curlParams->getValue($curl)['timeout']);
        $this->assertSame(49, $curlParams->getValue($curl)['connectTimeout']);
    }
}
