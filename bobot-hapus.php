<?php
require "include/conn.php";
$id = $_GET['id'];
mysqli_query($db, "DELETE FROM `saw_criterias` WHERE id_criteria='$id'");

header("location:./matrik.php");