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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <meta property="og:title" content="League of Legends Damage Calculator">
        <meta property="og:type" content="website">
        <!--need url-->
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/hjy4kh/project/index.html">
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
                        <?php if (!isset($_SESSION['email'])):?>
                            <a class="nav-item nav-link" href="signup.php">Sign Up</a>
                            <a class="nav-item nav-link" href="login.php">Log In</a>
                        <?php endif;?>
                        <a class="nav-item nav-link" href="viewBuilds.php">Builds</a>
                        <?php if (isset($_SESSION['email'])):?>
                            <a class="nav-item nav-link" href="index.php?command=logout">Log Out</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </nav>

        <!--Description and Instructions-->
        <div>
        <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-success" >
                <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class = "card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">
                    Use the fields below to input your stats and your opponents stats.
                    Click calculate to generate the damage per second.
                    </p>   
                <!--import and export builds-->  
                    <div class="btn-grouped">
                        <a class="btn btn-secondary mx-1" href="#">Import</a>
                        <a id="exportButton" class="btn btn-secondary mx-1" href="#">Export</a>
                    </div>
                </div>
            </div>
        </div>

        <!--Your damage-->
        <section class="card flexbox userTheme ">
            <h2>Your Champion's damage stats</h2> 
            <form id="userStatsForm" method="post">
                <div class="form-group">
                    <label for="attackDamage">Attack Damage</label>
                    <input type="text" class="form-control" name="attackDamage" id="attackDamage" aria-describedby="attackDamageHelp" placeholder="Enter attack damage">
                    <small id="attackDamageHelp" class="form-text text-muted">Add your champion's attack damage stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="abilityPower">Ability Power</label>
                    <input type="text" class="form-control" id="abilityPower"name="abilityPower" aria-describedby="abilityPowerHelp" placeholder="Enter ability power">
                    <small id="abilityPowerHelp" class="form-text text-muted">Add your champion's ability power stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="attackSpeed">Attack Speed</label>
                    <input type="text" class="form-control" id="attackSpeed"name="attackSpeed" aria-describedby="attackSpeedHelp" placeholder="Enter attack speed">
                    <small id="attackSpeedHelp" class="form-text text-muted">Add your champion's attack speed stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="lethality">Lethality</label>
                    <input type="text" class="form-control"id="lethality" name="lethality" aria-describedby="lethalityHelp" placeholder="Enter lethality">
                    <small id="lethalityHelp" class="form-text text-muted">Add your champion's lethality stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="criticalStrikeChance">Critical Strike Chance</label>
                    <input type="text" class="form-control" id="criticalStrikeChance" name="criticalStrikeChance" aria-describedby="criticalStrikeChanceHelp" placeholder="Enter critical strike chance">
                    <small id="criticalStrikeChanceHelp" class="form-text text-muted">Add your champion's critical strike chance stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="armorPenetration">Armor Penetration</label>
                    <input type="text" class="form-control"id="armorPenetration" name="armorPenetration" aria-describedby="armorPenetrationHelp" placeholder="Enter armor penetration">
                    <small id="armorPenetrationHelp" class="form-text text-muted">Add your champion's armor penetration stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="magicPenetration">Magic Penetration</label>
                    <input type="text" class="form-control"id="magicPenetration" name="magicPenetration" aria-describedby="magicPenetrationHelp" placeholder="Enter magic penetration">
                    <small id="magicPenetrationHelp" class="form-text text-muted">Add your champion's magic penetration stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="onHitPhysicalDamage">On-Hit Physical Damage</label>
                    <input type="text" class="form-control"id="onHitPhysicalDamage" name="onHitPhysicalDamage" aria-describedby="onHitPhysicalDamageHelp" placeholder="Enter on-hit physical damage">
                    <small id="onHitPhysicalDamageHelp" class="form-text text-muted">Add your champion's on-hit physical damage stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="onHitTrueDamage">On-Hit True Damage</label>
                    <input type="text" class="form-control" id="onHitTrueDamage"name="onHitTrueDamage" aria-describedby="onHitTrueDamageHelp" placeholder="Enter on-hit true damage">
                    <small id="onHitTrueDamageHelp" class="form-text text-muted">Add your champion's on-hit true damage stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="onHitMagicDamage">On-Hit Magic Damage</label>
                    <input type="text" class="form-control"id="onHitMagicDamage" name="onHitMagicDamage" aria-describedby="onHitMagicDamageHelp" placeholder="Enter on-hit magic damage">
                    <small id="onHitMagicDamageHelp" class="form-text text-muted">Add your champion's on-hit magic damage stat.</small>
                </div>
            </form>
            <div style="justify-content: left;">
            <button id="userStatsCalculate" class="btn btn-dark">
                Calculate
            </button>
            <button id="userStatsSave" class="btn btn-dark">
                Save to Profile
            </button>
            </div>
            <script>
                document.getElementById('userStatsSave').addEventListener('click', function() {
                    var form = document.getElementById('userStatsForm');
                    form.action = 'index.php?command=saveToProfile';
                    form.submit();
                });
            </script>
            
        </section>

        <!--Opponents stats-->
        <section class = "card flexbox opponentTheme">
            <h2>Your opponent's stats</h2>
            <form id="opponentStatsForm" >
                <div class="form-group">
                    <label for="armor">Armor</label>
                    <input type="text" class="form-control" id="armor" aria-describedby="armorHelp" placeholder="Enter armor">
                    <small id="armorHelp" class="form-text text-muted">Add opponent's armor stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="magicResistance">Magic Resistance</label>
                    <input type="text" class="form-control" id="magicResistance" aria-describedby="magicResistanceHelp" placeholder="Enter magic resistance">
                    <small id="magicResistanceHelp" class="form-text text-muted">Add opponent's magic resistance stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="healthPoints">Health Points</label>
                    <input type="text" class="form-control" id="healthPoints" aria-describedby="healthPointsHelp" placeholder="Enter health points">
                    <small id="healthPointsHelp" class="form-text text-muted">Add opponent's health points stat.</small>
                </div>
        
                <div class="form-group">
                    <label for="percentDamageReduction">Percent Damage Reduction</label>
                    <input type="text" class="form-control" id="percentDamageReduction" aria-describedby="percentDamageReductionHelp" placeholder="Enter percent damage reduction">
                    <small id="percentDamageReductionHelp" class="form-text text-muted">Add opponent's percent damage reduction stat.</small>
                </div>
            </form>
            <div style="justify-content: left;">
            <button class="btn btn-dark">
                Calculate
            </button>
            <input type="text" id="dpsBox" placeholder="DPS" readonly>
            <button class="btn btn-dark">
                Save to Profile
            </button>
            </div>
        </section>

        <footer class = "primaryfooter">
            <hr>
            <small>&copy; Tyler Rasmussen, Isabella Huang, 2024 </small>
        </footer>
        <script src = builds.js></script>
        <script>
            document.getElementById('exportButton').addEventListener('click', exportBuild);
            // Event listener for the Calculate button
            document.getElementById('userStatsCalculate').addEventListener('click', calculateDps);
            // Event listener for the Save to Profile button
            document.getElementById('userStatsSave').addEventListener('click', saveBuild);

        </script>

    </body>
</html>