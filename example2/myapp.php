<?php

//myapp.php
namespace App\Lib1;
 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');
header('Content-type: text/plain');
 
require_once("lib1.php");
 
require_once("lib2.php");
 
echo MYCONST . "\n";
 
echo MyFunction() . "\n";
 
echo MyClass::WhoAmI() . "\n";