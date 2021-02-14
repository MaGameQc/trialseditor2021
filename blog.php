
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

    include 'upload.php';

    $sql = "INSERT INTO post_table (post_title, post_content, post_image_path, post_author) VALUES ('$title', '$content','$imagePath', '$author');";

    if (mysqli_query($conn, $sql)) {
        // echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      
    //   mysqli_close($conn);

}

// if(isset($_POST['comment_submit'])){
//   $content = $_POST['comment_input'];
//   $username = $_SESSION['username'];
//   $sql = "INSERT INTO post_comments (post_id, content, author) VALUES ('$postId', '$content','$username');";

//   if (mysqli_query($conn, $sql)) {
//     // echo "New record created successfully";
//   } else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//   }
// }
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

                    <div id="<?php echo $rows['id'] ?>" class="post" style="display: flex; flex-direction: column;  border: solid black 2px; width: 40%;">
                        <h1><?php echo $rows['post_title'] ?></h1>
                        <p><?php echo $rows['post_content'] ?></p>
                        <img src="<?php echo $rows['post_image_path'] ?>" style="width: 14rem; height: auto;">
                        <p><?php echo $rows['post_author'] ?></p>
                        <p><?php echo $rows['post_date'] ?></p>
                    </div>

                <?php
            }
        }
        
    ?>
    </div>


    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

let posts = document.querySelectorAll(".post");

posts.forEach(function(element, index){
  let count = 0;
  element.addEventListener("click", function(){
    if(count == 0){
    let container = document.createElement("form");
    container.setAttribute("method", "POST");
    let input = document.createElement("input");
    input.setAttribute("name", "comment_input");
    input.setAttribute("class", "comment_input");
    input.setAttribute("type", "input");
    let button = document.createElement("input");
    button.setAttribute("type", "submit");
    button.setAttribute("name", "comment_submit");
    button.setAttribute("class", "comment_submit");
    button.value = "envoyer";

    container.appendChild(input);
    container.appendChild(button);

    element.appendChild(container);
    count++
  }else{
    count++
    return;
  }



  document.querySelector(".comment_submit").addEventListener("click", function(){
      value = document.querySelector(".comment_input").value;

      var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
      }
    };
    xhttp.open("POST", "getPostId.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("postId=" + element.id + "&content=" + value);

    });


    });



   


});

</script>

</body>
</html>