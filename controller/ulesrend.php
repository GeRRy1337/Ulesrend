<?php
// form feldolgozása
require 'model/Hianyzo.php';
require 'model/Admin.php';

$hianyzo = new Hianyzo();

if(!empty($_POST["hianyzo_id"])) {
	$hianyzo->set_id($_POST["hianyzo_id"], $conn);
}
elseif(!empty($_GET['nem_hianyzo'])) {
	$hianyzo->remove_id($_GET['nem_hianyzo'], $conn);
}
if(!empty($_POST["profilkep_id"])&&!empty($_FILES['fileToUpload'])) {
	$allowed_filetypes=["img","jpg","png","jpeg"];
	$target_dir = "uploads/";
	$imageFileType = strtolower(pathinfo( basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
	$target_file = $target_dir . basename($_POST["profilkep_id"].'.'.$imageFileType);
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
			if ( explode('.',$file)[0] == $_POST["profilkep_id"]){
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

$hianyzok = $hianyzo->lista($conn);

$admin = new Admin();

$adminok = $admin->lista($conn);

$en = 0;
if(!empty($_SESSION["id"])) $en = $_SESSION["id"];

$tanar = 17;

$tanuloIdk = $tanulo->tanulokListaja($conn);



include 'view/ulesrend.php';
?>