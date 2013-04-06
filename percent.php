<?php
    
    header('Content-Type: text/html; charset=utf-8');
    
    //соединяемся с бд конструктора
	$qs_host = "83.69.230.198";
	$qs_user = "root";
	$qs_pass = "qcon#sqlpwd";
	$qs_db = "constructor";
	
	$qres = mysql_connect($qs_host, $qs_user, $qs_pass);
    
	mysql_query("SET NAMES utf8", $qres);
	mysql_select_db($qs_db, $qres);
    
    //получаем первое и последнее числа прошлого месяца
	$first_day = date('Y-m-', mktime(0, 0, 0, date('m')-1, 1, date('Y')))."01";
	$first_day_stamp = strtotime($first_day);
	$last_day = date('Y-m-t', mktime(0, 0, 0, date('m')-1, 1, date('Y')));
	$last_day_stamp = strtotime($last_day);
    
    //var_dump($first_day);
    //var_dump($last_day); exit;
    
    //1. Достаем все ненулевые списания прошлого месяца, группируем в массив по site_id
    
   $sql = "SELECT billing_log.*, sites.name AS site_name FROM billing_log  LEFT JOIN sites ON billing_log.site_id = sites.id WHERE UNIX_TIMESTAMP(date) >= ".$first_day_stamp." AND UNIX_TIMESTAMP(date) <= ".$last_day_stamp." AND sum > 0";
   
    $r = mysql_query($sql, $qres);
    $res = array();
    while($row = mysql_fetch_assoc($r)){
       //$res[] = $row;
       $res[$row['site_id']]['logs'][$row['id']]['site_id'] = $row['site_id'];
       $res[$row['site_id']]['logs'][$row['id']]['item'] = $row['item'];
       $res[$row['site_id']]['logs'][$row['id']]['sum'] = $row['sum'];
       $res[$row['site_id']]['logs'][$row['id']]['site_name'] = $row['site_name'];
       $res[$row['site_id']]['logs'][$row['id']]['date'] = $row['date'];
    }
    
    
    
    /* echo "<pre>";
    print_r($res);
    echo "</pre>";
    exit; */
    
    //2. Проходимся по этому массиву, для каждой группы делаем запрос - ДОСТАТЬ ВСЕ СПИСАНИЯ С ТАКИМ site_id, дата которых ранее 1-го дня прошлого месяца, т.е. которые начали платить раньше. Если результат есть - значит эту группу удаляем из массива, она не подходит.
    
    foreach($res as $site_id => $logs){
        
        $sql = "SELECT * FROM billing_log WHERE site_id = ".$site_id." AND UNIX_TIMESTAMP(date) < ".$first_day_stamp." AND sum > 0";
        $rr = mysql_query($sql, $qres);
        $rres = array();
        while($rrow = mysql_fetch_assoc($rr)){
            $rres[] = $rrow; 
        }
        
        if($rres){
            unset($res[$site_id]);
        }
        
    }
    
    $totalsum = 0;
   
    //3. Подсчитываем списания, оставшиеся в массиве
    foreach($res as $site_id => $logs){
        
        $sitename = '';
        $siteid = '';
        
        foreach($logs['logs'] as $log_id => $log){
            
            $totalsum += $log['sum'];
            $sitename = $log['site_name'];
            $siteid = $log['site_id'];
            
        }
        
        echo $siteid." ".$sitename."<br />"; 
        
    }
    
    echo "<br /> <strong>Общая сумма новых поступлений:</strong>  ".$totalsum; exit;
    

    