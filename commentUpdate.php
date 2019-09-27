<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $commentNum = $_GET['commentNum'];    
    $commentData = $_GET['commentData'];

    $reviewUpdateSQL = "UPDATE accommodation_comment SET comment = '$commentData', update_time = now() WHERE comment_num = '$commentNum'";
    //$result = mysqli_query($con, $reviewUpdateSQL);

    if (mysqli_query($con, $reviewUpdateSQL)) {
        echo "댓글수정성공";
    } else {
        echo "댓글수정실패";
    }

}

?>