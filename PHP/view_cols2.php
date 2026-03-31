<?php
include 'Model/Database.php';
$vars = 'include/vars.php';
$db = new Database($vars);

$tables = ['shop', 'city', 'section', 'bank_accounts', 'Technical_Support', 'ads'];
$out = "";
foreach ($tables as $t) {
    $out .= "TABLE: $t\n";
    $res = $db->Connect->query("SHOW COLUMNS FROM `$t`");
    if ($res) {
        while($r = $res->fetch_assoc()) {
            $out .= " - " . $r['Field'] . "\n";
        }
    } else {
        $out .= "Error: " . $db->Connect->error . "\n";
    }
}
file_put_contents('db_dump.txt', $out);
?>
