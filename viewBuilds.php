<?php
session_start();
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
unset($_SESSION['errorMessage']); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <meta name="author" content="Tyler Rasmussen, Isabella Huang ">
        <meta name="description" content="A site for Calculating League of Legends Champion DPS">
        <meta name="keywords" content="League, Legends, lol, damage, second">
        
        <title>League of Legends Damage Calculator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <meta property="og:title" content="League of Legends Damage Calculator">
        <meta property="og:type" content="website">
        <!--need url-->
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/hjy4kh/">
        <meta property="og:image" content="mySite.jpg">
        <meta property="og:description" content="A site for Calculating League of Legends Champion DPS">
        <meta property="og:site_name" content="League of Legends Damage Calculator"> 
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet/less" type="text/css" href="styles/custom.less" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid justify-content-between">
                <a class="navbar-brand" href="indexhtml.php">League of Legends Damage Calculator</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-item nav-link" href="profile.php">Profile</a>
                        <a class="nav-item nav-link" href="index.php?command=logout">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <header style="display: flex; justify-content: left; align-items: center; margin:1em;">
          
            <h4>
            View your builds       
            </h4>
            
            <a class=links href="indexhtml.php" style="margin-left:1em;"><h4>New Build</h4></a>
     
        </header>

        <!--build1-->
        <section class = "card mx-2 mt-2">
            <h2> build 1</h2>
            <div id="images1" class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

            </div>
            <div id="build1" class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage">0</span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower">0</span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed">0</span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality">0</span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance">0</span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration">0</span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration">0</span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage">0</span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage">0</span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage">0</span>
                </div>
                <div>
                    <strong>Armor:</strong> <span id="displayArmor">0</span>
                </div>
                <div>
                    <strong>Magic Resistance:</strong> <span id="displayMagicResistance">0</span>
                </div>
                <div>
                    <strong>Health Points:</strong> <span id="displayHealthPoints">0</span>
                </div>
                <div>
                    <strong>Percent Damage Reduction:</strong> <span id="displayPercentDamageReduction">0</span>
                </div>
                <div>
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div>

        </section>
        <!--build2-->
        <section class = "card mx-2 mt-2">
            <h2>build 2</h2>
            <div id="images2" class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
            </div>
            <div id="build2" class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage2">0</span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower2">0</span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed2">0</span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality2">0</span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance2">0</span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration2">0</span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration2">0</span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage2">0</span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage2">0</span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage2">0</span>
                </div>
                <div>
                    <strong>Armor:</strong> <span id="displayArmor2">0</span>
                </div>
                <div>
                    <strong>Magic Resistance:</strong> <span id="displayMagicResistance2">0</span>
                </div>
                <div>
                    <strong>Health Points:</strong> <span id="displayHealthPoints2">0</span>
                </div>
                <div>
                    <strong>Percent Damage Reduction:</strong> <span id="displayPercentDamageReduction2">0</span>
                </div>
                <div>
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div> 
        </section>
        <!--build3-->
        <section class = "card mx-2 mt-2">
            <h2>build 3</h2>
            <div id= "images3"class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
            </div>
        
            <div id="buid3" class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage3">0</span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower3">0</span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed3">0</span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality3">0</span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance3">0</span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration3">0</span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration3">0</span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage3">0</span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage3">0</span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage3">0</span>
                </div>
                <div>
                    <strong>Armor:</strong> <span id="displayArmor3">0</span>
                </div>
                <div>
                    <strong>Magic Resistance:</strong> <span id="displayMagicResistance3">0</span>
                </div>
                <div>
                    <strong>Health Points:</strong> <span id="displayHealthPoints3">0</span>
                </div>
                <div>
                    <strong>Percent Damage Reduction:</strong> <span id="displayPercentDamageReduction3">0</span>
                </div>
                <div class="mt-2">
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div>
            
        </section>

        <footer>
            <small>
                &copy; Tyler Rasmussen, Isabella Huang, 2024
            </small>
        </footer>

        <script>
            document.getElementById("build1").addEventListener("click", populateBuild(1));
            document.getElementById("build2").addEventListener("click", populateBuild(2));
            document.getElementById("build3").addEventListener("click", populateBuild(3));

        </script>
    </body>