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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <meta property="og:title" content="League of Legends Damage Calculator">
        <meta property="og:type" content="website">
        <!--need url-->
        <meta property="og:url" content="https://cs464.cs.virginia.edu/hjy4kh/">
        <meta property="og:image" content="mySite.jpg">
        <meta property="og:description" content="A site for Calculating League of Legends Champion DPS">
        <meta property="og:site_name" content="League of Legends Damage Calculator"> 
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet/less" type="text/css" href="styles/custom.less" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6./jquery.min.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid justify-content-between">
                <a class="navbar-brand" href="indexhtml.php">League of Legends Damage Calculator</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
        <div id="buildsContainer">
            <!--
        <section id="build1" class = "card mx-2 mt-2" >
            <h2> build 1</h2>
            <div id="images1" class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

            </div>
            <div class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage"></span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower"></span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed"></span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality"></span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance"></span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration"></span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration"></span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage"></span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage"></span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage"></span>
                </div>
                
                <div>
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div>

        </section>
        
        <section id="build2" class = "card mx-2 mt-2">
            <h2>build 2</h2>
            <div id="images2" class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">

                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
            </div>
            <div class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage2"></span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower2"></span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed2"></span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality2"></span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance2"></span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration2"></span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration2"></span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage2"></span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage2"></span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage2"></span>
                </div>
              
                <div>
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div> 
        </section>
        
        <section id="build3"class = "card mx-2 mt-2">
            <h2>build 3</h2>
            <div id= "images3"class = "image-row flexbox">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
                <img class = "buildimage" src = "toto2.jpg" alt = "placeholder">
            </div>
        
            <div  class="card-body">
                <h3>Your Champion's Stats</h3>
                <div>
                    <strong>Attack Damage:</strong> <span id="displayAttackDamage3"></span>
                </div>
                <div>
                    <strong>Ability Power:</strong> <span id="displayAbilityPower3"></span>
                </div>
                <div>
                    <strong>Attack Speed:</strong> <span id="displayAttackSpeed3"></span>
                </div>
                <div>
                    <strong>Lethality:</strong> <span id="displayLethality3"></span>
                </div>
                <div>
                    <strong>Critical Strike Chance:</strong> <span id="displayCriticalStrikeChance3"></span>
                </div>
                <div>
                    <strong>Armor Penetration:</strong> <span id="displayArmorPenetration3"></span>
                </div>
                <div>
                    <strong>Magic Penetration:</strong> <span id="displayMagicPenetration3"></span>
                </div>
                <div>
                    <strong>On-Hit Physical Damage:</strong> <span id="displayOnHitPhysicalDamage3"></span>
                </div>
                <div>
                    <strong>On-Hit True Damage:</strong> <span id="displayOnHitTrueDamage3"></span>
                </div>
                <div>
                    <strong>On-Hit Magic Damage:</strong> <span id="displayOnHitMagicDamage3"></span>
                </div>
               
                <div class="mt-2">
                    <a class="btn btn-secondary mx-1" href="#">Import</a>
                    <a class="btn btn-secondary mx-1" href="#$">Export</a>
                </div>
            </div>
            
        </section> -->
        </div>
        <footer>
            <small>
                &copy; Tyler Rasmussen, Isabella Huang, 2024
            </small>
        </footer>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src = builds.js></script>
        
    </body>