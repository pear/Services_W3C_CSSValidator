<?php
/**
 * Example file to demonstrate validating a URI.
 *
 * PHP version 5
 *
 * @category Web_Services
 * @package  Services_W3C_CSSValidator
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD
 * @version  CVS: $id$
 * @link     http://pear.php.net/package/Services_W3C_CSSValidator
 * @since    File available since Release 0.1.0
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
require_once 'Services/W3C/CSSValidator.php';

$v = new Services_W3C_CSSValidator();
$r = $v->validateUri('http://pear.php.net');

echo '<pre>';
var_dump($r);
echo '</pre>';
?>