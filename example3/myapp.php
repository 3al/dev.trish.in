<?php

//myapp.php
use App\Lib2;

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');
header('Content-type: text/plain');

require_once("lib1.php");
 
require_once("lib2.php");
 
echo Lib2\MYCONST . "\n";
 
echo Lib2\MyFunction() . "\n";
 
echo Lib2\MyClass::WhoAmI() . "\n";