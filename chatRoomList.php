<?php
// 데이터베이스 연결 파일
include 'db_config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

$chatRoomCreator = $_GET['creator'];

$chatRoomSelectSQL = "SELECT * FROM accommodation_chatroom WHERE chatroom_names LIKE '%$chatRoomCreator%' OR chatroom_creator = '$chatRoomCreator' ORDER BY chatroom_num DESC";
$result = mysqli_query($con, $chatRoomSelectSQL);

// 쿼리 결과가 0 보다 클때 조건 시작
if (mysqli_num_rows($result) > 0) {

    $data = array();

    // 채팅방 목록 반복문 시작
    while ($row = mysqli_fetch_assoc($result)) {

        array_push($data,
            array('num'=>$row['chatroom_num'],
            'names'=>$row['chatroom_names'],
            'images'=>$row['chatroom_images'])            
            );
       
    } // 채팅방 목록 반복문 끝

    $json = json_encode(array('result'=>$data));
    echo $json;

} else {
    array_push($data,
    array('num'=>'0',
    'names'=>'0',
    'images'=>'0')
    );

    $json = json_encode(array('result'=>$data));
    echo $json;
}
}

?>