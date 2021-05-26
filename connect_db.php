<?php
require_once 'connection.php';
$link = mysqli_connect($host, $user, $password);

if (!$link) {
    die('Could not connect: ');
}

$db_selected = mysqli_select_db($link, $database);

if (!$db_selected) {
  $sql = 'CREATE DATABASE ' . $database;
  if (mysqli_query($link, $sql)) {
    mysqli_query($link, 'USE ' . $database);
      //echo "Database my_db created successfully\n";
  } else {
      echo 'Error creating database: ' . mysqli_error($link) . "\n";
  }
}
else {
  //echo "connected to db";
}

$val = mysqli_query($link, 'select 1 from visitors');
if($val !== False)
{
   //echo "exists";
}
else
{
  $query = file_get_contents("visitors.sql");
  if (mysqli_multi_query($link, $query)) {
    //echo "Table created successfully\n";
  }else {
    echo 'Error creating database: ' . mysqli_error($link) . "\n";
  }
}