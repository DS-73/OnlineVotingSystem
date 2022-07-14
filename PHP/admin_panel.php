<?php
    // Session Started
    session_start();
    $_SESSION['user'] = $_POST['username'];
    $_SESSION['pass'] = $_POST['password'];
?>

<?php
    // Setting Up connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voting";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if(!$conn){
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }

    $user = $_POST['username'];
    $pass = $_POST['password'];


    if(strcmp($user, "admin") != 0){
        header("Location: http://localhost/onlinevotingsystem/CSS/invalid_admin.html");
        exit();
    }

    $query = "select password from user where username='admin'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $actual_pass = $row[0];
            if(strcmp($actual_pass, $pass) != 0){
                header("Location: http://localhost/onlinevotingsystem/CSS/invalid_admin_pass.html");
                exit();
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    header("Location: http://localhost/onlinevotingsystem/CSS/admin_menu.html");
    exit();
?>