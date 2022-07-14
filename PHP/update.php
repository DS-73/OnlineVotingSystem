<?php
    session_start();
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


    $position = $_SESSION['position'];
    $cid = $_GET['cid'];

    $user = $_SESSION['user'];
    $query0 = "select $position from user where username = '$user'";
    $result0 = mysqli_query($conn, $query0);

    if(mysqli_num_rows($result0) > 0){
        while($row = mysqli_fetch_array($result0)){
            $n = $row[0]; 
            if($n != 0){
                header("Location: http://localhost/onlinevotingsystem/CSS/voted_error.html");
                exit();
            }
        }
    }


    $query = "select * from vote where cid='$cid'"; 
    $result = mysqli_query($conn, $query);
    // echo"$query<br>";
    
    echo '<link rel="stylesheet" href="default.css">';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo '<h1>Voting Successful</h1><br><br>';
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $n = $row[1];  $w = $row[3];
            
            // Updating Votes
            $votes = intval($row[2]) + 1;
            // echo "$votes  $w<br>";
            $query2 = "update vote set votes='$votes' where cid='$cid'";
            $result2 = mysqli_query($conn, $query2);
            // echo"$query2<br>";
            // Updating User's voting status
            $name = $_SESSION['user'];
            $query3 = "update user set $w=1 where username='$name'";
            // echo "$query3 <br>";
            // echo "$name";
            $result3 = mysqli_query($conn, $query3);

            if(!$result2 && !$result3){
                die('NOT WORKING');
            }

            echo '<pre>';
            echo "<h4> > $n for $w </h4></a><br>";
            echo '</pre>';
        }
    }

    echo "<br><br><br>";
    echo '<pre>';
    echo '<a href="main.html"><h4>> Return</h4><br></a><br>';
    echo '<pre>';
    echo '</div>';
    echo '</div>';
?>