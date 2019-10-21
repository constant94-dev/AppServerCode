import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.util.List;

// 사용자의 고유정보를 가지는 클래스 (소켓 존재)
public class ChatUser {

	String nickName;
	String profileImage;
	Socket socket;
	DataInputStream dis;
	DataOutputStream dos;

	public ChatUser(String nickName, String profileImage, Socket socket) {
		try {
			this.nickName = nickName;
			this.profileImage = profileImage;
			this.socket = socket;

			InputStream is = socket.getInputStream();
			OutputStream os = socket.getOutputStream();

			dis = new DataInputStream(is);
			dos = new DataOutputStream(os);

		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	// User message receive Thread
	public void run() {
		try {
			while (true) {
				// User message receive
				String msg = dis.readUTF();
				System.out.println("message:" + nickName + ":" + profileImage + ":" + msg);
				// Clients message send
				ChatRoom chatRoom = new ChatRoom();
				chatRoom.sendToClient("message:" + nickName + ":" + profileImage + ":" + msg);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

} // ChatUser class end