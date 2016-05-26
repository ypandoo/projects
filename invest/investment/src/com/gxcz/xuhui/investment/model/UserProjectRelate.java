package com.gxcz.xuhui.investment.model;

public class UserProjectRelate {
    private String uid;

    private String projectId;

    private String userprojRelateId;

    private String projectStatus;

    private String type;
    
    private String permissionFlag ;
//    1.项目跟人员基本关系 
//    2.项目对应的信息管理员
//    3.项目对应的跟投管理员'
    public String getUid() {
        return uid;
    }

    public void setUid(String uid) {
        this.uid = uid == null ? null : uid.trim();
    }

    public String getProjectId() {
        return projectId;
    }

    public void setProjectId(String projectId) {
        this.projectId = projectId == null ? null : projectId.trim();
    }

    public String getUserprojRelateId() {
        return userprojRelateId;
    }

    public void setUserprojRelateId(String userprojRelateId) {
        this.userprojRelateId = userprojRelateId == null ? null : userprojRelateId.trim();
    }

    public String getProjectStatus() {
        return projectStatus;
    }

    public void setProjectStatus(String projectStatus) {
        this.projectStatus = projectStatus == null ? null : projectStatus.trim();
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }

	public String getPermissionFlag() {
		return permissionFlag;
	}

	public void setPermissionFlag(String permissionFlag) {
		this.permissionFlag = permissionFlag;
	}
    
    
}