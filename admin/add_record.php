<?php
require_once 'include/db_config.php';
session_start();

$id=$_SESSION[ 'user_id']; 
$iduser=$_SESSION[ 'user_id'];


if(!isset($_SESSION["user_id"]))
{
	header("location:admin/login.php");
}




$user_name = '';
$user_id = '';

if(isset($_SESSION["user_name"], $_SESSION["user_id"]))
{
	$user_name = $_SESSION["user_name"];
	$user_id = $_SESSION["user_id"];
}

if(isset($_REQUEST[ 'submit'])) 

{ 
    extract($_REQUEST); 

    $result=$connect->prepare("INSERT INTO hotels SET h_name='$h_name', room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype', facility='$facility', price='$price', id='$user_id', rating='$rating', phone='$phone', address='$address', prefecture='$prefecture'");
    $result->execute() or die(print_r($result->errorInfo()."Data cannot inserted", true));

    if($result)
    {
        echo "<script type='text/javascript'>
              alert('Entry Added Succesfully');
              
         </script>";
    }
    else
    {
         echo $result;
    }
} 


//---------------------------IMG--------------------------------//

 error_reporting( ~E_NOTICE ); // avoid notice
 
 
 if(isset($_POST['submit']))
 {
  
  $legend = $_POST['legend'];// user email
  
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
  
  
   if(empty($legend)){
   $errMSG = "Please Enter Your Job Work.";
  }
  else if(empty($imgFile)){
   $errMSG = "Please Select Image File.";
  }
  else
  {
   $upload_dir = '../image-php-form/user_images/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '300kb'
    if($imgSize < 350000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large. Check file size to be 300KB.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $connect->prepare('INSERT INTO images(userID,legend,userPic) VALUES( :uids,:ujob, :upic)');
   $stmt->bindParam(':uids',$user_id);
   $stmt->bindParam(':ujob',$legend);
   $stmt->bindParam(':upic',$userpic);
   
   if($stmt->execute())
   {
    $successMSG = "new record succesfully inserted ...";
    header("refresh:2;../admin.php"); // redirects image view page after 2 seconds.
   }
   else
   {
    $errMSG = "error while inserting....";
   }
  }
 }
?>

<!-- ---------------------------/IMG-------------------------------- -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/toggle.css">
    <script src="../js/toggle.js" defer></script>
    <style>
        .well
        {
            background: rgba(0,0,0,0.7);
            border: none;
            width: 98%;
        }
        .splitscreen {
            display:flex;
        }
        .splitscreen .left {
            padding: 10px;
            
            flex: 1;
        }
        .splitscreen .centre {
            padding: 10px;
            flex: 1;
        }
        .splitscreen .right {
            padding: 10px;
            flex: 1;
        }
		p
		{
			font-size: 13px;
		}
        .pro_pic
        {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            margin-bottom: 15px;
            margin-right: 15px;
        }
        h4 {
              font-size: 180%;
              color: #ffbb2b;
          }
          h6
          {
              font-size: 110%;
              color: navajowhite;
              font-family:  monospace;
          }
    </style>
</head>

<body>
    <div class="container">
        <div class="well">
            <h4>Add Business</h4>
                <div class="toggle" style="float:right;">
                    <input type="checkbox" class="checkbox" id="chk" />
                        <label class="label" for="chk">
                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                                <i class="fa fa-cog "></i>
                                <div class="ball"></div>
                        </label>                          
                </div>
            <hr>
            <form action="" method="post" enctype="multipart/form-data" name="hotels">
                <div class="form-group">
                    <h6><label for="h_name">Hotel Name:</label></h6>
                    <input type="text" class="form-control" name="h_name" placeholder="super delux" required>
                </div>
                <div class='splitscreen'>
                    <div class='left'>
                        <div class="form-group">
                            <h6><label for="qty">No of Rooms:</label>&nbsp;</h6>
                            <select name="room_qnty">
                            <option value="1">10</option>
                            <option value="2">20</option>
                            <option value="3">30</option>
                            <option value="4">40</option>
                            <option value="5">50</option>
                            <option value="6">60</option>
                            <option value="7">70</option>
                            <option value="8">80</option>
                            <option value="9">90</option>
                            <option value="10">100</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label for="bed">No of Bed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                            <select name="no_bed">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label for="bedtype">Bed Type:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                        <select name="bedtype">
                            <option value="single">single</option>
                            <option value="double">double</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6><label for="rating">Rating(stars):</label>&nbsp;</h6>
                            <select name="rating">
                            <option value="1">*</option>
                            <option value="2">**</option>
                            <option value="3">***</option>
                            <option value="4">****</option>
                            <option value="5">*****</option>
                            </select>
                        </div>

                    </div>
                    <div class='centre'>
                        <div class="form-group">
                            <h6><label for="phone">Phone:</label></h6>
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                        <div class="form-group">
                            <h6><label for="price">Price Per Night:</label></h6>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <h6><label for="address">Address:</label></h6>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group">
                            <h6><label for="prefecture">Prefecture:</label>&nbsp;</h6>
                            <select name="prefecture">
                            <option value="Athens">Athens</option>
                            <option value="Pireas">Pireas</option>
                            <option value="Thessaloniki">Thessaloniki</option>
                            <option value="Chania">Chania</option>
                            <option value="Heraklion">Heraklion</option>
                            <option value="Zakynthos">Zakynthos</option>
                            <option value="Larisa">Larisa</option>
                            <option value="Florina">Florina</option>
                            </select>
                        </div>
                    </div>

                    <div class='right'>
                        <div class="form-group">
                            <h6><label for="Facility">Description</label></h6>
                            <textarea class="form-control" rows="5" name="facility"></textarea>
                        </div>
                        <div class="form-group">
                            <h6><label for="legend">Legend for image:</label></h6>
                            <input class="form-control" type="text" name="legend" placeholder="Your Profession" value="<?php echo "Here goes yours image legend"; ?>" />
                        </div>
                        <div class="form-group">
                            <h6><label for="user_image">Profile Img.</label></h6>
                            <input class="input-group" type="file" name="user_image" accept="image/*" />
                        </div>
                    </div>
                </div>
        
                <button style="float:right; top: 80%; right: 15%;" type="submit" class="btn btn-lg btn-primary button" name="submit"  value="Add Room">Add</button>
                <div id="click_here" >
                        <button style="top: 80%; left: 15%;" type="button" onclick="location.href='../admin.php'" class="btn btn-lg btn-success button">Back to Admin Panel</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>