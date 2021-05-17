<?php
    include "db_config.php";
        class user
        {
            public $db;
            public function __construct()
            {
                try {
                    $this->db= new PDO('mysql:host=localhost;dbname=booking;charset=utf8mb4', DB_USERNAME, DB_PASSWORD);
               } catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
               }
            }
            public function reg_user($username, $password, $email)
            {
                //$password=md5($password);
                $check = $this->db->prepare("SELECT * FROM users WHERE uname='$username' OR uemail='$email'");
                $check->execute();
                if($check->rowCount() ==0)
                {
                    $result = $this->db->prepare("INSERT INTO users SET uname='$username', upass='$password', uemail='$email'");
                    $result->execute() or die(print_r($result->errorInfo()."Data cannot be inserted", true));
                    return $result;
                }
                else
                {
                    return false;
                }
            }

            public function edit_room_cat($h_name, $room_qnty, $no_bed, $bedtype, $facility, $price, $room_cat,$rating, $phone, $address, $prefecture)
            {
 
                        
                 
                         $send=$this->db->prepare("UPDATE hotels  SET h_name='$h_name', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype',  price='$price', facility='$facility', price='$price', rating='$rating', phone='$phone', address='$address', prefecture='$prefecture' WHERE h_name='$h_name'");
                         $send->execute() or die(print_r($send->errorInfo()."Data cannot be updated", true));
                        if($send)
                        {
                            $result="Updated Successfully!!";
                        }
                        else
                        {
                            $result="Sorry, Internel Error";
                        }
  
                    
                
                    return $result;
                

            }
            

            public function add_room($h_name, $room_qnty, $no_bed, $bedtype,$facility,$price)
            {

                
                    $sql=$this->db->prepare("INSERT INTO hotels SET h_name='$h_name', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype', facility='$facility', price='$price'");
                    $sql->execute() or die(print_r($sql->errorInfo()."Data cannot inserted", true));
                
                
                    for($i=0;$i<$room_qnty;$i++)
                    {
                        
                        $sql2=$this->db->prepare("INSERT INTO hotels SET h_name='$h_name'");
                        $sql2->execute();
                        
                        
                    }
                
                    return $sql;
                

            }        
            
            public function check_login($emailusername,$password)
            {
                //$password=md5($password);
                $result = $this->db->prepare("SELECT id from users WHERE uemail='$emailusername' OR uname='$emailusername' and upass='$password'");
                $result->execute();
                $user_data= $result->fetch(PDO::FETCH_ASSOC);

                
                if($result->rowCount() ==1)
                {
                    $_SESSION['login']=true;
                    $_SESSION['id']=$user_data['id'];
                    return true;    
                }
                else
                {
                    return false;
                }
            }

            public function get_session()
            {
                return $_SESSION['login'];
            }
            public function user_logout()
            {
                $_SESSION['login']=false;
                session_destroy();
            }
        }

?>