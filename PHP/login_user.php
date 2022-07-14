<?php
    session_start();
    $_SESSION['user'] = $_POST['username'];
    $_SESSION['pass'] = $_POST['password'];
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

    $user = $_SESSION['user'] ;
    $pass = $_SESSION['pass'];
    $sql = "select * from user where username = '$user'"; 

    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $actual_pass = $row[4];
            if(strcmp($actual_pass, $pass) != 0){
                header("Location: http://localhost/onlinevotingsystem/CSS/wrong_password_error.html");
                exit();
            }
        }

        mysqli_free_result($result);
    } else{
        header("Location: http://localhost/onlinevotingsystem/CSS/no_user_error.html");
        exit();
    }

    # Terminating the connection
    mysqli_close($conn);
?>

<?php
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Voter Panel</title>';
echo '<link rel="stylesheet" href="default.css">';
echo '</head>';
echo '<body>';
echo '<div class="area"></div>';
echo '<div class="context" style="top:20vh;">';
echo '<h1>Welcome '.$user.' !</h1><br><br>';
echo '<pre><br>';
echo '<a href="vote_status.php"><h4>> Vote </h4></a><br><br>';
echo '<a href="index.html"><h4>> Exit</h4><br></a><br>';
echo '</pre>';
echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
?>