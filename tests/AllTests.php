<?php
/**
 * Test suite for Services_W3C_CSSValidator
 *
 * PHP version 5
 *
 * @category Web_Services
 * @package  Services_W3C_CSSValidator
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD
 * @version  CVS: $Id$
 * @link     http://pear.php.net/package/Services_W3C_CSSValidator
 * @since    File available since Release 0.1.0
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Services_W3C_CSSValidator_AllTests::main');
}

require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'PHPUnit/TextUI/TestRunner.php';


require_once 'Services_W3C_CSSValidatorTest.php';

/**
 * Class for running all test suites for Services_W3C_CSSValidator package.
 *
 * @category Web_Services
 * @package  Services_W3C_CSSValidator
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD
 * @version  Release: $id$
 * @link     http://pear.php.net/package/Services_W3C_CSSValidator
 * @since    File available since Release 0.1.0
 */

class Services_W3C_CSSValidator_AllTests
{
    /**
     * Runs the test suite.
     *
     * @return void
     * @static
     */
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    /**
     * Adds the Services_W3C_HTMLValidatorTest suite.
     *
     * @return object the PHPUnit_Framework_TestSuite object
     * @static
     */
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Services_W3C_CSSValidator'
            . ' Test Suite');
        /** Add testsuites, if there is. */
        $suite->addTestSuite('Services_W3C_CSSValidatorTest');
        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Services_W3C_CSSValidator_AllTests::main') {
    Services_W3C_CSSValidator_AllTests::main();
}
?>
