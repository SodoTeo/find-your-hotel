<html>
<head>
    <title>Pagination</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
                                {extract($img_row);

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
                    echo "Cannot connect to server".$res_data;
                } 
                
            

    ?>
    <ul class="pagination">
        <li><a href="?page=1">First</a></li>
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
        </li>
        <li><a href="?page=<?php echo $total_pages; ?>">Last</a></li>
    </ul>
</body>
</html>