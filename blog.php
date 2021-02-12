
<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

session_start();
include 'config.php';
echo $_SESSION['username'];
echo $_SESSION['password'];

if(isset($_POST['post_submit'])){
    $title = $conn -> real_escape_string($_POST['post_title']);
    $content = $conn -> real_escape_string($_POST['post_content']);
    $author = $conn -> real_escape_string($_SESSION['username']);

    $sql = "INSERT INTO post_table (post_title, post_content, post_author) VALUES ('$title', '$content', '$author');";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
    //   mysqli_close($conn);






/**********************************************************section upload file *******************************************/


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


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

    <form action="" method="post" style="display: flex; flex-direction: column; width: 40%;" enctype="multipart/form-data">
        <p>title</p>
        <input type="text" name="post_title" id="">
        <p>add image</p>
        <input type="file" name="fileToUpload" id="" >
        <p>content</p>
        <textarea name="post_content" id="" cols="30" rows="10"></textarea>
        <input type="submit" name="post_submit" value="post">
    </form>

    <div id="postsContainer">

    <?php
        $sql = "SELECT * FROM post_table ORDER BY id DESC;";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                ?>

                    <div style="display: flex; flex-direction: column;  border: solid black 2px; width: 40%;">
                        <h1><?php echo $rows['post_title'] ?></h1>
                        <p><?php echo $rows['post_content'] ?></p>
                        <p><?php echo $rows['post_author'] ?></p>
                        <p><?php echo $rows['post_date'] ?></p>
                    </div>

                <?php
            }
        }
        
    ?>
    </div>

</body>
</html>