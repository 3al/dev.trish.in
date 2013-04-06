<?php

	//получаем данные из файла
	$res = file_get_contents('cut.txt');
	//делаем массив
	$store_arr = explode("\n", $res);
	
	foreach($store_arr as $num => $str){
        //echo $str."<br />";
        if(trim($str) != ''){
            $pocket = array();  
            if(preg_match("/^(.+?)\s+/", $str, $pocket)){
               /*  echo "<pre>";
                print_r($pocket);
                echo "</pre>"; */
                echo $num."-------------".$pocket[1]."<br / >";
            }
        }
         //echo "<hr />";
    }
	
/* 	echo "<pre>";
	print_r($store_arr  );
	echo "</pre>";
	exit; */