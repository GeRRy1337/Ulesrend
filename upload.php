<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][0]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowed_filetypes=["img","jpg","png","jpeg","gif"];
$errors=array();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $countfiles = count($_FILES['fileToUpload']['name']);
  for($i=0;$i<$countfiles;$i++){
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $filename=$_FILES["fileToUpload"]["name"][$i];
    /*if (file_exists($target_file)) {
      echo "Már létezik ilyen nevű fájl.";
      $uploadOk = 0;
    }*/

    if ($_FILES["fileToUpload"]["size"][$i] > 102400) {
      $errors[$filename][]="Túl nagy fájl méret.<br>";
      $uploadOk = 0;
    }elseif($_FILES["fileToUpload"]["size"][$i] < 10000){
      $errors[$filename][]="Túl kicsi fájl méret.<br>";
      $uploadOk = 0;
    }

    if(!in_array($imageFileType,$allowed_filetypes)) {
      $errors[$filename][]="Csak JPG, JPEG, PNG & GIF formátumok engedélyezettek.<br>";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      $errors[$filename][]="<span style=color:#F22;>Nem sikerült a kép feltöltése.</span><br>";
    } else {
      if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
        $errors[$filename][]= "A kép fel lett töltve.<br>";
      } else {
        $errors[$filename][]="Hiba a kép feltöltése közben.<br>";
      }
    }

  }//for
 
}

  foreach($errors as $key => $error){
    echo $key."<br>";
    foreach($error as $line){
      echo "<span style=padding-left:50px;>".$line."</span>";
    }
  }

?>

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>