<?php

//home.php

session_start();



$id=$_SESSION[ 'user_id']; 
$iduser=$_SESSION[ 'user_id'];


if(!isset($_SESSION["user_id"]))
{
	header("location:login.php");
}

include('admin/include/db_config.php');


$user_name = '';
$user_id = '';

if(isset($_SESSION["user_name"], $_SESSION["user_id"]))
{
	$user_name = $_SESSION["user_name"];
	$user_id = $_SESSION["user_id"];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
    
    <style>
          
        .well {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            width: 98%;
            height: 40vh;
            left: 1%;
            
        }

        
        body {
            background-image: url(""), linear-gradient(150deg, rgba(255, 165, 150, 0.5) 5%, rgba(0, 228, 255, 0.35)), url("wall.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        h4 {
            color: #ffbb2b;
        }
        h6
        {
            color: navajowhite;
            font-family:  monospace;
        }

        .container{
            width: 100%;
            height: 100%;
        }


    </style>
    <link rel="stylesheet" href="css/toggle.css">
    <script src="js/toggle.js" defer></script>
    
</head>

<body>
    <div class="container">
      
      
    
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a><?php echo $user_name;?></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li class="toggle">
                        <div>
                            <input type="checkbox" class="checkbox" id="chk" />
                            <label class="label" for="chk">
                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                                <i class="fa fa-cog "></i>
                                <div class="ball"></div>
                            </label>
                            
                        </div>

                    </li>
                    <li >
                        <a href="otp-php-registration/logout.php">
                            <button  id="logbtn" type="button" class="btn btn-danger" <?php if (!isset($_SESSION["user_id"])){ echo 'style="display:none;"'; } ?>>Logout</button>
                        </a>
					</li>
                </ul>
            </div>
        </nav>
        
        
        
        <?php

        $result = $connect->query("SELECT * FROM hotels WHERE id LIKE $iduser ");
        if($result)
        {   
            if(($result-> rowCount()) > 0){

//               ********************************************** Show Room Category***********************
                while ($row = $result->fetch())
                {
                    
                    echo "
                            <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-6 well'>
                                <h4>".$row['roomname']."</h4><hr>
                                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed.</h6>
                                <h6>Facilities: ".$row['facility']."</h6>
                                <h6>Price: ".$row['price']." &euro;/night.</h6>

                                <form action='admin/edit_record.php?roomname=".$row['roomname']."' method='post' target='myFrame' id='myForm'>
                                    <button type='submit' class='btn btn-primary button'>Edit</button>
                                </form>
                            </div>
                            &nbsp;&nbsp;
                            </div>
                            
                        
                    
                         ";
                    
                    
                }

                
                
                
                          
            }
            else
            {
                echo "NO Data Exist";
            }
        }
        else
        {
            echo "Cannot connect to server".$result;
        }
        
        
        
        
        
        ?>


    </div>
    
    
    
    
    





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>