<?php
    session_start();
    if(strcmp($_SESSION['user'], "admin") != 0){
        header("Location: http://localhost/onlinevotingsystem/CSS/admin_login_required.html");
        exit();
    }
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

    $sql = "select voting from user where username = 'admin'"; 
    $result = mysqli_query($conn, $sql);
    $status = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $status = $row[0];
        }
        mysqli_free_result($result);
    } else{
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }

    if($status == 0){
        $sql = "UPDATE user SET voting = 1";    
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
            exit();
        }
    } else{
        $sql = "UPDATE user SET voting = 0";    
        $result = mysqli_query($conn, $sql);
        if(!$result){
            header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
            exit();
        }
    }
    mysqli_close($conn);
?>

<?php
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Voting Status</title>';
echo '<link rel="stylesheet" href="default.css">';
echo '</head>';
echo '<body>';
echo '<div class="area"></div>';
echo '<div class="context" style="top:20vh;">';
echo '<h1>Voting Status Updated</h1><br><br>';
echo '<pre><br>';
echo '<a href="admin_menu.html"><h4>> Return</h4><br></a><br>';
echo '</pre>';
echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
?>