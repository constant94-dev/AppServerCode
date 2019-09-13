<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 시작
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$placeName = $_POST['placeName'];
$placeTime = $_POST['placeTime'];
$placeScore = $_POST['placeScore'];
$placeImage = $_POST['placeImage'];
$writer = $_POST['writer'];

//echo $placeName." ".$placeTime." ".$placeScore." ".$placeImage." ".$writer." ";

// 클라이언트에서 서버로 POST 데이터 전달됬는지 확인하는 조건 시작
//if (isset($placeName) && isset($placeTime) && isset($placeScore) && isset($placeImage) && isset($writer)) {

// 데이터베이스에 리뷰를 삽입하기 위한 SQL
$reviewAddSQL = "INSERT INTO accommodation_review(place_name, place_time, place_score, place_image, create_time, update_time, writer) VALUES('$placeName','$placeTime','$placeScore','$placeImage',now(),now(),'$writer')";
// 추가한 리뷰 마지막 넘버 가져오기 위한 SQL
$reviewMaxNumSQL = "SELECT MAX(place_num) AS max_number FROM accommodation_review";

// 데이터베이스에 리뷰 정보 insert 성공할 때 조건 시작
if (mysqli_query($con, $reviewAddSQL)) {    
    // 데이터베이스에 저장된 리뷰 정보 마지막 번호
    $maxResult = mysqli_query($con, $reviewMaxNumSQL);
    // 추가한 리뷰 번호 가져오기
    $row = mysqli_fetch_array($maxResult);

    echo $row['max_number'];

} else {
    echo "리뷰등록실패!";
} // 데이터베이스에 리뷰 정보 insert 성공할 때 조건 끝


} // 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 끝 

?>