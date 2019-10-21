import java.util.List;

// ä�ù� ������ ������ �ϴ� Ŭ����
public class RoomManager {

	private List roomList; // room List

	// ä�ù� ���� ���
	public void createRoom(String roomID) {
		roomList.add(roomID);

		System.out.println("create Room!");
	}

	// ä�ù� ���� ���
	public void removeRoom(ChatRoom chatRoom) {
		roomList.remove(chatRoom);
	}

} // RoomManager class end