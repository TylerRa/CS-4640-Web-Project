function saveBuild() {
    var stats = [];
    var userStatsForm = $("#userStatsForm").children();
    userStatsForm.each(function(index, element) {
        stats.push(element.value);
    });

    $.ajax({
        type: "POST",
        url: "save_build.php", //Todo: add to controller save build handling
        data: { stats: JSON.stringify(stats) }, // Send the 'stats' array as JSON data
        success: function(response) {
            console.log("Build saved successfully.");
        },
        error: function(xhr, status, error) {
            console.error("Error saving build:", error);
        }
    });
}

function clearBuild() {
    $("#userStatsForm")[0].reset();
}

function loadBuild() {

    $.ajax({
        type: "GET",
        url: "get_build.php", // Todo: add to controller
        success: function(response) {
            var stats = JSON.parse(response);
            $("#userStatsForm").children().each(function(index, element) {
                $(element).val(stats[index]);
            });
            console.log("Build loaded successfully.");
        },
        error: function(xhr, status, error) {
            console.error("Error loading build:", error);
        }
    });
}

// formula: Damage = (physicalDamage + criticalChance * (modifier - 1) * 100) + onhitphysicalDamage
// mitigated damage = damage x 100/(100 + armor * armorPen - lethality)
// DPS = Damage * attackspeed
function calculateDps() {
    var stats = {};

    // Retrieve user input stats
    $("#userStatsForm").children().each(function(index, element) {
        var statName = $(element).find('label').text().trim(); // Get the label text as the stat name
        var statValue = parseFloat($(element).find('input').val()); // Get the input value as the stat value
        stats[statName] = statValue; 
    });
    
    // Retrieve opponent input stats
    $("#opponentStatsForm").children().each(function(index, element) {
        var statName = $(element).find('label').text().trim(); // Get the label text as the stat name
        var statValue = parseFloat($(element).find('input').val()); // Get the input value as the stat value
        stats[statName] = statValue; 
    } )

    // Extract individual stats from the stats object
    var physicalDamage = stats['Attack Damage'];
    var criticalChance = stats['Critical Strike Chance'];
    var modifier = stats['Ability Power'];
    var onhitPhysicalDamage = stats['On-Hit Physical Damage'];
    var armor = stats['Armor'];
    var armorPenetration = stats['Armor Penetration'];
    var lethality = stats['Lethality'];
    var attackSpeed = stats['Attack Speed'];

    var damage = (physicalDamage + criticalChance * (modifier - 1) * 100) + onhitPhysicalDamage;

    var mitigatedDamage = damage * 100 / (100 + armor * armorPenetration - lethality);

    var dps = mitigatedDamage * attackSpeed;

    return dps;
}