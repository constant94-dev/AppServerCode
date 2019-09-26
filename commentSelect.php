<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $placeNum = $_GET['placeNum'];

    $commentSelectSQL = "SELECT * FROM accommodation_comment WHERE place_num='$placeNum' ORDER BY comment_num DESC";
    $result = mysqli_query($con, $commentSelectSQL);

    // 쿼리 결과가 0 보다 클때 조건 시작
    if (mysqli_num_rows($result) > 0) {
        
        $data = array();
        // 반복문 시작
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,
            array('num'=>$row['place_num'],
            'email'=>$row['comment_email'],
            'time'=>$row['update_time'],
            'cnum'=>$row['comment_num'],
            'comment'=>$row['comment'])
            );
        } // 반복문 끝

        $json = json_encode(array('result'=>$data));
        echo $json;
    } else {

        array_push($data,
        array('num'=> '0',
        'email'=> '0',
        'time'=> '0',            
        'comment'=> '0')
        );

        $json = json_encode(array('result'=>$data));
        echo $json;
    } // 쿼리 결과가 0 보다 클때 조건 끝

    
}

?>