function saveBuild() {
    var stats = [];
    var userStatsForm = $("#userStatsForm").children();
    userStatsForm.each(function(index, element) {
        stats.push(element.value);
    });

    $.ajax({
        type: "POST",
        url: "index.php?command=saveToProfile", //Todo: add to controller save build handling
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
// load a build on the index page
function loadBuild() {

    $.ajax({
        type: "GET",
        url: "index.php?command=loadBuild", // Todo: add to controller
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
    console.log("entered calculate dps");
    // Retrieve user input stats
    $("#userStatsForm").children().each(function(index, element) {
        var statName = $(element).find('label').text().trim(); // Get the label text as the stat name
        var statValue = parseFloat($(element).find('input').val()); // Get the input value as the stat value
        stats[statName] = statValue; 

        if (!isNaN(statValue)) { // Validate that the stat value is a valid number
            stats[statName] = statValue;
        }
    });
    
    // Retrieve opponent input stats
    $("#opponentStatsForm").children().each(function(index, element) {
        var statName = $(element).find('label').text().trim(); // Get the label text as the stat name
        var statValue = parseFloat($(element).find('input').val()); // Get the input value as the stat value
        stats[statName] = statValue; 

        if (!isNaN(statValue)) { // Validate that the stat value is a valid number
            stats[statName] = statValue;
        }
    } )

    if (Object.keys(stats).length === 0) {
        console.log("No valid stats found.");
        return;
    }
    console.log(stats);
    // Extract individual stats from the stats object
    var physicalDamage = stats['Attack Damage'];
    var criticalChance = stats['Critical Strike Chance'];
    var modifier = 1.75;
    var onhitPhysicalDamage = stats['On-Hit Physical Damage'];
    var armor = stats['Armor'];
    var armorPenetration = stats['Armor Penetration'];
    var lethality = stats['Lethality'];
    var attackSpeed = stats['Attack Speed'];

    var damage = (physicalDamage + criticalChance/100 * (modifier - 1) * 100) + onhitPhysicalDamage;
    console.log(damage);
    var mitigatedDamage = damage * 100 / (100 + armor -(armor * armorPenetration*.01) - lethality);
    console.log(mitigatedDamage);
    var dps = mitigatedDamage * attackSpeed;
    console.log(dps);
    $("#dpsBox").val(dps);
}

function exportBuild() {
    var stats = {};
    $("#userStatsForm").children().each(function(index, element) {
        var statName = $(element).find('label').text().trim(); // Get the label text as the stat name
        var statValue = $(element).find('input').val(); // Get the input value as the stat value
        stats[statName] = statValue;
    });
    
    var jsonData = JSON.stringify(stats, null, 2);

    var blob = new Blob([jsonData], { type: 'application/json' });

    // Create a temporary anchor element
    var downloadAnchorNode = document.createElement('a');
    
    downloadAnchorNode.href = window.URL.createObjectURL(blob);
    downloadAnchorNode.download = 'user_stats.json'; // Default filename
    document.body.appendChild(downloadAnchorNode);
    downloadAnchorNode.click();
    document.body.removeChild(downloadAnchorNode);

}

function populateBuild(buildNumber) {
    $.ajax({
        type: "GET",
        url: "import.php",
        dataType: "json",
        success: function(buildData) {
            $('#displayAttackDamage').text(buildData.attackDamage);
            $('#displayAbilityPower').text(buildData.abilityPower);
            $('#displayAttackSpeed').text(buildData.attackSpeed);
            $('#displayLethality').text(buildData.lethality);
            
            console.log('Build data fetched successfully:', buildData);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching build data:', error);
        }
    });
}
// load users builds from profile
function loadBuilds() {
    var builds = [];
    $.ajax({
        type: "GET",
        url: "index.php?command=loadBuilds",
        data: { buildNumber : 0,
                userID : 0 },
        dataType: "array", //get array of jsons
        success: function(buildData) {
            for (i = 0; i < buildData.length; i++) {
                //update DOM with data
                
            }

        },
        error: function(xhr, status, error) {
            console.error('Error fetching build data:', error);
        }
    })

}