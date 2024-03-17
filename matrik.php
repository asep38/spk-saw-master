<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
?>
<style>
  .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Warna gelap dengan opasitas 50% */
    z-index: 1040;
    opacity: 0;
    transition: opacity 0.15s linear;
  }

  .modal-backdrop.show {
    opacity: 1;
  }
</style>


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
        <h3>Matrik</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Matriks Keputusan (X) &amp; Ternormalisasi (R)</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <p class="card-text">Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternormalisasi
                    (R), dengan ketentuan :
                    Untuk normalisai nilai, jika faktor/attribute kriteria bertipe cost maka digunakan rumusan:
                    Rij = ( min{Xij} / Xij)
                    sedangkan jika faktor/attribute kriteria bertipe benefit maka digunakan rumusan:
                    Rij = ( Xij/max{Xij} )</p>
                  <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#inlineForm">
                    Isi Nilai Alternatif
                  </button>
                </div>
                <!-- START FIX BUG  -->
                <?php
                $sql = "SELECT COUNT(*) as count FROM saw_evaluations";
                $result = $db->query($sql);
                $count = $result->fetch_object()->count;
                $result->free();
                if ($count > 0) {
                ?>
                  <div class="table-responsive">
                    <table class="table table-striped mb-0">
                      <caption>
                        Matrik Keputusan(X)
                      </caption>
                      <tr>
                        <th rowspan='2'>Alternatif</th>
                        <th colspan='6'>Kriteria</th>
                      </tr>
                      <tr>
                        <th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
                        <th>C4</th>
                        <th>C5</th>
                        <th>C6</th>
                        <th>C7</th>
                        <th>C8</th>
                        <th>C9</th>
                        <th>C10</th>
                        <th>C11</th>
                        <th>C12</th>
                        <th>C13</th>
                        <th>C14</th>
                        <th>C15</th>
                        <th>C16</th>
                        <th>C17</th>
                        <th>C18</th>
                        <th>C19</th>
                        <th>C20</th>
                      </tr>
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
                        20 => array(),
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
                        echo "<tr class='center'>
            <th>A<sub>{$row->id_alternative}</sub> {$row->name}</th>
            <td>" . round($row->C1, 2) . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
            <td>" . round($row->C4, 2) . "</td>
            <td>" . round($row->C5, 2) . "</td>
            <td>" . round($row->C6, 2) . "</td>
            <td>" . round($row->C7, 2) . "</td>
            <td>" . round($row->C8, 2) . "</td>
            <td>" . round($row->C9, 2) . "</td>
            <td>" . round($row->C10, 2) . "</td>
            <td>" . round($row->C11, 2) . "</td>
            <td>" . round($row->C12, 2) . "</td>
            <td>" . round($row->C13, 2) . "</td>
            <td>" . round($row->C14, 2) . "</td>
            <td>" . round($row->C15, 2) . "</td>
            <td>" . round($row->C16, 2) . "</td>
            <td>" . round($row->C17, 2) . "</td>
            <td>" . round($row->C18, 2) . "</td>
            <td>" . round($row->C19, 2) . "</td>
            <td>" . round($row->C20, 2) . "</td>
            <td>
            <a href='keputusan-hapus.php?id={$row->id_alternative}' class='btn btn-danger btn-sm'>Hapus</a>
            <button type='button' class='btn btn-primary btn-sm' 
            onclick='openEditModal({$row->id_alternative})'>Edit</button>
            </td>
          </tr>\n";
                      }
                      $result->free();

                      ?>
                    </table>

                    <table class="table table-striped mb-0">
                      <caption>
                        Matrik Ternormalisasi (R)
                      </caption>
                      <tr>
                        <th rowspan='2'>Alternatif</th>
                        <th colspan='5'>Kriteria</th>
                      </tr>
                      <tr>
                        <th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
                        <th>C4</th>
                        <th>C5</th>
                        <th>C6</th>
                        <th>C7</th>
                        <th>C8</th>
                        <th>C9</th>
                        <th>C10</th>
                        <th>C11</th>
                        <th>C12</th>
                        <th>C13</th>
                        <th>C14</th>
                        <th>C15</th>
                        <th>C16</th>
                        <th>C17</th>
                        <th>C18</th>
                        <th>C19</th>
                        <th>C20</th>
                      </tr>
                      <?php
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
                        echo "<tr class='center'>
            <th>A{$row->id_alternative}</th>
            <td>" . round($row->C1, 2) . "</td>
            <td>" . round($row->C2, 2) . "</td>
            <td>" . round($row->C3, 2) . "</td>
            <td>" . round($row->C4, 2) . "</td>
            <td>" . round($row->C5, 2) . "</td>
            <td>" . round($row->C6, 2) . "</td>
            <td>" . round($row->C7, 2) . "</td>
            <td>" . round($row->C8, 2) . "</td>
            <td>" . round($row->C9, 2) . "</td>
            <td>" . round($row->C10, 2) . "</td>
            <td>" . round($row->C11, 2) . "</td>
            <td>" . round($row->C12, 2) . "</td>
            <td>" . round($row->C13, 2) . "</td>
            <td>" . round($row->C14, 2) . "</td>
            <td>" . round($row->C15, 2) . "</td>
            <td>" . round($row->C16, 2) . "</td>
            <td>" . round($row->C17, 2) . "</td>
            <td>" . round($row->C18, 2) . "</td>
            <td>" . round($row->C19, 2) . "</td>
            <td>" . round($row->C20, 2) . "</td>
          </tr>\n";
                      }
                      ?>
                    </table>
                  </div>
                <?php } else { ?>
                  <div class="text-center p-3" role="alert">
                    <strong>Tidak ada data yang tersedia.</strong>
                  </div>
                <?php } ?>
                <!-- END FIX BUG  -->
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require "layout/footer.php"; ?>
    </div>
  </div>

  <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel33">Isi Nilai Kandidat </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="matrik-simpan.php" method="POST">
          <div class="modal-body">
            <label>Name: </label>
            <div class="form-group">
              <select class="form-control form-select" name="id_alternative">
                <?php
                $sql = 'SELECT id_alternative,name FROM saw_alternatives';
                $result = $db->query($sql);
                $i = 0;
                while ($row = $result->fetch_object()) {
                  echo '<option value="' . $row->id_alternative . '">' . $row->name . '</option>';
                }
                $result->free();
                ?>
              </select>
            </div>
          </div>
          <div class="modal-body">
            <label>Criteria: </label>
            <div class="form-group">
              <select class="form-control form-select" name="id_criteria">
                <?php
                $sql = 'SELECT * FROM saw_criterias';
                $result = $db->query($sql);
                $i = 0;
                while ($row = $result->fetch_object()) {
                  echo '<option value="' . $row->id_criteria . '">' . 'C' . $row->id_criteria . '-' . $row->criteria . '</option>';
                }
                $result->free();
                ?>
              </select>
            </div>
          </div>
          <div class="modal-body">
            <label>Nilai: (masukan nilai dari 1 - 4)</label>
            <div class="form-group">
              <input type="text" name="value" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" name="submit" class="btn btn-primary ml-1">
              <i class="bx bx-check d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Simpan</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal modal-backdrop fade show text-left" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit</h5>
        </div>
        <div class="modal-body">
          <form id="editForm" onsubmit="updateValues()">
            <input type="hidden" name="id_alternative" id="editId">
            <div class="form-group">
              <label for="editName">Name:</label>
              <input type="text" class="form-control" id="editName" name="name" disabled>
            </div>
            <div class="form-group">
              <label for="editC1">Nilai C1:</label>
              <input type="number" class="form-control" id="editC1" name="editC1" required>
            </div>
            <div class="form-group">
              <label for="editC1">Nilai C2:</label>
              <input type="number" class="form-control" id="editC2" name="editC2" required>
            </div>
            <div class="form-group">
              <label for="editC1">Nilai C3:</label>
              <input type="number" class="form-control" id="editC3" name="editC3" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-secondary" data-dismiss="modal" aria-label="Close" onclick="closeEditModal()">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php require "layout/js.php"; ?>

  <script>
    function openEditModal(id) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          var response = JSON.parse(this.responseText);
          // console.log(response);
          document.getElementById("editId").value = response.id_alternative;
          document.getElementById("editName").value = response.name;
          document.getElementById("editC1").value = response.C1;
          document.getElementById("editC2").value = response.C2;
          document.getElementById("editC3").value = response.C3;
          document.getElementById("editModal").classList.add("fade");
          document.getElementById("editModal").style.display = "block";
          setTimeout(function() {
            document.getElementById("editModal").classList.add("show");
            document.body.classList.add("modal-open");
          }, 100);
        }
      };
      xhr.open("GET", "keputusan-edit.php?id=" + id, true);
      xhr.send();
    }

    function closeEditModal() {
      document.getElementById("editModal").classList.remove("show");
      document.body.classList.remove("modal-open");
      setTimeout(function() {
        document.getElementById("editModal").style.display = "none";
        document.getElementById("editModal").classList.remove("fade");
      }, 500);
    }

    function updateValues() {

      var editC1 = document.getElementById('editC1').value;
      var editC2 = document.getElementById('editC2').value;
      var editC3 = document.getElementById('editC3').value;
      // Ambil nilai C4 hingga C20 yang lainnya sesuai kebutuhan

      // Kirim nilai-nilai ini ke server untuk disimpan
      var formData = new FormData();
      formData.append('id_alternative', document.getElementById('editId').value);
      formData.append('name', document.getElementById('editName').value);
      formData.append('editC1', editC1);
      formData.append('editC2', editC2);
      formData.append('editC3', editC3);
      // Tambahkan append untuk C4 hingga C20

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          var response = JSON.parse(this.responseText);
          if (response.status === 'success') {
            alert(response.message);
            closeEditModal()
          } else {
            alert(response.message);
            closeEditModal()
          };
        }
      };
      xhr.open("POST", "matrik-update.php", true);
      xhr.send(formData);
    }
  </script>


</body>

</html>