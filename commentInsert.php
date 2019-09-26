<?php 
// 데이터베이스 연결 파일
include 'db_config/connect.php';

// 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 시작
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$commentEmail = $_POST['userEmail'];
$placeNum = $_POST['placeNum'];
$comment = $_POST['commentData'];

$commentCheckSQL = "SELECT * FROM accommodation_comment WHERE comment_email = '$commentEmail' AND place_num = '$placeNum'";
$result = mysqli_query($con, $commentCheckSQL);
if (mysqli_num_rows($result) >= 1){
    echo "댓글이미작성함";
} else {
// 데이터베이스에 댓글을 삽입하기 위한 SQL
$commentAddSQL = "INSERT INTO accommodation_comment(comment_email, place_num, comment, create_time, update_time) VALUES('$commentEmail','$placeNum','$comment',now(),now())";
// 추가한 리뷰 마지막 넘버 가져오기 위한 SQL
//$reviewMaxNumSQL = "SELECT MAX(place_num) AS max_number FROM accommodation_review";

// 데이터베이스에 댓글 정보 insert 성공할 때 조건 시작
if (mysqli_query($con, $commentAddSQL)) {    
    
    echo "댓글등록성공!";

} else {
    echo "댓글등록실패!";
} // 데이터베이스에 댓글 정보 insert 성공할 때 조건 끝
}




} // 클라이언트에서 서버로 보낸 요청 메서드가 POST 일 때 조건 끝
?>