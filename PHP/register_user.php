<?php
    session_start();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
?>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voting";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if(!$conn){
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }
?>

<?php

    function validate_fname($fname){
        if (!preg_match ("/^[a-zA-z]*$/", $fname) || strlen($fname) > 20) {  
            header("Location: http://localhost/onlinevotingsystem/CSS/error_fname.php");
            exit();
        } 
    }

    function validate_lname($lname){
        if (!preg_match ("/^[a-zA-z]*$/", $lname) || strlen($lname) > 20) {  
            header("Location: http://localhost/onlinevotingsystem/CSS/error_lname.php");
            exit();
        }  
    }
    
    function validate_user($user, $conn){
        $query1 = "select * from user where username = '$user'";
        $result1 = mysqli_query($conn, $query1);

        if (!preg_match ("/^[a-zA-z0-9_]*$/", $user) || strlen($user) > 20) {  
            header("Location: http://localhost/onlinevotingsystem/CSS/error_user1.php");
            exit();
        } else if($result1 != NULL && mysqli_num_rows($result1) > 0){
            header("Location: http://localhost/onlinevotingsystem/CSS/error_user2.php");
            exit();
        } 
    }

    function validate_email($email, $conn){
        $regex ="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
        
        $query2 = "select * from user where email = '$email'";
        $result2 = mysqli_query($conn, $query2);

        if (!preg_match ($regex, $email) || strlen($email) > 40) {  
            header("Location: http://localhost/onlinevotingsystem/CSS/error_email1.php");
            exit();
        } else if($result2 != NULL && mysqli_num_rows($result2) > 0){
            header("Location: http://localhost/onlinevotingsystem/CSS/error_email2.php");
            exit();
        } 
    }
    
    function validate_pass($pass){
        if (strlen($pass) > 20) {  
            header("Location: http://localhost/onlinevotingsystem/CSS/error_password.php");
            exit();
        }
    }

    validate_fname($fname);
    validate_lname($lname);
    validate_user($user, $conn);
    validate_email($email, $conn);
    validate_pass($pass);
?>

<?php

    $query = "INSERT INTO `user`(`fname`, `lname`, `username`, `email`, `password`) VALUES('$fname','$lname', '$user', '$email', '$pass')";
    $result = mysqli_query($conn, $query);

    // echo "$query";
    if(!$result){
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Document</title>';
    echo '<link rel="stylesheet" href="default.css">';
    echo '<base href="http://localhost/onlinevotingsystem/CSS/" />';
    echo '</head>';
    echo '<body>';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo '<h1>Candidates</h1><br><br>';
    echo '<pre>';
    echo "<h4>> First Name : $fname </h4><br>";
    echo "<h4>> Last Name  : $lname </h4><br>";
    echo "<h4>> Username   : $user </h4><br>";
    echo "<h4>> Email ID   : $email </h4><br>";
    echo "<h4>> Password   : $pass </h4><br><br><br><br>";
    echo '<a href="main.html"><h4>> Return </h4></a><br>';
    echo '</pre>';
    echo '</div>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
?>