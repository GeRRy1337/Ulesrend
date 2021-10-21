<?php 
    require 'db.inc.php';
    class Ulesrend{
        private $id;
        private $nev;
        private $sor;
        private $oszlop;
        private $jelszo;
        private $felhasznalonev;

        public function get_user($id){
            // adatbázisból lekérdezzük
            $sql = "SELECT * FROM `5/13ice` WHERE id=$id";
		    $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc()
                return $row;
            }
            else return FALSE;   
        }
    }
?>