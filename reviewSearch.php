<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $keyword = $_GET['keyword'];

    //echo "내가 검색한 키워드 : ".$keyword;

    $reviewSearchSQL = "SELECT * FROM accommodation_review WHERE place_name LIKE '%$keyword%' OR writer LIKE '%$keyword%'";

    $result = mysqli_query($con, $reviewSearchSQL);

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
            'image'=>$row['place_image'],
            'review'=>$row['place_review'])
            );
        } // 반복문 끝

        $json = json_encode(array('result'=>$data));
        echo $json;
    } else {
        array_push($data,
            array('num'=>'0',
            'name'=>'0',
            'time'=>'0',
            'score'=>'0',
            'writer'=>'0',
            'image'=>'0',
            'review'=>'0')
            );
        $json = json_encode(array('result'=>$data));
        echo $json;
    } // 쿼리 결과가 0 보다 클때 조건 끝

    


}

?>