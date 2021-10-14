<?php
	require 'db.inc.php';
	require 'menu.php';
	require 'function.inc.php';

	$tanar=array(3,3);

	$admins= getIds($conn,"admins");

	//form feldolgozása
	if(!empty($_POST['hianyzo_id'])){
		$sql = "INSERT INTO `hianyzok` (id) VALUES (" .$_POST['hianyzo_id'] .")";
		$conn->query($sql);
	}
	elseif(!empty($_GET["nem_hianyzo"])){
		$sql = "DELETE FROM `hianyzok` Where id=".$_GET["nem_hianyzo"];
		$result = $conn->query($sql);
	}
	
	
	$hianyzok= getIds($conn,"hianyzok");

?>

<!doctype html>
<html lang="hu">
	<head>
		<meta charset="utf-8">
		<Title>Ülésrend</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<table>
			<tr>
				<th colspan="3">
					<?php
					if (!empty($_SESSION["id"])){
						echo 'Üdv '.$_SESSION['nev']."!";
					}
					?>	
				
				</th>
				<th colspan="3">Ülésrend
				<?php if(!empty($_SESSION['id']) and $_SESSION['admin']==1){ ?>
					<form action="ulesrend.php" method="post">
						Hiányzó: <select name="hianyzo_id">
								<?php
								$result=getStudents($conn);
								if ($result->num_rows > 0) {
									
									while($row = $result->fetch_assoc()) {
										if($row["nev"] and !in_array($row["id"],$hianyzok)){
											echo '<option value='.$row["id"].'>'.$row["nev"].'</option>';
										}
									}
								}
								?>
							</select><br>
						<input type="submit">
					</form>	
				<?php } ?>
				</th>
			</tr>
			<?php
				$result=getStudents($conn);
				if ($result->num_rows > 0) {
					$sor=0;
					while($row = $result->fetch_assoc()) {
						if($row["sor"] != $sor){
							if($sor != 0){
								echo '</tr>';
							}
							echo '<tr>';
							$sor = $row["sor"];
						}
						$plusz='';
						if(!$row["nev"])
							$plusz.= " class='empty'";
						else{
							if (!empty($_SESSION['id']) and $row['id'] == $_SESSION['id']) $plusz.= ' id="me"';
							if($sor-1 == $tanar[0] && $row["oszlop"]-1 == $tanar[1]) $plusz.=  ' colspan="2"';
							if(in_array($row["id"],$hianyzok)) $plusz.=  ' class="missing"';
							
						}
						if(!empty($_SESSION['id']) and $row['id']==$_SESSION['id']){
							echo "<td".$plusz." ><a href='user.php'>".$row["nev"]."</a>";
						}else{
							echo "<td".$plusz." >".$row["nev"];
						}
						if(!empty($_SESSION['id']) and $_SESSION['admin'] == 1 and in_array($row["id"],$hianyzok)) echo '<br><a href="ulesrend.php?nem_hianyzo='.$row["id"].'">Nem hiányzó</a>';
						echo "</td>";
					}
				} else {
					echo "0 results";
				}

				$conn->close();
			?>
		</table>
		
	</body>
</html>