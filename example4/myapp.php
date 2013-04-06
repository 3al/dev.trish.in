<?php

//myapp.php

use App\Lib1 as L;
 
use App\Lib2\MyClass as Obj;
 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');
header('Content-type: text/plain');
 
require_once("lib1.php"); 
require_once("lib2.php");
 
echo L\MYCONST . "\n";
 
echo L\MyFunction() . "\n";
 
echo L\MyClass::WhoAmI() . "\n";
 
echo Obj::WhoAmI() . "\n";