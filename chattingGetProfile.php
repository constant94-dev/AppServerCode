<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $chattingEmail = $_GET['chattingEmail'];

    $chattingProfileSQL = "SELECT * FROM accommodation_profile WHERE profile_email = '$chattingEmail'";
    $result = mysqli_query($con, $chattingProfileSQL);
   
    // 쿼리 결과가 0 보다 클때 조건 시작
    if (mysqli_num_rows($result) > 0) {

        $data = array();
        // 반복문 시작
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,
            array('email'=>$row['profile_email'],
            'name'=>$row['profile_name'],
            'image'=>$row['profile_image'])
            );
        } // 반복문 끝

        $json = json_encode(array('result'=>$data));
        echo $json;

    }

}
?>