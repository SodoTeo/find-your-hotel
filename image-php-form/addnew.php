<?php
 error_reporting( ~E_NOTICE ); // avoid notice
 require_once 'dbconfig.php';
 
 if(isset($_POST['btnsave']))
 {
  $username = $_POST['user_name'];// user name
  $userjob = $_POST['user_job'];// user email
  
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
  
  
  if(empty($username)){
   $errMSG = "Please Enter Username.";
  }
  else if(empty($userjob)){
   $errMSG = "Please Enter Your Job Work.";
  }
  else if(empty($imgFile)){
   $errMSG = "Please Select Image File.";
  }
  else
  {
   $upload_dir = 'user_images/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $DB_con->prepare('INSERT INTO images(userName,userProfession,userPic) VALUES(:uname, :ujob, :upic)');
   $stmt->bindParam(':uname',$username);
   $stmt->bindParam(':ujob',$userjob);
   $stmt->bindParam(':upic',$userpic);
   
   if($stmt->execute())
   {
    $successMSG = "new record succesfully inserted ...";
    header("refresh:2;index.php"); // redirects image view page after 5 seconds.
   }
   else
   {
    $errMSG = "error while inserting....";
   }
  }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
    <form method="post" enctype="multipart/form-data" class="form-horizontal">
     
     <table class="table table-bordered table-responsive">
     
        <tr>
         <td><label class="control-label">Username.</label></td>
            <td><input class="form-control" type="text" name="user_name" placeholder="Enter Username" value="<?php echo "name of the hotel in a variable"; ?>" /></td>
        </tr>
        
        <tr>
         <td><label class="control-label">Profession(Job).</label></td>
            <td><input class="form-control" type="text" name="user_job" placeholder="Your Profession" value="<?php echo "description of the name in a variable"; ?>" /></td>
        </tr>
        
        <tr>
         <td><label class="control-label">Profile Img.</label></td>
            <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
        </tr>
        
        <tr>
            <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
            <span class="glyphicon glyphicon-save"></span> &nbsp; save
            </button>
            </td>
        </tr>
        
        </table>
        
    </form>
    
</body>
</html>