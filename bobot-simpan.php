<?php
require "include/conn.php";
$criteria = $_POST['criteria'];
$weight = $_POST['weight'];
$attribute = $_POST['attribute'];
// $x = $db->query($sql);
// var_dump($x);
$sql = "INSERT INTO `saw_criterias`( `criteria`, `weight`, `attribute`) VALUES ('$criteria','$weight','$attribute')";

if ($db->query($sql) === true) {
    header("location:./bobot.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

