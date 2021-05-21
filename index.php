<?php
    //home.php
    session_start();
    include('admin/include/db_config.php');

    $user_name = '';
    $user_id = '';

    if(isset($_SESSION["user_name"], $_SESSION["user_id"]))
    {
        $user_name = $_SESSION["user_name"];
        $user_id = $_SESSION["user_id"];
    }

    

    require_once 'live-search/Live-Search/Config/Functions.php';
    $Fun_call = New Functions();



?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>InfoHotel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300&display=swap');
        .well
        {
            background: rgba(0,0,0,0.7);
            border: none;
            width: 98%;
            height: 48vh;
            left: 1%;
            display: inline-table;
    
        }
        .splitscreen {
            display:flex;
        }
        .splitscreen .left {
            flex: 1;
        }
        .splitscreen .right {
            flex: 1;
        }
        .wellfix{
            background: rgba(0,0,0,0.7);
            border: none;
            height: 150px;
        }
		p{
			font-size: 13px;
		}
        .pro_pic{
            border-radius: 50%;
            height: 50px;
            width: 50px;
            margin-bottom: 15px;
            margin-right: 15px;
        }
        h4{
            color: #ff964f;
            
        }
        h6{
              font-size: 150%;
              color: #ff964f;
              font-family: 'Crimson Pro', serif;
        }
        .container{
            width: 100%;
            height: 100%;
        }
        .alert-warning {
            width: 30%;
        }
    </style>
    <link rel="stylesheet" href="css/searchbar.css">
    <link rel="stylesheet" href="css/toggle.css">

    </head>
    <body >
        <div class="container">    
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="admin.php">Admin</a></li>
                        

                    <li>
                        <form method="post" autocomplete="off">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-lg-10 mb-0">
                            <div class="searchbar">
                                <input type="text" onmouseover="myFunction()" id="search_key" class="form-control" placeholder="Search Now" maxlength="100">
                            <div>
                            </div>
                        </div>
                        </form>
                        </li>
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
            <span id="search_msg" class="ser-msg"></span>

            

        


        
            <div id="record_load" style="display: none;">

            </div>
            <script type="text/javascript">
                    function myFunction() {
                    var x = document.getElementById("record_load");
                    if (x.style.display === "none") {

                        x.style.display = "block";
                    } 
                    }
                    function myClose() {
                    var x = document.getElementById("record_load");
                    
                        x.style.display = "none";

                    }


                    $(document).ready(function (){

                        $('#record_load').load('live-search/Live-Search/Ajax/Records.php');

                        $('#search_key').keyup(function (){

                            $search_data = $(this).val().trim();

                            if($search_data != '' && $search_data.match(/^[a-zA-Z0-9 ]*$/)){

                                $('#search_msg').text('');
                                $('#record_load').load('live-search/Live-Search/Ajax/Records.php', { 'search_keyword' : encodeURIComponent($search_data) });
                            
                            }
                            else{

                                $('#record_load').load('live-search/Live-Search/Ajax/Records.php');
                                if(!$search_data.match(/^[a-zA-Z]*$/)){
                                    $('#search_msg').text('Only Alphabet & Numbers Are Allow');
                                }
                                if($search_data == ''){
                                    $('#search_msg').text('');
                                }
                            }

                        });

                    });
                </script>




            <?php

                $result = $connect->query('SELECT * FROM hotels');
                if($result)
                {   
                    if(($result-> rowCount()) > 0 )
                    {
                        while (($row = $result->fetch()))
                        {
                            $stmt = $connect->prepare('SELECT legend, userPic FROM images WHERE userID=:uids  LIMIT 1 ');
                            $stmt->bindParam(':uids',$row['id']);
                            $stmt->execute();
                            if($stmt->rowCount() > 0)
                            {
                                while($img_row=$stmt->fetch())
                                {
                                    extract($img_row);

                                    echo "
                                            <div class='row'>
                                            <div class='col-md-3'></div>
                                            <div class='col-md-6 well'>
                                                <h4 class='post'>".$row['h_name']."</h4><hr>
                                                <div class='splitscreen'>
                                                <div class='left'>
                                                <img  src='image-php-form/user_images/".$img_row['userPic']."' class='img-rounded' width='60%' />
                                                </div>  
                                                <div class='right'>
                                                    <h6>No of Rooms: ".$row['room_qnty']."0 </h6>
                                                    <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed</h6>
                                                    <h6>Address: ".$row['address']." </h6>
                                                    <h6>Prefecture: ".$row['prefecture']." </h6>
                                                    <h6>Contact: ".$row['phone']." </h6>
                                                    <h6>Rating (stars): ".$row['rating']." </h6>
                                                    <h6>Description: ".$row['facility']."</h6><br>
                                                    <h6>Price: ".$row['price']." &euro;/night.</h6>
                                                    
                                                </div>  

                                            </div>  
                                            </div>
                                            </div>
                                            
                                            
                                        
                                    
                                        "; //echo end
                                
                                }
                            }
                            else
                            {
                                echo "
                                        <div class='row'>
                                        <div class='col-md-3'></div>
                                        <div class='col-md-6 well'>
                                            <h4 class='post'>".$row['h_name']."</h4><hr>
                                            <div class='splitscreen'>
                                            <div class='left'>
                                            <div class='alert alert-warning'>
                                                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; No Image Found ...
                                                    </div>
                                            </div>  
                                            <div class='right'>
                                                <h6>No of Rooms: ".$row['room_qnty']."0 </h6>
                                                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed</h6>
                                                <h6>Address: ".$row['address']." </h6>
                                                <h6>Prefecture: ".$row['prefecture']." </h6>
                                                <h6>Contact: ".$row['phone']." </h6>
                                                <h6>Rating (stars): ".$row['rating']." </h6>
                                                <h6>Description: ".$row['facility']."</h6><br>
                                                <h6>Price: ".$row['price']." &euro;/night.</h6>
                                                
                                            </div>  

                                        </div>  
                                        </div>
                                        </div>
                                        
                                        
                                    
                                
                                    ";
                            }
                               
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/toggle.js" defer></script>





    </body>
</html>