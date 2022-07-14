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

    $position = $_SESSION['position'];

    $query = "select * from vote where type='$position' order by votes desc";
    $result = mysqli_query($conn, $query);
        
    // echo "$query<br>";
    echo '<link rel="stylesheet" href="default.css">';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo "<h1>Result for $position</h1><br><br>";
    
    if(mysqli_num_rows($result) > 0){
        echo '<pre>';
        echo '<table style="margin-left: 30%;">';
        echo '<tr>';
        echo '<td><h4><u>Candidate</u></h4></td>';
        echo '<td><h4></h4></td>';
        echo '<td><h4><u>Votes</u></h4></td>';
        echo '</tr>';
            while($row = mysqli_fetch_array($result)){
                $n = $row[1];   $v = $row[2];
                echo '<tr>';
                echo "<td><h4>$n</h4></td>";
                echo '<td><h4></h4></td>';
                echo "<td><h4>$v</h4></td>";
                echo '</tr>';
                echo '</table>';
            }
        echo '</pre>';
    }
    echo '</div>';
    echo '</div>';

?>


<!-- <?php


?> -->