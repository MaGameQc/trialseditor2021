<?php
session_start();
 include 'config.php';

 if(isset($_POST['connect'])){
    $username = $conn -> real_escape_string($_POST['username']);
    $password = $conn -> real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password =  '$password';";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($username == $row['username'] && $password == $row['password']){
                echo $row['username'] . " " . $row['password'] . " is connected";
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                header('Location: ./blog.php');
            }else{
                echo "no corresponding accounts \n";
            }
        }
    }else{
        echo "no rows for result";
    }

    mysqli_close($conn);

 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trials Editor Blog</title>
</head>
<body>
    
<a href="createAccount.php">dont have an account, create one !</a>

<form action="" name="" method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="connect" name="connect">
</form>


</body>
</html>