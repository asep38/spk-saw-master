<?php
$sql = "SELECT
a.id_alternative,
b.name,
SUM(IF(a.id_criteria=1,a.value,0)) AS C1,
SUM(IF(a.id_criteria=2,a.value,0)) AS C2,
SUM(IF(a.id_criteria=3,a.value,0)) AS C3,
SUM(IF(a.id_criteria=4,a.value,0)) AS C4,
SUM(IF(a.id_criteria=5,a.value,0)) AS C5,
SUM(IF(a.id_criteria=6,a.value,0)) AS C6,
SUM(IF(a.id_criteria=7,a.value,0)) AS C7,
SUM(IF(a.id_criteria=8,a.value,0)) AS C8,
SUM(IF(a.id_criteria=9,a.value,0)) AS C9,
SUM(IF(a.id_criteria=10,a.value,0)) AS C10,
SUM(IF(a.id_criteria=11,a.value,0)) AS C11,
SUM(IF(a.id_criteria=12,a.value,0)) AS C12,
SUM(IF(a.id_criteria=13,a.value,0)) AS C13,
SUM(IF(a.id_criteria=14,a.value,0)) AS C14,
SUM(IF(a.id_criteria=15,a.value,0)) AS C15,
SUM(IF(a.id_criteria=16,a.value,0)) AS C16,
SUM(IF(a.id_criteria=17,a.value,0)) AS C17,
SUM(IF(a.id_criteria=18,a.value,0)) AS C18,
SUM(IF(a.id_criteria=19,a.value,0)) AS C19,
SUM(IF(a.id_criteria=20,a.value,0)) AS C20
FROM
saw_evaluations a
JOIN saw_alternatives b USING(id_alternative)
GROUP BY a.id_alternative
ORDER BY a.id_alternative";
$result = $db->query($sql);
$X = array(
  1 => array(),
  2 => array(),
  3 => array(),
  4 => array(),
  5 => array(),
  6 => array(),
  7 => array(),
  8 => array(),
  9 => array(),
  10 => array(),
  11 => array(),
  12 => array(),
  13 => array(),
  14 => array(),
  15 => array(),
  16 => array(),
  17 => array(),
  18 => array(),
  19 => array(),
  20 => array()
);
while ($row = $result->fetch_object()) {
  array_push($X[1], round($row->C1, 2));
  array_push($X[2], round($row->C2, 2));
  array_push($X[3], round($row->C3, 2));
  array_push($X[4], round($row->C4, 2));
  array_push($X[5], round($row->C5, 2));
  array_push($X[6], round($row->C6, 2));
  array_push($X[7], round($row->C7, 2));
  array_push($X[8], round($row->C8, 2));
  array_push($X[9], round($row->C9, 2));
  array_push($X[10], round($row->C10, 2));
  array_push($X[11], round($row->C11, 2));
  array_push($X[12], round($row->C12, 2));
  array_push($X[13], round($row->C13, 2));
  array_push($X[14], round($row->C14, 2));
  array_push($X[15], round($row->C15, 2));
  array_push($X[16], round($row->C16, 2));
  array_push($X[17], round($row->C17, 2));
  array_push($X[18], round($row->C18, 2));
  array_push($X[19], round($row->C19, 2));
  array_push($X[20], round($row->C20, 2));
}
$result->free();

$sql = "SELECT
          a.id_alternative,
          SUM(
            IF(
              a.id_criteria=1,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[1]) . ",
                " . min($X[1]) . "/a.value)
              ,0)
              ) AS C1,
          SUM(
            IF(
              a.id_criteria=2,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[2]) . ",
                " . min($X[2]) . "/a.value)
               ,0)
             ) AS C2,
          SUM(
            IF(
              a.id_criteria=3,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[3]) . ",
                " . min($X[3]) . "/a.value)
               ,0)
             ) AS C3,
          SUM(
            IF(
              a.id_criteria=4,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[4]) . ",
                " . min($X[4]) . "/a.value)
               ,0)
             ) AS C4,
          SUM(
            IF(
              a.id_criteria=5,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[5]) . ",
                " . min($X[5]) . "/a.value)
               ,0)
             ) AS C5,
          SUM(
            IF(
              a.id_criteria=6,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[6]) . ",
                " . min($X[6]) . "/a.value)
               ,0)
             ) AS C6,
          SUM(
            IF(
              a.id_criteria=7,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[7]) . ",
                " . min($X[7]) . "/a.value)
               ,0)
             ) AS C7,
          SUM(
            IF(
              a.id_criteria=8,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[8]) . ",
                " . min($X[8]) . "/a.value)
               ,0)
             ) AS C8,
          SUM(
            IF(
              a.id_criteria=9,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[9]) . ",
                " . min($X[9]) . "/a.value)
               ,0)
             ) AS C9,
          SUM(
            IF(
              a.id_criteria=10,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[10]) . ",
                " . min($X[10]) . "/a.value)
               ,0)
             ) AS C10,
          SUM(
            IF(
              a.id_criteria=11,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[11]) . ",
                " . min($X[11]) . "/a.value)
               ,0)
             ) AS C11,
          SUM(
            IF(
              a.id_criteria=12,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[12]) . ",
                " . min($X[12]) . "/a.value)
               ,0)
             ) AS C12,
          SUM(
            IF(
              a.id_criteria=13,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[13]) . ",
                " . min($X[13]) . "/a.value)
               ,0)
             ) AS C13,
          SUM(
            IF(
              a.id_criteria=14,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[14]) . ",
                " . min($X[14]) . "/a.value)
               ,0)
             ) AS C14,
          SUM(
            IF(
              a.id_criteria=15,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[15]) . ",
                " . min($X[15]) . "/a.value)
               ,0)
             ) AS C15,
          SUM(
            IF(
              a.id_criteria=16,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[16]) . ",
                " . min($X[16]) . "/a.value)
               ,0)
             ) AS C16,
          SUM(
            IF(
              a.id_criteria=17,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[17]) . ",
                " . min($X[17]) . "/a.value)
               ,0)
             ) AS C17,
          SUM(
            IF(
              a.id_criteria=18,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[18]) . ",
                " . min($X[18]) . "/a.value)
               ,0)
             ) AS C18,
          SUM(
            IF(
              a.id_criteria=19,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[19]) . ",
                " . min($X[19]) . "/a.value)
               ,0)
             ) AS C19,
          SUM(
            IF(
              a.id_criteria=20,
              IF(
                b.attribute='benefit',
                a.value/" . max($X[20]) . ",
                " . min($X[20]) . "/a.value)
               ,0)
             ) AS C20
        FROM
          saw_evaluations a
          JOIN saw_criterias b USING(id_criteria)
        GROUP BY a.id_alternative
        ORDER BY a.id_alternative
       ";
$result = $db->query($sql);
$R = array();
while ($row = $result->fetch_object()) {
  $R[$row->id_alternative] = array(
    $row->C1,
    $row->C2,
    $row->C3,
    $row->C4,
    $row->C5,
    $row->C6,
    $row->C7,
    $row->C8,
    $row->C9,
    $row->C10,
    $row->C11,
    $row->C12,
    $row->C13,
    $row->C14,
    $row->C15,
    $row->C16,
    $row->C17,
    $row->C18,
    $row->C19,
    $row->C20
  );
}
