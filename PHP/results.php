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

    $query = "select DISTINCT(type) from vote";
    $result = mysqli_query($conn, $query);
        
    
    echo '<link rel="stylesheet" href="default.css">';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo '<h1>Select Position</h1><br><br>';
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $n = $row[0];
            echo '<pre>';
            echo '<a href="output_result.php?position='.$n.'"><h4> > '. $n .'</h4></a><br>';
            echo '</pre>';
        }
    }
    echo '</div>';
    echo '</div>';

?>
