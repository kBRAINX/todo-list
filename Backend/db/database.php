<?php

$server="localhost";
$user="root";
$pass="";
$db_name="todolist";


try{
  
    $connect= new PDO("mysql:host=$server;dbname=$db_name",$user,$pass);
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
}catch(PDOException $e){
    echo "Connection failed : ". $e->getMessage();
}