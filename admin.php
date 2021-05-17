<?php
session_start();

$id=$_SESSION[ 'user_id']; 
$iduser=$_SESSION[ 'user_id'];

if(!isset($_SESSION["user_id"]))
{
	header("location:admin/login.php");
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
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Admin Panel</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery.js"></script>
        <link rel="stylesheet" href="css/toggle.css">
        

        <style>
            .well {
                background: rgba(0, 0, 0, 0.7);
                border: none;
                height: 200px;
                display: inline-table;
            }
            
            
            h4 {
                color: #ffbb2b;
            }
            
            ul {
                color: white;
                font-size: 13px;
            }
            .container{
                width: 100%;
                height: 100%;
            }

        </style>
        


    </head>

    <body >
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="admin.php">Admin</a></li>
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
                        <li>
                        <li >
                            <a href="otp-php-registration/logout.php">
                                <button  type="button" class="btn btn-danger">Logout</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6 well">
                    <h4>Admin Panel</h4>
                    <hr>
                    <ul>
                    <?php
                            $result = $connect->query("SELECT * FROM hotels WHERE id LIKE $iduser ");
                            if($result)
                            {   
                                if(($result-> rowCount()) > 0)
                                {
                                    while($row= $result->fetch(PDO::FETCH_ASSOC))
                                    {        
                                        echo "You already have created an record.";
                                    }       
                                }
                                else
                                {
                                    echo "<li><a href='admin/add_record.php'>Add your business</a></li>";
                                }
                            }
                            else
                            {
                                echo "Cannot connect to server".$result;
                            }
                            ?>
                        <li><a href="user-record.php">Edit your business</a></li>
                    </ul>
                </div>
                </div>
                
<!-- ---------------------------IMG-------------------------------- -->
            <?php
                require_once 'admin/include/db_config.php';
                if(isset($_GET['delete_id']))
                {
                // select image from db to delete
                $stmt_select = $connect->prepare('SELECT userPic FROM images WHERE userPic =:uid');
                $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
                $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
                unlink("image-php-form/user_images/".$imgRow['userPic']);
                
                // it will delete an actual record from db
                $stmt_delete = $connect->prepare('DELETE FROM images WHERE userPic =:uid');
                $stmt_delete->bindParam(':uid',$_GET['delete_id']);
                $stmt_delete->execute();
                
                header("Location: admin.php");
                }
                ?>


                    <?php
                    
                    $stmt = $connect->prepare('SELECT userID, legend, userPic FROM images ORDER BY userID DESC');
                    $stmt->execute();
                    
                    if($stmt->rowCount() > 0)
                    {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                    {
                    extract($row);
                    ?>

                <div class='row'>
                     <div class='col-md-3'></div>
                        <div class='col-md-6 well'>
                        <h4 ><?php echo "Legend: ".$legend; ?></h4>
                        <img src="image-php-form/user_images/<?php echo $row['userPic']; ?>" class="img-rounded" width="30%"  /> 
                        <a class="btn" style="color: #ffbb2b;" href="?delete_id=<?php echo $row['userPic']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>

                    </div>    
                    </div>   

                    <?php
                    }
                    }
                    else
                    {
                    ?>
                            <div class='row'>
                            <div class='col-md-3'></div>
                                <div class='col-md-6 well'>
                                    <div class="alert alert-warning">
                                        <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Image Found ...
                                        </div>
                                        </div>    
                                    </div> 

                    <?php
                    }
                    ?>

            </div> 
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/toggle.js" defer></script>
    </body>
</html>