<?php 
include "../util/dbhelper.php";

if (isset($_POST["save"])) {
    $mtgcode = $_POST["mtgcode"];
    $agenda = $_POST["agenda"];
    $venue = $_POST["venue"];
    $date = $_POST["date"];
    $tstart = $_POST["tstart"];
    $tend = $_POST["tend"];
    $facilitator = $_POST["facilitator"];
    $status = $_POST["status"];
    if (empty($mtgcode)) {
        if (!empty(trim($agenda) && trim($venue) && trim($date) && trim($tstart) && trim($tend) && trim($facilitator) && trim($status))) {
            $add_meetings = addrecord("meetings",["mtgAgenda" => $agenda, "mtgVenue" => $venue, "mtgDate" => $date, "mtgTstart" => $tstart, "mtgTend" => $tend, "mtgFaci" => $facilitator, "mtgStatus" => $status]);
            if ($add_meetings == 1) {
                header("Location: ../meeting_management.php?m=MEETING SUCCESSFULLY ADDED");
            } else {
                header("Location: ../meeting_management.php");
            }
        } else {
            header("Location: ../meeting_management.php?m=FILL OUT THE MISSING FIELDS");
        }
    } else {
        if (!empty(trim($agenda) && trim($venue) && trim($date) && trim($tstart) && trim($tend) && trim($facilitator) && trim($status))) {
            $update_meeting = updaterecord("meetings",["mtgCode" => $mtgcode,"mtgAgenda" => $agenda, "mtgVenue" => $venue, "mtgDate" => $date, "mtgTstart" => $tstart, "mtgTend" => $tend, "mtgFaci" => $facilitator, "mtgStatus" => $status]);
            if ($update_meeting == 1) {
                header("Location: ../meeting_management.php?m=MEETING SUCCESSFULLY UPDATED");
            } else {
                header("Location: ../meeting_management.php");
            }
        } else {
            header("Location: ../meeting_management.php?m=FILL OUT THE MISSING FIELDS");
        }
    }
} elseif (isset($_GET["delete_meeting"])) {
    $mtgcode = $_GET["delete_meeting"];
    $delete_meeting = deleterecord("meetings",["mtgCode" => $mtgcode]);
    if ($delete_meeting == 1) {
        header("Location: ../meeting_management.php?m=MEETING SUCCESSFULLY DELETED");
    } else {
        header("Location: ../meeting_management.php");
    } 
}
?>