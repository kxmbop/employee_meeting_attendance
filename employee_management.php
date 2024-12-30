<?php 
$title = "Employee Management";
$pagetitle = "EMPLOYEE MANAGEMENT";
$page = "employee_management";
include "./util/dbhelper.php";
$all_employees = getallrecords("employees");
$headers = ['EMP #','FIRST NAME','MIDDLE NAME','LAST NAME','POSITION','DEPARTMENT','CAMPUS','ACTION'];
ob_start();
?>   
    <div class="w3-padding-large w3-row-padding">
        <div class="w3-half">
            <button class="w3-button w3-blue w3-round" onclick="display_control('employee_modal','block')">+ ADD EMPLOYEE</button>
        </div>
        <div class="w3-half">
            <form action="employee_management.php" method="get">
                <input type="search" name="search_employee" id="search_employee" placeholder="SEARCH EMPLOYEE BY ID" class="w3-input w3-border w3-round">
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
            <?php if(isset($_GET["search_employee"])): ?>
                <?php 
                    $employee_num = $_GET["search_employee"]; 
                    $employees = getallrecords_v2("employees",["empNo" => $employee_num]);
                    ?>
                <?php foreach($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee["empNo"]; ?></td>
                    <td><?php echo $employee["empFName"]; ?></td>
                    <td><?php echo $employee["empMName"]; ?></td>
                    <td><?php echo $employee["empLName"]; ?></td>
                    <td><?php echo $employee["empPosition"]; ?></td>
                    <td><?php echo $employee["empDept"]; ?></td>
                    <td><?php echo $employee["empCampus"]; ?></td>
                    <td>
                        <button class="w3-button w3-blue w3-round" onclick="fill_fields_v2({empNo : '<?php echo $employee["empNo"]; ?>',fname : '<?php echo $employee["empFName"]; ?>',mname : '<?php echo $employee["empMName"]; ?>',lname : '<?php echo $employee["empLName"]; ?>',position : '<?php echo $employee["empPosition"]; ?>',dept : '<?php echo $employee["empDept"]; ?>',campus : '<?php echo $employee["empCampus"]; ?>'},'employee_modal')">&#9998;</button>
                        <button class="w3-button w3-red w3-round" onclick="delete_employee('<?php echo $employee["empNo"]; ?>')">&times;</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach($all_employees as $employee): ?>
                <tr>
                    <td><?php echo $employee["empNo"]; ?></td>
                    <td><?php echo $employee["empFName"]; ?></td>
                    <td><?php echo $employee["empMName"]; ?></td>
                    <td><?php echo $employee["empLName"]; ?></td>
                    <td><?php echo $employee["empPosition"]; ?></td>
                    <td><?php echo $employee["empDept"]; ?></td>
                    <td><?php echo $employee["empCampus"]; ?></td>
                    <td>
                        <button class="w3-button w3-blue w3-round" onclick="fill_fields_v2({empNo : '<?php echo $employee["empNo"]; ?>',fname : '<?php echo $employee["empFName"]; ?>',mname : '<?php echo $employee["empMName"]; ?>',lname : '<?php echo $employee["empLName"]; ?>',position : '<?php echo $employee["empPosition"]; ?>',dept : '<?php echo $employee["empDept"]; ?>',campus : '<?php echo $employee["empCampus"]; ?>'},'employee_modal')">&#9998;</button>
                        <button class="w3-button w3-red  w3-round" onclick="delete_something('<?php echo $employee["empNo"]; ?>','employee')">&times;</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <script>const id_names = ['empNo','fname','mname','lname','position','dept','campus'];</script>     
    <!--MODAL AREA-->
    <div class="w3-modal" id="employee_modal">
        <div class="w3-modal-content">
            <div class="w3-panel w3-blue">
                <h3>EMPLOYEE INFO</h3>
                <span class="w3-button w3-hover-red w3-display-topright" onclick="clear_fields(id_names,'employee_modal')">&times;</span>
            </div>
            <div class="w3-padding-large">
                <form action="./actions/employee.php" method="post">
                    <input type="hidden" name="empNo" id="empNo">
                    <p>
                        <input type="text" name="fname" id="fname" placeholder="FIRST NAME" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="mname" id="mname" placeholder="MIDDLE NAME" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="lname" id="lname" placeholder="LAST NAME" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="position" id="position" placeholder="POSITION" class="w3-input w3-border">
                    </p>
                    <p>
                        <input type="text" name="dept" id="dept" placeholder="DEPARTMENT" class="w3-input w3-border">
                    </p>
                    <p>
                        <select name="campus" id="campus" class="w3-select w3-border">
                            <option value="UC - MAIN">UC - MAIN</option>
                            <option value="UC - BANILAD">UC - BANILAD</option>
                            <option value="UC - LM">UC - LM</option>
                            <option value="UC - METC">UC - METC</option>
                            <option value="UC - PT">UC - PT</option>
                        </select>
                    </p>
                    <p>
                        <input type="submit" name="save" id="save" value="SAVE" class="w3-button w3-blue">
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