<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 시작
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];

    // 클라이언트에서 서버로 보낸 데이터가 존재할 때 조건 시작
    if (!(empty($loginEmail) || empty($loginPassword))) {
        // 데이터베이스에 계정이 존재하는지 검색하기 위한 SQL
        $loginCheckSQL = "SELECT * FROM accommodation_join";
        $result = mysqli_query($con, $loginCheckSQL);            
            // 이메일과 비밀번호 검사 반복문 시작
            while($row = mysqli_fetch_assoc($result)) {
                // 이메일 비교 검사 시작
                if ($row['email'] == $loginEmail) {
                    // 비밀번호 비교 검사 시작
                    if ($row['password'] == $loginPassword) {
                        echo "계정있어!";
                    } else {
                        echo "비밀번호없어!";
                    } // 비밀번호 비교 검사 끝
                } else {
                    echo "계정없어!";
                } // 이메일 존재 검사 끝
            } // 반복문 끝
    } else {
        echo "POST값없어!";        
    } // 클라이언트에서 서버로 보낸 데이터가 존재할 때 조건 끝    
} // 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 끝

?>