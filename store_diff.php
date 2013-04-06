<?php

	//получаем данные из файла Склад 1
	$res = file_get_contents('store1.txt');
	//делаем массив Склад 1
	$store1_arr = explode("\n", $res);
	
	//получаем данные из файла Склад 2
	$res = file_get_contents('store2.txt');
	//делаем массив Склад 2
	$store2_arr = explode("\n", $res);
	
	//получаем данные из файла Магазин
	$res = file_get_contents('shop.txt');
	//делаем массив Магазин
	$shop_arr = explode("\n", $res);
	
	//вычисляем, чего нет на складах, но есть в магазине
	$diff = array_diff($store2_arr, $shop_arr);
	$diff = array_values($diff);
	
    foreach($diff as $num => $art){
        echo $art."<br />";
    }
    
	/* echo "<pre>";
	print_r($diff);
	echo "</pre>";
	exit; */