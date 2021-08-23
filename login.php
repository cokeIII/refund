<?php
require_once "connect.php";
$username = $_POST["std_id"];
$password = $_POST["password"];
session_start();
if (strlen($username) != 13) {
    $sql = "select student_id,birthday from student where student_id='$username' and birthday='$password'";
    $res = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($res);
    if ($rowcount > 0) {
        $sqlStd = "select 
        s.student_id,
        s.people_id,
        s.stu_fname,
        s.stu_lname,
        s.group_id,
        p.prefix_name,
        g.grade_name,
        g.major_name,
        g.minor_name,
        g.student_group_no,
        g.student_group_short_name
        from student s ,  student_group g ,prefix p
        where student_id='$username' and s.group_id = g.student_group_id and p.prefix_id = s.perfix_id";
        $resStd = mysqli_query($conn, $sqlStd);
        while ($rowStd = mysqli_fetch_array($resStd)) {
            $_SESSION["student_id"] = $rowStd["student_id"];
            $_SESSION["people_id"] = $rowStd["people_id"];
            $_SESSION["stu_fname"] = $rowStd["stu_fname"];
            $_SESSION["stu_lname"] = $rowStd["stu_lname"];
            $_SESSION["group_id"] = $rowStd["group_id"];
            $_SESSION["student_group_no"] = $rowStd["student_group_no"];
            $_SESSION["grade_name"] = $rowStd["grade_name"];
            $_SESSION["major_name"] = $rowStd["major_name"];
            $_SESSION["minor_name"] = $rowStd["minor_name"];
            $_SESSION["prefix_name"] = $rowStd["prefix_name"];
            $_SESSION["student_group_short_name"] = $rowStd["student_group_short_name"];
            $_SESSION["user_status"] = "student";
        }
        echo "ok";
    } else {
        echo "fail";
    }
} else {
    if ($password == "ctcrefund") {
        // $sql = "select * from people where people_id = '$username' and people_birthday = '$password' ";
        $sql = "select * from people where people_id = '$username'";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($res);
        if ($rowcount) {
            $row = mysqli_fetch_array($res);
            $_SESSION["people_id"] = $row["people_id"];
            $_SESSION["people_name"] = $row["people_name"];
            $_SESSION["user_status"] = "teacher";
            echo "ok teacher";
        } else {
            echo "fail";
        }
    } else if ($password == "ctcfinance") {
        // $sql = "select * from people where people_id = '$username' and people_birthday = '$password' ";
        $sql = "select * from people where people_id = '$username'";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($res);
        if ($rowcount) {
            $row = mysqli_fetch_array($res);
            $_SESSION["people_id"] = $row["people_id"];
            $_SESSION["people_name"] = $row["people_name"];
            $_SESSION["user_status"] = "finance";
            echo "ok finance";
        } else {
            echo "fail";
        }
    } else if ($password == "ctcadmin") {
        // $sql = "select * from people where people_id = '$username' and people_birthday = '$password' ";
        $sql = "select * from people where people_id = '$username'";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($res);
        if ($rowcount) {
            $row = mysqli_fetch_array($res);
            $_SESSION["people_id"] = $row["people_id"];
            $_SESSION["people_name"] = $row["people_name"];
            $_SESSION["user_status"] = "admin";
            echo "ok admin";
        } else {
            echo "fail";
        }
    } else {
        echo "fail";
    }
}
