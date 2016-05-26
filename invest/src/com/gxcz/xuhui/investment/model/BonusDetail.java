package com.gxcz.xuhui.investment.model;

import java.math.BigDecimal;
import java.util.Date;

public class BonusDetail {
    private String bonusId;

    private String projectId;

    private String subscribeType;

    private String subscribePackageName;

    private BigDecimal subscribeAmount;

    private BigDecimal bonusTimes;

    private Date bonusDate;

    private BigDecimal bonusAmount;

    private String completeSubscribeRecord;

    private String userid;
    
    private String number;
    
    // 临时字段
    private String recordNumber;

    public String getBonusId() {
        return bonusId;
    }

    public void setBonusId(String bonusId) {
        this.bonusId = bonusId == null ? null : bonusId.trim();
    }

    public String getProjectId() {
        return projectId;
    }

    public void setProjectId(String projectId) {
        this.projectId = projectId == null ? null : projectId.trim();
    }

    public String getSubscribeType() {
        return subscribeType;
    }

    public void setSubscribeType(String subscribeType) {
        this.subscribeType = subscribeType == null ? null : subscribeType.trim();
    }

    public String getSubscribePackageName() {
        return subscribePackageName;
    }

    public void setSubscribePackageName(String subscribePackageName) {
        this.subscribePackageName = subscribePackageName == null ? null : subscribePackageName.trim();
    }

    public BigDecimal getSubscribeAmount() {
        return subscribeAmount;
    }

    public void setSubscribeAmount(BigDecimal subscribeAmount) {
        this.subscribeAmount = subscribeAmount;
    }

    public BigDecimal getBonusTimes() {
        return bonusTimes;
    }

    public void setBonusTimes(BigDecimal bonusTimes) {
        this.bonusTimes = bonusTimes;
    }

    public Date getBonusDate() {
        return bonusDate;
    }

    public void setBonusDate(Date bonusDate) {
        this.bonusDate = bonusDate;
    }

    public BigDecimal getBonusAmount() {
        return bonusAmount;
    }

    public void setBonusAmount(BigDecimal bonusAmount) {
        this.bonusAmount = bonusAmount;
    }

    public String getCompleteSubscribeRecord() {
        return completeSubscribeRecord;
    }

    public void setCompleteSubscribeRecord(String completeSubscribeRecord) {
        this.completeSubscribeRecord = completeSubscribeRecord == null ? null : completeSubscribeRecord.trim();
    }

    public String getUserid() {
        return userid;
    }

    public void setUserid(String userid) {
        this.userid = userid == null ? null : userid.trim();
    }

	public String getNumber() {
		return number;
	}

	public void setNumber(String number) {
		this.number = number;
	}

	public String getRecordNumber() {
		return recordNumber;
	}

	public void setRecordNumber(String recordNumber) {
		this.recordNumber = recordNumber;
	}
    
    
}