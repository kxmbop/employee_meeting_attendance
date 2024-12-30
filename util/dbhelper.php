<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "attendance";


function dbconnect(){
    global $hostname, $username, $password, $dbname;
    return new mysqli($hostname, $username, $password, $dbname);
}

function getallrecords($table){
    $conn = dbconnect();
    $sql = "SELECT * FROM `$table`";
    $query = $conn->query($sql);
    $rows = [];
    while ($row = $query->fetch_assoc()) {
        $rows[] = $row;
    }
    $conn->close();
    return $rows;
}

function getallrecords_v2($table, $key_val){
    $conn = dbconnect();
    $keys = array_keys($key_val);
    $values = array_values($key_val);
    $flds = [];
    for ($i=0; $i < count($keys); $i++) { 
        $flds[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
    }
    $fld = implode(" AND ", $flds);
    $sql = "SELECT * FROM `$table` WHERE $fld";
    $query = $conn->query($sql);
    $rows = [];
    while ($row = $query->fetch_assoc()) {
        $rows[] = $row;
    }
    $conn->close();
    return $rows;  
}

function getrecord($table, $key_val){
    $conn = dbconnect();
    $keys = array_keys($key_val);
    $values = array_values($key_val);
    $flds = [];
    for ($i=0; $i < count($keys); $i++) { 
        $flds[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
    }
    $fld = implode(" AND ", $flds);
    $sql = "SELECT * FROM `$table` WHERE $fld";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $conn->close();
    return $row;   
}

function addrecord($table, $key_val){
    $ok = -1;
    $conn = dbconnect();
    $keys = array_keys($key_val);
    $values = array_values($key_val);
    $ks = implode("`, `", $keys);
    $vs = implode("', '", $values);
    $sql = "INSERT INTO `$table` (`$ks`) VALUES ('$vs')";
    $query = $conn->query($sql);
    $ok = $conn->affected_rows;
    $conn->close();
    return $ok;
}

function updaterecord($table, $key_val){
    $ok = -1;
    $conn = dbconnect();
    $keys = array_keys($key_val);
    $values = array_values($key_val);
    $flds = [];
    for ($i=1; $i < count($keys); $i++) { 
        $flds[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
    }
    $fld = implode(", ", $flds);
    $sql = "UPDATE `$table` SET $fld WHERE `$keys[0]` = '$values[0]'";
    $query = $conn->query($sql);
    $ok = $conn->affected_rows;
    $conn->close();
    return $ok;
}

function deleterecord($table, $key_val){
    $ok = -1;
    $conn = dbconnect();
    $keys = array_keys($key_val);
    $values = array_values($key_val); 
    $flds = [];
    for ($i=0; $i < count($keys); $i++) { 
        $flds[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
    }
    $fld = implode(" AND ", $flds);
    $sql = "DELETE FROM `$table` WHERE $fld";
    $query = $conn->query($sql);
    $ok = $conn->affected_rows;
    $conn->close();
    return $ok;
}

?>