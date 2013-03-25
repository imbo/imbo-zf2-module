<?php
/**
 * This file is part of the Imbo module for ZF2 package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

namespace ImboTest;

use Imbo\Module;

/**
 * Module test
 *
 * @author Christer Edvartsen <cogo@starzinger.net>
 * @package Imbo module\Test suite
 */
class ModuleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @covers Imbo\Module::getConfig
     */
    public function testDefaultConfig() {
        $module = new Module();

        $this->assertSame(
            include __DIR__ . '/../../config/module.config.php',
            $module->getConfig()
        );
    }
}
