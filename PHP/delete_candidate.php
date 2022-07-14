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

    $query = "select * from vote where cid=$cid";
    $result = mysqli_query($conn, $query);

    
    // echo "$query<br>";
    if (mysqli_num_rows($result) == 0) {
        header("Location: http://localhost/onlinevotingsystem/CSS/admin_candidate_delete.html");
        exit();
    }
    
    $query = "delete from vote where cid=$cid";
    $result = mysqli_query($conn, $query);

    // echo "$query<br>";
    if(!$result){
        header("Location: http://localhost/onlinevotingsystem/CSS/ERROR.html");
        exit();
    }
?>

<?php
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
echo '<pre>';
echo '<a href="admin_menu.html">';
echo '<h1>Candidate Deleted</h1><br><br>';
echo '<h4>> Operation Successful !!!</h4>';
echo '</a>';
echo '</pre>';
echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
?>