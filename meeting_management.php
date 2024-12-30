<?php
$title = "Meeting Management";
$pagetitle = "MEETING MANAGEMENT";
$page = "meeting_management";
include "./util/dbhelper.php";
$all_meetings = getallrecords("meetings");
$headers = ['MTG CODE','AGENDA','VENUE','DATE','START TIME','END TIME','FACILITATOR','STATUS','ACTION'];
ob_start();
?>
    <div class="w3-padding-large w3-row-padding">
        <div class="w3-half">
            <button class="w3-button w3-blue w3-round" onclick="display_control('meeting_modal','block')">+ ADD MEETING</button>
        </div>
        <div class="w3-half">
            <form action="meeting_management.php" method="get">
                <input type="search" name="search_meeting" id="search_meeting" placeholder="SEARCH MEETING BY CODE" class="w3-input w3-border w3-round">
            </form>
        </div>
    </div>
    <div class="w3-container">
        <table class="w3-table-all w3-card-4">
            <tr>
            <?php foreach($headers as $head): ?>
                <th class="w3-blue"><?php echo $head; ?></th>
            <?php endforeach; ?>                
            </tr>
            <?php if(isset($_GET["search_meeting"])): ?>
                <?php
                    $search_meeting = $_GET["search_meeting"];
                    $search_meetings = getallrecords_v2("meetings", ["mtgCode" => $search_meeting]);
                ?>
                <?php foreach($search_meetings as $meetings): ?>
                <tr >
                    <td><?php echo $meetings["mtgCode"]; ?></td>
                    <td><?php echo $meetings["mtgAgenda"]; ?></td>
                    <td><?php echo $meetings["mtgVenue"]; ?></td>
                    <td><?php echo $meetings["mtgDate"]; ?></td>
                    <td><?php echo $meetings["mtgTstart"]; ?></td>
                    <td><?php echo $meetings["mtgTend"]; ?></td>
                    <td><?php echo $meetings["mtgFaci"]; ?></td>
                    <td <?php echo $meetings["mtgStatus"] == "CLOSED" ? "colspan='2'" : ""; ?>><?php echo $meetings["mtgStatus"]; ?></td>
                    <td <?php echo $meetings["mtgStatus"] == "CLOSED" ? "style = 'display: none'" : ""; ?>>
                        <button class="w3-button w3-blue w3-round" onclick="fill_fields_v2({mtgcode : '<?php echo $meetings["mtgCode"]; ?>', agenda : '<?php echo $meetings["mtgAgenda"]; ?>', venue : '<?php echo $meetings["mtgVenue"]; ?>', date : '<?php echo $meetings["mtgDate"]; ?>', tstart : '<?php echo $meetings["mtgTstart"]; ?>', tend : '<?php echo $meetings["mtgTend"]; ?>', facilitator : '<?php echo $meetings["mtgFaci"]; ?>', status : '<?php echo $meetings["mtgStatus"]; ?>'},'meeting_modal')">&#9998;</button>
                        <button class="w3-button w3-red w3-round" onclick="delete_something('<?php echo $meetings["mtgCode"]; ?>','meeting')">&times;</button>
                    </td>
                </tr>    
                <?php endforeach; ?>                
            <?php else: ?>
                <?php foreach($all_meetings as $meetings): ?>
                <tr>
                    <td><?php echo $meetings["mtgCode"]; ?></td>
                    <td><?php echo $meetings["mtgAgenda"]; ?></td>
                    <td><?php echo $meetings["mtgVenue"]; ?></td>
                    <td><?php echo $meetings["mtgDate"]; ?></td>
                    <td><?php echo $meetings["mtgTstart"]; ?></td>
                    <td><?php echo $meetings["mtgTend"]; ?></td>
                    <td><?php echo $meetings["mtgFaci"]; ?></td>
                    <td <?php echo $meetings["mtgStatus"] == "CLOSED" ? "colspan='2'" : ""; ?>><?php echo $meetings["mtgStatus"]; ?></td>
                    <td <?php echo $meetings["mtgStatus"] == "CLOSED" ? "style = 'display: none'" : ""; ?>>
                        <button class="w3-button w3-blue w3-round" onclick="fill_fields_v2({mtgcode : '<?php echo $meetings["mtgCode"]; ?>', agenda : '<?php echo $meetings["mtgAgenda"]; ?>', venue : '<?php echo $meetings["mtgVenue"]; ?>', date : '<?php echo $meetings["mtgDate"]; ?>', tstart : '<?php echo $meetings["mtgTstart"]; ?>', tend : '<?php echo $meetings["mtgTend"]; ?>', facilitator : '<?php echo $meetings["mtgFaci"]; ?>', status : '<?php echo $meetings["mtgStatus"]; ?>'},'meeting_modal')">&#9998;</button>
                        <button class="w3-button w3-red w3-round" onclick="delete_something('<?php echo $meetings["mtgCode"]; ?>','meeting')">&times;</button>
                    </td>
                </tr>    
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <script>const idnames = ['mtgcode','agenda','venue','date','tstart','tend','facilitator','status'];</script>
    <!--MODAL AREA-->
    <div class="w3-modal" id="meeting_modal">
        <div class="w3-modal-content">
            <div class="w3-panel w3-blue">
                <h3>MEETING INFO</h3>
                <span class="w3-button w3-hover-red w3-display-topright" onclick="clear_fields(idnames,'meeting_modal')">&times;</span>
            </div>
            <div class="w3-padding-large">
                <form action="./actions/meeting.php" method="post">
                    <input type="hidden" name="mtgcode" id="mtgcode">
                    <p>
                        <input type="text" name="agenda" id="agenda" placeholder="AGENDA" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="venue" id="venue" placeholder="VENUE" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="date" name="date" id="date" placeholder="DATE" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="time" name="tstart" id="tstart" placeholder="START TIME" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="time" name="tend" id="tend" placeholder="END TIME" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="facilitator" id="facilitator" placeholder="FACILITATOR" class="w3-input w3-border">
                    </p>
                    <p>
                        <select name="status" id="status" class="w3-select w3-border">
                            <option value="OPEN">OPEN</option>
                            <option value="CLOSED">CLOSE</option>
                        </select>
                    </p>
                    <p>
                        <input type="submit" value="SAVE" name="save" id="save" class="w3-button w3-blue">
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!--END OF MODAL AREA-->
<?php
$content = ob_get_clean();

require_once "./template/layout.php";
?>