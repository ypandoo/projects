package com.gxcz.xuhui.investment.service.impl;

import java.util.List;

import com.gxcz.xuhui.investment.model.ProjectBasicInfo;
import com.gxcz.xuhui.investment.model.dto.ProjectBasicInfoDTO;

public interface IProjectBasicService {
	int deleteByPrimaryKey(String projectId);

    int insert(ProjectBasicInfo record);

    int insertSelective(ProjectBasicInfo record);

    ProjectBasicInfo selectByPrimaryKey(String projectId);

    int updateByPrimaryKeySelective(ProjectBasicInfo record);

    int updateByPrimaryKey(ProjectBasicInfo record);
    
    List<ProjectBasicInfoDTO> getProjectList(ProjectBasicInfoDTO projectBasicInfoDTO);
    
    String fetchPorjectSubscribeProtocalList(String projectId) throws Exception;
}
