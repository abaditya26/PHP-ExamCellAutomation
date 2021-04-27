<?php 


if(!isset($_GET['email'])){
    header('location:./');
    exit;
}
extract($_GET);

include "./header.php";

?>    
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

<div class="container">
    <form action="../mail/" method="POST">
        <div class="form-group">
            <label for="emailid">
                Email ID
            </label>
            <input type="email" name="emailid" value="<?php echo $email; ?>" id="emailid" class="form-control" required readonly>
        </div>
        <div class="form-group">
            <label for="title">
                Title
            </label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="10" required placeholder="Description"></textarea>
            <script>
                CKEDITOR.replace('description' );
            </script>
        </div>
        <input type="submit" class="btn btn-success">
    </form>
</div>