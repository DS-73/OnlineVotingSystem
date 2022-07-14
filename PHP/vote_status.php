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

    $sql = "select voting from user where username = 'admin'"; 
    $result = mysqli_query($conn, $sql);
    $status = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $status = $row[0];
        }
        
        mysqli_free_result($result);
        if($status == 0){
            header("Location: http://localhost/onlinevotingsystem/CSS/voting_stopped_error.html");
            exit();
        }
    } else{
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }

    mysqli_close($conn);

    header("Location: http://localhost/onlinevotingsystem/CSS/vote.php");
    exit();
?>