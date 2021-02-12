<?php

include 'config.php';

if(isset($_POST['create'])){
    $username = $conn -> real_escape_string($_POST['username']);
    $password = $conn -> real_escape_string($_POST['password']);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header('Location: ./index.php');
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>Document</title>
</head>
<body>
    create account here
    <form action="" method="POST">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit" value="create account" name="create">
    </form>

</body>
</html>