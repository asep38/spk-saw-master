<?php
require "include/conn.php";

$id_alternative = $_POST['id_alternative'];
$criteria_values = $_POST['criteria_values'];

$total_criteria = count($criteria_values);

for ($i = 0; $i < $total_criteria; $i++) {
    $value = $criteria_values[$i];

    $id_criteria = $i + 1;

    if ($value >= 1 && $value <= 4) {
        $sql = "INSERT INTO saw_evaluations (id_alternative, id_criteria, value) VALUES ('$id_alternative', '$id_criteria', '$value')";
        $result = $db->query($sql);

        if (!$result) {
            echo '<script>alert("Gagal menyimpan data. Mungkin terdapat entri duplikat."); window.location.href="matrik.php";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Nilai kriteria tidak valid."); window.location.href="matrik.php";</script>';
        exit();
    }
}

header("location:./matrik.php");
