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