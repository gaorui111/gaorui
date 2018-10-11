<?php
header("content-type:text/html;charset=utf-8");
include 'ImportExportWithExcel.php';

$obj=new ImportExportWithExcel();

// 一 导入数据
$path='one.xlsx';	// 需要导入的Exel文件，大家使用文件上传功能上传文件，获取Excel文件名
$data=$obj->import($path);		// 调用import方法，获取Excel文件中的数据，返回的数据存放到$data数组中
// echo '<pre/>';
// var_dump($data);

// 二 导出数据（从数据库中读取出数据，存放到Excel中，生成Excel文件）
$title='商品数据统计';		// 数据的标题
$tableHeader=array('序号','标题','销售价格');		// 每列的标题
$tableName='商品数据';		// 文件名
//查询数据
$pdo= new PDO('mysql:host=localhost;dbname=yii;','root','root');
$sql="select id,good_name,good_price，good_stock from  limit 5";
$data=$pdo->query($sql)->fetchAll();
//调用export方法导出数据
//$obj->export(表的标题,列标题,工作表标签名,从数据库中读取出来的数据);		
$obj->export($title,$tableHeader,$tableName,$data);		