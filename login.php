<?php
    require 'menu.php';
    require 'db.inc.php';
    require 'function.inc.php';
    

    $admins= getIds($conn,"admins");

    if(isset($_POST['pw']) and isset($_POST['user'])) {
		$loginError='';
		if(strlen($_POST['user']) == 0) {
			$loginError.=" Nem írtál be felhasználónevet!";
		}
		if(strlen($_POST['pw']) == 0) {
			$loginError.=" Nem írtál be jelszót!";
		}
		if($loginError == ''){
			$sql = "SELECT * FROM `5/13ice` WHERE felhasznalonev='".$_POST['user']."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				if($row = $result->fetch_assoc()){
					if(md5($_POST['pw'])==$row['jelszo']){
						$_SESSION["id"]=$row['id'];
						$_SESSION["nev"]=$row['nev'];
						$_SESSION["username"]=$row['felhasznalonev'];
						if(in_array($row['id'],$admins)){
							$_SESSION["admin"]=1;
						}else{
							$_SESSION["admin"]=0;
						}

						$loginError="Sikeres bejelentkezés";
                        header("location: ulesrend.php");
                        exit();
					}
					else{
						$loginError="Hibás jelszó!<br>";
					}				
				}
			}
			else{
				$loginError="Nincs ilyen felhasználónév!<br>";
			}
		}
	}
	elseif(isset($_POST['logout'] )){
		session_unset();
        header("location: ulesrend.php");
        exit();
	}
?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title><?php if (!empty($_SESSION["id"])){ echo'Kilépés';}else{echo'Belépés';}?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th colspan="3">
                <?php
                if (!empty($_SESSION["id"])){
                    echo 'Üdv '.$_SESSION['nev']."!";
                    echo '<form action="login.php" method="post">
                        <input type="submit" value="Kilépés" name="logout">
                        </form>';
                }
                else{
                    if(isset($_POST['user'])){
                        echo "<br>".$loginError;
                    }
                    else echo 'Belépés';
                    
                
                ?>
                <form action="login.php" method="post">
                    Felhasználó:<input type="text" name="user"><br>
                    Jelszó:<input type="password" name="pw"><br>
                    <input type="submit">
                </form>
                <?php } ?>
            </th>
        </tr>
    </table>
</body>
</html>
