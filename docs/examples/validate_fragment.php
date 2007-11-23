<?php
/**
 * Example file demonstrating how to validate a CSS fragment.
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

error_reporting(E_ALL);
ini_set('display_errors', true);
require_once 'Services/W3C/CSSValidator.php';

$v = new Services_W3C_CSSValidator();
$r = $v->validateFragment('ul.man-side_top,
ul.man-side_up,
ul.man-side_download {
    margin-top: 0.5e;
    margin-bottom: 0.5em;
    margin-left: 0.7em;
    padding-left: 0.7em;
}');

echo '<pre>';
var_dump($r);
echo '</pre>';
?>