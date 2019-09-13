<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userEmail = $_POST['userEmail'];

    // 클라이언트에서 보낸 POST 값이 있다면 실행
    if (!empty($userEmail)) {
        // 데이터베이스에 계정이 존재하는지 검색하기 위한 SQL
        $checkEmailSQL = "SELECT * FROM accommodation_join WHERE email='$userEmail'";
        $result = mysqli_query($con, $checkEmailSQL);
        
            // SQL 값이 존재여부 조건 시작                   
            if (mysqli_num_rows($result) > 0) {
                echo "계정존재";
            } else {
                echo "계정없음";
            } // 존재여부 조건 끝
       
    } else {
        echo "POST값없음";
    }
    
    
}

?>