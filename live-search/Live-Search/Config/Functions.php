<?php

class Functions{

    private $DBHOST = 'localhost';
    private $DBUSER = 'root';
    private $DBPASS = '';
    PRIVATE $DBNAME = 'booking';
    public $conn;

    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=".$this->DBHOST.";dbname=".$this->DBNAME.";charset=utf8",$this->DBUSER, $this->DBPASS);
            if(!$this->conn){  
                throw new Exception('Connection was Not Extablish');
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

    }
    

    public function validate($string){
        try{
            $this->connn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
            if(!$this->conn){  
                throw new Exception('Connection was Not Extablish');
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        $string = urldecode($string);
        $string = mysqli_real_escape_string($this->connn, trim(strip_tags($string)));
        return $string;

    }



    public function select_order($tbl_name, $field_id, $order='ASC'){

        $select = "SELECT * FROM $tbl_name ORDER BY $field_id $order LIMIT 1";
        $query = $this->conn->query($select);
        if($query->rowCount() > 0){
            $select_fetch = $query->fetchAll();
            if($select_fetch){
                return $select_fetch;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

    }


	public function search($tblname, $search_val, $op="AND"){

		$search = "";
		foreach($search_val as $s_key => $s_value){
			$search = $search."$s_key LIKE '%$s_value%' $op ";
		}
		$search = rtrim($search, "$op ");

		$search = "SELECT * FROM $tblname WHERE $search";
        $search_query = $this->conn->query($search);
        if($search_query->rowCount() > 0){
            $serch_fetch = $search_query->fetchAll();
			return $serch_fetch;
		}
		else{
			return false;
		}

	}
        

}




?>