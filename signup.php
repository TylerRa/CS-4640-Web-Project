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
        <div id="errorContainer" class="alert alert-success"></div>
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
                var errorContainer=document.getElementById("errorContainer");
                errorContainer.style.display="flex";
                errorContainer.innerHTML=errorMessage;
            }
            else{
            errorContainer.style.display = 'none';
            }
        }

        
    </script>
        <section>
           
            <div class="row mx-auto">
                <div class="col mx-2 mt-2 border"> <!--/students/qh8cz/students/qh8cz/private/-->
                    <form action="index.php?command=signUp" method="post" id="signupForm"> 
                        <h2>Sign Up:</h2>
                        <div class="form-group">
                            <label for="InputEmail1">Email address:</label>
                            <input type="email" name="email" autocomplete="email" class="form-control" id="InputEmail1" placeholder="Enter email" required>
                        
                        </div>
                        <div class="form-group">
                            <label for="InputPassword1">Password:</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="ConfirmPassword1">Confirm Password:</label>
                            <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm password" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Sign Up</button>
                    </form>
                </div>
                <div class="col mx-2 mt-2 border">
                    <h2>Already have an account?</h2>
                    <form action="index.php?command=login" method="post">
                        <div class="form-group">
                            <label for="loginEmail1">Email address:</label>
                            <input type="email" name="email" autocomplete="email" class="form-control" id="loginEmail1" placeholder="Enter email" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="loginPassword1">Password:</label>
                            <input type="password" name="password" class="form-control" id="loginPassword1" placeholder="Password: (must have 1 number)" required>
                        </div>
                        <button class="btn btn-primary" type = "submit" >Log In</button>
                    </form>

                    <script>
                        
                        document.getElementById('signupForm').addEventListener('submit',function(){
                            
                            var errorMessage="";
                            var errorContainer=document.getElementById("errorContainer");
                            
                            errorContainer.innerHTML=errorMessage;
                            var email = document.getElementById('InputEmail1').value;
                            var password = document.getElementById('password').value;
                            var confirmPassword = document.getElementById('confirmpassword').value;
                            if (!email || !password || !confirmPassword) {
                                errorMessage = 'Please fill out all the fields first.'; 
                                errorContainer.innerHTML=errorMessage;
                                event.preventDefault(); 
                                
                            }
                            if (password !== confirmPassword) {
                                errorMessage = 'Please make sure your confirmed password matches your password.';
                                errorContainer.innerHTML=errorMessage;
                                event.preventDefault(); 
                            
                            }
                            
                            if (password !== confirmPassword) {
                                errorMessage = 'Please make sure your confirmed password matches your password.';
                                errorContainer.innerHTML=errorMessage;
                                event.preventDefault(); 
                            
                            }

                            var passwordRegex = /^\S*(?=\S*[a-z])(?=\S*[\d])\S*$/;
                            if (!passwordRegex.test(password)) {
                                errorMessage = 'Your password must have at least 1 letter and 1 number.';
                                errorContainer.innerHTML=errorMessage;
                                event.preventDefault(); 
                
                            }
                            if (errorMessage){
                                errorContainer.style.display="flex";
                            }
                            else{
                                errorContainer.style.display="none";
                            }
                            
                        });
                    </script>
                </div>
            </div>
        </section>

        
        <footer>
            
        </footer>
    </body>
</html>