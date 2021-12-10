<?php
    require('includes/db.inc.php');
    
	$telepulesek=array();

	$sql = "SELECT * FROM telepulesek order by nev";
	$result = $conn->query($sql);
	
	if($result){
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$telepulesek[$row['id']-1]=array($row['irsz'],$row["nev"]);
			}
		} else {
			echo "0 results";
		}
	}
	else{
		echo "Error in ".$sql."<br>".$conn->error;
  	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Települések</title>
    <style>
        table{
            border:2px solid black;
        }
        td{
            border:1px solid black;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Irányítószám</th>
        <th>Név</th>
    </tr>
    <?php
       
        foreach($telepulesek as $line){
            echo '<tr>';
            echo '<td>'.$line[0].'</td>';
            echo '<td>'.$line[1].'</td>';
            echo '</tr>';
        }
        unset($telepulesek);
    ?>
</table>
</body>
</html>