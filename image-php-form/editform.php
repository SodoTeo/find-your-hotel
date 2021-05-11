<?php
 error_reporting( ~E_NOTICE );
 require_once 'dbconfig.php';
 
 if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
 {
  $id = $_GET['edit_id'];
  $stmt_edit = $DB_con->prepare('SELECT userName, userProfession, userPic FROM images WHERE userID =:uid');
  $stmt_edit->execute(array(':uid'=>$id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
 }
 else
 {
  header("Location: index.php");
 }
 
 if(isset($_POST['btn_save_updates']))
 {
  $username = $_POST['user_name'];// user name
  $userjob = $_POST['user_job'];// user email
   
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
     
  if($imgFile)
  {
   $upload_dir = 'user_images/'; // upload directory 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
   $userpic = rand(1000,1000000).".".$imgExt;
   if(in_array($imgExt, $valid_extensions))
   {   
    if($imgSize < 5000000)
    {
     unlink($upload_dir.$edit_row['userPic']);
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else
    {
     $errMSG = "Sorry, your file is too large it should be less then 5MB";
    }
   }
   else
   {
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   } 
  }
  else
  {
   // if no image selected the old image remain as it is.
   $userpic = $edit_row['userPic']; // old image from database
  } 
      
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $DB_con->prepare('UPDATE images
              SET userName=:uname, 
               userProfession=:ujob, 
               userPic=:upic 
               WHERE userID=:uid');
   $stmt->bindParam(':uname',$username);
   $stmt->bindParam(':ujob',$userjob);
   $stmt->bindParam(':upic',$userpic);
   $stmt->bindParam(':uid',$id);
    
   if($stmt->execute()){
    ?>
                <script>
    alert('Successfully Updated ...');
    window.location.href='index.php';
    </script>
                <?php
   }
   else{
    $errMSG = "Sorry Data Could Not Updated !";
   }
  }    
 }
?>