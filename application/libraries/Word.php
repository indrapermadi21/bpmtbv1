<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Date: 3/11/14
 * Time: 12:02 PM
 */

require_once  APPPATH.'/third_party/PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader as Autoloader;
Autoloader::register();

class Word extends Autoloader {
//     public function __construct() {
//         parent::__construct();
//     }
}