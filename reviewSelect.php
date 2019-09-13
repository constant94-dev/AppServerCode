<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $reviewSelectSQL = "SELECT * FROM accommodation_review";
    $result = mysqli_query($con, $reviewSelectSQL);

    // 쿼리 결과가 0 보다 클때 조건 시작
    if (mysqli_num_rows($result) > 0) {
        
        $data = array();
        // 반복문 시작
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,
            array('num'=>$row['place_num'],
            'name'=>$row['place_name'],
            'time'=>$row['place_time'],
            'score'=>$row['place_score'],
            'writer'=>$row['writer'],
            'image'=>$row['place_image'])
            );
        } // 반복문 끝
    } // 쿼리 결과가 0 보다 클때 조건 끝

    $json = json_encode(array('review'=>$data));
    echo $json;

    
    
    
    // while($row = mysqli_fetch_assoc($result)) {
    //     $jsonResult = array('name'=>$row['place_name'],'time'=>$row['place_time'],'score'=>$row['place_score'],'image'=>$row['place_image'],'writer'=>$row['writer']);
    // }

    // echo json_encode($jsonResult);
    

}
?>