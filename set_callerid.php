#!/usr/bin/php -q
<?php

require('phpagi.php');
require('db.php');

$agi = new AGI();

$accountcode = $agi->request['agi_accountcode'];
$extension = $agi->request['agi_extension'];

$callerid = substr($extension, 5);

$agi->verbose($callerid);
$agi->verbose($accountcode);

$sql = "update pkg_sip set callerid = '$callerid', cid_number = '$callerid' where accountcode = '$accountcode'";

if ($conn->query($sql) === TRUE) {
    $agi->verbose("CallerID updated successfully");
    $agi->exec("playback", "beep");
} else {
    $agi->verbose("Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();

exit;

?>
