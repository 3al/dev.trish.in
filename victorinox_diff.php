<?php

	//�������� ������ �� ����� ����� 1
	$res = file_get_contents('store1.txt');
	//������ ������ ����� 1
	$store1_arr = explode("\n", $res);
	
	//�������� ������ �� ����� ����� 2
	$res = file_get_contents('store2.txt');
	//������ ������ ����� 2
	$store2_arr = explode("\n", $res);
	
	//�������� ������ �� ����� �������
	$res = file_get_contents('shop.txt');
	//������ ������ �������
	$shop_arr = explode("\n", $res);
	
	//���������, ���� ��� �� �������, �� ���� � ��������
	$diff = array_diff($shop_arr, $store1_arr, $store2_arr);
	$diff = array_values($diff);
	
	echo "<pre>";
	print_r($diff);
	echo "</pre>";
	exit;