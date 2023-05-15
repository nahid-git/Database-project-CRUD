<?php
require 'db-connect.php';
$receive_query = "SELECT * FROM student_info";
$datas = mysqli_query($db_connect, $receive_query);

$student = "SELECT COUNT(*) AS total FROM student_info";
$student_query = mysqli_query($db_connect, $student);
$student_data = mysqli_fetch_assoc($student_query);
$total_student = $student_data['total'];

$male_student = "SELECT COUNT(*) AS total_male FROM student_info WHERE gender = 'Male' ";
$male_student_query = mysqli_query($db_connect, $male_student);
$male_student_data = mysqli_fetch_assoc($male_student_query);
$male_total_student = $male_student_data['total_male'];

$female_student = "SELECT COUNT(*) AS total_female FROM student_info WHERE gender = 'Female' ";
$female_student_query = mysqli_query($db_connect, $female_student);
$female_student_data = mysqli_fetch_assoc($female_student_query);
$female_total_student = $female_student_data['total_female'];

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Database Project</title>

  <!-- Font Awesome 6 cdn -->
  <link rel="stylesheet" href="assets/fa/css/fontawesome.min.css">
  <script src="assets/fa/js/all.min.js"></script>

  <!-- Bootstarp css cdn -->
  <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="assets/CSS/dataTables.bootstrap5.min.css">

  <style>
    body {
      background: rgb(235, 221, 221);
      padding: 0;
      margin: 0;
    }
  </style>
</head>

<body>
  <header>
    <!-- Nav Start -->
    <nav class="navbar navbar-expand-lg bg-success navbar-dark fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav m-auto">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="reg.php">RegForm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="data-table.php">DataTable</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> 
    <!-- Nav End -->
  </header>

  <main>
    <!-- container start  -->
    <div class="container-fluid " style="margin-top: 65px">
      <div class="container">
        <div class="d-flex justify-content-between px-5">
          <h6 class="border border-dark p-2">Total Student : <span class="ms-2"><?php if(isset($total_student)) echo $total_student; ?></span></h6>
          <h6 class="border border-dark p-2">Total Boys : <span class="ms-2"><?php if(isset($male_total_student)) echo $male_total_student; ?></span></h6>
          <h6 class="border border-dark p-2">Total Girls : <span class="ms-2"><?php if(isset($female_total_student)) echo $female_total_student; ?></span> </h6>
        </div>
      </div>
      <!-- Data Table Start -->
      <hr>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Student ID</th>
            <th>Semester</th>
            <th>Gender</th>
            <th>Email address</th>
            <th>Password</th>
            <th>Address</th>
            <th>Photo</th>
            <th style="width: 200px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $serial = 1;
          foreach ($datas as $nahid) :
          ?>
            <tr>
              <td><?= $serial++ ?></td>
              <td><?= $nahid['name']; ?></td>
              <td><?= $nahid['batch']; ?></td>
              <td><?= $nahid['id']; ?></td>
              <td><?= $nahid['semester']; ?></td>
              <td><?= $nahid['gender']; ?></td>
              <td><?= $nahid['email']; ?></td>
              <td><?= $nahid['password']; ?></td>
              <td><?= $nahid['address']; ?></td>
              <td><img src="upload/<?php echo $nahid['photo']; ?>" style="height:80px; width:80px; padding: 2px" alt="Image"></td>

              <td>
                <!-- Edit Button Start -->
                <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModa<?= $nahid['id']; ?>" style="width:80px; margin-bottom: 10px">
                  <a href="#" class="text-white text-decoration-none">
                    <span><i class="fa-solid fa-pen-to-square"></i></span> <span>Edit</span> </a>
                </button>
                <!-- Edit Button End -->

                <!-- Modal reg form -->
                <div class="modal fade" id="exampleModa<?= $nahid['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form class="px-4" action="update.php" method="POST" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label class="form-label ">Name</label>
                            <input type="text" class="form-control" value="<?= $nahid['name']; ?>" name="edit_name">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Batch </label>
                            <select class="form-select" aria-label="Default select example" name="edit_batch">
                              <option value=" ">--select--</option>
                              <?php for ($i = 1; $i <= 21; $i++) : ?>
                                <option value="<?php echo $i ?>" <?php if ($nahid['batch'] == $i) echo "selected"; ?>>
                                  <?php echo $i ?>
                                </option>
                              <?php endfor ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label ">Student ID</label>
                            <input type="number" class="form-control" value="<?= $nahid['id']; ?>" name="edit_id" readonly>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Semester </label>
                            <select class="form-select" aria-label="Default select example" name="edit_semester">
                              <option value=" ">--select--</option>
                              <?php for ($i = 1; $i <= 8; $i++) : ?>
                                <option value="<?php echo $i ?>" <?php if ($nahid['semester'] == $i) echo "selected"; ?>>
                                  <?php echo $i ?>
                                </option>
                              <?php endfor ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Gender </label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="edit_gender" value="Male" <?php if ($nahid['gender'] == "Male") echo "checked"; ?>> Male<br>
                              <input class="form-check-input" type="radio" name="edit_gender" value="Female" <?php if ($nahid['gender'] == "Female") echo "checked"; ?>> Female
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" value="<?= $nahid['email']; ?>" name="edit_email">
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password </label>
                            <input type="text" class="form-control" placeholder="Password" id="edit_pass" value="<?= $nahid['password']; ?>" name="edit_password">
                            <div class="form-text"> 
                              
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <div class="form-floating">
                              <textarea class="form-control pt-3" name="edit_address"><?= $nahid['address']; ?></textarea>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Photo</label><br>
                            <input class="form-control" type="file" name="edit_photo" accept="image/*" onchange="readURL(this);">
                            <img id="edit_photo" src="upload/<?php echo $nahid['photo']; ?>" alt="Image" style="height: 100px; width: 100px; padding: 10px;">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button name="edit_btn" class="btn btn-primary btn-sm" id="edit_btn">Save Change</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal reg form -->

                <!-- Delete Button Start-->
                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $nahid['id']; ?>" style="width:80px; margin-bottom: 10px">
                  <a href="#" class="text-white text-decoration-none">
                    <span><i class="fa-solid fa-trash-can fs-6"></i></span> <span> Delete</span> </a>
                </button>
                <!-- Delete Button End-->

                <!-- Delete Modal -->
                <div class="modal fade" id="exampleModal<?= $nahid['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <a href="delete.php?id=<?= $nahid['id']; ?>" type="button" class="btn btn-primary btn-sm">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Delete Modal End-->
              </td>
            <?php
          endforeach;
            ?>
            </tr>
        </tbody>
      </table>
      <!-- Data Table end -->
    </div>
    <!-- container end -->
  </main>

  <!-- Bootstarp js cdn -->
  <script src="assets/JS/bootstrap.bundle.min.js"></script>
  <script src="assets/JS/main.js"></script>
  <!-- Datatable -->
    <script src="assets/JS/jquery-3.5.1.js"></script>
    <script src="assets/JS/jquery.dataTables.min.js"></script>
    <script src="assets/JS/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });
    </script>

  <script>
    // Image Show
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#edit_photo')
            .attr('src', e.target.result)
            .width(80)
            .height(80);
        };
        reader.readAsDataURL(input.files[0])
      }
    }
  </script>
</body>

</html>