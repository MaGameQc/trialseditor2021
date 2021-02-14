<?php

session_start();
include 'config.php';
$_SESSION['username'];
$_SESSION['password'];

if(isset($_POST['postId'])){
    
    $postId = $_POST['postId'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];
    $sql = "INSERT INTO post_comments (post_id, content, author) VALUES ('$postId', '$content','$username');";

    if (mysqli_query($conn, $sql)) {
      // echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  }



?>