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

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $position = $_POST['position'];

    // Checking if candidate already exist 
    $query = "select * from vote where cid=$cid";
    $result = mysqli_query($conn, $query);

    // echo " $query";
    if(mysqli_num_rows($result) > 0){
        header("Location: http://localhost/onlinevotingsystem/CSS/duplicate_candidate_error.html");
        exit();
    }

    // New Position
    $query = "insert into vote values($cid, '$name', 0, '$position')";
    $result = mysqli_query($conn, $query);

    if(!$result){
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }
  
    
    echo '<link rel="stylesheet" href="default.css">';
    echo '<div class="area"></div>';
    echo '<div class="context" style="top:20vh;">';
    echo '<pre>';
    echo '<a href="admin_menu.html">';
    echo '<h1>Candidate Added</h1><br><br>';
    echo '<h4>> Operation Successful !!!</h4>';
    echo '</a>';
    echo '</pre>';
    echo '</div>';

?>
