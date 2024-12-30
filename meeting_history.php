<?php 
$title = "Meeting History";
$pagetitle = "MEETING HISTORY";
$page = "meeting_history";
include "./util/dbhelper.php";

$header_meeting = ["MEETING CODE","AGENDA","VENUE","DATE","TIME START","TIME END","FACILITATOR"];
$header_att = ["#","EMPLOYEE NAME","TIME IN","POSITION","DEPARTMENT","CAMPUS","REMARKS"];
ob_start();
?>
<div class="w3-padding-large">
    <form action="./meeting_history.php" method="get">
        <input type="search" name="search_meet_hist" id="search_meet_hist" class="w3-input w3-border w3-card-2" placeholder="SEARCH CLOSED MEETING BY MTG CODE">
    </form>
</div>
<div class="w3-padding-large w3-animate-bottom">
    <?php if(isset($_GET["search_meet_hist"])): ?>
        <?php 
            $closed_meet = $_GET["search_meet_hist"];
            $closed_meeting = getallrecords_v2("meetings", ["mtgCode" => $closed_meet, "mtgStatus" => "CLOSED"]);
            if($closed_meeting != null): 
        ?>
            <table class="w3-table-all w3-card-4">
                <tr>
                <?php foreach($header_meeting as $h): ?>
                    <th class="w3-blue"><?php echo $h; ?></th>
                <?php endforeach; ?>
                </tr>                
                <?php foreach($closed_meeting as $cm): ?>
                <tr>
                    <td><?php echo $cm["mtgCode"] ?></td>
                    <td><?php echo $cm["mtgAgenda"] ?></td>
                    <td><?php echo $cm["mtgVenue"] ?></td>
                    <td><?php echo $cm["mtgDate"] ?></td>
                    <td><?php echo $cm["mtgTstart"] ?></td>
                    <td><?php echo $cm["mtgTend"] ?></td>
                    <td><?php echo $cm["mtgFaci"] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
                <?php
                $conn = dbconnect();
                $sql = "SELECT employees.*,attendance.timeIn FROM attendance JOIN employees ON attendance.empID = employees.empNo JOIN meetings ON attendance.mtgID = meetings.mtgCode WHERE meetings.mtgCode = '$closed_meet' ORDER BY attendance.timeIn ASC";
                $query = $conn->query($sql);
                $attendees = [];
                while ($row = $query->fetch_assoc()) {
                    $attendees[] = $row;
                }

                if ($attendees != null):
                ?>
                <p>
                    <table class="w3-table-all w3-card-4">
                        <tr>
                            <th colspan="7" class="w3-blue">MEETING ATTENDEES</th>
                        </tr>
                        <tr>
                        <?php foreach($header_att as $ha): ?>
                            <th><?php echo $ha; ?></th>
                        <?php endforeach; ?>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach($attendees as $attendee): ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $attendee["empLName"] . ", " . $attendee["empFName"] . " " . $attendee["empMName"]; ?></td>
                            <td><?php echo $attendee["timeIn"]; ?></td>
                            <td><?php echo $attendee["empPosition"]; ?></td>
                            <td><?php echo $attendee["empDept"]; ?></td>
                            <td><?php echo $attendee["empCampus"]; ?></td>
                            <td> </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </p>
                <?php else: ?>
                    <p class="w3-center">NO EMPLOYEES MARKED THEIR ATTENDANCE</p>
                <?php endif; ?>
            <?php else: ?>
                <div class="w3-center">MEETING IS EITHER STILL OPEN OR DOES NOT EXISTS</div>
            <?php endif; ?>
            <script>document.getElementById("search_meet_hist").value="<?php echo $closed_meet; ?>";</script>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

require_once "./template/layout.php";
?>