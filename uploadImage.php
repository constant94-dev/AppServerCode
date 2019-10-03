<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

$target_dir = "images/";
$target_file_name = $_FILES['upload']['name'];
$target_file_error = $_FILES['upload']['error'];
$name = $_POST['name'];
$profileName = $_POST['profileName'];
$profileEmail = $_POST['profileEmail'];

if (isset($_FILES['upload']['name'])) {
    if(move_uploaded_file($_FILES['upload']['tmp_name'],$target_dir.$target_file_name)){
        // 데이터베이스에 리뷰를 삽입하기 위한 SQL
    $profileImage = $target_dir.$target_file_name;
    //echo $target_dir.$target_file_name." / 이름 : ".$profileName." / 이메일 : ".$profileEmail;
    // 데이터베이스에 프로필을 삽입하기 위한 SQL
    $profileAddSQL = "INSERT INTO accommodation_profile(profile_email, profile_name, profile_image) VALUES ('$profileEmail','$profileName','$profileImage')";
    if(mysqli_query($con, $profileAddSQL)){
        echo "프로필 등록성공";
    } else {
        echo "프로필 등록실패";
    }
        
    } else {
        echo "클라이언트에서 전달한 파일은 있지만 업로드 실패!";    
    }
} else {
    echo "클라이언트에서 전달한 파일 없음";
}


?>
