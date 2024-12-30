<?php
include "../util/dbhelper.php";

if (isset($_POST["mark"])) {
    $mtgcode = $_POST["mtgcode"];
    $empID = $_POST["empID"];

    if (!empty($empID)) {
        $emp_exists = getrecord("employees",["empNo" => $empID]);
        if ($emp_exists != null) {
            $check_att = getrecord("attendance", ["empID" => $empID, "mtgID" => $mtgcode]);
            if ($check_att == null) {
                $mark_att = addrecord("attendance", ["mtgID" => $mtgcode, "empID" => $empID]);
                if ($mark_att == 1) {
                    header("Location: ../index.php?m=EMPLOYEE SUCCESSFULLY MARKED ATTENDANCE");
                } else {
                    header("Location: ../index.php");
                }
            } else {
                header("Location: ../index.php?m=EMPLOYEE ALREADY MARKED ATTENDANCE");
            }
        } else {
            header("Location: ../index.php?m=EMPLOYEE ID DOES NOT EXISTS");
        }
    } else {
        header("Location: ../index.php?m=INPUT YOUR EMPLOYEE ID");
    }
}
?>