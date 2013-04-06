<?php
	
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 'on');
	header('Content-type: text/plain');
	
	require_once('lib1.php');
	
	
	echo \App\Lib1\MYCONST . "\n";

	echo \App\Lib1\MyFunction() . "\n";

	echo \App\Lib1\MyClass::WhoAmI() . "\n";
	
	echo "\nПространство имен myapp.php после подключения lib1.php: \n";
	echo (__NAMESPACE__ == "" ? "Глобальное" : __NAMESPACE__)."\n\n";