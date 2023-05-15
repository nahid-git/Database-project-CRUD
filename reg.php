<?php
  require 'db-connect.php';

  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $batch = $_POST['batch'];
    $id = $_POST['id'];
    $semester = $_POST['semester'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $photo_name = $_FILES['photo']['name'];
    $photo_temp_name = $_FILES['photo']['tmp_name'];

    // Form Validation Start
    $empt = []; 
    $flag = 0;
    if(empty($name)) 
    { 
      $empt['name'] ="* Please enter your Name.";
      $flag = 1;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name) && !empty($name)) 
    {
      $nameErr = "* Only letters and white space allowed.";
      $flag = 1;
    }
    if(empty($batch) || $batch == "--select--")
    {
      $empt['batch'] ="* Please enter your Batch.";
      $flag = 1;
    } 
    $idd = "SELECT id FROM student_info WHERE id = '$id' ";
    $result = mysqli_query($db_connect, $idd);
    $ids = mysqli_fetch_assoc($result);

    $iddd = isset($ids['id']);

    if($id == $iddd && !empty($id) && !empty($iddd))
    {
      $id_check = "* This ID already registered.";
      echo '<script>alert("This ID already registered.")</script>';
    }
    if(empty($id))
    {
      $empt['id'] ="* Please enter your ID.";
      $flag = 1;
    } 
    $coun = strlen($id);
    if( $coun != 11)
    {
       $id_len ="* Student id must have 11 digite.";
       $flag = 1;
    } 
    if(empty($semester) || $semester == "--select--")
    {
      $empt['semester'] ="* Please enter your Semester.";
      $flag = 1;
    }  
    if(empty($email))
    {
      $empt['email'] ="* Please enter your E-mail.";
      $flag = 1;
    } 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
      $emailErr = "Invalid email format";
      $flag = 1;
    }
    if(empty($gender))
    {
      $empt['gender'] ="* Please enter your Gender.";
      $flag = 1;
    }  
    if(empty($password)) 
    {
      $empt['password'] ="* Please enter Password.";
      $flag = 1;
    } 
    if(strlen($password) < 6 && !empty($password)) 
    {
      $pass_len = "* Password at least 6 characters. ";
      $flag = 1;
    } 
     // Pass and Con Pass Equal
     if($password != $confirm_password && !empty($confirm_password))
     {
       $c_pass_not_equal = "* Password not match.";
     }
    if(empty($confirm_password)) 
    {
      $empt['confirm_password'] ="* Please enter Confirm Password.";
      $flag = 1;
    } 
    if(empty($address)) 
    {
      $empt['address'] ="* Please enter your Address.";
      $flag = 1;
    } 
    if(empty($photo_name))
    {
      $empt['photo'] ="* Please enter your Photo.";
      $flag = 1;
    }  
    // Form Validation End

    // Captcha Check Start
    session_start();
    $status = '';
    if ( isset($_POST['captcha']) && ($_POST['captcha']!="") ){
    if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
      $status = '<script>alert("Entered captcha code does not match! Kindly try again.")</script>';
      $flag = 1;
      }
    }
    if(empty($_POST['captcha']))
    {
      echo '<script>alert("Please Enter Captcha. ")</script>';
      $flag = 1;
    }
     // Captcha Check End

    if($flag == 0)
    {
      move_uploaded_file($photo_temp_name, "upload/".$photo_name);
      $insert_query = "INSERT INTO student_info (name, batch, id, semester, gender, email, password, address, photo) 
      VALUES ('$name','$batch','$id','$semester','$gender','$email','$confirm_password','$address','$photo_name')";
    
      mysqli_query($db_connect, $insert_query);
      echo "Thank you";
      header("location: data-table.php");
    }else{
      echo $status;
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Registration Form</title>
      <link rel="icon" href="assets/Image/icon.png">

      <!-- Font Awesome 6 cdn -->
      <link rel="stylesheet" href="assets/fa/css/fontawesome.min.css">
      <script src="assets/fa/js/all.min.js"></script>

      <!-- Bootstarp css cdn -->
      <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">

      <!-- Custom CSS -->
      <style>
        @font-face {
          font-family: header;
          src: url(assets/Fonts/BreeSerif-Regular.ttf);
        }
      
        .font {
          font-family: header;
        }
      
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"    data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav m-auto">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="reg.php">RegForm</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="data-table.php">DataTable</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- Nav End -->
      </header>
      <main>
        <!-- container start -->
        <div class="container-fluid mt-4">
          <div class="row">
            <!-- row start -->
            <div class="col-3"></div>
      
            <div class="col-12 col-lg-6 p-5">
              <div class="card">
                <!-- Card Start -->
                <h5 class="card-header fs-1 p-3 text-white text-center bg-success font">Registration    Form</h5>
                <div class="card-body">
      
                  <form class="p-4" id="form" method="POST" enctype="multipart/form-data" >
                    <!-- form start -->
                    <div class="mb-3">
                      <label class="form-label ">Name </label>
                      <input type="text" class="form-control" placeholder="Enter full name" name="name"     value="<?php if(isset($name)) { echo $name;} ?>" >
                      <div class="form-text"> 
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['name'])) {echo $empt['name'];} if(isset($nameErr)) echo $nameErr; ?></p>
                      </div>
                    </div>
      
                    <div class="mb-3">
                      <label class="form-label">Batch </label>
                      <select class="form-select" name="batch">
                      <option value="--select--" selected>--select--</option>
                        <?php 
                          for($i = 1; $i <= 21; $i++):
                        ?>
                        <option value="<?php echo $i ?>" <?php if(isset($batch) && $batch == $i) {echo    "selected";} ?> > <?php echo $i ?></option>
                        <?php 
                          endfor; 
                        ?>
                      </select>
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['batch'])) {echo $empt['batch'];} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Student ID </label>
                      <input type="number" class="form-control" placeholder="Enter your student ID" name="id" value="<?php if(isset($id)) { echo $id;} ?>">
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['id'])) {echo $empt['id'];} if(isset($id_len)){ echo $id_len; } if(isset($id_check)) echo $id_check; ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Semester </label>
                      <select class="form-select" name="semester">
                        <option value="--select--" selected>--select--</option>
                        <?php 
                          for($i = 1; $i <= 8; $i++){ 
                        ?>
                        <option value="<?php echo $i ?>" <?php if(isset($semester) && $semester == $i)    {echo "selected";} ?> ><?php echo $i ?></option>
                        <?php 
                          } 
                        ?>
                      </select>
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['semester'])) {echo $empt['semester'];} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Gender </label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="Male" 
                        <?php if(isset($gender) && $gender == "Male") {echo "checked";}  ?>
                        
                        > Male<br>
                        <input class="form-check-input" type="radio" name="gender" value="Female"
                        <?php if(isset($gender) && $gender == "Female") {echo "checked";} ?>
                        > Female
                      </div>
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['gender'])) {echo $empt['gender'];} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Email address</label>
                      <input type="email" class="form-control" placeholder="name@example.com"     name="email" value="<?php if(isset($email)) { echo $email;} ?>">
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt ['email'])) {echo $empt['email'];} if(isset($emailErr)) echo $emailErr; ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Password </label>
                      <input type="password" class="form-control" id="" placeholder="Password"    name="password" value="<?php if(isset($password)) { echo $password;} ?>">
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['password'])) {echo $empt['password'];} if(isset($pass_len)) echo $pass_len; ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Confirm password </label>
                      <input type="password" class="form-control" id="" placeholder="Confirm Password"    name="confirm_password"
                      value="<?php if(isset($confirm_password)) { echo $confirm_password;} ?>" >
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['confirm_password'])) {echo $empt['confirm_password'];} if(isset   ($c_pass_not_equal)){echo $c_pass_not_equal;} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Address</label>
                      <div class="form-floating">
                        <textarea class="form-control pt-3" name="address"><?php if(isset($address)) {echo $address;} ?></textarea>
                      </div>
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['address'])) {echo $empt['address'];} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <label class="form-label">Photo </label>
                      <div class="d-flex w-100 mb-3">
                          <img src="assets/Image/upload_icon.svg" class="m-auto" id="photo" alt="Image"  style="height: 100px; width: 100px; padding: 5px; border: .5px solid gray;">
                      </div>
                      <input class="form-control" type="file" name="photo" accept="image/*"     onchange="readURL(this);">
                      <div class="form-text">
                        <p class="text-danger ms-1" style="font: size 16px;"><?php if(isset($empt   ['photo'])) {echo $empt['photo'];} ?></p>
                      </div>
                    </div>
                        
                    <div class="mb-3">
                      <div class="row">
                        <label class="mb-2">Captcha</label>
                        <div class="col-5"> 
                        <input type="text" class="form-control" myTable placeholder="Enter captcha" name="captcha">
                        </div>
                        <div class="col-7">
                          <img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
                          <a href='javascript: refreshCaptcha();'><span class="btn btn-success btn-sm ms-3">Refresh</span></a>
                        </div> 
                      </div> 
                    </div>
                        
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="check"    onclick="checkbox()">
                      <p>Please confirm that you agree to our terms & conditions</p>
                    </div>
                        
                    <div class="text-center mt-5">
                      <button class="btn btn-outline-success" type="submit" name="submit" value="Submit" id="sbtn">Registration</button>
                    </div>
                  </form><!-- form end -->
                </div>
              </div>
            </div>
                        
            <div class="col-3"></div>
          </div><!-- row end -->
        </div><!-- container end -->
      </main>
                        
      <!-- Bootstarp js cdn -->
      <script src="assets/JS/bootstrap.bundle.min.js"></script>
      <script src="assets/JS/main.js"></script>

      
                        
      <script>
        // checkbox enable disable start
        var sbtn = document.getElementById("sbtn");
        var check = document.getElementById("check");
        sbtn.disabled = "true";
        function checkbox(){
          if(check.checked){
            sbtn.removeAttribute("disabled");
          }else{
            sbtn.disabled = "true";
          }
        }
        // checkbox enable disable end
        // Image Show
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#photo')
                .attr('src', e.target.result)
                .width(100)
                .height(110)
                .overflow(hidden);
            };
            reader.readAsDataURL(input.files[0])
          }
        }
      </script>
      
      <script>
        //Refresh Captcha
        function refreshCaptcha(){
            var img = document.images['captcha_image'];
            img.src = img.src.substring(
        		0,img.src.lastIndexOf("?")
        		)+"?rand="+Math.random()*1000;
        }
      </script>
    </body>
</html>