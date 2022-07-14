<?php 
   session_start();
   $_SESSION['position'] = $_GET['position'];
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
    
    $user = $_SESSION['user'];
    $position = $_GET['position'];

    // Voting for new Position
    // 1. Checking if position exist or not 
    // 2. Adding new position if it does not exist
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'voting' AND TABLE_NAME = 'user'";
    $result = mysqli_query($conn, $query);

    $flag = 0;    $last_column="custom";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $n = $row[0]; 
            $last_column=$n;
            if(strcmp($position, $n) == 0){
                $flag = 1;
                break;
            }
        }

        if($flag == 0){
            $query = "ALTER TABLE user ADD `$position` BOOLEAN NULL DEFAULT FALSE AFTER `$last_column`";
            $result = mysqli_query($conn, $query);
            if(!$result){
                header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
                exit();
            }
        }
    }

    $query0 = "select $position from user where username = '$user'";
    $result0 = mysqli_query($conn, $query0);

    // echo "$query0";

    if(mysqli_num_rows($result0) > 0){
        while($row = mysqli_fetch_array($result0)){
            $n = $row[0]; 
            if($n != 0){
                header("Location: http://localhost/onlinevotingsystem/CSS/voted_error.html");
                exit();
            }
        }
    }

    $query = "select candidate, cid from vote where type='$position'";
    $result = mysqli_query($conn, $query);        
    
    echo '<link rel="stylesheet" href="default.css">';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo '<h1>Candidates</h1><br><br>';
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $n = $row[0];  $m = $row[1];   
            echo '<pre>';
            echo '<a href="update.php?cid='.$m.'"><h4> > '. $n .'</h4></a><br>';
            echo '</pre>';
        }
    }
    echo '</div>';
    echo '</div>';
?>
