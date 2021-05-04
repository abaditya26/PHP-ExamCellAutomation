<?php
if (isset($_POST['examId'])) {
    extract($_POST); // $examId
    include "../database.php";
    session_start();
    $_SESSION['examId'] = $examId;
    $query = "SELECT * FROM questions WHERE examId=$examId";
    $result = mysqli_query($conn, $query);
    if ($result) {
        //query fired
        $questions = [];
        while ($row = mysqli_fetch_row($result)) {
            array_push($questions, $row);
        }
        $uname = $_SESSION['uname'];
        shuffle($questions);
        $_SESSION['questions'] = $questions;
?>
        <!-- html -->



        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Students' Exam</title>
            <!-- CSS only -->
            <link rel="icon" href="../images/logo.png">
            <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
            <!-- JS, Popper.js, and jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <style>
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
            </style>
        </head>

        <body>
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
                            <h3>Students' Exam</h3>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($page)) {
                } else {
                    $page = "";
                }
                ?>

            </div>

            <div class="container">
                <hr class="hr" style="border-color: white;">
                <div class="row">
                    <div class="col-md-4">
                        <center>
                            Time Left :- <span id="timer">30:00 mins</span>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                            Exam :- <?php echo $examName; ?>
                        </center>
                    </div>
                    <div class="col-md-4">
                        <center>
                            User Name :- <?php echo $uname; ?>
                        </center>
                    </div>
                </div>
                <hr class="hr" style="border-color: white;">


                <div style="padding:10px; border:ridge; border-radius: 10px; ">
                    <div class="question">
                        Question :
                        <span id="questionId">
                            1/10
                        </span><br>
                        <h5 id="question">
                            Question Text Shall Go Here including image
                        </h5>
                    </div>
                    <br>
                    <div id="optionsDiv">
                        <div class="form-group">
                            <input type="radio" name="options" id="option1" onclick="selectOption(1)">
                            <label for="option1">
                                <span id="option1Text">Option 1 Text Goes Here</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="options" id="option2" onclick="selectOption(2)">
                            <label for="option2">
                                <span id="option2Text">Option 2 Text Goes Here</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="options" id="option3" onclick="selectOption(3)">
                            <label for="option3">
                                <span id="option3Text">Option 3 Text Goes Here</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="options" id="option4" onclick="selectOption(4)">
                            <label for="option4">
                                <span id="option4Text">Option 4 Text Goes Here</span>
                            </label>
                        </div>
                    </div>
                    <div class="controls">
                        <hr class="hr" style="border-color: white;">
                        <center>
                            <button class="btn btn-primary" onclick="changeQuestion(-1)">Previous</button>
                            <button class="btn btn-primary" onclick="changeQuestion(1)">&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </center>
                        <hr class="hr" style="border-color: white;">
                        <center>
                            <button class="btn btn-danger" onclick="endExam()">End Exam</button>
                        </center>
                    </div>

                </div>

            </div>

            <form action="./submitExam.php" name="data_form" method="post">
                <textarea name="data_area" id="data_area" cols="30" rows="10" style="display: none;"></textarea>
            </form>

        </body>

        </html>


        <script>
            var currentIndex = 0;
            var currentTimer = 1800;
            var questions = [
                <?php for ($i = 0; $i < sizeof($questions); $i++) {
                    echo "[";
                    echo "'" . $questions[$i][2] . "',";
                    echo "'" . $questions[$i][3] . "',";
                    echo "'" . $questions[$i][4] . "',";
                    echo "'" . $questions[$i][5] . "',";
                    echo "'" . $questions[$i][6] . "',";
                    echo "'',";
                    echo "'" . $questions[$i][0] . "'";
                    echo "],";
                } ?>
            ];
            var totalQuestions = questions.length;
            changeQuestion(0);

            function changeQuestion(changeIndex) {
                currentIndex = currentIndex + (changeIndex);
                if (currentIndex < 0) {
                    currentIndex = totalQuestions - 1;
                }
                if (currentIndex >= totalQuestions) {
                    currentIndex = 0;
                }
                document.getElementById('question').innerHTML = questions[currentIndex][0]
                document.getElementById('option1Text').innerHTML = questions[currentIndex][1]
                document.getElementById('option2Text').innerHTML = questions[currentIndex][2]
                document.getElementById('option3Text').innerHTML = questions[currentIndex][3]
                document.getElementById('option4Text').innerHTML = questions[currentIndex][4]
                document.getElementById('questionId').innerHTML = (currentIndex + 1) + '/' + totalQuestions

                disableAllRadio();

                if (questions[currentIndex][1] == questions[currentIndex][5]) {
                    document.getElementById('option1').checked = true;
                } else if (questions[currentIndex][2] == questions[currentIndex][5]) {
                    document.getElementById('option2').checked = true;
                } else if (questions[currentIndex][3] == questions[currentIndex][5]) {
                    document.getElementById('option3').checked = true;
                } else if (questions[currentIndex][4] == questions[currentIndex][5]) {
                    document.getElementById('option4').checked = true;
                }
            }

            function disableAllRadio() {
                document.getElementById('option1').checked = false;
                document.getElementById('option2').checked = false;
                document.getElementById('option3').checked = false;
                document.getElementById('option4').checked = false;
            }

            function selectOption(o) {
                const option = questions[currentIndex][o];
                questions[currentIndex][5] = option
            }
            misatmpt = 3;

            window.onload = function() {
                document.body.oncopy = function(event) {
                    event.preventDefault();
                    alert('NO COPY!!!!!!!!!');
                    misatmpt--;
                    if (misatmpt == 0) {
                        alert('Your misbehaviour attempts exceeds!');
                        document.location = './exams.php';
                    } else {
                        alert('Your misbehaviour chances left :- ' + misatmpt);
                    }
                }
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        alert('You Have Changed Window.!');
                        misatmpt--;
                        if (misatmpt == 0) {
                            alert('Your misbehaviour attempts exceeds!');
                            document.location = './exams.php';
                        } else {
                            alert('Your misbehaviour chances left :- ' + misatmpt);
                        }
                    }
                });
                document.addEventListener('contextmenu', event => event.preventDefault());
            }

            function timerDown() {
                currentTimer--;
                if (currentTimer <= 0) {
                    // alert('Time Out');
                    // end exam code 
                    document.getElementById('data_area').innerHTML = JSON.stringify(questions);
                    document.data_form.submit();
                }
                var sec = currentTimer%60;
                var min = currentTimer/60;
                document.getElementById('timer').innerHTML = parseInt(min) +" : "+sec;
                setTimeout(() => {
                    timerDown()
                }, 1000);
            }
            timerDown();

            function endExam() {
                if (confirm("Do You Want to end Exam?")) {
                    document.getElementById('data_area').innerHTML = JSON.stringify(questions);
                    document.data_form.submit();
                }
            }
        </script>



    <?php
    } else {
        //query unsuccessful
        echo "<script>console.log('" . mysqli_error($conn) . "');alert('error to get data');document.location='./exams.php';</script>";
    }
} else {
    ?>
    <script>
        alert('invalid navigation');
        document.location = './exams.php';
    </script>
<?php
}
?>

<!-- <script>
  
// Creating a cookie after the document is ready
$(document).ready(function () {
    createCookie("gfg", "GeeksforGeeks", "10");
});
   
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
}
  
</script> -->