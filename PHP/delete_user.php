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

    $user = $_POST['username'];

    if(strcmp($user, "admin") == 0){
        header("Location: http://localhost/onlinevotingsystem/CSS/admin_user_delete1.html");
        exit();
    }

    $query = "select * from user where username='$user'";
    $result = mysqli_query($conn, $query);

    
    // echo "$query<br>";
    if (mysqli_num_rows($result) == 0) {
        header("Location: http://localhost/onlinevotingsystem/CSS/admin_user_delete2.html");
        exit();
    }
    
    $query = "delete from user where username='$user'";
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
echo '<h1>User Deleted</h1><br><br>';
echo '<h4>> Operation Successful !!!</h4>';
echo '</a>';
echo '</pre>';
echo '</div>';
echo '</div>';
echo '</body>';
echo '</html>';
?>