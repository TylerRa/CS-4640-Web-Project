// Function to save the build
function saveBuild() {
    var stats = [];
    var userStatsForm = $("#userStatsForm").children();
    userStatsForm.each(function(index, element) {
        stats.push(element.value);
    });

    // Assuming you will send the 'stats' array to the server to save it in the database
    // You can use AJAX to send the data to the server
    // Example AJAX request:
    $.ajax({
        type: "POST",
        url: "save_build.php", // Replace with the URL of your server-side script to save the build
        data: { stats: JSON.stringify(stats) }, // Send the 'stats' array as JSON data
        success: function(response) {
            console.log("Build saved successfully.");
            // Optionally, you can perform actions after the build is saved
        },
        error: function(xhr, status, error) {
            console.error("Error saving build:", error);
            // Optionally, you can handle errors if the build fails to save
        }
    });
}

// Function to clear the build
function clearBuild() {
    // Clear the form fields or reset to default values
    $("#userStatsForm")[0].reset();
}

// Function to load the build
function loadBuild() {
    // Assuming you will retrieve the build data from the server
    // You can use AJAX to fetch the data from the server
    // Example AJAX request:
    $.ajax({
        type: "GET",
        url: "get_build.php", // Replace with the URL of your server-side script to fetch the build data
        success: function(response) {
            // Assuming the server returns the build data as JSON
            var stats = JSON.parse(response);
            // Populate the form fields with the retrieved build data
            $("#userStatsForm").children().each(function(index, element) {
                $(element).val(stats[index]);
            });
            console.log("Build loaded successfully.");
            // Optionally, you can perform actions after the build is loaded
        },
        error: function(xhr, status, error) {
            console.error("Error loading build:", error);
            // Optionally, you can handle errors if the build fails to load
        }
    });
}