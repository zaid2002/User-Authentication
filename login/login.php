<?php
  
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    include '../php/dbconnect.php';

    $email = $_POST["myemail"];
    $password = $_POST["mypass"];

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        
        // Verify the password
        if ($password == $row['password']) 
        {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header(header: "refresh:2; url=../homepage/home.php");
            exit();
        } 
        else 
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Invalid Password!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } 
    else 
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        User does not exist!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
    <!-- <link rel="stylesheet" href="script.js"> -->
</head>

<body>
    <form action="login.php" method="post">
        <div class="container flex min-vh-100">
            <div class="row border p-3 rounded-4 bg-white shadow box-area">
                <div class="col-md-6 left-box ">
                    <div class="featured-image logo p-5 ">
                        <img src="../img/logo1.png" class="img-fluid" alt="" />
                    </div>
                    <div class="welcome flex mt-5 flex-column ">
                        <p class="h2 text-white fs-2">Welcome ! User</p>
                    </div>
                </div>
                <div class="col-md-6 p-4 right-box flex flex-column">
                    <form action="signup.php" method="POST">
                        <div class="row align-items-center mt-2">
                            <p class="signin-heading flex fs-4">Log In</p>
                            <div class="input-group mt-1 inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="myemail" id="" pattern="[a-z0-9._]@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                <label for="myemail">Email</label>
                            </div>
                            <div class="input-group mt-4 inputbox mb-2">
                                <ion-icon name="eye-off-outline"></ion-icon>
                                <input type="password" name="mypass" id="" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                                <label for="mypass">Password</label>
                            </div>
                            <div class="input-group d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="" id="formCheck">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Remember me</small></label>
                                </div>
                                <div class="forget">
                                    <small><a href="#" class="link-secondary">Forgotten password?</a></small>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button class="login btn btn-lg btn-primary w-100 " value="submit">Login</button>
                            </div>
                            <div class="register">
                                <p>Don't have an account? <a href="register.php" class="link-secondary">create account</a></p>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </form>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>