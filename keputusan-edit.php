<?php

require_once "include/conn.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID alternatif tidak valid.");
}

$id_alternative = $_GET['id'];

$sql = "SELECT a.*, 
               SUM(IF(e.id_criteria=1, e.value, 0)) AS C1,
               SUM(IF(e.id_criteria=2, e.value, 0)) AS C2,
               SUM(IF(e.id_criteria=3, e.value, 0)) AS C3,
               SUM(IF(e.id_criteria=4, e.value, 0)) AS C4,
               SUM(IF(e.id_criteria=5, e.value, 0)) AS C5,
               SUM(IF(e.id_criteria=6, e.value, 0)) AS C6,
               SUM(IF(e.id_criteria=7, e.value, 0)) AS C7,
               SUM(IF(e.id_criteria=8, e.value, 0)) AS C8,
               SUM(IF(e.id_criteria=9, e.value, 0)) AS C9,
               SUM(IF(e.id_criteria=10, e.value, 0)) AS C10,
               SUM(IF(e.id_criteria=11, e.value, 0)) AS C11,
               SUM(IF(e.id_criteria=12, e.value, 0)) AS C12,
               SUM(IF(e.id_criteria=13, e.value, 0)) AS C13,
               SUM(IF(e.id_criteria=14, e.value, 0)) AS C14,
               SUM(IF(e.id_criteria=15, e.value, 0)) AS C15,
               SUM(IF(e.id_criteria=16, e.value, 0)) AS C16,
               SUM(IF(e.id_criteria=17, e.value, 0)) AS C17,
               SUM(IF(e.id_criteria=18, e.value, 0)) AS C18,
               SUM(IF(e.id_criteria=19, e.value, 0)) AS C19,
               SUM(IF(e.id_criteria=20, e.value, 0)) AS C20
        FROM saw_alternatives a
        LEFT JOIN saw_evaluations e ON a.id_alternative = e.id_alternative
        WHERE a.id_alternative = ?
        GROUP BY a.id_alternative";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_alternative);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "Data alternatif tidak ditemukan.";
}

$stmt->close();
$db->close();
