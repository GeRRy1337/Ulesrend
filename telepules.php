<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
       
        /*$file=file("telepulesek.txt");
        sort($file);
        foreach($file as $line){
            echo '<tr>';
            $line=explode("\t",$line);
            echo '<td>'.$line[0].'</td>';
            echo '<td>'.$line[1].'</td>';
            echo '</tr>';
        }*/

        require('includes/db.inc.php');

        $myfile= fopen('telepulesek.txt','r') or die('Unable to open file!');
        while(!feof($myfile)){
            $line=explode("\t",fgets($myfile));
            $sql = "INSERT INTO telepulesek(irsz,nev) VALUES(".$line[0].",'".$line[1]."') ";
            if(!$result = $conn->query($sql)) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            echo '</tr>';
        }

        fclose($myfile);

    ?>
</table>
</body>
</html>