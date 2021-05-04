<?php
session_start();
$page = "students-request";
if (!isset($_SESSION['admin'])) {
    header('location:../');
    exit;
}

include "./header.php";
include "../database.php";
if (isset($_GET['sort'])) {
    extract($_GET);
    if ($sort == "all") {
        $query = "SELECT * FROM `studentuser`";
    } elseif ($sort == "pending") {
        $query = "SELECT * FROM `studentuser` WHERE `verified` = 'true' AND `permitted` = 'false'";
    } elseif ($sort == "approved") {
        $query = "SELECT * FROM `studentuser` WHERE `permitted` = 'true'";
    } else {
    }
} else {
    $query = "SELECT * FROM `studentuser`";
}
$result = mysqli_query($conn, $query);
$data = [];
if ($result) {
    while ($row = mysqli_fetch_row($result)) {
        array_push($data, $row);
    }
} else {
    echo mysqli_error($conn);
}
?>
<div class="container" style="margin-top: 30px;">
    <form action="">
        <div class="form-group">
            <label for="sort">
                Sort By:-
            </label>
            <select name="sort" id="sort" class="form-control" style="max-width:200px;">
                <option value="all">Show All</option>
                <option value="pending">Pending Requests</option>
                <option value="approved">Approved Requests</option>
            </select>
        </div>
        <input type="submit" class="btn btn-secondary">
    </form><br>
    <table class="table table-hover" style="border: inset;">
        <tr>
            <th>
                #
            </th>
            <th>
                Enrollment No.
            </th>
            <th>
                Name
            </th>
            <th>
                Semester
            </th>
            <th>
                Branch
            </th>
            <th>
                Status
            </th>
            <th class="text-center">
                Operations
            </th>
        </tr>

        <?php
        if (sizeof($data) == 0) {
        ?>
            <tr>
                <td colspan="7">
                    <center>No Data Found</center>
                </td>
            </tr>
        <?php
        }
        for ($i = sizeof($data) - 1; $i >= 0; $i--) { ?>
            <tr>
                <td>
                    <?php echo sizeof($data) - $i; ?>
                </td>
                <td>
                    <?php echo $data[$i][1]; ?>
                </td>
                <td>
                    <?php echo $data[$i][2]; ?>
                </td>
                <td>
                    <?php echo $data[$i][5]; ?>
                </td>
                <td>
                    <?php echo $data[$i][6]; ?>
                </td>
                <td>
                    <?php
                    if ($data[$i][10] == "true") {
                    ?>
                        <b class="btn btn-success">Approved</b>
                    <?php
                    } else {
                    ?>
                        <b class="btn btn-secondary">Pending</b>
                    <?php
                    } ?>
                </td>
                <td class="text-center">
                    <a href="./applications.php?id=<?php echo $data[$i][0]; ?>" class="btn btn-primary">View Profile</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>