<?php
error_reporting(0);
session_start();
include('conn.php');
if (!isset($_SESSION['member_id'])){
header('location:index.php');
}

/*
$log = new MyLogPHP();

$log->info('The program starts here.');

$log->warning('This problem can affect the program logic');

$log->warning('Use this software at your own risk!');

$log->info('Lawrence Lagerlof','AUTHOR');

$log->info('Asimov rulez','FACT');

$log->error('Everything crash and burn','IE');

$log->debug("select * from table",'DB');

*/
?>

