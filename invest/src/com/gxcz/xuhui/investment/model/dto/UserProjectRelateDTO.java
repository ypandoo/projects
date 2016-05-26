package com.gxcz.xuhui.investment.model.dto;

public class UserProjectRelateDTO extends PagerDTO {
    private String uid;

    private String projectId;

    private String userprojRelateId;

    private String projectStatus;

    private String type;
//    1.项目跟人员基本关系 
//    2.项目对应的信息管理员
//    3.项目对应的跟投管理员'
    private String projectName;
    private String userName;
    private String projectArea;//项目区域
    private String permissionFlag; 

	public String getProjectArea() {
		return projectArea;
	}

	public void setProjectArea(String projectArea) {
		this.projectArea = projectArea;
	}

	public String getProjectName() {
		return projectName;
	}

	public void setProjectName(String projectName) {
		this.projectName = projectName;
	}

	public String getUserName() {
		return userName;
	}

	public void setUserName(String userName) {
		this.userName = userName;
	}

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