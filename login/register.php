<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include '../php/dbconnect.php';
    $email = $_POST["myemail"];
    $password = $_POST["mypass"];
    $cpassword = $_POST["cpass"];
    $exists = false;
    if($password == $cpassword)
    {
        // Check if the email already exists in the database
        $existsQuery = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query(query: $existsQuery);

        if($result->num_rows == 0) {
            // Insert user into the database
            $query = "INSERT INTO users (email, password, date) VALUES ('$email', '$password', current_timestamp())";
            
            if ($conn->query(query: $query) === TRUE) 
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong>Registration Successful
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                header(header: "refresh:2; url=login.php");
            } 
            else 
            {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } 
        else 
        {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Email already exists! 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            header(header: "refresh:2; url=login.php"); 
        }
    } 
    else 
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Password did not match
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style1.css">
    <!-- <link rel="stylesheet" href="script.js"> -->
 
</head>

<body>

    <form action="register.php" method="post">
        <div class="container flex min-vh-100">
            <div class="row border p-3 rounded-4 bg-white shadow box-area">
                <div class="col-md-6 p-3 left-box flex">
                    <div class="featured-image logo">
                        <p class="h2 text-white fs-2">User Authentication</p> 
                    </div>
                </div>
                <div class="col-md-6 p-4 right-box flex flex-column">
                    <form action="signup.php" method="POST">
                        <div class="row align-items-center mt-2">
                            <p class="signin-heading flex fs-4">Sign Up</p>
                            <div class="input-group mt-1 inputbox">
                                <ion-icon name="mail-outline"></ion-icon>
                                <input type="email" name="myemail" id="myemail" pattern="[a-z0-9._]@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                <label for="myemail">Email</label>
                            </div>
                            <div class="input-group mt-4 inputbox mb-2">
                                <ion-icon name="eye-off-outline"></ion-icon>
                                <input type="password" name="mypass" id="mypass" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                                <label for="mypass">Password</label>
                            </div>
                            <div class="input-group mt-4 inputbox mb-2">
                                <ion-icon name="eye-off-outline"></ion-icon>
                                <input type="password" name="cpass" id="cpass" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
                                <label for="cpass">Confirm Password</label>
                            </div>

                            <div class="input-group mb-3">
                                <button class="login btn btn-lg btn-primary w-100 mt-4" value="submit">Sign Up</button>
                            </div>
                            <div class="register">
                                <p>Already have an account? <a href="login.php" class="link-secondary">sign in</a></p>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </form>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>