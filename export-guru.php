<?php
require './include/conn.php';
$id_alternative = $_GET['id'];
?>

<html>

<head>
  <title>
    <?php
    $query_nama = "SELECT * FROM `saw_alternatives` WHERE id_alternative = '$id_alternative'";
    $hasil = mysqli_query($db, $query_nama);
    if ($hasil) {
      // Tampilkan data sesuai dengan id_alternative
      while ($row = mysqli_fetch_assoc($hasil)) {
        $name = $row['name'];

      }
    }

    ?>
    <?= $name; ?>
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

    .garis {
      height: 1px;
      width: 100%;
      background-color: black;
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
  <div class="container d-flex justify-content-center">
    <div class="garis"></div>
  </div>
  <br>
  <div class="container">
    <h2>
      <?php echo $name; ?>
    </h2>

  </div>
  <br>
  <div class="container">
    <button class="print-button" onclick="window.print()">Cetak Halaman</button>
    <div class="data-tables datatable-dark">
      <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0" data-page-length="20">
        <thead>
          <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Nilai</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $query = "SELECT saw_evaluations.id_criteria, saw_criterias.criteria, saw_evaluations.value FROM saw_evaluations INNER JOIN saw_criterias ON saw_evaluations.id_criteria = saw_criterias.id_criteria WHERE saw_evaluations.id_alternative = $id_alternative";
          $result = mysqli_query($db, $query);
          $i = 1;
          // Periksa apakah query berhasil dieksekusi
          if ($result) {
            // Tampilkan data sesuai dengan id_alternative
            while ($row = mysqli_fetch_assoc($result)) {
              $id_criteria = $row['id_criteria'];
              $criteria = $row['criteria'];
              $value = $row['value'];
              // Tampilkan nilai id_criterias dan value
              // Tampilkan baris data dalam tabel
              echo "<tr>
            <td>{$i}</td>
            <td>{$criteria}</td>
            <td>{$value}</td>
            </tr>";
              $i++;
            }
          } else {
            echo "Query tidak berhasil dieksekusi: " . mysqli_error($koneksi);
          }
          ?>

        </tbody>


      </table>
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

</body>

</html>