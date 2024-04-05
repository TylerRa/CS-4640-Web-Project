<?php

function exportStatsToJson() {
    $stats = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $stats['attackDamage'] = $_POST['attackDamage'];
        $stats['abilityPower'] = $_POST['abilityPower'];
        $stats['attackSpeed'] = $_POST['attackSpeed'];
        $stats['lethality'] = $_POST['lethality'];
        $stats['criticalStrikeChance'] = $_POST['criticalStrikeChance'];
        $stats['armorPenetration'] = $_POST['armorPenetration'];
        $stats['magicPenetration'] = $_POST['magicPenetration'];
        $stats['onHitPhysicalDamage'] = $_POST['onHitPhysicalDamage'];
        $stats['onHitTrueDamage'] = $_POST['onHitTrueDamage'];
        $stats['onHitMagicDamage'] = $_POST['onHitMagicDamage'];
        
        $jsonStats = json_encode($stats);

        return $jsonStats;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exportedStats = exportStatsToJson();
    $sql = "UPDATE users SET user_data = :exportedStats WHERE username = :_SESSION['user']";
    $result = pg_prepare($dbHandle, "", $sql);
    $result = pg_execute($dbHandle, "", array($exportedStats, $_SESSION['email']));

    if ($dbHandle) {
        echo "Success connecting to database";
    } 
    else {
        echo "An error occurred connecting to the database";
    }

    if ($exportedStats) {
        ?><div class='alert'>Successfully Exported Build</div><?php
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="user_data.json"');
        echo $exportedStats;
        header("Location: ?viewBuilds.html");
    } else {
        ?><div class='alert'>Error Exporting Build</div><?php

        echo "Error exporting stats.";
    }
}

