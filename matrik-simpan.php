<?php
require "include/conn.php";

$id_alternative = $_POST['id_alternative'];
$id_criteria = $_POST['id_criteria'];
$value = $_POST['value'];

$sql = "INSERT INTO saw_evaluations values ('$id_alternative','$id_criteria','$value')";
$result = $db->query($sql);

try {
    //code...
    if ($result === true) {
        header("location:./matrik.php");
    } else {
        echo '<script>alert("Gagal menyimpan data. Mungkin terdapat entri duplikat."); window.location.href="matrik.php";</script>';
        // echo "Error: " . $sql . "<br>" . $db->error;
    }
} catch (mysqli_sql_exception $e) {
    //throw $th;
    echo '<script>alert("Terjadi kesalahan: ' . $e->getMessage() . '"); window.location.href="matrik.php";</script>';
}


