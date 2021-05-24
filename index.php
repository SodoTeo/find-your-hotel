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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>InfoHotel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style>
        @import url("https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800");
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
            flex: 1.5;
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
            font-family: 'Fira Sans', sans-serif;
            font-size: 170%;
            color: #fff;
            font-weight:lighter;
            
        }
        h6{
              font-size: 150%;
              color: #ff964f;
              font-family: 'Fira Sans', sans-serif;
        }
        .container{
            width: 100%;
            height: 100%;
        }
        .alert-warning {
            width: 30%;
        }
        .stats {
  font-size: 2rem;
  display: flex;
 
  bottom: 2rem;
  left: 2rem;
  right: 2rem;
  top: auto;
  color: #fff;
}

.stats {
  color: #fff;
}

 .stats > div {
  flex: 1;
  text-align: center;
}

 .stats i {
  display: block;
}

 .stats div.title {
  font-size: 0.75rem;
  font-weight: bold;
  text-transform: uppercase;
}

 .stats div.value {
  font-size: 1.5rem;
  font-weight: bold;
  line-height: 1.5rem;
}

 .stats div.value.infinity {
  font-size: 2.5rem;
}

html {
    font-family: 'Fira Sans', sans-serif;
  --scrollbarBG: #a9abac8f;
  --thumbBG: #2e3031;
}
textarea::-webkit-scrollbar {
  width: 11px;
}
textarea {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}
textarea::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
textarea::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}
 textarea{
  background-color: transparent;
  color: #fff;
  font-size: 17px;
  margin-bottom: 30px;
  line-height: 1.5em;
  text-align:justify;
  resize: none;
  outline: none;
  border-color: transparent;

  
}
.footer {
   
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: transparent;
   color: white;
   text-align: center;
}
.container{
            width: 100%;
           
        }
        .container .gallery a img {
        float: left;
        width: 20%;
        height: auto;
        border: 2px solid #fff;
        -webkit-transition: -webkit-transform .15s ease;
        -moz-transition: -moz-transform .15s ease;
        -o-transition: -o-transform .15s ease;
        -ms-transition: -ms-transform .15s ease;
        transition: transform .15s ease;
        position: relative;
        }

        .container .gallery a:hover img {
        -webkit-transform: scale(1.05);
        -moz-transform: scale(1.05);
        -o-transform: scale(1.05);
        -ms-transform: scale(1.05);
        transform: scale(1.05);
        z-index: 5;
        }

        .clear {
        clear: both;
        float: none;
        width: 100%;
        }

        .modal-content{
                background-color: #6d6e77e6;
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
    include('admin/include/db_config.php');

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page;



    

        

        $total_pages_sql = "SELECT COUNT(*) FROM hotels";
        $result = $connect->prepare($total_pages_sql);
        $result->execute();
        $total_rows = $result->fetchColumn();
      
        $total_pages = ceil($total_rows / $no_of_records_per_page);

     
        $sql = "SELECT * FROM hotels LIMIT $offset, $no_of_records_per_page";
        $res_data = $connect->prepare($sql);
        $res_data->execute();
                if($res_data)
                {   
                    if(($res_data-> rowCount()) > 0 )
                    {
                        while (($row =$res_data->fetch()))
                        {
                            $stmt = $connect->prepare('SELECT legend, userPic FROM images WHERE userID=:uids  LIMIT 1 ');
                            $stmt->bindParam(':uids',$row['id']);
                            $stmt->execute();
                            if($stmt->rowCount() > 0)
                            {
                                while($img_row=$stmt->fetch())
                                {
                                    extract($img_row);
                                    ?>
                                            <div class='row'>
                                                <div class='col-md-3'></div>
                                                <div class='col-md-6 well'>
                                                    <h4 class='post'><?php echo $row['h_name']?></h4><hr>
                                                    <div class='splitscreen'>
                                                        <div class='left'>
                                                            <img  src='image-php-form/user_images/<?php echo $img_row['userPic']?>' class='img-rounded' id='Myimg<?php echo $row['id']?>' width='60%' />
                                                        </div>  
                                                        <div class='right'>
                                                            <br>
                                                            <textarea  rows='5' style='overflow:auto; width:100%;'>
<?php echo $row['facility']?>
                                                            </textarea>
                                                            <br>
                                                            <div class='stats'>
                                                                <div>
                                                                    <div class='title'>Address</div>
                                                                    <i class='fas fa-road'></i>
                                                                    <div class='value'><?php echo $row['address']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Contact</div>
                                                                    <i class='fas fa-phone'></i>
                                                                    <div class='value'>"<?php echo $row['phone']?>0</div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Rooms</div>
                                                                    <i class='fas fa-cubes'></i>
                                                                    <div class='value'><?php echo $row['room_qnty']?>0</div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Beds</div>
                                                                    <i class='fas fa-bed'></i>
                                                                    <div class='value'><?php echo $row['no_bed'],$row['bedtype']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Stars</div>
                                                                    <i class='fas fa-star'></i>
                                                                    <div class='value'><?php echo $row['rating']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Prefecture</div>
                                                                    <i class='fas fa-map-marker-alt'></i>
                                                                    <div class='value'><?php echo $row['prefecture']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Price</div>
                                                                    <i class='fas fa-euro-sign'></i>
                                                                    <div class='value'><?php echo $row['price']?>/Night</div>
                                                                </div>
                                                            </div>  
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="modal fade" id="Mymodal<?php echo $row['id']?>">
                                                <div class="modal-dialog"  style="top:20%; width: 80%; height: 50%;">
                                                    <div class="modal-content" style="width: 100%; height: 100%;" >
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">×</button> 
                                                            <h4 class="modal-title">
                                                                Gallery
                                                            </h4>                                                             
                                                        </div> 
                                                        <div class="modal-body">
                                                            <div class='container'>
                                                                <div  class="gallery gallery<?php echo $row['id']?> " >
                                                                    <?php 
                                                                    include('admin/include/db_config.php');
                                                                        $stmtimg = $connect->prepare('SELECT legend, userPic FROM images WHERE userID=:uids ');
                                                                        $stmtimg->bindParam(':uids',$row['id']);
                                                                        $stmtimg->execute();
                                                                        if($stmtimg->rowCount() > 0)
                                                                            {
                                                                                while($img_row=$stmtimg->fetch())
                                                                                {
                                                                                    extract($img_row);
                                                                                    $imageThumbURL = 'image-php-form/user_images/'.$img_row["userPic"];
                                                                                    $imageURL = 'image-php-form/user_images/'.$img_row["userPic"];
                                                                                    ?>
                                                                                    <a href="<?php echo $imageURL; ?>" data-fancybox="gallery<?php echo $row['id']?>" data-caption="<?php echo $img_row["legend"]; ?>" >
                                                                                        <img src="<?php echo $imageThumbURL; ?>" alt="" />
                                                                                    </a>
                                                                                    <?php 
                                                                                }
                                                                            } ?>
                                                                </div>
                                                            </div>
                                                        </div>   
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
                                                        </div>
                                                    </div>                                                                       
                                                </div>                                      
                                            </div>
                                        <script>
                                            $(document).ready(function(){
                                            $('#Myimg<?php echo $row['id']?>').click(function(){
                                                $('#Mymodal<?php echo $row['id']?>').modal('show')
                                            });
                                        });

                                        $(document).ready(function(){

                                        // Intialize gallery
                                        var gallery = $('.gallery<?php echo $row['id']?> a').simpleLightbox();

                                        });
                                        </script>
                                            
                                        
                                    
                                      <?php
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
                    echo "Cannot connect to server".$res_data;
                } 
    ?>
        </div>
            <div class="footer">
                <div class="pagination">
                    <li><a href="?page=1">First</a></li>
                    <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
                        <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
                    </li>
                    <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                        <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
                    </li>
                    <li><a href="?page=<?php echo $total_pages; ?>">Last</a></li>
                </div>
            </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/toggle.js" defer></script>
        <link rel="stylesheet" href="node_modules/simple-lightbox/dist/simpleLightbox.min.css">
    <script src="node_modules/simple-lightbox/dist/simpleLightbox.min.js"></script>
    </body>
</html>