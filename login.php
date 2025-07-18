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

        <meta name="author" content="Tyler Rasmussen, Isabella Huang">
        <meta name="description" content="A site for Calculating League of Legends Champion DPS">
        <meta name="keywords" content="League, Legends, lol, damage, second">
        
        <title>League of Legends Damage Calculator</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <meta property="og:title" content="League of Legends Damage Calculator">
        <meta property="og:type" content="website">
        <!--need url-->
        <meta property="og:url" content="https://cs4640.cs.virginia.edu/hjy4kh/">
        <meta property="og:image" content="mySite.jpg">
        <meta property="og:description" content="A site for Calculating League of Legends Champion DPS">
        <meta property="og:site_name" content="League of Legends Damage Calculator"> 
        <link rel="stylesheet" href="styles/main.css">
        
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
                        
                    </div>
                </div>
            </div>
        </nav>
        <script>
        
        var errorMessage = <?php echo json_encode($errorMessage); ?>;

        window.onload = function() {
            if (errorMessage) {
                var errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-success';
                errorDiv.innerHTML = errorMessage;
                document.body.insertBefore(errorDiv, document.body.firstChild);
            }
        }
    </script>
        <section>
            
            <div class="mx-auto mt-3 border" style="width:40%">
                <h2>Log In:</h2> 
                <form action="index.php?command=login" method="post">
                    <div class="form-group">
                        <label for="inputemail">Email address:</label>
                        <input type="email" name="email" autocomplete="email" class="form-control" id="email" placeholder="Enter email" required>
                                            
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Log In</button>
                </form>
            </div>
        </section>

        
        <footer>
            
        </footer>
    </body>