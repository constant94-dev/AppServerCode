import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.util.ArrayList;
import java.util.List;

// 채팅 전송 및 채팅방 유저 추가 클래스
public class ChatRoom {

	private int id; // room ID
	private List userList;

	public ChatRoom(List users) {
	        this.userList = users;

	        // room in
	        for(ChatUser user : users){
	            user.enterRoom(this);
	        }

	        
	}

	public synchronized void sendToClient(String msg) {
		try {
			// Repeat as clients
			for (ChatUser user : user_list) {
				// clients send message
				user.dos.writeUTF(msg);

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	} // sendToClient method end

} // ChatRoom class end