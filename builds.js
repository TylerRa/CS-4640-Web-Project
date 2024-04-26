$(document).ready(function() {
    /*function saveBuild() {
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
}*/
    
    loadViewBuilds();
});
function clearBuild() {
    $("#userStatsForm")[0].reset();
}
// load a build on the index page
function loadBuild() {

    $.ajax({
        type: "GET",
        url: "index.php?command=retrieveBuilds", // Todo: add to controller
        // could add dataTyper here so dont have to parse later
        success: function(response) {
            var builds = JSON.parse(response);
            var stats = builds[0];
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
    return dps;
    // not done here so we can used arrow function later
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
// think this is unused
/*function populateBuild(buildNumber) {
    $.ajax({
        type: "GET",
        url: "index.php?command=retrieveBuilds",
        dataType: "json", //get array of build objects
        success: function(buildData) {
            $('#attackDamage').text(buildData.attackDamage);
            $('#abilityPower').text(buildData.abilityPower);
            $('#attackSpeed').text(buildData.attackSpeed);
            $('#lethality').text(buildData.lethality);
            
            console.log('Build data fetched successfully:', buildData);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching build data:', error);
        }
    });
}*/
// load users builds from profile
function loadViewBuilds() {
   
    $.ajax({
        type: "GET",
        url: "index.php?command=retrieveBuilds",
        dataType: "json", //get array of build objects
        success: function(buildData) {
           // var buildData = JSON.parse(response);
           $("#buildsContainer").empty();
            console.log(buildData);

            if (buildData.length==0){
                var alert=$('<div>').addClass('alert alert-success').text("You haven't saved any builds yet!");
                $("#buildsContainer").append(alert);
            }
            
            
            $.each(buildData, function(index, build) {
                var buildCard = $('<section>').addClass('card mx-2 mt-2');
                var cardBody = $('<div>').addClass('card-body');

                $.each(build, function(stat, value) {
             
                    var statDiv = $('<div>');
                    var statStrong = $('<strong>').text(stat.replace(/([A-Z])/g, ' $1').trim().toLowerCase() + ': ');
                    var statSpan = $('<span>').text(value);
                    
                    statDiv.append(statStrong, statSpan);
                    cardBody.append(statDiv);
                });
                buildCard.append($('<img>',{src:"toto2.jpg",alt:"placeholder",class:"buildimage"}));
                buildCard.append($('<h2>').text('Build ' + (index + 1)), cardBody);
                
                $("#buildsContainer").append(buildCard);
            });
            /*
            $('#displayAttackDamage').text(buildData[0].attackDamage);
            $('#displayAbilityPower').text(buildData[0].abilityPower);
            $('#displayAttackSpeed').text(buildData[0].attackSpeed);
            $('#displayLethality').text(buildData[0].lethality);
            $('#displayCriticalStrikeChance').text(buildData[0].criticalStrikeChance);
            $('#displayArmorPenetration').text(buildData[0].armorPenetration);
            $('#displayMagicPenetration').text(buildData[0].magicPenetration);
            $('#displayOnHitPhysicalDamage').text(buildData[0].onHitPhysicalDamage);
            $('#displayOnHitTrueDamage').text(buildData[0].onHitTrueDamage);
            $('#displayOnHitMagicDamage').text(buildData[0].onHitMagicDamage);
            $('#displayArmor').text(buildData[0].armor);
            $('#displayMagicResistance').text(buildData[0].magicResistance);
            $('#displayHealthPoints').text(buildData[0].healthPoints);
            $('#displayPercentDamageReduction').text(buildData[0].percentDamageReduction);
            for (i = 1; i < buildData.length; i++) {
                //update DOM with data
                $('#displayAttackDamage' + (i)).text(buildData[i].attackDamage);
                $('#displayAbilityPower' + (i)).text(buildData[i].abilityPower);
                $('#displayAttackSpeed' + (i)).text(buildData[i].attackSpeed);
                $('#displayLethality' + (i)).text(buildData[i].lethality);
                $('#displayCriticalStrikeChance'+ (i)).text(buildData[i].criticalStrikeChance);
                $('#displayArmorPenetration'+ (i)).text(buildData[i].armorPenetration);
                $('#displayMagicPenetration' + (i)).text(buildData[i].magicPenetration);
                $('#displayOnHitPhysicalDamage' + (i)).text(buildData[i].onHitPhysicalDamage);
                $('#displayOnHitTrueDamage' + (i)).text(buildData[i].onHitTrueDamage);
                $('#displayOnHitMagicDamage' + (i)).text(buildData[i].onHitMagicDamage);
                $('#displayArmor' + (i)).text(buildData[i].armor);
                $('#displayMagicResistance' + (i)).text(buildData[i].magicResistance);
                $('#displayHealthPoints' + (i)).text(buildData[i].healthPoints);
                $('#displayPercentDamageReduction' + (i)).text(buildData[i].percentDamageReduction);
            */
        },
        error: function(xhr, status, error) {
            console.error('Error fetching build data:', error);
        }
    });

}

function importBuild(buttonId, fileId) {
    document.getElementById(buttonId).onclick = function() {
        var files = document.getElementById(fileId).files;
        console.log(files);
        if (files.length <= 0) {
        return false;
      }
    
      var fr = new FileReader();
    
      fr.onload = function(e) { 
      console.log(e);
        var result = JSON.parse(e.target.result);
        var stats = result;

        // Get an array of keys from the stats object
        var statKeys = Object.keys(stats);
        
        // Iterate over the input fields in the form
        $("#userStatsForm input").each(function(index, element) {
            // Get the corresponding key from the stats object based on the current index
            var statKey = statKeys[index];
            
            // Check if a key exists at this index
            if (statKey) {
                // Set the value of the input field to the corresponding value from the stats object
                $(element).val(stats[statKey]);
            }
        });
        console.log(stats);
      }
    
      fr.readAsText(files.item(0));
    };
}
