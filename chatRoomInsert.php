<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 GET 일 때
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $chatRoomNames = $_GET['names'];
    $chatRoomImages = $_GET['images'];
    $chatRoomCreator = $_GET['creator'];

    //echo  "이미지 : ".$chatRoomImages." / 이름 : ".$chatRoomNames;

    $chatRoomSQL = "INSERT INTO accommodation_chatroom(chatroom_names, chatroom_images, create_time, update_time, chatroom_creator) VALUES('$chatRoomNames', '$chatRoomImages',now(),now(), '$chatRoomCreator')";

    // 데이터베이스에 댓글 정보 insert 성공할 때 조건 시작
    if (mysqli_query($con, $chatRoomSQL)) {    
    
        echo "채팅방등록성공!";

    } else {
        echo "채팅방등록실패!";
    } // 데이터베이스에 댓글 정보 insert 성공할 때 조건 끝

}


?>