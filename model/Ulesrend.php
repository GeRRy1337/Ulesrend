<?php
    require '../db.inc.php';

    class Ulesrend{
        private $id;
        private $nev;
        private $sor;
        private $oszlop;
        private $jelszo;
        private $felhasznalonev;

        public function set_user($id,$conn){
            $sql = "SELECT * FROM `5/13ice` WHERE id=$id";
		    $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row["id"];
                $this->nev = $row["nev"];
                $this->sor = $row["sor"];
                $this->oszlop = $row["oszlop"];
                $this->jelszo = $row["jelszo"];
                $this->felhasznalonev = $row["felhasznalonev"];

            }
        }

        public function get_nev(){
           return $this->nev;
        }
    }   
    $tanulo = new Ulesrend;
    $tanulo ->set_user(2, $conn);
    echo $tanulo->get_nev();

?>