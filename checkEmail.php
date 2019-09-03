<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userEmail = $_POST['userEmail'];

    // 클라이언트에서 보낸 POST 값이 있다면 실행
    if (!empty($userEmail)) {
        // 데이터베이스에 계정이 존재하는지 검색하기 위한 SQL
        $checkEmailSQL = "SELECT * FROM accommodation_join";
        $result = mysqli_query($con, $checkEmailSQL);
        // SQL 값이 존재하지 않을 때
        if(mysqli_fetch_assoc($result) == 0){
            echo "SQL값없음";
        } else {
            while($row = mysqli_fetch_assoc($result)) {
                if ($row['email'] == $userEmail) {
                    echo "계정존재";
                } else {
                    echo "계정없음";
                }
            } // 반복문 끝    
        }       
    } else {
        echo "POST값없음";
    }
    
    
}

?>