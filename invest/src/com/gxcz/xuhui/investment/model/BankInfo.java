package com.gxcz.xuhui.investment.model;

public class BankInfo {
    private String bankId;

    private String uid;

    private String bankNo;

    private String bankName;

    private String bankAttribute;

    public String getBankId() {
        return bankId;
    }

    public void setBankId(String bankId) {
        this.bankId = bankId == null ? null : bankId.trim();
    }

    public String getUid() {
        return uid;
    }

    public void setUid(String uid) {
        this.uid = uid == null ? null : uid.trim();
    }

    public String getBankNo() {
        return bankNo;
    }

    public void setBankNo(String bankNo) {
        this.bankNo = bankNo == null ? null : bankNo.trim();
    }

    public String getBankName() {
        return bankName;
    }

    public void setBankName(String bankName) {
        this.bankName = bankName == null ? null : bankName.trim();
    }

    public String getBankAttribute() {
        return bankAttribute;
    }

    public void setBankAttribute(String bankAttribute) {
        this.bankAttribute = bankAttribute == null ? null : bankAttribute.trim();
    }
}