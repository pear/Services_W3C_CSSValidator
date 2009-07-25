<?php
/**
 * Test suite for the Services_W3C_CSSValidator class
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
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Services_W3C_CSSValidatorTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";
require_once "HTTP/Request2/Adapter/Mock.php";

require_once 'Services/W3C/CSSValidator.php';

/**
 * Test class for Services_W3C_CSSValidator.
 *
 * @category Web_Services
 * @package  Services_W3C_CSSValidator
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD
 * @version  Release: $id$
 * @link     http://pear.php.net/package/Services_W3C_CSSValidator
 * @since    File available since Release 0.1.0
 */
class Services_W3C_CSSValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @static
     * @return void
     */
    public static function main()
    {
        include_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite('Services_W3C_CSSValidator Test');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->mock = new HTTP_Request2_Adapter_Mock();

        $request = new HTTP_Request2();
        $request->setAdapter($this->mock);

        $this->validator = new Services_W3C_CSSValidator($request);
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
    }

    /**
     * Tests setting the options.
     *
     * @return void
     */
    public function testSetOptions()
    {
        $v          = new Services_W3C_CSSValidator();
        $v->uri     = 'foo';
        $v->profile = 'css2';
        // Test that value was set.
        $this->assertEquals($v->uri, 'foo');
        $this->assertEquals($v->profile, 'css2');
    }

    /**
     * Tests validating a URI
     *
     * @return void
     */
    public function testValidateUri()
    {
        $response = new HTTP_Request2_Response('HTTP/1.1 200 OK');
        $response->appendBody(file_get_contents(dirname(__FILE__) . '/data/ValidateUri.xml'));

        $this->mock->addResponse($response);

        $uri = 'http://validator.w3.org/';

        $v = $this->validator;
        $r = $v->validateUri($uri);
        $this->assertEquals(get_class($r), 'Services_W3C_CSSValidator_Response');
        $this->assertTrue($r->isValid());
        $this->assertEquals(count($r->errors), 0);
        $this->assertEquals($v->uri, $uri);
        $this->assertEquals($r->uri, $uri);
        $this->assertEquals($r->checkedby.'validator',
            Services_W3C_CSSValidator::VALIDATOR_URI);
    }

    /**
     * Tests validating a local file.
     *
     * @return void
     */
    public function testValidateFile()
    {
        $response = new HTTP_Request2_Response('HTTP/1.1 200 OK');
        $response->appendBody(file_get_contents(dirname(__FILE__) . '/data/ValidateFile.xml'));

        $this->mock->addResponse($response);

        $v       = $this->validator;
        $doc_dir = dirname(realpath(__FILE__));
        $file    = DIRECTORY_SEPARATOR . 'fragment.css';
        $r       = $v->validateFile($doc_dir.$file);
        $this->assertEquals(get_class($r), 'Services_W3C_CSSValidator_Response');
        $this->assertFalse($r->isValid());
        $this->assertEquals(count($r->errors), 1);
        $this->assertEquals(get_class($r->errors[0]),
            'Services_W3C_CSSValidator_Error');
    }

    /**
     * Tests validating a fragment of html
     *
     * @return void
     */
    public function testValidateFragment()
    {
        $response = new HTTP_Request2_Response('HTTP/1.1 200 OK');
        $response->appendBody(file_get_contents(dirname(__FILE__) . '/data/ValidateFragment.xml'));

        $this->mock->addResponse($response);

        $v = $this->validator;
        $r = $v->validateFragment('ul.man-side_top,
ul.man-side_up,
ul.man-side_download {
    margin-top: 0.5e;
    margin-bottom: 0.5em;
    margin-left: 0.7em;
    padding-left: 0.7em;
}');
        $this->assertEquals(get_class($r), 'Services_W3C_CSSValidator_Response');
        $this->assertFalse($r->isValid());
        $this->assertEquals($r->uri, 'file://localhost/TextArea');
    }
}

// Call Services_W3C_CSSValidatorTest::main() if file is executed directly.
if (PHPUnit_MAIN_METHOD == "Services_W3C_CSSValidatorTest::main") {
    Services_W3C_CSSValidatorTest::main();
}
?>
