package com.TeacherManagement.services;

import java.nio.ByteBuffer;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.TimeZone;

import javax.json.bind.annotation.JsonbDateFormat;
import javax.swing.text.DateFormatter;
import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;

@Path("/Teacher")
public class TeacherManagementServices {
	
	/* All user functions */
	
	/* 1. Login */
	@POST
	@Path("/login/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public String isAdmin(@FormParam("username") String username, @FormParam("password") String password)
	{
		System.out.println("input username :" + username);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();

			String value = "0";
			//rs = stmt.executeQuery("SELECT * FROM account");
			if(checkUsername(username,password)) {
				rs = stmt.executeQuery("SELECT * FROM account WHERE USERNAME = '" + username + "'");
				while (rs.next())
				{
					String role = rs.getString("ROLE");
					if(role.equals("1")) {
						value = "1";
					}
					else {
						value = "0";
					}
				}
			}
			else {
				value = "3";
				//return "0";
			}
			System.out.println("Role is: " + value);
			logging(username);
			//logout(username);
			return value;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "0";
	}
	
	private boolean checkUsername(String username, String password) {
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM account WHERE ACTIVE = '1'");
			while (rs.next())
			{
				String u = rs.getString("USERNAME");
				String p = rs.getString("PASSWORD");
				if(username.equals(u) && password.equals(p)) {
					return true;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/* 2. Logging  -> Return start time */
/*	@POST
	@Path("/logging/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)*/
	private boolean logging(String username) {
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs1 = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			
			String date = getCurrentDate1();
			String time = getCurrentTime1();
			stmt.executeUpdate("INSERT INTO `logging`(`ACCOUNTLOGGER`, `DATE`, `TIMESTART`, `TIMEOUT`) VALUES ('" + username + "','"+ date +"','" + time + "','')");
			System.out.println("date: " + date);
			System.out.println("time" + time);
			System.out.println("Success logging");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	private String getCurrentDate() {
		System.out.println("get Date begin");
		LocalDate localDate = LocalDate.now();
        String result = DateTimeFormatter.ofPattern("yyyy-mm-dd").format(localDate);
        System.out.println("get Date end");
        System.out.println("Date get: " + result);
        return result;
	}
	
	private String getCurrentTime() {
		System.out.println("get Time begin");
		LocalTime time = java.time.LocalTime.now();
		String result = time.toString();
		System.out.println("result");
		System.out.println("get Time begin");
		return result;
	}
	
	private String getCurrentTime1() {
		return java.time.LocalTime.now().toString();
	}
	
	private String getCurrentDate1() {
		long millis=System.currentTimeMillis();  
		java.sql.Date date=new java.sql.Date(millis);
		return date.toString();
	}
	
	/* 3. Logout */
	@POST
	@Path("/logout/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	//public void logout(@FormParam("username") String username, @FormParam("date") String date, @FormParam("timestart") String timestart )
	public boolean logout(@FormParam("username") String username)
	{
		System.out.println("Logout name: " + username);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();

			String time = getCurrentTime1();			
		    /*Sua cau truy van*/
			//stmt.executeUpdate("UPDATE `teacherdatabase`.`logging` SET `TIMEOUT` = '" + time + "' WHERE `logging`.`ACCOUNTLOGGER` = '" + username + "' AND `logging`.`DATE` = '" + date +"' AND `logging`.`TIMESTART` = '" + timestart +"';");
			stmt.executeUpdate("UPDATE `logging`  SET `TIMEOUT`='" + time + "' WHERE ACCOUNTLOGGER = '" + username +"' ORDER BY `DATE` DESC, `TIMESTART` DESC LIMIT 1"); // Duy : co the where timeout null
			System.out.println("time logout: " + time);
			System.out.println("Success Logout!");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("TeacherManagement/ViewAnnoucement/") 
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)     
	@Produces(MediaType.APPLICATION_JSON)
	public Announcement ViewAnnoucement(@FormParam("TITLE") String TITLE)   //Duy : return ve title+content , co nen tao doi tuong thong bao ?
	{
		System.out.println("Receive: " + TITLE);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `announcement` WHERE  `TITLE` = '" + TITLE + "'");

			String id = "";
			String content= "";
			String idAdmin= "";
			 
			Announcement ann = new Announcement();
			while(rs.next()) {				
				Date datepost = new Date();
				id       = rs.getString("ID");
				content  = rs.getString("CONTENT");
				idAdmin  = rs.getString("IDADMIN");
				//datepost = new SimpleDateFormat("dd/MM/yyyy").parse(rs.getString("DATEPOS"));	
				
				 /* DOB */
				 datepost = rs.getDate("DATEPOST");
				 System.out.println("DatePost: " + datepost.toString());
				 String datepostStr = datepost.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 datepost = utcFormat.parse(datepostStr);
				 System.out.println("After DatePost: " + datepost.toString());
				 /*      */
				 
				ann.setId(id);
				ann.setContent(content);
				ann.setIdadmin(idAdmin);
				ann.setTitle(TITLE);
				ann.setDatepost(datepost);
			}
			return ann;     //Duy: return Object ?
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		
		return null;
	}
	 
	 /* End all user functions*/
	
	/*********Teacher Functions**********/
	
	/*UpdatePersonalInformation*/
	@POST
	@Path("TeacherManagement/UpdatePersonalInfomation/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UpdatePersonalInfomation(@FormParam("ID") String ID
			, @FormParam("TEACHERNAME") String TEACHERNAME
			, @FormParam("DOB") String DOB
			, @FormParam("GENDER") String GENDER
			, @FormParam("PHONENUMBER") String PHONENUMBER
			, @FormParam("COUNTRY") String COUNTRY
			, @FormParam("EMAIL") String EMAIL
			, @FormParam("ADDRESS") String ADDRESS
			, @FormParam("RELIGION") String RELIGION
			, @FormParam("PASSWORD") String PASSWORD)   
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("UPDATE `teacher` SET `NAME`='"+TEACHERNAME+"',`DOB`='"+DOB+"', `GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',WHERE ID = '"+ID+"'  ");
			rs = stmt.executeQuery("UPDATE `account` SET PASSWORD`='"+PASSWORD+"' WHERE USERNAME = '"+ID+"'");
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return true;
	}
	
	/*SearchTeacher*/
	
	/*ViewPersonalSalary*/
	@POST
	@Path("TeacherManagement/ViewSalary/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Salary> ViewSalary(@FormParam("ID") String ID)   //Duy: ID nay l� SESSION ID cua Teacher
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Salary> lstSalary = new ArrayList<Salary>();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `salary` WHERE `TEACHER_ID`= '"+ID+"'");
			
			while (rs.next())
			{
				String id =		    rs.getString("ID");
				String month = 		rs.getString("MONTH");
				Integer year =		rs.getInt("YEAR");
				Double total =   rs.getDouble("TOTAL");
				Salary salary = new Salary();
				salary.setId(id);
				salary.setMonth(month);
				salary.setYear(year);
				salary.setTotal(total);
			
				lstSalary.add(salary);
			}
		
			return lstSalary;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return lstSalary ;
	}
	
//	/*ViewTeachingSchedule*/
//	@POST
//	@Path("TeacherManagement/ViewTeachingScheduling/")  
//	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
//	@Produces(MediaType.APPLICATION_JSON)
//	public ArrayList<Schedule> ViewTeachingScheduling(@FormParam("ID") String ID)   //Duy: ID nay l� SESSION ID cua Teacher
//	{
//		Connection conn = null;
//		Statement stmt = null;
//		ResultSet rs = null;
//		ArrayList<Schedule> ArraySchedule = new ArrayList<Schedule>();
//		try {
//			Class.forName("com.mysql.jdbc.Driver");
//			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
//			String connectionUser = "root";
//			String connectionPassword = "";
//			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
//			stmt = conn.createStatement();
//			rs = stmt.executeQuery("SELECT * FROM `schedule` WHERE `IDTEACHER`= '"+ID+"'");
//			Schedule schedule = new Schedule();
//			while (rs.next())
//			{
//				String id =		    rs.getString("ID");
//				Integer day = 		rs.getInt("DAY");
//				Integer shift =		rs.getInt("SHIFT");
//				String location =   rs.getString("LOCATION");
//				String semester =   rs.getString("SEMESTER");
//				String year = 		rs.getString("YEAR");
//				
//				schedule.setId(id);
//				schedule.setDay(day);
//				schedule.setShift(shift);;
//				schedule.setLocation(location);
//				schedule.setSemester(semester);
//				schedule.setYear(year);
//			
//				ArraySchedule.add(schedule);
//			}
//			return ArraySchedule;
//				
//		} catch (Exception e) {
//			e.printStackTrace();
//		} finally {
//			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
//		}
//		return ArraySchedule ;
//	}
	
	/*ViewAnnouncement*/
	/*********End Teacher Functions***********/
	
	
	/*********All Admin Function**********/
	
	/*Teacher - Add*/
	@POST
	@Path("TeacherManagement/AddTeacher/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddTeacher(@FormParam("TEACHERNAME") String TEACHERNAME, @FormParam("DOB") String DOB, @FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER,
			@FormParam("GENDER") String GENDER, @FormParam("PHONENUMBER") String PHONENUMBER, @FormParam("COUNTRY") String COUNTRY,
			@FormParam("EMAIL") String EMAIL, @FormParam("ADDRESS") String ADDRESS, @FormParam("RELIGION") String RELIGION,
			@FormParam("SUBJECT_NAME") String SUBJECT_NAME)
	{
		System.out.println("Begin   ADD TEACHER");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			
			String ID = Auto_Increment_ID();
			
			java.util.Date dt = new java.util.Date();
			java.text.SimpleDateFormat sdf = 
			     new java.text.SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
			String currentTime = sdf.format(dt);
			
//			System.out.println("TEACHERNAME: " + TEACHERNAME);
//			System.out.println("DOB: " + DOB);
//			System.out.println("IDENTIFYCARDNUMBER: " + IDENTIFYCARDNUMBER);
//			System.out.println("GENDER: " + GENDER);
//			System.out.println("PHONENUMBER: " + PHONENUMBER);
//			System.out.println("COUNTRY: " + COUNTRY);
//			System.out.println("EMAIL: " + EMAIL);
//			System.out.println("ADDRESS: " + ADDRESS);
//			System.out.println("RELIGION: " + RELIGION);
//			
			stmt = conn.createStatement();
			
			

			// insert account
			stmt.executeUpdate("INSERT INTO `account` (`USERNAME`, `PASSWORD`, `DATECREATED`, `ROLE`, `ACTIVE`) VALUES ('"+ID+"','123456','"+currentTime+"',b'0', b'1')");
			
			stmt.executeUpdate("INSERT INTO `teacher` (`ID`, `NAME`, `DOB`, `IDENTIFYCARDNUMBER`, `GENDER`, `PHONENUMBER`, `COUNTRY`, `EMAIL`, `ADDRESS`, `RELIGION`, `STATUS`, `SUBJECT_NAME`) VALUES\r\n" + 
					"('"+ID+"', '"+TEACHERNAME+"', '"+DOB+"', '"+IDENTIFYCARDNUMBER+"', '"+GENDER+"', '"+PHONENUMBER+"', '"+COUNTRY+"', '"+EMAIL+"', '"+ADDRESS+"', '"+RELIGION+"', b'1', '"+SUBJECT_NAME+"')");
			
			String scheduleID = "SC" + ID.substring(2);
			stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `IDTEACHER`) VALUES ('"+ scheduleID +"',0,0,'0','0','0000','"+ ID + "')");
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Admin - update*/
	@POST
	@Path("TeacherManagement/UpdateAdmin/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UpdateAdminInformation(@FormParam("ID") String ID,@FormParam("TEACHERNAME") String TEACHERNAME, @FormParam("DOB") String DOB, @FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER, @FormParam("GENDER") String GENDER, @FormParam("PHONENUMBER") String PHONENUMBER, @FormParam("COUNTRY") String COUNTRY, @FormParam("EMAIL") String EMAIL, @FormParam("ADDRESS") String ADDRESS, @FormParam("RELIGION") String RELIGION,@FormParam("STATUS") String STATUS)
	{
		Connection conn = null;
		Statement stmt = null;
		try {
			System.out.println("BEGIN UPDATE INFORMATION!");
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			// Update teacher _ Admin ( khong update ID)
			System.out.println("ID: " + ID);
			System.out.println("TEACHERNAME: " + TEACHERNAME);
			System.out.println("DOB: " + DOB);
			System.out.println("IDENTIFYCARDNUMBER: " + IDENTIFYCARDNUMBER);
			System.out.println("GENDER: " + GENDER);
			System.out.println("PHONENUMBER: " + PHONENUMBER);
			System.out.println("COUNTRY: " + COUNTRY);
			System.out.println("EMAIL: " + EMAIL);
			System.out.println("ADDRESS: " + ADDRESS);
			System.out.println("RELIGION: " + RELIGION);
			System.out.println("STATUS: " + STATUS);
			String sqlStatement = "UPDATE `admin` SET `NAME`='"+TEACHERNAME+"',`DOB`='"+DOB+"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+"',`GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',`STATUS`='"+STATUS+"' WHERE ID = '"+ID+"'";
			System.out.println("SQLSTATEMENT update: " + sqlStatement);
			stmt.executeUpdate("UPDATE `admin` SET `NAME`='"+TEACHERNAME+"',`DOB`='"+DOB+"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+"',`GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',`STATUS`="+STATUS+" WHERE ID = '"+ID+"'");
			System.out.println("Update Admin Succeed");
		return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Teacher - Delete*/
	@POST
	@Path("TeacherManagement/DeleteTeacher/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	
	public boolean DeleteTeacher(@FormParam("ID") String ID)
	{
		System.out.println("Input ID : " + ID);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			// delete teacher
			stmt.executeUpdate("UPDATE `teacher` SET `STATUS`= 0 WHERE ID ='"+ID+"'");
		return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Teacher - update*/
	@POST
	@Path("TeacherManagement/UpDateTeacher/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED + "; charset=utf-8")
	//@Produces(MediaType.APPLICATION_JSON + "; charset=utf-8")
	@Produces(MediaType.APPLICATION_JSON + "; charset=utf-8")
	
	public boolean UpdateTeacher_Admin(@FormParam("ID") String ID,@FormParam("TEACHERNAME") String TEACHERNAME, @FormParam("DOB") String DOB, @FormParam("IDENTIFYCARDNUMBER") String IDENTIFYCARDNUMBER, @FormParam("GENDER") String GENDER, @FormParam("PHONENUMBER") String PHONENUMBER, @FormParam("COUNTRY") String COUNTRY, @FormParam("EMAIL") String EMAIL, @FormParam("ADDRESS") String ADDRESS, @FormParam("RELIGION") String RELIGION,@FormParam("STATUS") String STATUS, @FormParam("SUBJECT_NAME") String SUBJECT_NAME)
	{

		/*Vào iso-8859-1, ra utf-8 => ?*/
		Connection conn = null;
		Statement stmt = null;
		try {
			System.out.println("BEGIN UPDATE INFORMATION!");
			Class.forName("com.mysql.jdbc.Driver");
			//String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
		
			stmt = conn.createStatement();
			// Update teacher _ Admin ( khong update ID)
			System.out.println("ID: " + ID);
			System.out.println("TEACHERNAME: " + TEACHERNAME);
			System.out.println("DOB: " + DOB);
			System.out.println("IDENTIFYCARDNUMBER: " + IDENTIFYCARDNUMBER);
			System.out.println("GENDER: " + GENDER);
			System.out.println("PHONENUMBER: " + PHONENUMBER);
			System.out.println("COUNTRY: " + COUNTRY);
			System.out.println("EMAIL: " + EMAIL);
			System.out.println("ADDRESS: " + ADDRESS);
			System.out.println("RELIGION: " + RELIGION);
			System.out.println("STATUS: " + STATUS);
			System.out.println("SUBJECT_NAME: " + SUBJECT_NAME);
			String sqlStatement = "UPDATE `teacher` SET `NAME`='"+TEACHERNAME+"',`DOB`='"+DOB+"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+"',`GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',`STATUS`='"+STATUS+"',`SUBJECT_NAME`='"+SUBJECT_NAME+"' WHERE ID = '"+ID+"'";
			System.out.println("SQLSTATEMENT update: " + sqlStatement);
			stmt.executeUpdate("UPDATE `teacher` SET `NAME`='"+TEACHERNAME+"',`DOB`='"+DOB+"',`IDENTIFYCARDNUMBER`='"+IDENTIFYCARDNUMBER+"',`GENDER`='"+GENDER+"',`PHONENUMBER`='"+PHONENUMBER+"',`COUNTRY`='"+COUNTRY+"',`EMAIL`='"+EMAIL+"',`ADDRESS`='"+ADDRESS+"',`RELIGION`='"+RELIGION+"',`STATUS`="+STATUS+",`SUBJECT_NAME`='"+SUBJECT_NAME+"' WHERE ID = '"+ID+"'");
			System.out.println("Update Teacher By Admin Succeed");
			
		return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*Teacher - ViewInformation*/
	@POST
	@Path("TeacherManagement/ViewTeacherInfomation/")  // GetInfoTeacher
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	@JsonbDateFormat
	public Teacher ViewTeacherInfomation(@FormParam("username") String ID)   
	{
		System.out.println("input id: " + ID);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			System.out.println("Getting Information of Teacher: " + ID );
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `teacher` WHERE ID = '"+ID+"'"); 
			Teacher teacher = new Teacher();
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 /* DOB */
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 /*      */
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 String subjectname =	     rs.getString("SUBJECT_NAME");
				 
				 teacher.setId(id);
				 teacher.setName(name);
				 teacher.setDOB(DOB);
				 teacher.setIdentifycardnumber(identifycardnumber);
				 teacher.setGender(gender);
				 teacher.setPhonenumber(phonenumber);
				 teacher.setCountry(country);
				 teacher.setEmail(email);
				 teacher.setAddress(address);
				 teacher.setReligion(religion);
				 teacher.setStatus(status);
				 teacher.setSubjectname(subjectname);
				
			}
			System.out.println("Getting Success!");
			return teacher;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	/*ADMIN - ViewInformation*/
	@POST
	@Path("TeacherManagement/ViewAdminInfomation/")  // GetInfoTeacher
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
	@Produces(MediaType.APPLICATION_JSON)
	public Admin ViewAdminInfomation(@FormParam("username") String ID)   
	{
		System.out.println("input id: " + ID);
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			System.out.println("Getting Information");
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `admin` WHERE ID = '"+ID+"'"); 
			Admin admin = new Admin();
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 //java.util.Date DOB   = new java.util.Date(rs.getDate("DOB").getTime());  // Duy: xem lai
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 
				 admin.setId(id);
				 admin.setName(name);
				 admin.setDOB(DOB);
				 admin.setIdentifycardnumber(identifycardnumber);
				 admin.setGender(gender);
				 admin.setPhonenumber(phonenumber);
				 admin.setCountry(country);
				 admin.setEmail(email);
				 admin.setAddress(address);
				 admin.setReligion(religion);
				 admin.setStatus(status);
				 System.out.println("username: " + id);
				 System.out.println("DOB: " + DOB);
				
			}
			System.out.println("Getting Success!");
			return admin;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	/*Teacher - GetAllUserInformation*/
	@POST
	@Path("TeacherManagement/GetListTeacher/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Teacher> GetListTeacher() 
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Teacher> ArrayTeacher = new ArrayList<Teacher>();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT * FROM `teacher`");
			System.out.println("Begin get List Teacher:");
			
			while (rs.next())
			{
				 String id = 				 rs.getString("ID");
				 String name = 				 rs.getString("NAME");
				 /* DOB */
				 Date DOB = rs.getDate("DOB");
				 String DOBStr = DOB.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 DOB = utcFormat.parse(DOBStr);
				 /*      */
				 String identifycardnumber = rs.getString("IDENTIFYCARDNUMBER");
				 String gender =			 rs.getString("GENDER");
				 String phonenumber =		 rs.getString("PHONENUMBER");
				 String country = 			 rs.getString("COUNTRY");
				 String email =				 rs.getString("EMAIL");
				 String address =			 rs.getString("ADDRESS");
				 String religion =			 rs.getString("RELIGION");
				 Boolean status  =           rs.getBoolean("STATUS");
				 String subjectname =	     rs.getString("SUBJECT_NAME");
				 
				 Teacher teacher = new Teacher();
				 teacher.setId(id);
				 teacher.setName(name);
				 teacher.setDOB(DOB);
				 teacher.setIdentifycardnumber(identifycardnumber);
				 teacher.setGender(gender);
				 teacher.setPhonenumber(phonenumber);
				 teacher.setCountry(country);
				 teacher.setEmail(email);
				 teacher.setAddress(address);
				 teacher.setReligion(religion);
				 teacher.setStatus(status);
				 teacher.setSubjectname(subjectname);
				 
				 ArrayTeacher.add(teacher);
				 System.out.println("Status: "  + status);
			}
			return ArrayTeacher;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return ArrayTeacher ;
	}
	
	/* Schedule - Create*/
	
	/* Schedule - Update*/
	
	/* Announcement - Upload*/
	@POST
	@Path("Admin/UploadAnnoucement/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean UploadAnnoucement(@FormParam("TITLE") String TITLE,
			@FormParam("CONTENT") String CONTENT, @FormParam("IDADMIN") String IDADMIN)
	{
		System.out.println("Go");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		String ID = Auto_Increment_ID_Announcement();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			
			String date = getCurrentDate1();
			System.out.println("By " +  IDADMIN);
			stmt.executeUpdate("INSERT INTO `announcement` (`ID`, `TITLE`, `CONTENT`, `IDADMIN`, `DATEPOST`) VALUES\r\n" + 
					"('"+ID+"','"+TITLE+"', '"+CONTENT+"', '"+IDADMIN+"', '"+date+"')"); 
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	/*GET List Announcement*/
	/*Bao comment: Sua DB:
	 * Delete IDTeacher + Add : DatePost Date
	 * Sua cau truy van
	 * */	
	@POST
	@Path("TeacherManagement/GetListAnnouncement/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Announcement> GetListAnnouncement_Title() 
	{
		System.out.println("Reach Annoucement");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Announcement> ArrayAnnouncement = new ArrayList<Announcement>();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			
			while (rs.next())
			{
				String title = rs.getString("TITLE");
				
				 /* DOB */
				 Date datepost = rs.getDate("DATEPOST");
				 System.out.println("DatePost: " + datepost.toString());
				 String datepostStr = datepost.toString();
				 DateFormat utcFormat = new SimpleDateFormat("yyyy-MM-dd");
				 utcFormat.setTimeZone(TimeZone.getTimeZone("UTC"));
				 datepost = utcFormat.parse(datepostStr);
				 System.out.println("After DatePost: " + datepost.toString());
				 /*      */
				 
				Announcement announcement = new Announcement();
				announcement.setTitle(title);

				announcement.setDatepost(datepost);
				
				ArrayAnnouncement.add(announcement);
			}
			return ArrayAnnouncement;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return ArrayAnnouncement ;
	}
	
	/*********End All Admin Function*********/
	
	public String Auto_Increment_ID ()
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			int count = 0;
			rs = stmt.executeQuery("SELECT * FROM teacher");
			while (rs.next())
			{
				count+=1;
			}
			count+=1;
			String result = "";
			if(count < 10) {
				result = "GV00" + count;
			}
			else if(count >= 10 && count <100) {
				result = "GV0" + count;
			}
			else {
				result = "GV" + count;
			}
			System.out.println("ID: " + result);
			return result;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "GV000";
	}
	
	
	public String Auto_Increment_ID_Announcement ()
	{
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			int count = 0;
			rs = stmt.executeQuery("SELECT * FROM announcement");
			while (rs.next())
			{
				count+=1;
			}
			count+=1;
			String result = "";
			if(count < 10) {
				result = "TB00" + count;
			}
			else if(count >= 10 && count <100) {
				result = "TB0" + count;
			}
			else {
				result = "TB" + count;
			}
			System.out.println("ID_TB: " + result);
			return result;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return "TB000";
	}
	
//	/*Duy - Logging - Start*/
//	@POST
//	@Path("TeacherManagement/Logging_Start/")  
//	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
//	@Produces(MediaType.APPLICATION_JSON)
//	public boolean Logging_Start(@FormParam("ID") String ID)   
//	{
//		Connection conn = null;
//		Statement stmt = null;
//		ResultSet rs = null;
//		try {
//			Class.forName("com.mysql.jdbc.Driver");
//			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
//			String connectionUser = "root";
//			String connectionPassword = "";
//			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
//			stmt = conn.createStatement();
//			
//			// java.util.Date         //Duy : can check lai
//			DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy-MM-dd");
//			LocalDate localDate = LocalDate.now();
//			String currentDate = dtf.format(localDate);
//			
//			Date date = new Date();
//		    String strDateFormat = "HH:mm:ss";
//		    DateFormat dateFormat = new SimpleDateFormat(strDateFormat);
//		    String formattedDate= dateFormat.format(date);
//	
//			rs = stmt.executeQuery("INSERT INTO `logging`(`ACCOUNTLOGGER`, `DATE`, `TIMESTART`, `TIMEOUT`) VALUES ('"+ID+"','"+currentDate+"','"+formattedDate+"',''");
//		} catch (Exception e) {
//			e.printStackTrace();
//		} finally {
//			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
//		}
//		return true;
//	}
//	
//	/*Duy - Logging - End*/
//	@POST
//	@Path("TeacherManagement/Logging_Out/")  
//	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)   
//	@Produces(MediaType.APPLICATION_JSON)
//	public boolean Logging_Out(@FormParam("ID") String ID)   
//	{
//		Connection conn = null;
//		Statement stmt = null;
//		ResultSet rs = null;
//		try {
//			Class.forName("com.mysql.jdbc.Driver");
//			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase";
//			String connectionUser = "root";
//			String connectionPassword = "";
//			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
//			stmt = conn.createStatement();
//		
//			Date date = new Date();
//		    String strDateFormat = "HH:mm:ss";
//		    DateFormat dateFormat = new SimpleDateFormat(strDateFormat);
//		    String formattedDate= dateFormat.format(date);
//		
//			stmt.executeUpdate("UPDATE `logging`  SET `TIMEOUT`='" + formattedDate + "' WHERE ACCOUNTLOGGER = '" + ID +"' ORDER BY `TIMESTART` DESC LIMIT 1"); // Duy : co the where timeout null
//		} catch (Exception e) {
//			e.printStackTrace();
//		} finally {
//			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
//			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
//		}
//		return true;
//	}
	
	private String Substring_IDteacher(String ID) {
		String s = ID;
		s.substring(2);
		return s;
	}	
	
	
	
	@POST
	@Path("TeacherManagement/viewTeachingSchedule/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Schedule> getListSchedule(@FormParam("teacherID") String teacherID,@FormParam("day") int day,@FormParam("semester") String semester, @FormParam("year") String year) 
	{
		System.out.println("Reach Schedule");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Schedule> ArraySchedule = new ArrayList<Schedule>();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			//rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			String query = "SELECT * FROM `schedule` WHERE IDTEACHER = '" + teacherID +"' AND SEMESTER = '"+semester+"' AND YEAR = '"+year+"' AND DAY = " + day;
			System.out.println("query is: " + query);
			rs = stmt.executeQuery(query);
			while (rs.next())
			{
				System.out.println("have result");
				Schedule schedule = new Schedule();
				String id = rs.getString("ID");
				System.out.println("ID: " + id);
				int shift = rs.getInt("SHIFT");
				String[] time;
				time = convertShiftToTime(shift);
				String timeStart = time[0];
				String timeEnd = time[1];
				String location = rs.getString("LOCATION");
				schedule.setId(teacherID);
				schedule.setDay(day);
				schedule.setId(id);
				schedule.setLocation(location);
				schedule.setSemester(semester);
				schedule.setTimeEnd(timeEnd);
				schedule.setTimeStart(timeStart);
				schedule.setYear(year);
				ArraySchedule.add(schedule);
				
				System.out.println("Schedule for teacher ID:" + schedule.getIdteacher());
				System.out.println("Location: " + schedule.getLocation());
				System.out.println("Shift: " +  shift);
				System.out.println("Time start: " + schedule.getTimeStart());
				System.out.println("Time end: " + schedule.getTimeEnd());
			}
			return ArraySchedule;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	private String[] convertShiftToTime(int shift){
		String[] result = new String[2];
		if(shift == 1) {
			result[0] = "7:00";
			result[1] = "7:45";
		}
		else if (shift == 2) {
			result[0] = "7:55";
			result[1] = "8:40";
		}
		else if (shift == 3) {
			result[0] = "9:00";
			result[1] = "9:45";
		}
		else if (shift == 4) {
			result[0] = "9:55";
			result[1] = "10:40";
		}
		else if (shift == 5) {
			result[0] = "10:50";
			result[1] = "11:35";
		}
		else if (shift == 6) {
			result[0] = "13:00";
			result[1] = "13:45";
		}
		else if (shift == 7) {
			result[0] = "13:55";
			result[1] = "14:40";
		}
		else if (shift == 8) {
			result[0] = "15:00";
			result[1] = "15:45";
		}
		else if (shift == 9) {
			result[0] = "15:55";
			result[1] = "16:40";
		}
		else if (shift == 10) {
			result[0] = "16:50";
			result[1] = "17:35";
		}
		return result;
	}
	
	/*Schedule - Add*/
	@POST
	@Path("TeacherManagement/AddSchedule/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddSchedule(@FormParam("TeacherID") String TeacherID,
			@FormParam("Day") int Day,
			@FormParam("Shift") int Shift,
			@FormParam("Location") String Location,
			@FormParam("Semester") String Semester,
			@FormParam("Year") String Year
	) {
		System.out.println("Begin Add Schedule");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			
			String scheduleID = "SC" + TeacherID.substring(2);
			System.out.println("Schedule ID: " + scheduleID);
			System.out.println("TeacherID: " + TeacherID);
			stmt = conn.createStatement();
			String queryDelete = "DELETE FROM `schedule` WHERE 'SHIFT' = 0 AND 'DAY' = 0 AND ID='"+scheduleID+"'";
			String queryInsert = "INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `IDTEACHER`) VALUES ('"+ scheduleID +"',"+ Day + ","+ Shift+ ",'"+ Location+ "','"+ Semester+"','"+ Year+ "','"+ TeacherID + "')";
			stmt.executeUpdate(queryDelete);
			stmt.executeUpdate(queryInsert);
			//stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `IDTEACHER`) VALUES ('"+ scheduleID +"',"+ Day + ", +"+ Shift+ "0,+'"+ Location+ "','"+ Semester+",'"+ Year+ "','"+ TeacherID + "')");
			System.out.println("query Insert: " + queryInsert);
			System.out.println("query Delete: " + queryDelete);
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
	@POST
	@Path("Admin/getListSalary/")  
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)    
	@Produces(MediaType.APPLICATION_JSON)
	public ArrayList<Salary> getListSalary() 
	{
		System.out.println("get List Salary");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		ArrayList<Salary> ArraySalary = new ArrayList<Salary>();
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			stmt = conn.createStatement();
			//rs = stmt.executeQuery("SELECT DISTINCT `TITLE` ,`DATEPOST` FROM `announcement` ORDER BY `DATEPOST`DESC ");
			String query = "SELECT * FROM `salary` ORDER BY `ID` ASC, `YEAR` DESC, `MONTH` DESC";
			System.out.println("query is: " + query);
			rs = stmt.executeQuery(query);
			while (rs.next())
			{
				Salary salary = new Salary();
				String id = rs.getString("ID");
				String month = rs.getString("MONTH");
				int year = rs.getInt("YEAR");
				double total = rs.getDouble("TOTAL");
				String teacherID = rs.getString("TEACHER_ID");
				
				salary.setId(id);
				salary.setMonth(month);
				salary.setYear(year);
				salary.setTotal(total);
				salary.setTeacherID(teacherID);
				
				System.out.println("ID: " + salary.getId());
				System.out.println("total: " + salary.getTotal());
				ArraySalary.add(salary);
			}
			return ArraySalary;
				
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return null;
	}
	
	/*Salary - Add*/
	@POST
	@Path("Admin/AddSalary/")
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	@Produces(MediaType.APPLICATION_JSON)
	public boolean AddSalary(@FormParam("TeacherID") String TeacherID,
			@FormParam("Month") String Month,
			@FormParam("Year") int Year,
			@FormParam("Total") Double Total
	) {
		System.out.println("Begin Add Salary");
		Connection conn = null;
		Statement stmt = null;
		ResultSet rs = null;
		try {
			Class.forName("com.mysql.jdbc.Driver");
			String connectionUrl = "jdbc:mysql://localhost:3306/teacherdatabase?useUnicode=true&characterEncoding=utf-8";
			String connectionUser = "root";
			String connectionPassword = "";
			conn = DriverManager.getConnection(connectionUrl, connectionUser, connectionPassword);
			
			String salaryID = "LB" + TeacherID.substring(2);
			System.out.println("Schedule ID: " + salaryID);
			System.out.println("TeacherID: " + TeacherID);
			stmt = conn.createStatement();
			String queryInsert = "INSERT INTO `salary`(`ID`, `MONTH`, `YEAR`, `TOTAL`, `TEACHER_ID`) VALUES ('"+salaryID+"','"+Month+"',"+Year+","+Total.intValue()+",'"+TeacherID+"')";
			stmt.executeUpdate(queryInsert);
			//stmt.executeUpdate("INSERT INTO `schedule`(`ID`, `DAY`, `SHIFT`, `LOCATION`, `SEMESTER`, `YEAR`, `IDTEACHER`) VALUES ('"+ scheduleID +"',"+ Day + ", +"+ Shift+ "0,+'"+ Location+ "','"+ Semester+",'"+ Year+ "','"+ TeacherID + "')");
			System.out.println("query Insert: " + queryInsert);
			return true;
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			//try { if (rs != null) rs.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (stmt != null) stmt.close(); } catch (SQLException e) { e.printStackTrace(); }
			try { if (conn != null) conn.close(); } catch (SQLException e) { e.printStackTrace(); }
		}
		return false;
	}
	
}
