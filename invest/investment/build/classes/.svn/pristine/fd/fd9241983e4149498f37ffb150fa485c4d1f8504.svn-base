package com.gxcz.xuhui.investment.model.dto;

public class PagerDTO {

	private int currentPage;
	private int startPage;
	private int totalPage;
	private int totalRecord;
	private int pageSize = 20;
	private int endPage;
	
	public PagerDTO() {
	}
	
	public PagerDTO(int totalRecord,int pageSize){
		this.currentPage = 1;
		this.pageSize = pageSize;
		this.totalPage =(int) Math.floor(totalRecord/pageSize);
		this.startPage = this.currentPage*this.pageSize;
		this.endPage = this.startPage+this.pageSize;
	}
	
	public PagerDTO(int totalRecord) {
		this(totalRecord,20);
	}

	public int getEndPage() {
		return endPage;
	}

	public void setEndPage(int endPage) {
		this.endPage = endPage;
	}

	public int getCurrentPage() {
		return currentPage;
	}

	public void setCurrentPage(int currentPage) {
		this.currentPage = currentPage;
	}

	public int getStartPage() {
		return startPage;
	}

	public void setStartPage(int startPage) {
		this.startPage = startPage;
	}

	public int getTotalPage() {
		return totalPage;
	}

	public void setTotalPage(int totalPage) {
		this.totalPage = totalPage;
	}

	public int getTotalRecord() {
		return totalRecord;
	}

	public void setTotalRecord(int totalRecord) {
		this.totalRecord = totalRecord;
	}

	public int getPageSize() {
		return pageSize;
	}

	public void setPageSize(int pageSize) {
		this.pageSize = pageSize;
	}

}
