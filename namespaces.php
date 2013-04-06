<?php
	namespace MyProject;

	echo '<script type="text/javascript" src="syntaxhighlighter_3.0.83/scripts/shCore.js"></script>
	<script type="text/javascript" src="syntaxhighlighter_3.0.83/scripts/shBrushPhp.js"></script>
	<link type="text/css" rel="stylesheet" href="syntaxhighlighter_3.0.83/styles/shCoreDefault.css"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>';
	
	echo "<style>li{margin-bottom:10px;}</style>";

	echo '<style>blockquote{background-color:lightgrey;}</style>';
	echo '<h2 style="background-color:lightgreen;">������� ������������ ���� � PHP 5.3 !</h2><br/>';
	
		echo '
		<ul>
		<li><a href="#p1">������ �� ��������� � ������������ ����?</a></li>
		<li><a href="#p2">��� ������������ ������������ ����?</a></li>
		<li><a href="#p3">��������������� ���� (Sub-namespaces)</a></li>
		<li><a href="#p4">����� ����, ������������ � ������������ ����</a></li>
		<li><a href="#p5">�����������: ������ ����������������� ��� (Fully-qualified name)</a></li>
		<li><a href="#p6">�����������: ����������������� ��� (Qualified name)</a></li>
		<li><a href="#p7">�����������: ������������������� ��� (Unqualified name)</a></li>
		<li><a href="#p8">������ � ����������� �������������� ����</a></li>
		<li><a href="#p9">�������������� ����������� ��� (Namespace Importing)</a></li>
		<li><a href="#p10">���������� ������������ ��� (Namespace Aliases)</a></li>
		<li><a href="#p11">������� ������� ���</a></li>
		<li><a href="#p12">��������� __NAMESPACE__</a></li>
		<li><a href="#p13">�������� ����� namespace</a></li>
		<li><a href="#p14">������������ ������� ����������� ����</a></li>
		</ul>
	';
	
	
	echo '<br/><br/><a name="p1"></a><h3>������ �� ��������� � ������������ ����?</h3>';
	echo '<blockquote>� ������ ������� ������� ���� ���������� ���� ���������� ��������������� ������� ��� ����� ������, ������� ���� ��������� �����.<br/> �������� ������������, ����� �� ��������� ��������� ��������� ���������� ��� �������;<br/> ��� �����, ���� ��� ��� ����� ������� ���� ����� ������������ ������ �Database� ��� �User�?</blockquote><br/>';
	

	
	echo '<a name="p2"></a><h3>��� ������������ ������������ ����?</h3>';

	echo '<blockquote>�� ���������, ��� ����� ��������, ������� � ������� ��������� � ���������� ������������ � ��� ��� � ���� �� ����, ��� PHP ���� ������������ ������������ ����.

� ����, ������������ ���� ������������ � ������� ������������� ����� <strong>namespace</strong> � ����� ������ ������ PHP �����. ��� ����� ������ ���� ����� ������ �������� (�� ����������� <strong>declare</strong>) � �� ��-PHP ���, �� HTML, �� ���� ������ �� ������ �������������� ���� �������, ��������:</blockquote>';

	echo '<pre class="brush: php;">';
	echo
		'
			// ���� ��� ����� ��������� � ������������ ���� "MyProject"
			namespace MyProject;

			// ... ��� ...'
	;
	echo '</pre>';

	echo '<blockquote>���� ���, ��������� �� ����� ��������, ����� ���������� � ������������ ���� �MyProject�.</blockquote><br/>';

	echo '<a name="p3"></a><h3>��������������� ���� (Sub-namespaces)</h3>';
	echo '<blockquote>PHP ���� ��� ����������� ���������� �������� ����������� ���� ����� �������, ����� ���������� ����� ���� ����������� ���� �����. ������������ ��������������� ���� ����������� � ������� �������� ������ <strong>\</strong>, ��������:
<ul><li>MyProject \ SubName</li>
<li>MyProject \ Database \ MySQL</li>
<li>CompanyName \ MyProject \ Library \ Common \ Widget1</li></ul></blockquote><br/>';

	echo '<a name="p4"></a><h3>����� ����, ������������ � ������������ ����</h3>';
	echo '<blockquote>� ����� � ������ <strong>lib1.php</strong> �� ��������� ���������, ������� � ����� � �������� ������������ ���� <strong>App\Lib1</strong>:</blockquote>';

	echo '<pre class="brush: php;">';
	echo
		'
			// application library 1
			namespace App\Lib1;

			const MYCONST = "App\Lib1\MYCONST";

			function MyFunction() {
				return __FUNCTION__;
			}

			class MyClass {

				static function WhoAmI() {
					return __METHOD__;
				}
			}'
	;
	echo '</pre>';

	echo '<blockquote>������ �� ����� �������� ���� ��� � ������ PHP ����, ��������, <strong>myapp.php</strong>:</blockquote>';

	echo '<pre class="brush: php;">';
	echo
		'
			header("Content-type: text/plain");

			require_once("lib1.php");

			echo \App\Lib1\MYCONST . "\n";

			echo \App\Lib1\MyFunction() . "\n";

			echo \App\Lib1\MyClass::WhoAmI() . "\n";'
	;
	echo '</pre>';

	echo '<blockquote>������� ����������� ���� �� ���������� � ����� <strong>myapp.php</strong>, ������� ��� ���������� � ���������� ������������. ����� ������ ������ �� <strong>MYCONST</strong>, <strong>MyFunction</strong> ��� <strong>MyClass</strong> ������� ����, ��������� ��� ���������� ������ � ������������ ���� <strong>App\Lib1</strong>. ����� ������� ��� �� <strong>lib1.php</strong>, �� ����� �������� ������� <strong>\App\Lib1</strong>, ����� ���������� <strong>������ ����������������� ���</strong>. �� ������, ����� �������� <strong>myapp.php</strong>, �� ������� ��������� ���������:
</blockquote>';

echo '<pre class="brush: php;">';
	echo
		'
			App\Lib1\MYCONST

			App\Lib1\MyFunction

			App\Lib1\MyClass::WhoAmI'
	;
	echo '</pre>';

	echo '<blockquote><a href="example1/myapp.php" target="_blank">����� ������</a>. �������� ��������, ��� ������������ ���� myapp.php �� ����������, ����� ����������� lib1.php, � �� �������� �������� ����������. �� ���� <strong>������������ ���� ������������� �����, �� ������������� � ��������� ����</strong></blockquote><br/>';

	echo '<a name="p5"></a><h3>�����������: ������ ����������������� ��� (Fully-qualified name)</h3>';

	echo '<blockquote>����� PHP ��� ����� ��������� �� ������ ����������������� ��� � �������������, ������������ � ����������� ������������ ��� (��������� ����� � backslash), ��������: <strong>\App\Lib1\MYCONST</strong>,<br/> <strong>\App\Lib2\MyFunction()</strong> � �.�.<br />

� ������ ����������������� ������ ��� ������� ���������������. ��������� �������� ���� ���������� ������� (root)� ����������� ������������ ����. �������, ������������ � ���������� ����������� ����, ����� ������� ��� <strong>FunctionName()</strong>, ��� � ��� <strong>\FunctionName()</strong>.<br/>

������ ����������������� ����� ������� ��� ������������ ������ ������� ��� ������������� ��������. ������, ����� �� ������� ����� �������, ��� ���������� �������������. ��� �� ������ ����, PHP ���������� ������ �������� � ���� �������.</blockquote><br/>';

echo '<a name="p6"></a><h3>�����������: ����������������� ��� (Qualified name)</h3>';

echo '<blockquote>�������������, ������� ��� ������� ���� �� ���� ����������� ������������ ��� (namespace separator, ���������� � �������� ����), �������� <strong>Lib1\MyFunction()</strong>.</blockquote><br/>';

echo '<a name="p7"></a><h3>�����������: ������������������� ��� (Unqualified name)</h3>';

echo '<blockquote>������������� ��� ����������� ������������ ���, �������� <strong>MyFunction()</strong>.</blockquote><br/>';

echo '<a name="p8"></a><h3>������ � ����������� �������������� ����</h3>';

echo '<blockquote>���������� ��� ����� ���������� ����, ������������ �������� ������� - � ������������� ����:</blockquote>';

echo '<pre class="brush: php;">';
	echo
		'
		//lib1.php
		namespace App\Lib1;

		const MYCONST = "App\Lib1\MYCONST";

		function MyFunction() {

			return __FUNCTION__;

		}

		class MyClass {

		  static function WhoAmI() {

			return __METHOD__;

		  }

		}'
	;
echo '</pre>';

echo '<pre class="brush: php;">';
	echo
		'
		//lib2.php
		namespace App\Lib2;

		const MYCONST = "App\Lib2\MYCONST";

		function MyFunction() {

			return __FUNCTION__;

		}

		class MyClass {

		  static function WhoAmI() {

			return __METHOD__;

		  }

		}'
	;
echo '</pre>';

echo '<blockquote>������� ��������� ���:</blockquote>';

echo '<pre class="brush: php;">';
	echo
		'
		//myapp.php
		namespace App\Lib1;

		require_once("lib1.php");

		require_once("lib2.php");

		echo MYCONST . "\n";

		echo MyFunction() . "\n";

		echo MyClass::WhoAmI() . "\n";'
	;
echo '</pre>';

echo '<blockquote>���� �� ������������ � <strong>lib1.php</strong> � <strong>lib2.php</strong>, �������������� <strong>MYCONST</strong>, <strong>MyFunction</strong> � <strong>MyClass</strong> ����� ���������� ������ � <strong>lib1.php</strong>. ��� ���������� ������ ��� ��� <strong>myapp1.php</strong> ���������� � <span style="color:red;">������</span> � <strong>App\Lib1</strong> ������������ ���. ���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		App\Lib1\MYCONST

		App\Lib1\MyFunction

		App\Lib1\MyClass::WhoAmI'
;
echo '</pre>';

echo '<blockquote><a href="example2/myapp.php" target="_blank">����� ������</a>.</blockquote><br/>';

echo '<a name="p9"></a><h3>�������������� ����������� ��� (Namespace Importing)</h3>';

echo '<blockquote>������������ ��� ����� ���� ������������� � ������� ��������� <strong>use</strong>. ���������� 2 ����� <strong>lib1.php</strong> � <strong>lib2.php</strong> �� ����������� �������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		//myapp.php

		use App\Lib2;

		require_once("lib1.php");

		require_once("lib2.php");

		echo Lib2\MYCONST . "\n";

		echo Lib2\MyFunction() . "\n";

		echo Lib2\MyClass::WhoAmI() . "\n";
	'
;
echo '</pre>';

echo '<blockquote>�� ������ ������������� � ������� <strong>use</strong> ���� ��� ��������� ����������� ���, �������� �� �������. � ������ �������, �� ������������� ������������ ��� <strong>App\Lib2</strong>. �� ��� ��� �� ����� ��������� ����� �� <strong>MYCONST</strong>, <strong>MyFunction</strong> ��� <strong>MyClass</strong> ������ ��� ��� ��� ��������� � ���������� ������������ � PHP ����� ������ �� ������ ���. �� ���� �� ������� ������� <strong>�Lib2\�</strong>, ��� ������ ������������������ �������, � PHP ������ ������ �� � ��������������� ������������� ���, ���� �� ������ ������� ����������. ���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		App\Lib2\MYCONST

		App\Lib2\MyFunction

		App\Lib2\MyClass::WhoAmI
	'
;
echo '</pre>';

echo '<blockquote><a href="example3/myapp.php" target="_blank">����� ������</a>.</blockquote><br/>';

echo '<a name="p10"></a><h3>���������� ������������ ��� (Namespace Aliases)</h3>';

echo '<blockquote>���������� ������������ ���, ��������, ����� �������� �����������. ���������� ��������� ��������� �� ������� ������������ ��� � ������� ��������� �����.</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		//myapp.php

		use App\Lib1 as L;

		use App\Lib2\MyClass as Obj;


		require_once("lib1.php");

		require_once("lib2.php");

		echo L\MYCONST . "\n";

		echo L\MyFunction() . "\n";

		echo L\MyClass::WhoAmI() . "\n";

		echo Obj::WhoAmI() . "\n";
	'
;
echo '</pre>';

echo '<blockquote>������ �������� <strong>use</strong> ���������� <strong>App\Lib1</strong> ��� <strong>�L�</strong>. ����� ����������������� ���, ������������ <strong>�L�</strong>, ����� ������������� �� ����� ���������� � <strong>�App\Lib1�</strong>. �������, �� ������ �������� �� <strong>L\MYCONST</strong> ��� <strong>L\MyFunction</strong>, ��� �� ������ ����������������� ���.

������ �������� <strong>use</strong> ����� ���������. �� ���������� <strong>�Obj�</strong> ��� ��������� ��� ������ <strong>�MyClass�</strong> � �������� ������������ ��� <strong>App\Lib2\</strong>. ��� �������� ������������� <span style="color:red;">������ ��� �������</span> � �� ��� �������� ��� �������. ������ �� ����� ������������ <strong>new Obj()</strong>, ��� �������� ����������� ������, ��� �������� ����. ���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		App\Lib1\MYCONST

		App\Lib1\MyFunction

		App\Lib1\MyClass::WhoAmI

		App\Lib2\MyClass::WhoAmI
	'
;
echo '</pre>';

echo '<blockquote><a href="example4/myapp.php" target="_blank">����� ������</a>.</blockquote><br/>';

echo '<a name="p11"></a><h3>������� ������� ���</h3>';

echo '<blockquote>����� PHP ��������������� ����������� ���������� ��������� ����������� ���. ��� ����� ������ ����������, ���������� � ����������� �� PHP (<a href="http://www.php.net/manual/en/language.namespaces.rules.php" target="_blank">�� ����������</a> / <a href="http://docs.php.net/manual/ru/language.namespaces.rules.php" target="_blank">�� �������</a>)
<ul>
	<li>����� ����������������� ������� ����������� �� ����� ��������������.</li>
	
	<li>��� ����������������� ����� ������������� �� ����� ���������� � ������������ � �������� ���������������� �������������� ���. � �������, ���� ������������� ������������ ��� <strong>A::B::C</strong>, ����� <strong>C::D::e()</strong> ����� ������������ ��� <strong>A::B::C::D::e()</strong>.</li>
	<li>������ ������������ ��� ��� ����������������� ����� ������������� �������� �������� ��������������, ��������, ���� ������������ ��� <strong>A\B\C</strong> ������������� ��� <strong>C,</strong> ����� <strong>C\D\e()</strong> ������������� � <strong>A\B\C\D\e()</strong>.</li>
	<li>������������������� ����� ������� ������������� �� ����� ���������� � ������������ � �������� ���������������� �������������� ��� � ������ ����� �������� �������� ��������������� �����, ��������, ���� ����� <strong>C</strong> � ������������ ��� <strong>A\B</strong> ������������ ��� <strong>X</strong>, <strong>new X()</strong> ����� ������������ � <strong>new A\B\C()</strong>.</li>
	<li>������ ������������ ��� ����� ������������������� ������� ���������������� �� ����� ����������. ��������, ���� <strong>MyFunction()</strong> ������� � �������� ������������ ��� <strong>A\B</strong>, PHP ������ ���� ������� <strong>\A\B\MyFunction()</strong>. ���� ��� �� ����� �������, PHP ����� ������ <strong>\MyFunction()</strong> � ���������� ������������.</li>
	<li>������ ������������������� ��� ����������������� ��� ������� ���������������� �� ����� ����������. ��������, ���� �� �������� <strong>new C()</strong> � �������� ������������ ��� <strong>A\B</strong>, PHP ����� ������ ����� <strong>A\B\C</strong>. ���� �� �� ����� ������, ��� �������� � ������� <span style="color:red;">������������</span> <strong>A\B\C</strong>.</li>
</ul>
</blockquote><br/>';

echo '<a name="p12"></a><h3>��������� __NAMESPACE__</h3>';

echo '<blockquote><span style="color:red;">__NAMESPACE__</span> ��� ��������� PHP, ������� ������ ���������� ������� ��� ������������ ���. � ���������� ������������ ��� ����� ������ ������ �������.</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		namespace App\Lib1;

		echo __NAMESPACE__;
	'
;
echo '</pre>';

echo '<blockquote>���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1'
;
echo '</pre>';

echo '<blockquote>Ÿ �������� ����� ��������� ������ �� ����� �������. Ÿ ����� ����� ������������ ����� ����������� ������������ ������ ����������������� ����� �������, ��������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		namespace App\Lib1;

		class MyClass {

			public function WhoAmI() {

				return __METHOD__;

			}

		}

		$c = __NAMESPACE__ . "\\MyClass";

		$m = new $c;

		echo $m->WhoAmI();
	'
;
echo '</pre>';

echo '<blockquote>���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1\MyClass::WhoAmI'
;
echo '</pre><br/>';

echo '<a name="p13"></a><h3>�������� ����� namespace</h3>';

echo '<blockquote>�������� ����� <strongz>namespace</strong> ����� �������������� ��� ���� ����� ���� ������� �������� ������� (���� �� ���� ������) � �������� �������� ������������ ��� ��� ��������������� ���. ���������� <strong>namespace</strong> � �������� ����� <strong>self</strong> ��� �������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'namespace App\Lib1;

	class MyClass {

		public function WhoAmI() {

			return __METHOD__;

		}

	}

	$m = new namespace\MyClass;

	echo $m->WhoAmI();'
;
echo '</pre>';

echo '<blockquote>���������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1\MyClass::WhoAmI'
;
echo '</pre><br/>';

echo '<a name="p14"></a><h3>������������ ������� ����������� ����</h3>';

echo '<blockquote>���� �� ��������� ������������ ���������� ����� � PHP 5 ��� <span style="color:red;">������������</span>. � ���������� (�� ���������� � ������-���� ������������ ����) PHP ����, ����������� ������� ������������ ����� ���� �������� ��������� �������:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
	$obj1 = new MyClass1(); // �������� ����� classes/MyClass1.php

	$obj2 = new MyClass2(); //�������� ����� classes/MyClass2.php

 
	// ������� ������������
	
	function __autoload($class_name){

	  require_once("classes/$class_name.php");

	}
'
;
echo '</pre>';

echo '<blockquote>� PHP 5.3 �� ������ ������� ��������� ������ ������������ ����. � ���� ��������, ������ ����������������� ����� ����������� ��� � ����� ������� ���������� ������� <strong>__autoload</strong>, ��������, ��������� <strong>$class_name</strong> ����� ���� <strong>"App\Lib1\MyClass"</strong>. �� ������ ���������� ��������� ���� ����� PHP ������� � ����� � ��� �� ����� � �������� ������������ ��� �� ������, ������, ��� ����� �������� � ��������� �������� ����.

� �������� ������������, �������� �������� ����� ������� ����� ���� ������������ ����� �� ������� ��� � ��������� ����� ����������� ����. ��������, ���� <strong>MyClass.php</strong> ����� ���� ������ � ����� <strong>/classes/App/Lib1</strong>:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
	/* /classes/App/Lib1/MyClass.php: */
	
	namespace App\Lib1;

	class MyClass {

		public function WhoAmI() {

			return __METHOD__;

		}

	}
	'
;
echo '</pre>';

echo '<blockquote>����, ����������� � �������� ���������� ����� ��� ������������ � ������� ���������� ����:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
	//myapp.php
	
	use App\Lib1\MyClass as MC;

	$obj = new MC();

	echo $obj->WhoAmI();

	// ������� ������������

	function __autoload($class) {
	
		// ������������ ������������ ���� � ���� � �����

		$class = "classes/" . str_replace("\\", "/", $class) . ".php";

		require_once($class);
	}
	'
;
echo '</pre>';