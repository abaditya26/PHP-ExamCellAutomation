<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}
include "../database.php";

if (isset($_POST['submit'])) {
    $sem = $_SESSION['sem'];
    $branch = $_SESSION['branch'];
    $enrollment_no = $_SESSION['enroll'];
    $query = "SELECT * FROM `subjects` WHERE `semester`='$sem' AND `course`='$branch'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $subjects = [];
    $subcode = [];
    if ($result) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($subjects, $row);
            array_push($subcode, $row[4]);
        }
    }
    $marks = [];
    for ($i = 0; $i < sizeof($subcode); $i++) {
        array_push($marks, [$subcode[$i], $_POST["$subcode[$i]"]]);
    }

    $query = "SELECT * FROM `statuses`";
    $result = mysqli_query($conn, $query);
    $status = [];
    if ($result) {
        while ($row = mysqli_fetch_row($result)) {
            array_push($status, [$row[2], $row[3]]);
        }
    } else {
        echo mysqli_error($conn);
    }
    $examname = $status[1][1];
    $query = "SELECT `seatno` FROM `exam_form` WHERE `enrollment_no` = $enrollment_no AND `semester` = '$sem' AND `branch` = '$branch' AND `exam_name` = '$examname'";

    $result = mysqli_query($conn, $query);
    $seatno = [];
    if ($result) {
        $seatno = mysqli_fetch_row($result)[0];
    } else {
        echo mysqli_error($conn);
    }
    $data = [];
    for ($i = 0; $i < sizeof($marks); $i++) {
        $temp = [];
        array_push($temp, "$enrollment_no");
        array_push($temp, "$seatno");
        array_push($temp, "$sem");

        $j = 0;
        for (; $j < sizeof($subjects); $j++) {
            if ($marks[$i][0] == $subjects[$j][4]) {
                array_push($temp, $subjects[$j][4]);
                array_push($temp, $subjects[$j][5]);
                array_push($temp, $subjects[$j][6]);
                array_push($temp, $marks[$i][1]);
                array_push($temp, $subjects[$j][7]);
                array_push($temp, $status[1][1]);
            }
        }
        if ($j == sizeof($subjects)) {
            array_push($temp, "NA");
            array_push($temp, "NA");
            array_push($temp, "NA");
            array_push($temp, "NA");
            array_push($temp, $status[2][1]);
        }
        array_push($data, $temp);
    }

    for ($i = 0; $i < sizeof($data); $i++) {

        $choice = $_SESSION[$enrollment_no . 'marks'];

        if ($choice == "update") {
            $query = "UPDATE `marks` SET `obtained_marks` = '";
            $query .= ($data[$i][6] . "' WHERE `enrollment_no` = '$enrollment_no';");
        } else {
            $query = "INSERT INTO `marks` (`enrollment_no`, `seatno`, `semester`, `subject_code`, `total_marks`, `min_marks`, `obtained_marks`, `credits`, `exam_name`) ";
            $query .= "VALUES ('" . $data[$i][0] . "','" . $data[$i][1] . "','" . $data[$i][2] . "','" . $data[$i][3] . "','" . $data[$i][4] . "','" . $data[$i][5] . "','" . $data[$i][6] . "','" . $data[$i][7] . "','" . $data[$i][8] . "')";
        }
        echo $query;

        $result = mysqli_query($conn, $query);
    }
    if ($result) {
?>
        <script>
            alert('Marks Inserted/Updated');
            document.location = "./fillmarks.php";
        </script>
<?php

    } else {
        echo "<br>" . mysqli_error($conn);
    }
}
