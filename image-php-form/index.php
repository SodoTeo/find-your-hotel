<?php
require_once 'dbconfig.php';
if(isset($_GET['delete_id']))
 {
  // select image from db to delete
  $stmt_select = $DB_con->prepare('SELECT userPic FROM images WHERE userID =:uid');
  $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
  $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
  unlink("user_images/".$imgRow['userPic']);
  
  // it will delete an actual record from db
  $stmt_delete = $DB_con->prepare('DELETE FROM images WHERE userID =:uid');
  $stmt_delete->bindParam(':uid',$_GET['delete_id']);
  $stmt_delete->execute();
  
  header("Location: index.php");
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
    <div class="row">
    <?php
    
    $stmt = $DB_con->prepare('SELECT userID, userName, userProfession, userPic FROM images ORDER BY userID DESC');
    $stmt->execute();
    
    if($stmt->rowCount() > 0)
    {
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
    extract($row);
    ?>
    <div class="col-xs-3">
        <p class="page-header"><?php echo $userName."&nbsp;/&nbsp;".$userProfession; ?></p>
        <img src="user_images/<?php echo $row['userPic']; ?>" class="img-rounded" width="250px" height="250px" />
        <p class="page-header">
        <span>
        <a class="btn" href="editform.php?edit_id=<?php echo $row['userID']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
        <a class="btn" href="?delete_id=<?php echo $row['userID']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
        </span>
        </p>
    </div>       
    <?php
    }
    }
    else
    {
    ?>
            <div class="col-xs-12">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
                </div>
            </div>
            <?php
    }
    
    ?>
    </div>

    
</body>
</html>