
		<table>
			<tr>
				<th colspan="3">
					<h2>Ülésrend</h2>
				</th>
				<th colspan="3">
				<?php
				
				if(!empty($_SESSION["id"])) {
					if(in_array($_SESSION["id"], $adminok)) {
						?>
						<form action="index.php?page=ulesrend" method="post">
						Hiányzó: 	<select name="hianyzo_id">
									<?php

									if ($tanuloIdk) {
										foreach($tanuloIdk as $row) {
											$tanulo->set_user($row, $conn);
											if($tanulo->get_nev() and !in_array($row, $hianyzok)) echo '<option value="'.$row.'">'.$tanulo->get_nev().'</option>';
										}
									}
									?>
										
									</select>
						<input type="submit">
						</form>
						<hr></hr>
						<form action="index.php?page=ulesrend" method="post" enctype="multipart/form-data">
							Profilkép: 	<select name="profilkep_id">
								<?php

								if ($tanuloIdk) {
									foreach($tanuloIdk as $row) {
										$tanulo->set_user($row, $conn);
										if($tanulo->get_nev()) echo '<option value="'.$row.'">'.$tanulo->get_nev().'</option>';
									}
								}
								?>
							</select>
							<input type="file" name="fileToUpload" id="fileToUpload"><br>
							<input type="submit">
						</form>							
						<?php
					}
				}
				?>
				</th>
			</tr>
			
				<?php

				if ($tanuloIdk) {
					$sor = 0;
					$files=scandir("uploads");
					foreach($tanuloIdk as $row) {
						$tanulo->set_user($row, $conn);
						if($tanulo->get_sor() != $sor) {
							if($sor != 0) echo '</tr>';
							echo '<tr>';
							$sor = $tanulo->get_sor();
						}
						if(!$tanulo->get_nev()) echo '<td class="empty"></td>';
						else {
							$plusz = '';
							if(in_array($row, $hianyzok)) $plusz .=  ' class="missing"';
							if($row == $en) $plusz .=  ' id="me"';
							if($row == $tanar) $plusz .=  ' colspan="2"';
							foreach($files as $file){
								if ( explode('.',$file)[0] == $tanulo->get_id()){
									$plusz .= ' style="background-image:url(uploads/'.$file.');background-size:contain; background-repeat: no-repeat;"';
								}
							}
							
							echo "<td".$plusz.">" . $tanulo->get_nev();
							if(!empty($_SESSION["id"])) {
								if(in_array($_SESSION["id"], $adminok)) {
									if(in_array($row, $hianyzok)) echo '<br><a href="index.php?page=ulesrend&nem_hianyzo='.$row.'">Nem hiányzó</a>';
								}
							}
							echo "</td>";
						}
					}
				} 
				else {
					echo "0 results";
				}
				$conn->close();

				?>
		</table>
	</body>
</html>