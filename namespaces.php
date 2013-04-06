<?php
	namespace MyProject;

	echo '<script type="text/javascript" src="syntaxhighlighter_3.0.83/scripts/shCore.js"></script>
	<script type="text/javascript" src="syntaxhighlighter_3.0.83/scripts/shBrushPhp.js"></script>
	<link type="text/css" rel="stylesheet" href="syntaxhighlighter_3.0.83/styles/shCoreDefault.css"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>';
	
	echo "<style>li{margin-bottom:10px;}</style>";

	echo '<style>blockquote{background-color:lightgrey;}</style>';
	echo '<h2 style="background-color:lightgreen;">Изучаем пространства имен в PHP 5.3 !</h2><br/>';
	
		echo '
		<ul>
		<li><a href="#p1">Почему мы нуждаемся в пространстве имен?</a></li>
		<li><a href="#p2">Как определяются пространства имен?</a></li>
		<li><a href="#p3">Подпространства имен (Sub-namespaces)</a></li>
		<li><a href="#p4">Вызов кода, относящегося к пространству имен</a></li>
		<li><a href="#p5">Определение: полное квалифицированное имя (Fully-qualified name)</a></li>
		<li><a href="#p6">Определение: Квалифицированное имя (Qualified name)</a></li>
		<li><a href="#p7">Определение: Неквалифицированное имя (Unqualified name)</a></li>
		<li><a href="#p8">Работа с одинаковыми пространствами имен</a></li>
		<li><a href="#p9">Импортирование пространств имён (Namespace Importing)</a></li>
		<li><a href="#p10">Псевдонимы пространства имён (Namespace Aliases)</a></li>
		<li><a href="#p11">Правила разбора имён</a></li>
		<li><a href="#p12">Константа __NAMESPACE__</a></li>
		<li><a href="#p13">Ключевое слово namespace</a></li>
		<li><a href="#p14">Автозагрузка классов пространств имен</a></li>
		</ul>
	';
	
	
	echo '<br/><br/><a name="p1"></a><h3>Почему мы нуждаемся в пространстве имен?</h3>';
	echo '<blockquote>В случае больших объемов кода возрастает риск случайного переопределения функции или имени класса, которые были объявлены ранее.<br/> Проблема усугубляется, когда Вы пытаетесь добавлять сторонние компоненты или плагины;<br/> что будет, если два или более наборов кода будут использовать классы «Database» или «User»?</blockquote><br/>';
	

	
	echo '<a name="p2"></a><h3>Как определяются пространства имен?</h3>';

	echo '<blockquote>По умолчанию, все имена констант, классов и функций размещены в глобальном пространстве — как это и было до того, как PHP стал поддерживать пространства имен.

В коде, пространства имен определяются с помощью единственного слова <strong>namespace</strong> в самом начале Вашего PHP файла. Это слово должно быть самой первой командой (за исключением <strong>declare</strong>) и ни не-PHP код, ни HTML, ни даже пробел не должен предшествовать этой команде, например:</blockquote>';

	echo '<pre class="brush: php;">';
	echo
		'
			// этот код будет определен в пространстве имен "MyProject"
			namespace MyProject;

			// ... код ...'
	;
	echo '</pre>';

	echo '<blockquote>Весь код, следующий за этими строками, будет относиться к пространству имен «MyProject».</blockquote><br/>';

	echo '<a name="p3"></a><h3>Подпространства имен (Sub-namespaces)</h3>';
	echo '<blockquote>PHP дает Вам возможность определять иерархию пространств имен таким образом, чтобы библиотеки могли быть соподчинены друг другу. Получившиеся подпространства имен разделяются с помощью обратных слэшей <strong>\</strong>, например:
<ul><li>MyProject \ SubName</li>
<li>MyProject \ Database \ MySQL</li>
<li>CompanyName \ MyProject \ Library \ Common \ Widget1</li></ul></blockquote><br/>';

	echo '<a name="p4"></a><h3>Вызов кода, относящегося к пространству имен</h3>';
	echo '<blockquote>В файле с именем <strong>lib1.php</strong> мы определим константу, функцию и класс в пределах пространства имен <strong>App\Lib1</strong>:</blockquote>';

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

	echo '<blockquote>Теперь мы можем включить этот код в другой PHP файл, например, <strong>myapp.php</strong>:</blockquote>';

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

	echo '<blockquote>Никаких пространств имен не определено в файле <strong>myapp.php</strong>, поэтому код существует в глобальном пространстве. Любая прямая ссылка на <strong>MYCONST</strong>, <strong>MyFunction</strong> или <strong>MyClass</strong> вызовет сбой, поскольку они существуют только в пространстве имен <strong>App\Lib1</strong>. Чтобы вызвать код из <strong>lib1.php</strong>, мы можем добавить префикс <strong>\App\Lib1</strong>, чтобы определить <strong>полное квалифицированное имя</strong>. На выходе, когда загрузим <strong>myapp.php</strong>, мы получим следующий результат:
</blockquote>';

echo '<pre class="brush: php;">';
	echo
		'
			App\Lib1\MYCONST

			App\Lib1\MyFunction

			App\Lib1\MyClass::WhoAmI'
	;
	echo '</pre>';

	echo '<blockquote><a href="example1/myapp.php" target="_blank">Живой пример</a>. Обратите внимание, что пространство имен myapp.php не поменялось, после подключения lib1.php, а по прежнему осталось глобальным. То есть <strong>пространство имен подключаемого файла, не импортируется в вызвавший файл</strong></blockquote><br/>';

	echo '<a name="p5"></a><h3>Определение: полное квалифицированное имя (Fully-qualified name)</h3>';

	echo '<blockquote>Любой PHP код может ссылаться на полное квалифицированное имя — идентификатор, начинающийся с разделителя пространства имён (обратного слэша — backslash), например: <strong>\App\Lib1\MYCONST</strong>,<br/> <strong>\App\Lib2\MyFunction()</strong> и т.д.<br />

В полных квалифицированных именах нет никакой двусмысленности. Начальный обратный слэш обозначает «корень (root)» глобального пространства имен. Функцию, определенную в глобальном простанстве имен, можно вызвать как <strong>FunctionName()</strong>, так и как <strong>\FunctionName()</strong>.<br/>

Полные квалифицированные имена полезны для одноразового вызова функций или инициализации объектов. Однако, когда вы делаете много вызовов, они становятся непрактичными. Как мы узнаем ниже, PHP предлагает другие варианты в этих случаях.</blockquote><br/>';

echo '<a name="p6"></a><h3>Определение: Квалифицированное имя (Qualified name)</h3>';

echo '<blockquote>Идентификатор, имеющий как минимум хотя бы один разделитель пространства имён (namespace separator, фактически — обратный слэш), например <strong>Lib1\MyFunction()</strong>.</blockquote><br/>';

echo '<a name="p7"></a><h3>Определение: Неквалифицированное имя (Unqualified name)</h3>';

echo '<blockquote>Идентификатор без разделителя пространства имён, например <strong>MyFunction()</strong>.</blockquote><br/>';

echo '<a name="p8"></a><h3>Работа с одинаковыми пространствами имен</h3>';

echo '<blockquote>Рассмотрим два почти идентичных кода, единственное различие которых - в пространствах имен:</blockquote>';

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

echo '<blockquote>Обсудим следующий код:</blockquote>';

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

echo '<blockquote>Хотя мы присоединили и <strong>lib1.php</strong> и <strong>lib2.php</strong>, идентификаторы <strong>MYCONST</strong>, <strong>MyFunction</strong> и <strong>MyClass</strong> будут относиться только к <strong>lib1.php</strong>. Это произойдет потому что код <strong>myapp1.php</strong> расположен в <span style="color:red;">едином</span> с <strong>App\Lib1</strong> пространстве имён. Результат:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		App\Lib1\MYCONST

		App\Lib1\MyFunction

		App\Lib1\MyClass::WhoAmI'
;
echo '</pre>';

echo '<blockquote><a href="example2/myapp.php" target="_blank">Живой пример</a>.</blockquote><br/>';

echo '<a name="p9"></a><h3>Импортирование пространств имён (Namespace Importing)</h3>';

echo '<blockquote>Пространства имён могут быть импортированы с помощью оператора <strong>use</strong>. Рассмотрим 2 файла <strong>lib1.php</strong> и <strong>lib2.php</strong> из предыдущего примера:</blockquote>';

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

echo '<blockquote>Вы можете импортировать с помощью <strong>use</strong> одно или несколько пространств имён, разделяя их запятой. В данном примере, мы импортировали пространство имён <strong>App\Lib2</strong>. Мы все еще не можем ссылаться прямо на <strong>MYCONST</strong>, <strong>MyFunction</strong> или <strong>MyClass</strong> потому что наш код находится в глобальном пространстве и PHP будет искать их именно там. Но если мы добавим префикс <strong>«Lib2\»</strong>, они станут квалифицированными именами, а PHP станет искать их в импортированных пространствах имён, пока не найдет полного совпадения. Результат:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		App\Lib2\MYCONST

		App\Lib2\MyFunction

		App\Lib2\MyClass::WhoAmI
	'
;
echo '</pre>';

echo '<blockquote><a href="example3/myapp.php" target="_blank">Живой пример</a>.</blockquote><br/>';

echo '<a name="p10"></a><h3>Псевдонимы пространства имён (Namespace Aliases)</h3>';

echo '<blockquote>Псевдонимы пространства имён, возможно, самая полезная конструкция. Псевдонимы позволяют ссылаться на длинные пространства имён с помощью короткого имени.</blockquote>';

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

echo '<blockquote>Первый оператор <strong>use</strong> определяет <strong>App\Lib1</strong> как <strong>«L»</strong>. Любое квалифицированное имя, использующее <strong>«L»</strong>, будет преобразовано во время компиляции в <strong>«App\Lib1»</strong>. Поэтому, мы скорее сошлемся на <strong>L\MYCONST</strong> или <strong>L\MyFunction</strong>, чем на полное квалифицированное имя.

Второй оператор <strong>use</strong> более интересен. Он определяет <strong>«Obj»</strong> как псевдоним для класса <strong>«MyClass»</strong> в пределах пространства имён <strong>App\Lib2\</strong>. Эта операция применительна <span style="color:red;">только для классов</span> — не для констант или функций. Теперь мы можем использовать <strong>new Obj()</strong>, или вызывать статические методы, как показано выше. Результат:</blockquote>';

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

echo '<blockquote><a href="example4/myapp.php" target="_blank">Живой пример</a>.</blockquote><br/>';

echo '<a name="p11"></a><h3>Правила разбора имён</h3>';

echo '<blockquote>Имена PHP идентификаторов разрешаются следующими правилами пространств имён. Для более полной информации, обратитесь к руководству по PHP (<a href="http://www.php.net/manual/en/language.namespaces.rules.php" target="_blank">на английском</a> / <a href="http://docs.php.net/manual/ru/language.namespaces.rules.php" target="_blank">на русском</a>)
<ul>
	<li>Вызов квалифицированных функций разрешается во время компилирования.</li>
	
	<li>Все квалифицированные имена транслируются во время компиляции в соответствии с текущими импортированными пространствами имён. К примеру, если импортировано пространство имён <strong>A::B::C</strong>, вызов <strong>C::D::e()</strong> будет транслирован как <strong>A::B::C::D::e()</strong>.</li>
	<li>Внутри пространства имён все квалифицированные имена транслируются согласно правилам импортирования, например, если пространство имён <strong>A\B\C</strong> импортируется как <strong>C,</strong> вызов <strong>C\D\e()</strong> транслируется в <strong>A\B\C\D\e()</strong>.</li>
	<li>Неквалифицированные имена классов транслируются во время компиляции в соответствии с текущими импортированными пространствами имён и полные имена заменяют короткие импортированные имена, например, если класс <strong>C</strong> в пространстве имён <strong>A\B</strong> импортирован как <strong>X</strong>, <strong>new X()</strong> будет транслирован в <strong>new A\B\C()</strong>.</li>
	<li>Внутри пространства имён вызов неквалифицированных функций интерпретируется во время компиляции. Например, если <strong>MyFunction()</strong> вызвана в пределах пространства имён <strong>A\B</strong>, PHP сперва ищет функцию <strong>\A\B\MyFunction()</strong>. Если она не будет найдена, PHP будет искать <strong>\MyFunction()</strong> в глобальном пространстве.</li>
	<li>Вызовы неквалифицированных или квалифицированных имён классов интерпретируется во время компиляции. Например, если мы вызываем <strong>new C()</strong> в пределах пространства имён <strong>A\B</strong>, PHP будет искать класс <strong>A\B\C</strong>. Если он не будет найден, это приведет к попытке <span style="color:red;">автозагрузки</span> <strong>A\B\C</strong>.</li>
</ul>
</blockquote><br/>';

echo '<a name="p12"></a><h3>Константа __NAMESPACE__</h3>';

echo '<blockquote><span style="color:red;">__NAMESPACE__</span> это константа PHP, которая всегда возвращает текущее имя пространства имён. В глобальном пространстве она будет всегда пустой строкой.</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
		namespace App\Lib1;

		echo __NAMESPACE__;
	'
;
echo '</pre>';

echo '<blockquote>Результат:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1'
;
echo '</pre>';

echo '<blockquote>Её значение имеет очевидную выгоду во время отладки. Её также можно использовать чтобы динамически генерировать полные квалифицированные имена классов, например:</blockquote>';

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

echo '<blockquote>Результат:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1\MyClass::WhoAmI'
;
echo '</pre><br/>';

echo '<a name="p13"></a><h3>Ключевое слово namespace</h3>';

echo '<blockquote>Ключевое слово <strongz>namespace</strong> может использоваться для того чтобы явно указать источник позиции (дать на него ссылку) в пределах текущего пространства имён или подпространства имён. Эквивалент <strong>namespace</strong> — ключевое слово <strong>self</strong> для классов:</blockquote>';

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

echo '<blockquote>Результат:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'App\Lib1\MyClass::WhoAmI'
;
echo '</pre><br/>';

echo '<a name="p14"></a><h3>Автозагрузка классов пространств имен</h3>';

echo '<blockquote>Одна из наилучших возможностей экономящих время в PHP 5 это <span style="color:red;">автозагрузка</span>. В глобальном (не отнесенном к какому-либо пространству имен) PHP коде, стандартная функция автозагрузки может быть записана следующим образом:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
	$obj1 = new MyClass1(); // загружен класс classes/MyClass1.php

	$obj2 = new MyClass2(); //загружен класс classes/MyClass2.php

 
	// функция автозагрузки
	
	function __autoload($class_name){

	  require_once("classes/$class_name.php");

	}
'
;
echo '</pre>';

echo '<blockquote>В PHP 5.3 Вы можете создать экземпляр класса пространства имен. В этой ситуации, полные квалифицированные имена пространств имён и имена классов передаются функции <strong>__autoload</strong>, например, значением <strong>$class_name</strong> может быть <strong>"App\Lib1\MyClass"</strong>. Вы можете продолжить размещать Ваши файлы PHP классов в одной и той же папке и отбирать пространства имён из строки, однако, это может привести к конфликту файловых имен.

В качестве альтернативы, файловая иерархия Ваших классов может быть организована таким же образом как и структура Ваших пространств имен. Например, файл <strong>MyClass.php</strong> может быть создан в папке <strong>/classes/App/Lib1</strong>:</blockquote>';

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

echo '<blockquote>Файл, находящийся в корневой директории может его использовать с помощью следующего кода:</blockquote>';

echo '<pre class="brush: php;">';
echo
	'
	//myapp.php
	
	use App\Lib1\MyClass as MC;

	$obj = new MC();

	echo $obj->WhoAmI();

	// функция автозагрузки

	function __autoload($class) {
	
		// конвертируем пространство имен в путь к файлу

		$class = "classes/" . str_replace("\\", "/", $class) . ".php";

		require_once($class);
	}
	'
;
echo '</pre>';