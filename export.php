<?php
require './include/conn.php';
require "W.php";
require "R.php";
// $id_alternative = $_GET['id'];

$query_nama = "SELECT * FROM `saw_alternatives`";
$hasil = mysqli_query($db, $query_nama);
if ($hasil) {
  // Tampilkan data sesuai dengan id_alternative
  while ($row = mysqli_fetch_assoc($hasil)) {
    $name = $row['name'];


  }
}

?>

<html>

<head>
  <title>
    Nilai Guru
  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <style>
    .no-border {
      border: none;
    }

    .print-button {
      display: block;
    }

    @media print {
      .print-button {
        display: none;
      }
    }

    img {
      height: 100px;
    }

    .uppercase {
      text-transform: uppercase;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-between mt-4">
    <div>
      <img src="assets/images/LogoKabupatenCiamis.png" alt="">
    </div>
    <div class="text-center">
      <p class="uppercase">
        Pemerintah kabupaten ciamis dinas pendidikan
      </p>
      <h2>
        SMP NEGERI 1 CIHAURBEUTI
      </h2>
      <p>
        Jl.Panjalu No.26 Sukamulya Cihaurbeuti tlp.(0265)336005 Ciamis
      </p>
    </div>
    <div>
      <img src="assets/images/logo-smpn1.jpeg" alt="">
    </div>
  </div>

  <div class="container">
    <button class="print-button" onclick="window.print()">Cetak Halaman</button>
    <div class="data-tables datatable-dark">
      <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0" data-page-length="20">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Nilai</th>
            <th>Rank</th>

          </tr>
        </thead>

        <tbody>
          <?php

          $P = array();
          $m = count($W);
          $no = 0;
          foreach ($R as $i => $r) {
            for ($j = 0; $j < $m; $j++) {
              $P[$i] = (isset($P[$i]) ? $P[$i] : 0) + $r[$j] * $W[$j];
            }
          }

          // Urutkan array $P dari nilai terbesar ke terkecil
          arsort($P);

          // Tetapkan peringkat pada setiap nilai
          $ranking = array();
          $rank = 1;
          foreach ($P as $id_alternative => $value) {
            // Query untuk mengambil nama alternatif berdasarkan id_alternative
            $query_nama = "SELECT name FROM `saw_alternatives` WHERE id_alternative = $id_alternative";
            $hasil = mysqli_query($db, $query_nama);

            // Periksa apakah query berhasil dieksekusi
            if ($hasil) {
              // Periksa apakah ada hasil yang ditemukan
              if (mysqli_num_rows($hasil) > 0) {
                // Ambil data nama dari hasil query
                $row = mysqli_fetch_assoc($hasil);
                $name = $row['name'];
              } else {
                $name = "Nama tidak ditemukan";
              }
            } else {
              $name = "Query tidak berhasil dieksekusi: " . mysqli_error($db);
            }

            // Tampilkan hasil peringkat dalam tabel bersama dengan nama
            echo "<tr class='center'>
        <td>" . (++$no) . "</td>
        <td>A{$id_alternative}</td>
        <td>{$name}</td>
        <td>" . number_format($P[$id_alternative], 2) . "</td>
        <td>{$rank}</td>
        
      </tr>";
            $rank++;
          }
          ?>

        </tbody>
      </table>
    </div>
    <div class="container d-flex justify-content-between">
      <div></div>
      <div>
        Ciamis, <span id="tanggalwaktu"></span>
        <br>
        <br>
        <br>
        <br>

        ___________________________________
        <br>
        (Kepala Sekolah)
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

  <script>
    // $(document).ready(function () {
    //   var table = $('#mauexport').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //       {
    //         extend: 'excel',
    //         footer: true
    //       },
    //       {
    //         extend: 'pdf',
    //         footer: true
    //       },
    //       {
    //         extend: 'print',
    //         footer: true
    //       }
    //     ]
    //   });
    // });
  </script>
  <script>
    var dt = new Date();
    var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var namaBulan = bulan[dt.getMonth()];

    document.getElementById("tanggalwaktu").innerHTML = ("0" + dt.getDate()).slice(-2) + " " + namaBulan + " " + dt.getFullYear();
  </script>

</body>

</html>