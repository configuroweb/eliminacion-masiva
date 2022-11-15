<?php
require_once('db-connect.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ids = isset($_POST['ids']) ? $_POST['ids'] : [];
    if(count($ids) > 0){
        $sql = "DELETE FROM `posts` where `id` IN (".(implode(",", $ids)).")";
        $delete = $conn->query($sql);
        if($delete){
            $resp['status'] = 'success';
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $conn->error;
        }
    }else{
        $resp['status'] = 'failed';
        $resp['error'] = 'No Post ID(s) Data sent to delete.';
    }
}else{
    $resp['status'] = 'failed';
    $resp['error'] = 'No Post Data sent to this current request.';
}

echo json_encode($resp);

$conn->close();