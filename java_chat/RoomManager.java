import java.util.List;

// 채팅방 생성과 삭제를 하는 클래스
public class RoomManager {

	private List roomList; // room List

	// 채팅방 생성 기능
	public void createRoom(String roomID) {
		roomList.add(roomID);

		System.out.println("create Room!");
	}

	// 채팅방 삭제 기능
	public void removeRoom(ChatRoom chatRoom) {
		roomList.remove(chatRoom);
	}

} // RoomManager class end