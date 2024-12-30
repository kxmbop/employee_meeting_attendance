<?php
include "../util/dbhelper.php";

if (isset($_POST["save"])) {
    $empNo = $_POST["empNo"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $dept = $_POST["dept"];
    $position = $_POST["position"];
    $campus = $_POST["campus"];

    if (empty($empNo)) {
        if (!empty(trim($fname) && trim($lname) && trim($dept) && trim($position) && trim($campus))) {
            $add_employee = addrecord("employees",["empFName" => $fname, "empMName" => $mname, "empLName" => $lname, "empPosition" => $position, "empDept" => $dept, "empCampus" => $campus]);
            if ($add_employee == 1) {
                header("Location: ../employee_management.php?m=EMPLOYEE SUCCESSFULLY ADDED");
            } else {
                header("Location: ../employee_management.php");
            }
        } else {
            header("Location: ../employee_management.php?m=FILL OUT THE MISSING FIELDS");
        }
    } else {
        if (!empty(trim($fname) && trim($lname) && trim($dept) && trim($position) && trim($campus))) {
            $update_employee = updaterecord("employees",["empNo" => $empNo, "empFName" => $fname, "empMName" => $mname, "empLName" => $lname, "empPosition" => $position, "empDept" => $dept, "empCampus" => $campus]);
            if ($update_employee == 1) {
                header("Location: ../employee_management.php?m=EMPLOYEE SUCCESSFULLY UPDATED");
            } else {
                header("Location: ../employee_management.php");
            }
        } else {
            header("Location: ../employee_management.php?m=FILL OUT THE MISSING FIELDS");
        }
    }
} elseif (isset($_GET["delete_employee"])) {
    $delete_employee = $_GET["delete_employee"];

    $del_emp = deleterecord("employees",["empNo" => $delete_employee]);
    if ($del_emp == 1) {
        header("Location: ../employee_management.php?m=EMPLOYEE SUCCESSFULLY DELETED");
    } else {
        header("Location: ../employee_management.php");
    }
} else {
    header("Location: ../employee_management.php");
}
?>