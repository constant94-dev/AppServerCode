<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $placeNum = $_GET['placeNum'];    
    $placeName = $_GET['placeName'];
    $placeImage = $_GET['placeImage'];
    $placeTime = $_GET['placeTime'];
    $placeScore = $_GET['placeScore'];
    $placeReview = $_GET['placeReview'];
    $writer = $_GET['writer'];


    $reviewUpdateSQL = "UPDATE accommodation_review SET place_name = '$placeName', place_image = '$placeImage', place_time = '$placeTime', place_score = '$placeScore', place_review = '$placeReview', update_time = now() WHERE place_num = '$placeNum'";
    //$result = mysqli_query($con, $reviewUpdateSQL);

    if (mysqli_query($con, $reviewUpdateSQL)) {
        echo "리뷰수정성공";
    } else {
        echo "리뷰수정실패";
    }

}

?>