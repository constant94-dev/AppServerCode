import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;

public class newMainServer {

	private ServerSocket server;

	// client access list
	ArrayList<UserClass> user_list;

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		new newMainServer();
	} // main method Only call is good

	public newMainServer() {
		try {
			user_list = new ArrayList<UserClass>();
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
				String nickName = dis.readUTF();
				// welcome message send
				dos.writeUTF("name " + nickName);
				System.out.println("name " + nickName + " sir access");
				// Already access client message send
				sendToClient("name " + nickName);
				// client infomation management Object create
				UserClass user = new UserClass(nickName, socket);
				user.start();
				user_list.add(user);
			} catch (Exception e) {
				e.printStackTrace();
			}
		}
	} // NickNameThread class end

	// User information management class
	class UserClass extends Thread {
		String nickName;
		Socket socket;
		DataInputStream dis;
		DataOutputStream dos;

		public UserClass(String nickName, Socket socket) {
			try {
				this.nickName = nickName;
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
					System.out.println("message " + nickName + ":" + msg);
					// Clients message send
					sendToClient("message " + nickName + ":" + msg);
				}
			} catch (Exception e) {
				e.printStackTrace();
			}
		}

	} // UserClass class end

	public synchronized void sendToClient(String msg) {
		try {
			// Repeat as clients
			for (UserClass user : user_list) {
				// clients send message
				user.dos.writeUTF(msg);

			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	} // sendToClient method end

} // newMainServer class end