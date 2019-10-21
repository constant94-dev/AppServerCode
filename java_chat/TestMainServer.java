import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.List;

public class TestMainServer {

	private ServerSocket server;

	// client access list
	ArrayList<ChatUser> user_list;

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		RoomManager roomManager = new RoomManager();

		roomManager.createRoom();
		new TestMainServer();
	} // main method Only call is good

	public TestMainServer() {
		try {

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
					// client socket infomation throught stream create
					NickNameThread thread = new NickNameThread(socket);
					thread.start();

				}
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	} // ConnectionThread class end

	// name input control Thread
	class NickNameThread extends Thread {
		private Socket socket;

		public NickNameThread(Socket socket) {
			this.socket = socket;
		}

		public void run() {
			try {
				// Stream Extraction
				InputStream is = socket.getInputStream();
				OutputStream os = socket.getOutputStream();
				DataInputStream dis = new DataInputStream(is);
				DataOutputStream dos = new DataOutputStream(os);

				// name receive
				String nameANDimage = dis.readUTF();
				String[] nameANDimageSplit = nameANDimage.split(":");

				System.out.println("nameANDimage" + nameANDimage);

				// welcome message send
				dos.writeUTF("name " + nameANDimageSplit[0]);
				System.out.println("name " + nameANDimageSplit[0] + " sir access");
				// Already access client message send
				sendToClient("name " + nameANDimageSplit[0]);
				// client infomation management Object create
				ChatUser user = new ChatUser(nameANDimageSplit[0], nameANDimageSplit[1], socket);
				user.start();
				user_list.add(user);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	} // NickNameThread class end

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

} // newMainServer class end