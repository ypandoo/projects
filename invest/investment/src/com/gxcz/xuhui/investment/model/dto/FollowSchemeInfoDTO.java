package com.gxcz.xuhui.investment.model.dto;

import java.math.BigDecimal;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

import com.alibaba.druid.util.StringUtils;
import com.gxcz.xuhui.investment.model.FollowSchemeInfo;

public class FollowSchemeInfoDTO extends PagerDTO {
    private String schemeId;

    private String projectId;

    private String projectReleaseDate;

    private String subscribeStartDate;

    private String subscribeEndDate;

    private String payStartDate;

    private String payEndDate;

    private BigDecimal followAmount;

    private String followAmountDesc;

    private BigDecimal fundPeake;

    private BigDecimal groupForceAmount;

    private BigDecimal groupForceRatio;

    private BigDecimal compForceRatio;

    private BigDecimal compForceAmount;

    private BigDecimal compChoiceRatio;

    private BigDecimal compChoiceAmount;

    private String leverageDes;

    private String followChemeLink;

    private BigDecimal personamt;

    private BigDecimal yxpersonamt;

    private BigDecimal jtpersonamt;

    private String subscribeRemind;
    
    private BigDecimal maxamount;

    private BigDecimal minamount;
    

    public BigDecimal getMaxamount() {
		return maxamount;
	}

	public void setMaxamount(BigDecimal maxamount) {
		this.maxamount = maxamount;
	}

	public BigDecimal getMinamount() {
		return minamount;
	}

	public void setMinamount(BigDecimal minamount) {
		this.minamount = minamount;
	}

	public String getSchemeId() {
        return schemeId;
    }

    public void setSchemeId(String schemeId) {
        this.schemeId = schemeId == null ? null : schemeId.trim();
    }

    public String getProjectId() {
        return projectId;
    }

    public void setProjectId(String projectId) {
        this.projectId = projectId == null ? null : projectId.trim();
    }

    public String getProjectReleaseDate() {
        return projectReleaseDate;
    }

    public void setProjectReleaseDate(String projectReleaseDate) {
        this.projectReleaseDate = projectReleaseDate;
    }

    public String getSubscribeStartDate() {
        return subscribeStartDate;
    }

    public void setSubscribeStartDate(String subscribeStartDate) {
        this.subscribeStartDate = subscribeStartDate;
    }

    public String getSubscribeEndDate() {
        return subscribeEndDate;
    }

    public void setSubscribeEndDate(String subscribeEndDate) {
        this.subscribeEndDate = subscribeEndDate;
    }

    public String getPayStartDate() {
        return payStartDate;
    }

    public void setPayStartDate(String payStartDate) {
        this.payStartDate = payStartDate;
    }

    public String getPayEndDate() {
        return payEndDate;
    }

    public void setPayEndDate(String payEndDate) {
        this.payEndDate = payEndDate;
    }

    public BigDecimal getFollowAmount() {
        return followAmount;
    }

    public void setFollowAmount(BigDecimal followAmount) {
        this.followAmount = followAmount;
    }

    public String getFollowAmountDesc() {
        return followAmountDesc;
    }

    public void setFollowAmountDesc(String followAmountDesc) {
        this.followAmountDesc = followAmountDesc == null ? null : followAmountDesc.trim();
    }

    public BigDecimal getFundPeake() {
        return fundPeake;
    }

    public void setFundPeake(BigDecimal fundPeake) {
        this.fundPeake = fundPeake;
    }

    public BigDecimal getGroupForceAmount() {
        return groupForceAmount;
    }

    public void setGroupForceAmount(BigDecimal groupForceAmount) {
        this.groupForceAmount = groupForceAmount;
    }

    public BigDecimal getGroupForceRatio() {
        return groupForceRatio;
    }

    public void setGroupForceRatio(BigDecimal groupForceRatio) {
        this.groupForceRatio = groupForceRatio;
    }

    public BigDecimal getCompForceRatio() {
        return compForceRatio;
    }

    public void setCompForceRatio(BigDecimal compForceRatio) {
        this.compForceRatio = compForceRatio;
    }

    public BigDecimal getCompForceAmount() {
        return compForceAmount;
    }

    public void setCompForceAmount(BigDecimal compForceAmount) {
        this.compForceAmount = compForceAmount;
    }

    public BigDecimal getCompChoiceRatio() {
        return compChoiceRatio;
    }

    public void setCompChoiceRatio(BigDecimal compChoiceRatio) {
        this.compChoiceRatio = compChoiceRatio;
    }

    public BigDecimal getCompChoiceAmount() {
        return compChoiceAmount;
    }

    public void setCompChoiceAmount(BigDecimal compChoiceAmount) {
        this.compChoiceAmount = compChoiceAmount;
    }

    public String getLeverageDes() {
        return leverageDes;
    }

    public void setLeverageDes(String leverageDes) {
        this.leverageDes = leverageDes == null ? null : leverageDes.trim();
    }

    public String getFollowChemeLink() {
        return followChemeLink;
    }

    public void setFollowChemeLink(String followChemeLink) {
        this.followChemeLink = followChemeLink == null ? null : followChemeLink.trim();
    }

    public BigDecimal getPersonamt() {
        return personamt;
    }

    public void setPersonamt(BigDecimal personamt) {
        this.personamt = personamt;
    }

    public BigDecimal getYxpersonamt() {
        return yxpersonamt;
    }

    public void setYxpersonamt(BigDecimal yxpersonamt) {
        this.yxpersonamt = yxpersonamt;
    }

    public BigDecimal getJtpersonamt() {
        return jtpersonamt;
    }

    public void setJtpersonamt(BigDecimal jtpersonamt) {
        this.jtpersonamt = jtpersonamt;
    }

    public String getSubscribeRemind() {
        return subscribeRemind;
    }

    public void setSubscribeRemind(String subscribeRemind) {
        this.subscribeRemind = subscribeRemind == null ? null : subscribeRemind.trim();
    }
    public FollowSchemeInfo toModelVO(FollowSchemeInfoDTO record) throws ParseException{
    	SimpleDateFormat sdf=new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
    	Date projectReleaseDate = null;
    	Date subscribeStartDate = null;
    	Date subscribeEndDate = null;
    	Date payStartDate = null;
    	Date payEndDate = null;
    	if(!StringUtils.isEmpty(record.getProjectReleaseDate())) 
    		projectReleaseDate=sdf.parse(record.getProjectReleaseDate());
    	if(!StringUtils.isEmpty(record.getSubscribeStartDate())) 
    		subscribeStartDate=sdf.parse(record.getSubscribeStartDate());
    	if(!StringUtils.isEmpty(record.getSubscribeEndDate())) 
    		subscribeEndDate=sdf.parse(record.getSubscribeEndDate());
    	if(!StringUtils.isEmpty(record.getPayStartDate())) 
    		payStartDate=sdf.parse(record.getPayStartDate());
    	if(!StringUtils.isEmpty(record.getPayEndDate())) 
    		payEndDate=sdf.parse(record.getPayEndDate());
    	FollowSchemeInfo followSchemeInfo=new FollowSchemeInfo(record.getSchemeId(),record.getProjectId(), projectReleaseDate, subscribeStartDate, subscribeEndDate, payStartDate,payEndDate,record.getFollowAmount(),record.getFollowAmountDesc(),record.getFundPeake(),record.getGroupForceAmount(),record.getGroupForceRatio(),record.getCompForceRatio(),record.getCompForceAmount(),record.getCompChoiceRatio(),record.getCompChoiceAmount(),record.getLeverageDes(),record.getFollowChemeLink(),record.getPersonamt(),record.getYxpersonamt(),record.getJtpersonamt(),record.getSubscribeRemind(),record.getMaxamount(),record.getMinamount());
    	return followSchemeInfo;
    }
}