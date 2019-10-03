<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 GET 일 때
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

$chatSearchEmail = $_GET['email'];

$chatSearchSQL = "SELECT * FROM accommodation_profile WHERE profile_email = '$chatSearchEmail'";

$result = mysqli_query($con, $chatSearchSQL);

// 쿼리 결과가 0 보다 클때 조건 시작
if (mysqli_num_rows($result) > 0) {
    //echo "good";
    $profileData = "";
    // 반복문 시작
    while ($row = mysqli_fetch_assoc($result)) {
        $profileData = $row['profile_name']." ".$row['profile_image']." ".$row['profile_email'];
        //echo $profileData;
    }
    
    echo $profileData;
    
} else {
    echo "유저없음";
}



}
?>