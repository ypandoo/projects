package com.gxcz.xuhui_ldap.ldap.model;

public class UserDTO {
	/**
	 * 用户姓名
	 */
	private String name;
	/**
	 * 
	 */
	private String whenChanged;
	/**
	 * 帐号状态：1/禁用 2/正常使用
	 */
	private String status;

	/**
	 * 帐号
	 */
	private String sAMAccountName;

	/**
	 * 帐号@cifi.com.cn
	 */
	private String userPrincipalName;

	/**
	 * 行政部门
	 */
	private String department;
	/**
	 * 分公司
	 */
	private String service;
	/**
	 * 公司
	 */
	private String filiale;
	/**
	 * 行政组织
	 */
	private String headquarters;

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getWhenChanged() {
		return whenChanged;
	}

	public void setWhenChanged(String whenChanged) {
		this.whenChanged = whenChanged;
	}

	public String getStatus() {
		return status;
	}

	public void setStatus(String status) {
		this.status = status;
	}

	public String getsAMAccountName() {
		return sAMAccountName;
	}

	public void setsAMAccountName(String sAMAccountName) {
		this.sAMAccountName = sAMAccountName;
	}

	public String getUserPrincipalName() {
		return userPrincipalName;
	}

	public void setUserPrincipalName(String userPrincipalName) {
		this.userPrincipalName = userPrincipalName;
	}

	public String getDepartment() {
		return department;
	}

	public void setDepartment(String department) {
		this.department = department;
	}

	public String getService() {
		return service;
	}

	public void setService(String service) {
		this.service = service;
	}

	public String getFiliale() {
		return filiale;
	}

	public void setFiliale(String filiale) {
		this.filiale = filiale;
	}

	public String getHeadquarters() {
		return headquarters;
	}

	public void setHeadquarters(String headquarters) {
		this.headquarters = headquarters;
	}

	public UserDTO() {
		super();
		// TODO Auto-generated constructor stub
	}

	public UserDTO(String name, String whenChanged, String status, String sAMAccountName, String userPrincipalName, String department, String service, String filiale, String headquarters) {
		super();
		this.name = name;
		this.whenChanged = whenChanged;
		this.status = status;
		this.sAMAccountName = sAMAccountName;
		this.userPrincipalName = userPrincipalName;
		this.department = department;
		this.service = service;
		this.filiale = filiale;
		this.headquarters = headquarters;
	}

	@Override
	public int hashCode() {
		final int prime = 31;
		int result = 1;
		result = prime * result + ((department == null) ? 0 : department.hashCode());
		result = prime * result + ((name == null) ? 0 : name.hashCode());
		result = prime * result + ((sAMAccountName == null) ? 0 : sAMAccountName.hashCode());
		result = prime * result + ((status == null) ? 0 : status.hashCode());
		result = prime * result + ((userPrincipalName == null) ? 0 : userPrincipalName.hashCode());
		return result;
	}

	@Override
	public boolean equals(Object obj) {
		if (this == obj)
			return true;
		if (obj == null)
			return false;
		if (getClass() != obj.getClass())
			return false;
		UserDTO other = (UserDTO) obj;
		if (department == null) {
			if (other.department != null)
				return false;
		} else if (!department.equals(other.department))
			return false;
		if (name == null) {
			if (other.name != null)
				return false;
		} else if (!name.equals(other.name))
			return false;
		if (sAMAccountName == null) {
			if (other.sAMAccountName != null)
				return false;
		} else if (!sAMAccountName.equals(other.sAMAccountName))
			return false;
		if (status == null) {
			if (other.status != null)
				return false;
		} else if (!status.equals(other.status))
			return false;
		if (userPrincipalName == null) {
			if (other.userPrincipalName != null)
				return false;
		} else if (!userPrincipalName.equals(other.userPrincipalName))
			return false;
		return true;
	}

	@Override
	public String toString() {
		return "UserDTO [name=" + name + ", sAMAccountName=" + sAMAccountName + ", userPrincipalName=" + userPrincipalName + "]";
	}

}
