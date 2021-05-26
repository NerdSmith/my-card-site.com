<?php
require_once 'connection.php';

$con = mysqli_connect($host, $user, $password);
$db_selected = mysqli_select_db($con, $database);
mysqli_query($con, 'USE ' . $database);

$disallow = ['~', '\'', '"', '<', '>', '.', '%'];
$nick = str_replace($disallow, '', $_POST['name_input']);
$comment = str_replace($disallow, '', $_POST['comment_input']);
$sql = "INSERT INTO visitors (id_v, nick, date, text) VALUES (NULL, '$nick' , CURRENT_TIMESTAMP, '$comment')";
echo $sql;
if (!mysqli_query($con, $sql)) {
    echo 'Error database: ' . mysqli_error($con) . "\n";
}
mysqli_close($con);
?>