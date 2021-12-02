<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][0]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if(isset($_POST["submit"])) {
  $countfiles = count($_FILES['fileToUpload']['name']);
  for($i=0;$i<$countfiles;$i++){
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
    if (compressImage($_FILES["fileToUpload"]["tmp_name"][$i], $target_file,30)) {
      echo "A kép: ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " fel lett töltve.";
    } else {
      echo "Hiba a kép feltöltése közben.";
    }
    echo "<br>";
  }//for
 
}//isset

// Compress image
function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  if (imagejpeg($image, $destination, $quality))
    return true;
  else
    return false;
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