<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:../');
    exit;
}

function getPassword() { 
    $characters = '0123456789@_$abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 8; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
if(isset($_GET['id'])){
    extract($_GET);
    include "./header.php";
    include "../database.php";
    $query="SELECT * FROM `studentuser` WHERE `_id` = $id";
    $result=mysqli_query($conn,$query);
    $data=[];
    if($result){
        $data=mysqli_fetch_row($result);
    }else{
        echo mysqli_error($conn);
    }
    ?>
    <div class="container">
        <br><br>
        <table class="table table-hover" style="border:inset;">
            <tr>
                <td>Profile Image</td>
                <td>
                    <img src="<?php echo $data[11]; ?>" style="width:100px;">
                </td>
            </tr>
            <tr>
                <td>Enrollment Number</td>
                <td><?php echo $data[1]; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $data[2]; ?></td>
            </tr>
            <tr>
                <td>Email ID</td>
                <td><?php echo $data[3]; ?></td>
            </tr>
            <tr>
                <td>Mobile Number</td>
                <td><?php echo $data[4]; ?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td><?php echo $data[5]; ?></td>
            </tr>
            <tr>
                <td>Branch</td>
                <td><?php echo $data[6]; ?></td>
            </tr>
            <tr>
                <td>UserName</td>
                <td><?php echo $data[7]; ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><?php echo $data[8]; ?></td>
            </tr>
            <tr>
                <td>Verified</td>
                <td><?php echo $data[9]; ?></td>
            </tr>
            <tr>
                <td>Approved</td>
                <td><?php echo $data[10]; ?></td>   
            </tr>
            <?php if($data[10]=="false"){
                $_SESSION['id']=$data[0];
                $_SESSION['email']=$data[3];
                $_SESSION['name']=$data[2];
            ?>
                <tr>
                    <td colspan="2">
                        <center>
                            <form action="approve.php" method="POST" style="max-width: 400px;">
                                <div class="form-group">
                                    <label for="uname">
                                        UserName
                                    </label>
                                    <input type="text" value="<?php echo $data[1]; ?>" name="uname" id="uname" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password
                                    </label>
                                    <input type="text" value="<?php echo getPassword(); ?>" name="password" id="password" class="form-control" required>
                                </div>
                                <input type="submit" class="btn btn-success">
                            </form>
                        </center>
                    </td>
                </tr>
            <?php } ?>
            <tr><td colspan="2">
                <center>
                    <a href="./sendmail.php?email=<?php echo $data[3]; ?>" class="btn btn-secondary">Send Mail</a>
                </center>
            </td></tr>
        </table>
    </div>
    <br><br>
    <?php
    include "./footer.php";
}else{
    header('location:./');
}
?>