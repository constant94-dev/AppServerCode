<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $userName = $_POST['userName'];
    
    // 클라이언트에서 보낸 POST 값이 있다면 실행
    if (empty($userEmail) || empty($userPassword) || empty($userName)) {
        echo "POST값없음";
    } else {
        // 데이터베이스에 계정을 삽입하기 위한 SQL
        $signUpSQL = "INSERT INTO accommodation_join(email,password,name,create_time,update_time) VALUES('$userEmail','$userPassword','$userName',now(),now())";
    
        if(mysqli_query($con, $signUpSQL)){
            echo "계정생성";
        } else {
            echo "계정생성실패";
        }
    }

}


?>