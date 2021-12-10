<?php 
    require('includes/db.inc.php');
    set_time_limit(500);    
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