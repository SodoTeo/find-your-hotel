<?php
include_once 'include/class.user.php'; 
$user=new User(); 

$room_cat=$_GET['roomname'];


$query=$user->db->query("SELECT * FROM hotels WHERE roomname='$room_cat'");
$row = $query->fetch();
 

if(isset($_REQUEST[ 'submit'])) 
{ 
    extract($_REQUEST); 
    $result=$user->edit_room_cat($roomname, $room_qnty, $no_bed, $bedtype,$facility,$price,$room_cat);
    if($result)
    {
        echo "<script type='text/javascript'>
              alert('".$result."');
         </script>";
    }

   
} 
?>

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
            <h4>Edit your Record</h4>
                <div class="toggle" style="float:right;">
                    <input type="checkbox" class="checkbox" id="chk" />
                        <label class="label" for="chk">
                                <i class="fa fa-moon-o" aria-hidden="true"></i>
                                <i class="fa fa-cog "></i>
                                <div class="ball"></div>
                        </label>                          
                </div>
            <hr>
            <form action="" method="post" name="hotels">
                <div class="form-group">
                    <h6><label for="roomname">Hotel Name:</label></h6>
                    <input type="text" class="form-control" name="roomname" value="<?php echo $row['roomname'] ?>" required>
                </div>
                 <div class="form-group">
                    <h6><label for="qty">No of Rooms:</label>&nbsp;</h6>
                    <select name="room_qnty">
                    <option value="<?php echo $row['room_qnty'] ?>"><?php echo $row['room_qnty'] ?></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                       <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                </div>
                <div class="form-group">
                    <h6><label for="bed">No of Bed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                    <select name="no_bed">
                     <option value="<?php echo $row['no_bed'] ?>"><?php echo $row['no_bed'] ?></option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                    </select>
                </div>
                <div class="form-group">
                    <h6><label for="bedtype">Bed Type:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                   <select name="bedtype">
                     <option value="<?php echo $row['bedtype'] ?>"><?php echo $row['bedtype'] ?></option>
                      <option value="single">single</option>
                      <option value="double">double</option>
                    </select>
                </div>
                <!--
                PHP image form
                -->
                <div class="form-group">
                    <h6><label for="Facility">Description</label></h6>
                    <textarea class="form-control" rows="5" name="facility"><?php echo $row['facility'] ?></textarea>
                </div>
               <div class="form-group">
                    <h6><label for="price">Price Per Night:</label></h6>
                    <input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" required>
                </div>
                <button style="float: right;" type="submit" class="btn btn-lg btn-primary button" name="submit">Update</button>

               
                <div id="click_here" >
                        <button  type="button" onclick="location.href='../admin.php'" class="btn btn-lg btn-success button">Back to Admin Panel</button>
                </div>


            </form>
            
        </div>
    </div>

</body>

</html>