package com.gxcz.xuhui.investment.model;

import java.math.BigDecimal;
import java.util.Date;

public class ForceFollowInfo extends BaseModel{
    private String forceFollowId;

    private String projectId;
    
    private String uid;

    private String name;

    private String company;

    private String department;

    private String duty;

    private BigDecimal toplimit;

    private BigDecimal downlimit;

    private String remark;

    private Date createtime;
    
    private String forceType;

    public String getForceFollowId() {
        return forceFollowId;
    }

    public void setForceFollowId(String forceFollowId) {
        this.forceFollowId = forceFollowId == null ? null : forceFollowId.trim();
    }

    public String getProjectId() {
        return projectId;
    }

    public void setProjectId(String projectId) {
        this.projectId = projectId == null ? null : projectId.trim();
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name == null ? null : name.trim();
    }

    public String getUid() {
		return uid;
	}

	public void setUid(String uid) {
		this.uid = uid;
	}

	public String getCompany() {
        return company;
    }

    public void setCompany(String company) {
        this.company = company == null ? null : company.trim();
    }

    public String getDepartment() {
        return department;
    }

    public void setDepartment(String department) {
        this.department = department == null ? null : department.trim();
    }

    public String getDuty() {
        return duty;
    }

    public void setDuty(String duty) {
        this.duty = duty == null ? null : duty.trim();
    }

    public BigDecimal getToplimit() {
        return toplimit;
    }

    public void setToplimit(BigDecimal toplimit) {
        this.toplimit = toplimit;
    }

    public BigDecimal getDownlimit() {
        return downlimit;
    }

    public void setDownlimit(BigDecimal downlimit) {
        this.downlimit = downlimit;
    }

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark == null ? null : remark.trim();
    }

    public Date getCreatetime() {
        return createtime;
    }

    public void setCreatetime(Date createtime) {
        this.createtime = createtime;
    }

	public String getForceType() {
		return forceType;
	}

	public void setForceType(String forceType) {
		this.forceType = forceType;
	}
}