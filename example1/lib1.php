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
	
	echo "������������ ���� lib1.php: \n";
	echo (__NAMESPACE__ == "" ? "����������" : __NAMESPACE__)."\n\n";
	
