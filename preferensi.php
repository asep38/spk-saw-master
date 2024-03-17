<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
require "W.php";
require "R.php";
?>

<body>
  <div id="app">
    <?php require "layout/sidebar.php"; ?>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="page-heading">
        <h3>Nilai Preferensi (P)</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Tabel Nilai Preferensi (P)</h4>
                <a class="btn btn-primary" href="./export.php">Cetak Laporan</a>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <p class="card-text">
                    Nilai preferensi (P) merupakan penjumlahan dari perkalian matriks ternormalisasi R dengan vektor
                    bobot W.</p>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <caption>
                      Nilai Preferensi (P)
                    </caption>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Alternatif</th>
                      <th>Hasil</th>
                      <th>Ranking</th>
                      <!-- <th>Aksi</th> -->
                    </tr>
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
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require "layout/footer.php"; ?>
    </div>
  </div>
  <?php require "layout/js.php"; ?>
</body>

</html>