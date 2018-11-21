package com.TeacherManagement.services;

public class Schedule {
	public Schedule(String id, Integer day, String timeStart, String timeEnd, String location, String semester,
			String year, String idteacher) {
		super();
		this.id = id;
		this.day = day;
		this.timeStart = timeStart;
		this.timeEnd = timeEnd;
		this.location = location;
		this.semester = semester;
		this.year = year;
		this.idteacher = idteacher;
	}
	public Schedule() {}
	private String id;
	private Integer day;
	//private Integer shift;
	private String timeStart;
	private String timeEnd;
	private String location;
	private String semester;
	private String year;
	private String idteacher;
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public Integer getDay() {
		return day;
	}
	public void setDay(Integer day) {
		this.day = day;
	}
//	public Integer getShift() {
//		return shift;
//	}
//	public void setShift(Integer shift) {
//		this.shift = shift;
//	}
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public String getSemester() {
		return semester;
	}
	public void setSemester(String semester) {
		this.semester = semester;
	}
	public String getYear() {
		return year;
	}
	public void setYear(String year) {
		this.year = year;
	}
	public String getIdteacher() {
		return idteacher;
	}
	public void setIdteacher(String idteacher) {
		this.idteacher = idteacher;
	}
	
	public String getTimeStart() {
		return timeStart;
	}
	public void setTimeStart(String timeStart) {
		this.timeStart = timeStart;
	}
	public String getTimeEnd() {
		return timeEnd;
	}
	public void setTimeEnd(String timeEnd) {
		this.timeEnd = timeEnd;
	}
}
