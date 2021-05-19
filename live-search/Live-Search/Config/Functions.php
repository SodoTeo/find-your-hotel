<?php

class Functions{

    private $DBHOST = 'localhost';
    private $DBUSER = 'root';
    private $DBPASS = '';
    private $DBNAME = 'booking';
    public $conn;

    public function __construct(){
        try{
            $this->conn = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
            if(!$this->conn){  
                throw new Exception('Connection was Not Extablish');
            }
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

    }

    public function validate($string){
        $string = urldecode($string);
        $string = mysqli_real_escape_string($this->conn, trim(strip_tags($string)));
        return $string;
    }

    public function select_order($tbl_name, $field_id, $order='ASC'){

        $select = "SELECT * FROM $tbl_name ORDER BY $field_id $order";
        $query = mysqli_query($this->conn, $select);
        if(mysqli_num_rows($query) > 0){
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
		$search_query = mysqli_query($this->conn, $search);
		if(mysqli_num_rows($search_query) > 0){
			$serch_fetch = mysqli_fetch_all($search_query, MYSQLI_ASSOC);
			return $serch_fetch;
		}
		else{
			return false;
		}

	}
        

}




?>