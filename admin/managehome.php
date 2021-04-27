<?php 
if(!isset($_SESSION)){
    session_start();
}
$page="manage-home-page";
include "../database.php";
// Code to add image
if(isset($_POST['title'])){
    extract($_POST);
    $random=rand(00,99);
    $file_name=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $file_size=$_FILES['image']['size'];
    $file_temp_loc=$_FILES['image']['tmp_name'];
    $filestore="./images/".$random;
    move_uploaded_file($file_temp_loc,".".$filestore);
    $query="INSERT INTO `carousel`(`path`, `title`, `description`) VALUES ('$filestore','$title','$description')";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Added');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
// Code to add image end

// Code to remove image
if(isset($_GET['id'])){
    extract($_GET);
    $query="DELETE FROM `carousel` WHERE `_id` = $id";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Removed');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
//code to remove image end

//notice add code start
if(isset($_POST['notice'])){
    extract($_POST);
    $query="INSERT INTO `notice`(`title`, `link`) VALUES ('$notice','$noticelink')";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Notice Added');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
//notice add code end

//notice delete code start
if(isset($_GET['noticeid'])){
    extract($_GET);
    $query="DELETE FROM `notice` WHERE `_id` = $noticeid";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Removed');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
//notice delete code start end

//Quick Link add code start
if(isset($_POST['quicklinktitle'])){
    extract($_POST);
    $query="INSERT INTO `quicklinks`(`title`, `link`) VALUES ('$quicklinktitle','$quicklink')";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Link Added');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
//Quick Link add code end

//notice delete code start
if(isset($_GET['linkid'])){
    extract($_GET);
    $query="DELETE FROM `quicklinks` WHERE `_id` = $linkid";
    $result=mysqli_query($conn,$query);
    if($result){
        ?>
        <script>
            alert('Removed');
            document.location="./managehome.php";
        </script>
        <?php 
    }else{
        echo mysqli_error($conn);
    }
}
//notice delete code start end

//Fetch Code
{
    include "./header.php";
    $query="SELECT * FROM `carousel`;";
    $result=mysqli_query($conn,$query);
    $images=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($images,$row);
        }
    }else{

    }
    $query="SELECT * FROM `notice`;";
    $result=mysqli_query($conn,$query);
    $notices=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($notices,$row);
        }
    }else{

    }
    $query="SELECT * FROM `quicklinks`;";
    $result=mysqli_query($conn,$query);
    $links=[];
    if($result){
        while($row=mysqli_fetch_row($result)){
            array_push($links,$row);
        }
    }else{

    }
}

?>
<div class="container">

<nav class="navbar-light " >
    
    <div id="navbar1" style="padding-top: 3%;">
        <ul class="nav justify-content-center">
            <li class="nav-item active navlink">
                <a class="nav-link active" href="#addimage">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-image" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14.002 2h-12a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-12-1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12z"/>
                        <path d="M10.648 7.646a.5.5 0 0 1 .577-.093L15.002 9.5V14h-14v-2l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71z"/>
                        <path fill-rule="evenodd" d="M4.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                    </svg>
                        <small id="home-txt">
                            Add Image
                        </small>
                </a>
            </li>
            <li class="nav-item navlink">
                
                <a class="nav-link" href="#deleteimage">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                    <small id="about-txt">
                        Delete Image
                    </small>
                </a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="#addnotices">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-zip-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h.5v1h1v1h-1v1h1v1h-1v1h1v1H7V6H6V5h1V4H6V3h1V2H6V1h3.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM5.5 7.5a1 1 0 0 0-1 1v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1zm0 1.938V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                </svg>
                <small>
                    Add Notices
                </small></a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="#removenotices">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-zip-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h.5v1h1v1h-1v1h1v1h-1v1h1v1H7V6H6V5h1V4H6V3h1V2H6V1h3.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM5.5 7.5a1 1 0 0 0-1 1v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1zm0 1.938V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                </svg>
                <small>
                    Delete Notices
                </small></a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="#addquicklinks">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-zip-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h.5v1h1v1h-1v1h1v1h-1v1h1v1H7V6H6V5h1V4H6V3h1V2H6V1h3.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM5.5 7.5a1 1 0 0 0-1 1v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1zm0 1.938V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                </svg>
                <small>
                    Add Quick Links
                </small></a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="#removelinks">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-zip-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h.5v1h1v1h-1v1h1v1h-1v1h1v1H7V6H6V5h1V4H6V3h1V2H6V1h3.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM5.5 7.5a1 1 0 0 0-1 1v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1zm0 1.938V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                </svg>
                <small>
                    Delete Notices
                </small></a>
            </li>


        </ul>
    </div>
    <br><br>
</nav>


    <div class="">
        <section id="addimage">
            <h3>
                <center>
                    Home Image Carousel
                </center>
            </h3>
            <br><br>
            <form action="#" method="POST" style="border: ridge; padding:20px; border-radius:10px;" enctype="multipart/form-data">
                <h4>
                    Add Image
                </h4>
                <div class="form-group">
                    <label for="image">
                        Select Image
                    </label><br>
                    <input type="file" name="image" id="image" required>
                </div>

                <div class="form-group">
                    <label for="title">
                        Image Title
                    </label>
                    <input type="text" name="title" id="title" required placeholder="Enter Title Here" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">
                        Descripiton of image
                    </label>
                    <textarea name="description" id="description" class="form-control">

                    </textarea>
                </div>
                <input type="submit" class="btn btn-success">
            </form>
        </section>

        <br><br>

        <section id="deleteimage">
            <br>
            <h4>
                Delete Image
            </h4>
            <table class="table table-hover" style="border: ridge; border-radius: 10px; padding:20px;">
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
                <?php for($i=0;$i<sizeof($images);$i++){ ?>
                <tr>
                    <td>
                        <?php echo $i+1; ?>
                    </td>
                    <td>
                        <img src="../<?php echo $images[$i][1]; ?>" style="max-width:100px">
                    </td>
                    <td>
                        <?php echo $images[$i][2]; ?>   
                    </td>
                    <td>
                        <?php echo $images[$i][3]; ?>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="managehome.php?id=<?php echo $images[$i][0]; ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section>
        <br><br>

        <section id="addnotices">
            <h3>
                <center>
                    Notices
                </center>
            </h3><br><br>
            <form action="#" method="POST" style="border: ridge; border-radius: 10px; padding:20px;">
                <h4>
                    Add Notices
                </h4>
                <div class="form-group">
                    <label for="notice">
                        Notice Title
                    </label>
                    <input type="text" name="notice" id="notice" required class="form-control" placeholder="Notice title here">
                </div>

                <div class="form-group">
                    <label for="noticelink">
                        Notice Link
                    </label>
                    <input type="text" name="noticelink" id="noticelink" required class="form-control" placeholder="Format :- http://www.link.com" value="http://">
                </div>
                <input type="submit" class="btn btn-secondary">
            </form>
        </section>

        <br><br>

        <section id="removenotices" >
            <h4>
                Remove Notice
            </h4>
            <table class="table table-hover" style="border: ridge; border-radius: 10px; padding:20px;">
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Notice Title
                    </th>
                    <th>
                        Notice Link
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
                <?php for($i=0;$i<sizeof($notices);$i++){ ?>
                <tr>
                    <td>
                        <?php echo $i+1; ?>
                    </td>
                    <td>
                        <?php echo $notices[$i][1]; ?>
                    </td>
                    <td>
                        <a href="<?php echo $notices[$i][2]; ?>"><?php echo $notices[$i][2]; ?></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="managehome.php?noticeid=<?php echo $notices[$i][0]; ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section>

        <br><br>

        <section id="addquicklinks">
            <h3>
                <center>
                    Quick Links
                </center>
            </h3><br><br>
            <form action="#" method="POST" style="border: ridge; border-radius: 10px; padding:20px;">
                <h4>
                    Add Notices
                </h4>
                <div class="form-group">
                    <label for="quicklinktitle">
                        Notice Title
                    </label>
                    <input type="text" name="quicklinktitle" id="quicklinktitle" required class="form-control" placeholder="Qick Link title here">
                </div>

                <div class="form-group">
                    <label for="quicklink">
                        Notice Link
                    </label>
                    <input type="text" name="quicklink" id="quicklink" required class="form-control" placeholder="Format :- http://www.link.com" value="http://">
                </div>
                <input type="submit" class="btn btn-secondary">
            </form>
        </section>
        
        <br><br>

        <section id="removelinks" >
            <h4>
                Remove Quick Link
            </h4>
            <table class="table table-hover" style="border: ridge; border-radius: 10px; padding:20px;">
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Quick Link Title
                    </th>
                    <th>
                        Quick Link
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
                <?php for($i=0;$i<sizeof($links);$i++){ ?>
                <tr>
                    <td>
                        <?php echo $i+1; ?>
                    </td>
                    <td>
                        <?php echo $links[$i][1]; ?>
                    </td>
                    <td>
                        <a href="<?php echo $links[$i][2]; ?>"><?php echo $links[$i][2]; ?></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="managehome.php?linkid=<?php echo $links[$i][0]; ?>">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section>

    </div>
</div><br>
<?php
include "./footer.php";
?>