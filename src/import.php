<?php

function import($jsonBuild) {
    $buildArray = json_decode($jsonBuild);
    $stats['attackDamage'] = $buildArray['attackDamage'];
    $stats['abilityPower'] = $buildArray['abilityPower'];
    $stats['attackSpeed'] = $buildArray['attackSpeed'];
    $stats['lethality'] = $buildArray['lethality'];
    $stats['criticalStrikeChance'] = $buildArray['criticalStrikeChance'];
    $stats['armorPenetration'] = $buildArray['armorPenetration'];
    $stats['magicPenetration'] = $buildArray['magicPenetration'];
    $stats['onHitPhysicalDamage'] = $buildArray['onHitPhysicalDamage'];
    $stats['onHitTrueDamage'] = $buildArray['onHitTrueDamage'];
    $stats['onHitMagicDamage'] = $buildArray['onHitMagicDamage'];
}

