<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $placeNum = $_GET['placeNum'];

    $reviewDeleteSQL = "DELETE FROM accommodation_review WHERE place_num ='$placeNum'";

    if (mysqli_query($con, $reviewDeleteSQL)) {
        echo "리뷰삭제성공";
    } else {
        echo "리뷰삭제실패";
    }
}

?>