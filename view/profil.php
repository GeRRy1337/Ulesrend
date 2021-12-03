<?php
    if(!empty($_POST['user'])){
        $sql = "UPDATE `5/13ice`  SET felhasznalonev='" .$_POST['user'] ."' WHERE id=".$_SESSION['id'];
		$conn->query($sql);
        $_SESSION['username']=$_POST['user'];
    }
    if(!empty($_POST['pw'])){
        $sql = "UPDATE `5/13ice`  SET jelszo='" .md5($_POST['pw'])."' WHERE id=".$_SESSION['id'];
		$conn->query($sql);
    }
    if(!empty($_FILES['fileToUpload'])){
        $allowed_filetypes=["img","jpg","png","jpeg"];
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo( basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($_SESSION['id'].'.'.$imageFileType);
        $uploadOk = 1;
        if(!in_array($imageFileType,$allowed_filetypes)) {
            echo "Csak JPG, JPEG, PNG & GIF formátumok engedélyezettek.<br>";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "<span style=color:#F22;>Nem sikerült a kép feltöltése.</span><br>";
        } else {
            $files=scandir("uploads");
            foreach($files as $file){
                if ( explode('.',$file)[0] == $_SESSION['id']){
                unlink("uploads/$file");
                }
            }
            if (@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Sikeres kép feltöltés.<br>";
            } else {
                echo "Hiba a kép feltöltése közben.<br>";
            }
        }
    }
?>

<!doctype html>
<html lang="hu">
	<head>
		<meta charset="utf-8">
		<Title>User</title>
	</head>
	<body>
		
        <form action="index.php?page=profil" method="post" enctype="multipart/form-data">
            
            Felhasználónév (<?php echo $_SESSION['username']; ?>): 
            <br><input type="text" name="user"><br>
            Jelszó:
            <br><input type="password" name="pw"><br>
            Profilkép:
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input type="submit" value="Módosít">
        </form>
		<a href="ulesrend.php">Vissza</a>
	</body>
</html>
