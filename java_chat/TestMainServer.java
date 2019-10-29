import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.HashMap;

public class TestMainServer {

	private ServerSocket server;

	// client access list
	ArrayList<ChatUser> user_list;
	HashMap<String, DataOutputStream> userMap;

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		new TestMainServer();
	} // main method Only call is good

	public TestMainServer() {
		try {

			// client user set HashMap
			userMap = new HashMap<>();
			user_list = new ArrayList<ChatUser>();
			// Server run
			server = new ServerSocket(8888);
			// client access wait thread run
			ConnectionThread thread = new ConnectionThread();
			thread.start();
		} catch (Exception e) {
			e.printStackTrace();
		}
	} // newMainServer creator end

	// client access wait control class
	class ConnectionThread extends Thread {

		@Override
		public void run() {
			// TODO Auto-generated method stub
			try {
				while (true) {
					System.out.println("client access wait...");
					Socket socket = server.accept();
					System.out.println("client access in");
					System.out.println("client socket info : " + socket.toString());

					// client socket infomation throught stream create
					NameAccessThread thread = new NameAccessThread(socket);
					thread.start();

				}
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	} // ConnectionThread class end

	// name input control Thread
	class NameAccessThread extends Thread {
		private Socket socket;

		public NameAccessThread(Socket socket) {
			this.socket = socket;

		}

		public void run() {
			try {
				// Stream Extraction
				InputStream inputStream = socket.getInputStream();
				OutputStream outputStream = socket.getOutputStream();
				DataInputStream dataInputStream = new DataInputStream(inputStream);
				DataOutputStream dataOutputStream = new DataOutputStream(outputStream);

				// name receive
				String nickName = dataInputStream.readUTF();
				System.out.println("client user name : " + nickName);

				if (nickName.startsWith("LoginName")) {
					System.out.println("Login String start");
					String[] nameSplit = nickName.split(":");
					// welcome message send
					dataOutputStream.writeUTF("Halo -> " + nameSplit[1]);

					userMap.put(nameSplit[1], dataOutputStream);
					System.out.println("userMap put end");

					System.out.println("Login String end");
				}

				// Already access client message send
				// sendToClient("name " + nickName);

				// client user HashMap
				// key -> name , value -> dataOutputStream

				System.out.println("userMap save key : " + userMap.keySet().toString());
				System.out.println("userMap save values : " + userMap.values());

				System.out.println("userMap repeat end");

				// client infomation management Object create
				ChatUser user = new ChatUser(socket);
				user.start();

				// user_list.add(user);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	} // NameAccessThread class end

	// User information management class
	class ChatUser extends Thread {
		String nickName;
		String profileImage;
		Socket socket;
		DataInputStream dataInputStream;
		DataOutputStream dataOutputStream;

		public ChatUser(Socket socket) {
			try {
				this.nickName = nickName;
				this.socket = socket;
				InputStream inputStream = socket.getInputStream();
				OutputStream outputStream = socket.getOutputStream();
				dataInputStream = new DataInputStream(inputStream);
				dataOutputStream = new DataOutputStream(outputStream);

			} catch (Exception e) {
				e.printStackTrace();
			}
		}

		// User message receive Thread
		public void run() {
			try {
				while (true) {
					// User message receive
					String msg = dataInputStream.readUTF();

					System.out.println(msg);

					String[] content = msg.split("content");

					System.out.println("content -> " + content[1]);

					System.out.println("chatting String start");
					String[] msgSplit = msg.split(":");

					System.out.println("what name message send -> " + msgSplit[3]);
					System.out.println("chatting String end");

					// Clients message send
					sendToClient("roomNum:" + msgSplit[1] + "otherClient:" + msgSplit[2] + "sendClient:" + msgSplit[3]
							+ "sendMessage:" + content[1]);

					System.out.println("Clients message send");
				}
			} catch (Exception e) {
				e.printStackTrace();
			}
		}

	} // UserClass class end

	public synchronized void sendToClient(String msg) {
		try {

			int targetRoomNum = msg.indexOf("roomNum");
			String resultRoomNum = msg.substring(targetRoomNum, (msg.substring(targetRoomNum).indexOf("otherClient")));

			int targetOtherClient = msg.indexOf("otherClient");
			String resultOtherClient = msg.substring(targetOtherClient,
					(msg.substring(targetRoomNum).indexOf("sendClient")));

			int targetSendClient = msg.indexOf("sendClient");
			String resultSendClient = msg.substring(targetSendClient,
					(msg.substring(targetRoomNum).indexOf("sendMessage")));

			int targetSendMessage = msg.indexOf("sendMessage");
			String resultSendMessage = msg.substring(targetSendMessage);

			String[] resultRoomNumSplit = resultRoomNum.split(":");
			String[] resultOtherClientSplit = resultOtherClient.split(":");
			String[] resultSendClientSplit = resultSendClient.split(":");
			String[] resultSendMessageSplit = resultSendMessage.split(":");

			System.out.println("roomNum -> " + resultRoomNumSplit[1]);
			System.out.println("otherClient -> " + resultOtherClientSplit[1]);
			System.out.println("sendClient -> " + resultSendClientSplit[1]);
			System.out.println("sendMessage -> " + resultSendMessageSplit[1]);

			ArrayList<String> userSend = new ArrayList<>();

			String[] otherClient = resultOtherClientSplit[1].split(" ");

			System.out.println("otherClient length -> " + otherClient.length);

			userSend.add(resultSendClientSplit[1]);

			for (int i = 0; i < otherClient.length; i++) {
				userSend.add(otherClient[i]);
				System.out.println("other Client list save -> " + userSend.get(i).toString());
			}

			for (int i = 0; i < userSend.size(); i++) {

				System.out.println("ALL Client list save -> " + userSend.get(i).toString());

				userMap.get(userSend.get(i)).writeUTF(
						resultRoomNumSplit[1] + ":" + resultSendClientSplit[1] + ":" + resultSendMessageSplit[1]);

			}

			// Repeat as clients
//			for (ChatUser user : user_list) {
//				// clients send message
//				user.dos.writeUTF(msg);
//
//			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	} // sendToClient method end

} // newMainServer class end