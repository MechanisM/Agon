<?php
    if($_GET['id']) {
        if($redis->exists("slight.post." . $_GET['id'])) {
            // Delete Slugs
            $slug = $redis->lindex("slight.post." . $_GET['id'], 2);
            $redis->del("slight.slug." . $slug);
            $redis->del("slight.slug." . $_GET['id']);

            //Delete Hash
            $redis->del("slight.post." . $_GET['id']);  
            header("Location: ?m=del_ok");            
        } else if($redis->exists("slight.page." . $_GET['id'])) {
            $slug = $redis->lindex("slight.page." . $_GET['id'], 1);
            $redis->del("slight.page." . $slug);
            echo "Hello 123";
        } else {
            header("Location: ?m=page_not_found"); 
        }  
    }
?>
