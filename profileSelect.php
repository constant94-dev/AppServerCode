<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

$profileEmail = $_GET['profileEmail'];

//echo $profileEmail;

$profileSelectSQL = "SELECT * FROM accommodation_profile WHERE profile_email = '$profileEmail'";

$result = mysqli_query($con, $profileSelectSQL);

// 쿼리 결과가 0 보다 클때 조건 시작
if (mysqli_num_rows($result) > 0) {
    //echo "good";
    $profileData = "";
    // 반복문 시작
    while ($row = mysqli_fetch_assoc($result)) {
        $profileData = $row['profile_name']." ".$row['profile_image'];
        //echo $profileData;
    }
    
    echo $profileData;
    
}
?>