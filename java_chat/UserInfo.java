import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.net.Socket;
import java.util.ArrayList;

import TestMainServer.ChatUser;

public class UserInfo {

	private String userInfoName;
	private String userInfoImage;
	private Socket socket;
	DataInputStream dataInputStream;
	DataOutputStream dataOutputStream;

	public UserInfo() {

	}

	public UserInfo(String userInfoName, Socket socket) {
		this.socket = socket;
		this.userInfoName = userInfoName;
	}

	public String getUserInfoImage() {
		return userInfoImage;
	}

	public String getUserInfoName() {
		return userInfoName;
	}

	// User message receive Thread
	public void run() {
		try {
			while (true) {
				// User message receive
				String msg = dataInputStream.readUTF();
				System.out.println("message:" + msg);
				// Clients message send
				sendToClient("message:" + msg);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public synchronized void sendToClient(String msg) {
		try {
			// Repeat as clients
			for (UserInfo userInfo : userInfoName) {
				// clients send message
				userInfo.dataOutputStream.writeUTF(msg);

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	} // sendToClient method end

} // UserInfo class end