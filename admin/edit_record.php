<?php
    require_once 'include/db_config.php';
    $room_cat=$_GET['h_name'];

    session_start();

    $id=$_SESSION[ 'user_id']; 
    $iduser=$_SESSION[ 'user_id'];
    $user_id=$_SESSION[ 'user_id'];

    if(!isset($_SESSION["user_id"]))
    {
        header("location:admin/login.php");
    }

    $query=$connect->query("SELECT * FROM hotels WHERE h_name='$room_cat'");
    $row = $query->fetch();

    error_reporting( ~E_NOTICE ); // avoid notice

    if(isset($_REQUEST[ 'submit'])) 
    { 
        extract($_REQUEST); 
        $send=$connect->prepare("UPDATE hotels  SET  room_qnty='$room_qnty', no_bed='$no_bed', bedtype='$bedtype',  price='$price', facility='$facility', price='$price', rating='$rating', phone='$phone', address='$address', prefecture='$prefecture' WHERE h_name='$h_name'");
        $send->execute() or die(print_r($send->errorInfo()."Data cannot be updated", true));
        if($send)
        {
            $result="Updated Successfully!!";
            echo "<script type='text/javascript'>
                alert('".$result."');
            </script>";
        }
        else
        {
            $result="Sorry, Internel Error";
            echo "<script type='text/javascript'>
                alert('".$result."');
            </script>";
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
                <form action="" method="post" enctype="multipart/form-data" name="hotels">
                    <div class="form-group">
                        <h6><label for="h_name">Hotel Name:</label></h6>
                        <input type="text" class="form-control" name="h_name" value="<?php echo $row['h_name'] ?>" disabled required>
                    </div>
                    <div class='splitscreen'>
                        <div class='left'>
                            <div class="form-group">
                                <h6><label for="qty">No of Rooms:</label>&nbsp;</h6>
                                <select name="room_qnty">
                                <option value="<?php echo $row['room_qnty'] ?>"><?php echo $row['room_qnty'] ?></option>
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
                            <div class="form-group">
                                <h6><label for="rating">Rating(stars):</label>&nbsp;</h6>
                                <select name="rating">
                                <option value="<?php echo $row['rating'] ?>"><?php echo $row['rating'] ?></option>
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
                                <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>"required>
                            </div>
                            <div class="form-group">
                                <h6><label for="price">Price Per Night:</label></h6>
                                <input type="text" class="form-control" name="price" value="<?php echo $row['price'] ?>" required>
                            </div>
                            <div class="form-group">
                                <h6><label for="address">Address:</label></h6>
                                <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" required>
                            </div>
                            <div class="form-group">
                                <h6><label for="prefecture">Prefecture:</label>&nbsp;</h6>
                                <select name="prefecture">
                                <option value="<?php echo $row['prefecture'] ?>"><?php echo $row['prefecture'] ?></option>
                                <option value="Νομός Αθηνών">Νομός Αθηνών</option>
                                <option value="Νομός Ανατολικής Αττικής">Νομός Ανατολικής Αττικής</option>
                                <option value="Νομός Δυτικής Αττικής">Νομός Δυτικής Αττικής</option>
                                <option value="Νομός Πειραιά">Πειραιάς</option>
                                <option value="Νομός Θεσσαλονίκης">Νομός Θεσσαλονίκης</option>
                                <option value="Νομός Χανίων">Νομός Χανίων</option>
                                <option value="Νομός Ηρακλείου">Νομός Ηρακλείου</option>
                                <option value="Νομός Ζακύνθου">Νομός Ζακύνθου</option>
                                <option value="Νομός Λάρισας">Νομός Λάρισας</option>
                                <option value="Νομός Φλώρινας">Νομός Φλώρινας</option>
                                </select>
                            </div>
                        </div>
                        <div class='right'>
                            <div class="form-group">
                                <h6><label for="Facility">Description</label></h6>
                                <textarea class="form-control" rows="5" name="facility"><?php echo $row['facility'] ?></textarea>
                            </div>
                        
                            <div class="form-group">
                                <h6><label for="legend">Legend:</label></h6>
                                <input class="form-control" type="text" name="legend" placeholder="Your Profession" value="<?php echo "Here goes yours image legend"; ?>" />
                            </div>
                            <div class="form-group">
                                <h6><label for="user_image">Profile Img.</label></h6>
                                <input class="input-group" type="file" name="user_image" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <button style="float: right;" type="submit" class="btn btn-lg btn-primary button" name="submit">Update</button>

                    <div id="click_here" >
                            <button  type="button" onclick="location.href='../admin.php'"  class="btn btn-lg btn-success button">Back to Admin Panel</button>
                    </div>
                </form>
                
            </div>
        </div>
    </body>
</html>