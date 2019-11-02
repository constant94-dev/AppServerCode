<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sendName = $_GET['sendName'];

    $chattingSendUserSQL = "SELECT * FROM accommodation_profile WHERE profile_name = '$sendName'";
    $result = mysqli_query($con, $chattingSendUserSQL);
   
    // 쿼리 결과가 0 보다 클때 조건 시작
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $sendUserImage = $row['profile_image'];
        }
        
        echo $sendUserImage;

    }

}



?>