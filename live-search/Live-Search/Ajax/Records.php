<?php

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


<?php $i = 1; if($view_rec){ foreach($view_rec as $view_data){ ?>
    <tr class="v-set">
        <th scope="row"><?php echo $i; $i++; ?></th>
        <td><?php echo $view_data['h_name']; ?></td>
        <td><?php echo $view_data['room_qnty']; ?></td>
        <td><?php echo $view_data['address']; ?></td>
        <td><?php echo $view_data['phone']; ?></td>
        <td><?php echo $view_data['price']; ?></td>
    </tr>
<?php }}else{ echo "<tr><td colspan='6'><h2>Record Not Found</h2></td></tr>"; } ?>