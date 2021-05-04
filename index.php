<?php
session_start();
include "./header.php";
include "./database.php";
$query = "SELECT * FROM `carousel`;";
$result = mysqli_query($conn, $query);
$images = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        array_push($images, $row);
    }
} else {
}
$query = "SELECT * FROM `notice`;";
$result = mysqli_query($conn, $query);
$notices = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        array_push($notices, $row);
    }
} else {
}


$query = "SELECT * FROM `quicklinks`;";
$result = mysqli_query($conn, $query);
$links = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        array_push($links, $row);
    }
} else {
}
?>



<!-- New Code -->

<style>
    .form {
        border: inset;
        border-radius: 20px;
        padding: 20px;
        background: rgba(0, 0, 0, 0.56);
    }

    .row {
        margin: 0px;
        padding: 0px;
        max-width: 100%;
    }

    .w-100 {
        object-fit: cover;
        height: 600px;
    }

    .list-group-item {
        background: rgba(0, 0, 0, 0.3);
    }
</style>

<!-- Image Carousel -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < sizeof($images); $i++) { ?>
            <li data-target="#carousel" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {
                                                                                echo 'class="active"';
                                                                            } ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php for ($i = 0; $i < sizeof($images); $i++) { ?>
            <div class="carousel-item <?php if ($i == 0) {
                                            echo "active";
                                        } ?>">
                <img src="<?php echo $images[$i][1]; ?>" class="d-block w-100" alt="<?php echo $images[$i][1]; ?>">
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Image Carousel Complete -->

<div class="container">
    <!-- Notices -->
    <div class="row">
        <div class="col-md-6">
            <div class="card" id="notices" style="background:rgba(255,255,255,0.2); margin:10px;">
                <div class="card-header">
                    <h4>Notices</h4>
                </div>
                <marquee onmouseover="stop();" onmouseout="start();" direction="up" scrollamount="3" style="height: 200px;width: 90%; border: ridge; margin: 5%;">
                    <ul class="list-group list-group-flush">

                        <?php for ($i = sizeof($notices) - 1; $i >= 0; $i--) { ?>
                            <li class="list-group-item"><a href="<?php echo $notices[$i][2]; ?>" target="_blank">"<?php echo $notices[$i][1]; ?>" </a></li>
                        <?php } ?>
                    </ul>
                </marquee>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" id="quicklinks" style="background:rgba(255,255,255,0.2); margin:10px; position: relative;">
                <div class="card-header">
                    <h4>Quick Links</h4>
                </div>

                <div data-spy="scroll" style="max-height: 200px;margin:5%; overflow: hidden;overflow-y: scroll;">
                    <ul class="list-group list-group-flush">
                        <?php for ($i = sizeof($links) - 1; $i >= 0; $i--) { ?>
                            <li class="list-group-item">
                                <a href="<?php echo $links[$i][2]; ?>" target="_blank">
                                    "<?php echo $links[$i][1]; ?>"
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Notices Complete -->
</div>
<!-- New Code End -->


<?php include "./footer.php"; ?>