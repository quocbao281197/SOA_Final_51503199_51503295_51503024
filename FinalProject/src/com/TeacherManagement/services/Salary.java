package com.TeacherManagement.services;

public class Salary {

	String id;
	String month;
	int year;
	double total;
	String teacherID;
	
	public String getTeacherID() {
		return teacherID;
	}
	public void setTeacherID(String teacherID) {
		this.teacherID = teacherID;
	}
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String getMonth() {
		return month;
	}
	public void setMonth(String month) {
		this.month = month;
	}
	public int getYear() {
		return year;
	}
	public void setYear(int year) {
		this.year = year;
	}
	public double getTotal() {
		return total;
	}
	public void setTotal(double total) {
		this.total = total;
	}
	public Salary(String id, String month, int year, double total) {
		super();
		this.id = id;
		this.month = month;
		this.year = year;
		this.total = total;
	}
	public Salary() {
		// TODO Auto-generated constructor stub
	}
	
	public Salary(String id, String month, int year, double total, String teacherID) {
		super();
		this.id = id;
		this.month = month;
		this.year = year;
		this.total = total;
		this.teacherID = teacherID;
	}
}
