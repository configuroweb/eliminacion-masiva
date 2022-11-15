<?php
require_once('db-connect.php');

function get_posts(){
    global $conn;

    $sql = "SELECT * FROM `posts` order by abs(unix_timestamp(`created_at`)) desc";
    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}

