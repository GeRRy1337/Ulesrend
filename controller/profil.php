<?php
if(!empty($_SESSION["id"])){
    include 'view/profil.php';
}else{
    header("location:index.php?page=index");
}

?>
