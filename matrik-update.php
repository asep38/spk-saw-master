<?php
require_once "include/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_alternative'], $_POST['name'], $_POST['editC1'], $_POST['editC2'], $_POST['editC3'])) {
        $id_alternative = $_POST['id_alternative'];
        $name = $_POST['name'];
        $editC1 = $_POST['editC1'];
        $editC2 = $_POST['editC2'];
        $editC3 = $_POST['editC3'];

        $sql_update_alternative = "UPDATE saw_alternatives SET name = ? WHERE id_alternative = ?";
        $stmt_update_alternative = $db->prepare($sql_update_alternative);
        $stmt_update_alternative->bind_param("si", $name, $id_alternative);

        if ($stmt_update_alternative->execute()) {
            $criteria_values = array($editC1, $editC2, $editC3);
            $criteria_ids = array(1, 2, 3);

            $sql_update_criteria = "UPDATE saw_evaluations SET value = ? WHERE id_alternative = ? AND id_criteria = ?";
            $stmt_update_criteria = $db->prepare($sql_update_criteria);

            foreach ($criteria_ids as $criteria_id) {
                $stmt_update_criteria->bind_param("iii", $criteria_values[$criteria_id - 1], $id_alternative, $criteria_id);
                $stmt_update_criteria->execute();
            }

            $stmt_update_criteria->close();
            $stmt_update_alternative->close();

            $response = array(
                'status' => 'success',
                'message' => 'Data alternatif dan nilai-nilai kriteria berhasil diperbarui.'
            );
            echo json_encode($response);
            // header("location:./matrik.php");
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data alternatif.'
            );
            echo json_encode($response);
        }

        $db->close();
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Data yang diperlukan tidak lengkap.'
        );
        echo json_encode($response);
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Metode tidak diizinkan.'
    );
    echo json_encode($response);
}
