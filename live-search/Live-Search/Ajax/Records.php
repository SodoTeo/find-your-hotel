<?php



include('../../../admin/include/db_config.php');


require_once '../Config/Functions.php';
$Fun_call = New Functions();

$json_data = array();

$view_rec = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['search_keyword']) && !empty(trim($_POST['search_keyword']))){
        $search_key = $Fun_call->validate($_POST['search_keyword']);
        $search_key = strtolower($search_key);

        $search_key = preg_replace('/\h+/', ' ', $search_key);

        if(strlen($search_key) <= 100){

            if(preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/', $search_key)){

                $match_fields['h_name'] = $search_key;
                $match_fields['prefecture'] = $search_key;
                $view_rec = $Fun_call->search('hotels', $match_fields, 'OR');
                
            }
            else{
    
                $json_data['status'] = 101;
                $json_data['msg'] = 'Only Number and Alphabet Allow';
    
            }

        }
        else{

            $json_data['status'] = 102;
            $json_data['msg'] = 'Search Invalid Length';

        }

    }
    else{
        
        $json_data['status'] = 103;
        $json_data['msg'] = 'Invalid Request Not Allow';

    }

}
elseif($_SERVER['REQUEST_METHOD'] == 'GET'){

    $view_rec = $Fun_call->select_order('hotels', 'id');


}
else{

    $json_data['status'] = 104;
    $json_data['msg'] = 'Invalid Method Not Allow';

}

echo json_encode($json_data);

?>


<?php $i = 1; if($view_rec){ foreach($view_rec as $view_data) {


     $stmt = $connect->prepare('SELECT legend, userPic FROM images WHERE userID=:uids  LIMIT 1 ');
                            $stmt->bindParam(':uids',$view_data['id']);
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
                                                    <h4 class='post'><?php echo $view_data['h_name']?></h4><hr>
                                                    <div class='splitscreen'>
                                                        <div class='left'>
                                                            <img  src='image-php-form/user_images/<?php echo $img_row['userPic']?>' class='img-rounded' id='Myimg<?php echo $view_data['id']?>' width='60%' />
                                                        </div>  
                                                        <div class='right'>
                                                            <br>
                                                            <textarea  rows='5' style='overflow:auto; width:100%;'>
<?php echo $view_data['facility']?>
                                                            </textarea>
                                                            <br>
                                                            <div class='stats'>
                                                                <div>
                                                                    <div class='title'>Address</div>
                                                                    <i class='fas fa-road'></i>
                                                                    <div class='value'><?php echo $view_data['address']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Contact</div>
                                                                    <i class='fas fa-phone'></i>
                                                                    <div class='value'>"<?php echo $view_data['phone']?>0</div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Rooms</div>
                                                                    <i class='fas fa-cubes'></i>
                                                                    <div class='value'><?php echo $view_data['room_qnty']?>0</div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Beds</div>
                                                                    <i class='fas fa-bed'></i>
                                                                    <div class='value'><?php echo $view_data['no_bed'],$view_data['bedtype']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Stars</div>
                                                                    <i class='fas fa-star'></i>
                                                                    <div class='value'><?php echo $view_data['rating']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Prefecture</div>
                                                                    <i class='fas fa-map-marker-alt'></i>
                                                                    <div class='value'><?php echo $view_data['prefecture']?></div>
                                                                </div>
                                                                <div>
                                                                    <div class='title'>Price</div>
                                                                    <i class='fas fa-euro-sign'></i>
                                                                    <div class='value'><?php echo $view_data['price']?>/Night</div>
                                                                </div>
                                                            </div> 
                                                            <button style="float:right" id="closeS" onclick="myClose()" type="button" class="btn btn-danger">Close</button> 
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="modal fade" id="Mymodal<?php echo $view_data['id']?>">
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
                                                                <div  class="gallery gallery<?php echo $view_data['id']?> " >
                                                                    <?php 
                                                                    include('../../../admin/include/db_config.php');
                                                                        $stmtimg = $connect->prepare('SELECT legend, userPic FROM images WHERE userID=:uids ');
                                                                        $stmtimg->bindParam(':uids',$view_data['id']);
                                                                        $stmtimg->execute();
                                                                        if($stmtimg->rowCount() > 0)
                                                                            {
                                                                                while($img_row=$stmtimg->fetch())
                                                                                {
                                                                                    extract($img_row);
                                                                                    $imageThumbURL = 'image-php-form/user_images/'.$img_row["userPic"];
                                                                                    $imageURL = 'image-php-form/user_images/'.$img_row["userPic"];
                                                                                    ?>
                                                                                    <a href="<?php echo $imageURL; ?>" data-fancybox="gallery<?php echo $view_data['id']?>" data-caption="<?php echo $img_row["legend"]; ?>" >
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
                                            $('#Myimg<?php echo $view_data['id']?>').click(function(){
                                                $('#Mymodal<?php echo $view_data['id']?>').modal('show')
                                            });
                                        });

                                        $(document).ready(function(){

                                        // Intialize gallery
                                        var gallery = $('.gallery<?php echo $view_data['id']?> a').simpleLightbox();

                                        });
                                        </script>
                                            
                                        
                                    
                                      <?php
                                }
                            }
                            

 }}else{ echo "<tr><td colspan='6'><h2>Record Not Found</h2></td></tr>"; } ?>

