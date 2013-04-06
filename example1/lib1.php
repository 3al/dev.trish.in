<?php
	
	// application library 1
	namespace App\Lib1;

	const MYCONST = 'App\Lib1\MYCONST';

	function MyFunction() {
		return __FUNCTION__;
	}

	class MyClass {
		static function WhoAmI() {
			return __METHOD__;
		}
	}
	
	echo "Пространство имен lib1.php: \n";
	echo (__NAMESPACE__ == "" ? "Глобальное" : __NAMESPACE__)."\n\n";
	
