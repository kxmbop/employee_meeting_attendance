<?php 
$title = "Open Meetings";
$pagetitle = "OPEN MEETINGS";
$page = "index";
include "./util/dbhelper.php";
$open_meetings = getallrecords_v2("meetings", ["mtgStatus" => "OPEN"]);
ob_start();
?>
    <?php if($open_meetings != null): ?>
        <?php foreach($open_meetings as $meetings): ?>
            <div class="w3-card-4 w3-animate-bottom" style="width: 60%; margin: auto; cursor: pointer" onclick="fill_fields_v3(['<?php echo $meetings["mtgCode"]; ?>','<?php echo strtoupper($meetings["mtgAgenda"]); ?>'],'open_meeting')">
                <div class="w3-panel w3-blue">
                    <h3 class="w3-left"><?php echo strtoupper($meetings["mtgAgenda"]); ?></h3>
                    <h3 class="w3-right">MEETING CODE: <?php echo $meetings["mtgCode"]; ?></h3>
                </div>
                <div class="w3-row-padding">
                    <div class="w3-half">
                        <p>FACILITATED BY: <?php echo strtoupper($meetings["mtgFaci"]); ?><p>
                        <p>VENUE: <?php echo strtoupper($meetings["mtgVenue"]); ?></p>
                    </div>
                    <div class="w3-half">
                        <p>DATE: <?php echo strtoupper($meetings["mtgDate"]); ?></p>
                        <p>TIME: <?php echo strtoupper($meetings["mtgTstart"]); ?> TO <?php echo strtoupper($meetings["mtgTend"]); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="w3-center">NO OPEN MEETINGS AVAILABLE</p>
    <?php endif; ?>
    <!--MODAL AREA-->
    <div class="w3-modal" id="open_meeting">
        <div class="w3-modal-content">
            <div class="w3-panel w3-blue">
                <h3 id="agenda_name"></h3>
                <span class="w3-hover-red w3-button w3-display-topright" onclick="display_control('open_meeting','none')">&times;</span>
            </div>
            <div class="w3-padding-large">
                <form action="./actions/attendance.php" method="post">
                    <input type="hidden" name="mtgcode" id="mtgcode">
                    <p>
                        <input type="number" name="empID" id="empID" class="w3-input w3-border" placeholder="ENTER YOUR EMPLOYEE ID #">
                    </p>
                    <p>
                        <input type="submit" value="MARK YOUR ATTENDANCE" name="mark" id="mark" class="w3-button w3-blue w3-block">
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL AREA-->
<?php
$content = ob_get_clean();
require_once "./template/layout.php";
?>