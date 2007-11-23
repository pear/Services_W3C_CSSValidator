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
$r = $v->validateFragment('@import url("foo.css") screen, print;
@media screen { color: green; background-color: yellow; }
@namespace foo url("http://www.example.com/");
html { height: 100%; }
@charset "UTF-8";
@page thin:first { size: 3in 8in }
@fontdef url("http://www.example.com/sample.pfr");
@font-face { font-family: dreamy; font-weight: bold; }');

echo '<pre>';
var_dump($r);
echo '</pre>';
?>