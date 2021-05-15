<?php
function endsWith($s1, $s2) {
    if (!isset($s1) || !isset($s2)) {
        return false;
    }

    $strlen = strlen($s1);
    $testlen = strlen($s2);
    if ($testlen > $strlen) return false;
    return substr_compare($s1, $s2, $strlen - $testlen, $testlen) === 0;
}

$serverAddress = getenv('SERVER_ADDR');
$serverName = getenv('SERVER_NAME');
$remoteAddress = getenv('REMOTE_ADDR');

$isLocal = $serverAddress == '::1' || $serverAddress == '127.0.0.1' || $serverName == 'localhost'
    || substr($serverAddress, 0, 8) == '192.168.';

$isRhCloud = endsWith($serverName, 'rhcloud.com');

$isSuffah = endsWith($serverName, 'masjidsuffah.com');

/*
if ($isLocal) {
    $db = new mysqli("localhost", "dkkkpmba_mba", "password123", "suffahdb");
} elseif ($isRhCloud) {
    $db = new mysqli(getenv('OPENSHIFT_MYSQL_DB_HOST'), "dbuser", "password123", "disp");
} elseif ($isSuffah) {
    $db = new mysqli("localhost", "dkkkpmba_mba", "Incr254@#$", "dkkkpmba_suffahwp2");
}
*/

 
  $db = new mysqli("localhost", "almdhuss_suffah", "Welcome123$", "almdhuss_suffah_wp2");


if ($db->connect_errno) {
    echo $db->connect_error;
    die("Sorry, we are having some DB problems.");
} else {
    $db->set_charset("utf8");
}