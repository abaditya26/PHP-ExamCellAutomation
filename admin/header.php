<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- CSS only -->
    <link rel="icon" href="../images/logo.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(rgba(1, 1, 1, 0.8), rgba(1, 1, 1, 0.9)), url("../images/c2.jpg");
            background-color: #5e5e5e;
            /* Used if the image is unavailable */
            background-position: center;
            /* Center the image */
            background-attachment: fixed;
            background-repeat: no-repeat;
            /* Do not repeat the image */
            background-size: cover;
            /* Resize the background image to cover the entire container */
            color: #FFFFFF;
        }

        .nav-item {
            text-align: center;
            color: white;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        td,
        th {
            color: white;
        }
    </style>

</head>

<body onload="resizeWindow()">
    <div class="header">

        <div class="jumbotron" style="padding: 1%; background:rgba(0,0,0,0.1); margin-bottom: 0;">
            <div class="row">
                <div class="col-lg-3" align="center">
                    <a href="./">
                        <img src="../images/logo.png" style="max-height: 80px;" alt="Logo Here" />
                    </a>
                </div>
                <div class="col-lg-9" align="center">
                    <h1 class="display-4"><b>Exam Cell Automation</b></h1>
                    <h3>Admin Panel</h3>
                </div>
            </div>
        </div>
        <?php
        if (!isset($_SESSION['admin'])) {
            header('location:../');
            exit;
        }
        if (isset($page)) {
        } else {
            $page = "";
        }
        ?>

        <div>
            <nav class="navbar navbar-dark bg-dark navbar-expand-lg" style="padding-left: 10%; padding-right: 10%;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav flex-fill justify-content-center">
                        <li class="nav-item flex-fill">
                            <a class="nav-link" href="../">Homepage</a>
                        </li>
                        <li class="nav-item flex-fill <?php if ($page == "dashboard") {
                                                            echo "active";
                                                        } ?>">
                            <a class="nav-link" href="./">Dashboard</a>
                        </li>
                        <li class="nav-item flex-fill <?php if ($page == "profile") {
                                                            echo "active";
                                                        } ?>">
                            <a class="nav-link" href="./profile.php">Profile</a>
                        </li>

                        <li class="nav-item flex-fill <?php if ($page == "students-request") {
                                                            echo "active";
                                                        } ?>">
                            <a class="nav-link" href="./studentrequests.php">Students' Management</a>
                        </li>

                        <li class="nav-item flex-fill <?php if ($page == "examination") {
                                                            echo "active";
                                                        } ?>">
                            <a class="nav-link" href="./examination.php">Examination</a>
                        </li>

                        <li class="nav-item flex-fill <?php if ($page == "manage-home-page") {
                                                            echo "active";
                                                        } ?>">
                            <a class="nav-link" href="./managehome.php">Manage Home Page</a>
                        </li>

                        <li class="nav-item flex-fill">
                            <a class="nav-link" href="./logout.php" style="color: red;">Log Out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>


    </div>