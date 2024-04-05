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
    if ($exportedStats) {
        header("Location: ?viewBuilds.html");
    } else {
        echo "Error exporting stats.";
    }
}

