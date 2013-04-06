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
    
   /*  //1. Достаем все ненулевые списания прошлого месяца, группируем в массив по site_id
    
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
    } */
    
    //1. Достаем все ненулевые списания прошлого месяца, группируем в массив по userid_accountid
    
    $sql = "SELECT billing_log.*, sites.name AS site_name, sites.username FROM billing_log  LEFT JOIN sites ON billing_log.site_id = sites.id WHERE UNIX_TIMESTAMP(date) >= ".$first_day_stamp." AND UNIX_TIMESTAMP(date) <= ".$last_day_stamp." AND sum > 0";
   
    $r = mysql_query($sql, $qres);
    $res = array();
    while($row = mysql_fetch_assoc($r)){
       //$res[] = $row;
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['id'] = $row['id'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['site_id'] = $row['site_id'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['item'] = $row['item'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['sum'] = $row['sum'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['username'] = $row['username'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['site_name'] = $row['site_name'];
       $res[$row['bm_user_id']."_".$row['bm_account_id']]['logs'][$row['id']]['date'] = $row['date'];
    }
    
    /* echo "<pre>";
    print_r($res);
    echo "</pre>";
    exit; */
    
    /* //2. Проходимся по этому массиву, для каждой группы делаем запрос - ДОСТАТЬ ВСЕ СПИСАНИЯ С ТАКИМ site_id, дата которых ранее 1-го дня прошлого месяца, т.е. которые начали платить раньше. Если результат есть - значит эту группу удаляем из массива, она не подходит.
    
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
    
    $totalsum = 0; */
    
    //Проходимся по этому массиву, для каждой группы делаем запрос - ДОСТАТЬ ДАТУ САМОГО ПЕРВОГО СПИСАНИЯ с таким userid_accountid. 
    //Проходимся по списаниям - если дата списания - дата самого первого списания больше 30 дней, то удаляем списание из массива, оно не подходит.
   
   foreach($res as $userhash => $logs){
        
        $sql = "SELECT MIN(date) as min_date FROM billing_log WHERE CONCAT(bm_user_id, '_', bm_account_id) = '".$userhash."' AND sum > 0";
        
        $rr = mysql_query($sql, $qres);
        $rres = array();
        
        $rrow = mysql_fetch_assoc($rr);
        $min_date = $rrow['min_date'];
        $min_date_object = date_create($min_date);
        
        foreach($logs['logs'] as $log_id => $log){
            
            
            
            $date_log_object = date_create($log['date']);
            date_sub($date_log_object, date_interval_create_from_date_string('1 month'));
            
           /*  echo $log['date']."<br />";;
            echo date_format($date_log_object, 'Y-m-d')."<br>";
            echo date_format($min_date_object, 'Y-m-d');
            
            var_dump($date_log_object < $min_date_object); */
            
            //если с момента 1-го списания прошло более месяца, значит удаляем из массива, не подходит
            if($date_log_object > $min_date_object){
                unset($res[$userhash]['logs'][$log_id]);
            }
            
            //exit;
            
        }        
   }
   
   $totalsum = 0;
   
   /* echo "<pre>";
   print_r($res);
   echo "</pre>";
   exit; */
   
    //3. Подсчитываем списания, оставшиеся в массиве
   foreach($res as $user => $logs){
        
        $username = '';
        
        if(count($logs['logs'])){
                
            $reindexed = array_values($logs['logs']);
            
            echo "<h3>Пользователь: " .$reindexed[0]['username']. "</h3>";
            
            foreach($reindexed as $log_id => $log){
            
                $totalsum += $log['sum'];
                
                echo "Списание #".$log['id']." по сайту \"".$log['site_name']."\" на сумму ".$log['sum']." от ".date('Y-m-d', strtotime($log['date']))."<br />";
            
            }
            
            echo "<hr />";
            
        }
       
    }
    
    echo "<br /><br /> <strong>Общая сумма списаний за 1-й месяц платного периода:&nbsp;</strong>  <span style='color:green;'>".$totalsum."</span>"; exit;
    

    