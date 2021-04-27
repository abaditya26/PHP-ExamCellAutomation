
<?php 
if(isset($_POST['enrollmentno'])){
    extract($_POST);
    session_start();
    session_unset();
    include "./database.php";

    $file_name=$_FILES['profileimage']['name'];
    $file_type=$_FILES['profileimage']['type'];
    $file_size=$_FILES['profileimage']['size'];
    $file_temp_loc=$_FILES['profileimage']['tmp_name'];
    $filestore="images/profile/".$enrollmentno.".jpg";
    move_uploaded_file($file_temp_loc,$filestore);  
    session_unset();
    $_SESSION['enrollmentno']=$enrollmentno;
    $_SESSION['name']=$name;
    $_SESSION['emailid']=$emailid;
    $_SESSION['mobileno']=$mobileno;
    $_SESSION['semester']=$semester;
    $_SESSION['branch']=$branch;
    $_SESSION['filestore']="../".$filestore;
    $_SESSION['to']=$emailid;
    ?>
    <script>
        document.location='verify-student.php';
        </script>
    <?php
}
?>
<?php include "./header.php"; ?>

    <div class="container">
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            <center><br>
                <h3>
                    Student Enrollment
                </h3>
            </center>
            <div class="form-group">
                <label for="enrollmentno">
                    Enrollment Number
                </label>
                <input type="number" class="form-control" required name="enrollmentno" id="enrollmentno">
            </div>

            <div class="form-group">
                <label for="name">
                    Enter your Name
                </label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>

            <div class="form-group">
                <label for="emailid">
                    Email ID
                </label>
                <input type="email" name="emailid" id="emailid" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="mobileno">
                    Mobile Number
                </label>
                <input type="tel" name="mobileno" id="mobileno" required class="form-control">
            </div>

            <div class="form-group">
                <label for="semester">
                    Semester You're applying for
                </label>
                <select name="semester" id="semester" required class="form-control">
                    <option value="" selected><center>--Select Semester--</center></option>
                    <option value="First Semester">First Semester</option>
                    <option value="Second Semester">Second Semester</option>
                    <option value="Third Semester">Third Semester</option>
                    <option value="Forth Semester">Forth Semester</option>
                    <option value="Fifth Semester">Fifth Semester</option>
                    <option value="Sixth Semester">Sixth Semester</option>
                </select>
            </div>

            <div class="form-group">
                <label for="branch">
                    Branch
                </label>
                <select name="branch" id="branch" required class="form-control">
                    <option value="" selected>--Select Branch--</option>
                    <option value="Computer Engineering">Computer Engineering</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Electrical Engineering">Electrical Engineering</option>
                    <option value="Electronics & Telecommunication Engineering">Electronics & Telecommunication Engineering</option>
                    <option value="Pharmacy">Pharmacy</option>
                    <option value="Science">Science</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profileimage">
                    Profile Image
                </label><br>
                <input type="file" name="profileimage" id="profileimage" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success">
                <input type="reset" class="btn btn-danger">
            </div>
        </form>
    </div>

<?php include "./footer.php"; ?>