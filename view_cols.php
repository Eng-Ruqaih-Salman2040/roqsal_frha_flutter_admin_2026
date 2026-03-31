<?php
include 'Model/Database.php';
$vars = 'include/vars.php';
$db = new Database($vars);

$tables = ['shop', 'city', 'section', 'bank_accounts', 'Technical_Support', 'ads'];
foreach ($tables as $t) {
    echo "TABLE: $t\n";
    $res = $db->Connect->query("SHOW COLUMNS FROM `$t`");
    if ($res) {
        while($r = $res->fetch_assoc()) {
            echo " - " . $r['Field'] . "\n";
        }
    } else {
        echo "Error: " . $db->Connect->error . "\n";
    }
}
?>
